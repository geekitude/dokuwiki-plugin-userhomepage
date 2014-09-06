<?php
/**
 * Userhomepage plugin main file
 * Previous authors: James GuanFeng Lin, Mikhail I. Izmestev, Daniel Stonier
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');

require_once (DOKU_PLUGIN . 'action.php');
require_once (DOKU_PLUGIN . '/acl/admin.php');

class action_plugin_userhomepage extends DokuWiki_Action_Plugin{
    function register(&$controller) {
        $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'redirect',array());
        $controller->register_hook('AUTH_LOGIN_CHECK', 'AFTER', $this, 'templates',array());
    }
    function templates(&$event, $param) {
        if (!file_exists(DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt')) {
            if (file_exists(DOKU_INC.$this->getConf('templatepath'))) {
                if (!copy(DOKU_INC.$this->getConf('templatepath'), DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt')) {
//                    echo ' An error occured while attempting to copy old template to '.DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt';
//                } else {
//                    echo ' Successfully copied private template.';
                }
            } elseif (!copy(DOKU_INC.'lib/plugins/userhomepage/userhomepage_private.default', DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt')) {
//                echo ' An error occured while attempting to copy userhomepage_private.default to '.DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt';
//            } else {
//                echo ' Successfully copied private template.';
            }
        }
        if (!file_exists(DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt')) {
            if (!copy(DOKU_INC.'lib/plugins/userhomepage/userhomepage_public.default', DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt')) {
//                echo ' An error occured while attempting to copy userhomepage_public.default to '.DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt';
//            } else {
//                echo ' Successfully copied public template.';
            }
        }
    }
    function redirect(&$event, $param) {
        global $conf;
        global $INFO;
        $created = array();
        // If user just logged in
        if (($_SERVER['REMOTE_USER']!=null)&&($_REQUEST['do']=='login')) {
            // Determine targets
            if ($this->getConf('group_by_name')) {
                // private:s:simon
                $this->private_ns = cleanID($this->getConf('users_namespace').':'.strtolower(substr($this->privateNamespace(), 0, 1)).':'. $this->privateNamespace());
            } else {
                // private:simon
                $this->private_ns = cleanID($this->getConf('users_namespace').':'. $this->privateNamespace());
            }
            // private:simon:start.txt
            $this->private_page = cleanID($this->private_ns . ':' . $this->privatePage());
            // user:simon.txt
            $this->public_page = cleanID($this->getConf('public_pages_ns').':'. $_SERVER['REMOTE_USER']);
            // if private page doesn't exists, create it (from template)
            if ($this->getConf('create_private_ns') && !page_exists($this->private_page) && !checklock($this->private_page) && !checkwordblock()) {
                // set acl's if requested
                if ( $this->getConf('set_permissions') == 1 ) {
                    $acl = new admin_plugin_acl();
                    // Old user-page ACL (version 3.0.4):
                    // $ns = cleanID($this->private_ns.':'.$this->privatePage());
                    // New user-namespace ACL (based on Luitzen van Gorkum and Harmen P. (Murf) de Ruiter suggestions):
                    $ns = cleanID($this->private_ns).':*';
                    $acl->_acl_add($this->getConf('users_namespace').':*', '@ALL', (int)$this->getConf('set_permissions_others'));
                    $acl->_acl_add($this->getConf('users_namespace').':*', '@user', (int)$this->getConf('set_permissions_others'));
                    $acl->_acl_add($ns, strtolower($_SERVER['REMOTE_USER']), AUTH_DELETE);
                }
                // If the 2 lines concerning set_permissions_others above allready existed in conf/acl.auth.php file they've been duplicated so let's read the file
                $lines = file(DOKU_INC.'conf/acl.auth.php');
                // Only keep unique lines (OK, we loose an empty comment line...)
                $lines = array_unique($lines);
                // Write things back to conf/acl.auth.php
                file_put_contents(DOKU_INC.'conf/acl.auth.php', implode($lines));
                // Read private start page template
                $this->private_page_template = DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt';
                // Create private page
                lock($this->private_page);
                saveWikiText($this->private_page,$this->_template_private(),$lang['created']);
                unlock($this->private_page);
                // Note that we created private page
                $created['private'] = true;
            }
            // Public page?
            // If public page doesn't exists, create it (from template)
            if ($this->getConf('create_public_page') && !page_exists($this->public_page) && !checklock($this->public_page) && !checkwordblock()) {
                // Read public page template
                $this->public_page_template = DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt';
                // Create public page
                lock($this->public_page);
                saveWikiText($this->public_page,$this->_template_public(),$lang['created']);
                unlock($this->public_page);
                // Note that we created public page
                $created['public'] = true;
            }
            // If Translation plugin is active, determine if we're at wikistart
            if (!plugin_isdisabled('translation')) {
                foreach (explode(' ',$conf['plugin']['translation']['translations']) as $lang){
                    if (getID() === $lang.':'.$conf['start']) {
                        $wikistart = true;
                        break;
                    }
                }
            }
            // If Public page was just created, redirect to it and edit
            if ($created['public']) {
                send_redirect(wl($this->public_page, 'do=edit', false, '&'));
            // Else if private start page was just created and edit option is set, redirect to it and edit
            } elseif (($created['private']) && ($this->getConf('edit_before_create'))) {
                send_redirect(wl($this->private_page, 'do=edit', false, '&'));
            // Else if the user was not at a specific page (beside wiki start) and private page exists, redirect to it.
            } elseif ((($_REQUEST['id']==$conf['start'])||(!isset($_REQUEST['id']))||($wikistart)) && (page_exists($this->private_page))) {
                send_redirect(wl($this->private_page));
            }
        }
    }
    function privateNamespace() {
        if ( $this->getConf('use_name_string')) {
            global $INFO;
            $raw_string = $INFO['userinfo']['name'];
            // simon_delage
            return $raw_string;
        } else {
            // simon
            return strtolower($_SERVER['REMOTE_USER']);
        }
    }
    function privatePage() {
        if ( $this->getConf('use_start_page')) {
            global $conf;
            return $conf['start'];
        } else {
            return $this->homeNamespace();
        }
    }
    function _template_private() {
        global $INFO;
        $content = io_readFile($this->private_page_template, false);
        // Improved template process to use any replacement patterns from https://www.dokuwiki.org/namespace_templates
        // Code by Christian Nancy
		// Build a fake data structure for the parser
		$data = array('tpl' => $content, 'id' => $this->private_page);
		// Use the built-in parser
		$content = parsePageTemplate($data);
        return $content;
    }
    function _template_public() {
        global $INFO;
        $content = io_readFile($this->public_page_template, false);
        // Improved template process to use any replacement patterns from https://www.dokuwiki.org/namespace_templates
        // Code by Christian Nancy
		// Build a fake data structure for the parser
		$data = array('tpl' => $content, 'id' => $this->public_page);
		// Use the built-in parser
		$content = parsePageTemplate($data);
        return $content;
    }
}
