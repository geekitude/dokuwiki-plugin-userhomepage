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
        $controller->register_hook('AUTH_LOGIN_CHECK', 'AFTER', $this, 'init',array());
        $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'redirect',array());
    }

    function init(&$event, $param) {
        global $conf;
        global $INFO;
        // CREATE PRIVATE NAMESPACE START PAGE TEMPLATES IF NEEDED
        if (($this->getConf('create_private_ns')) && (!file_exists(DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt'))) {
            // If old template exists, use it as source to create userhomepage_private.txt in templates_path
            if (file_exists(DOKU_INC.$this->getConf('templatepath'))) {
                $source_private = DOKU_INC.$this->getConf('templatepath');
            } else {
                $source_private = DOKU_INC.'lib/plugins/userhomepage/lang/'.$conf['lang'].'/userhomepage_private.default';
            }
            if (!copy($source_private, DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt')) {
//                echo ' An error occured while attempting to copy userhomepage_private.default to '.DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt';
//            } else {
//                echo ' Successfully copied private template.';
            }
        }
        // CREATE PUBLIC PAGE TEMPLATES IF NEEDED
        if (($this->getConf('create_public_page')) && (!file_exists(DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt'))) {
            if (!copy(DOKU_INC.'lib/plugins/userhomepage/lang/'.$conf['lang'].'/userhomepage_public.default', DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt')) {
//                echo ' An error occured while attempting to copy userhomepage_public.default to '.DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt';
//            } else {
//                echo ' Successfully copied public template.';
            }
        }
        // TARGETS
        if ($this->getConf('group_by_name')) {
            // private:s:simon or private:s:simon_delage
            $this->private_ns = cleanID($this->getConf('users_namespace').':'.substr($this->privateNamespace(), 0, 1).':'. $this->privateNamespace());
        } else {
            // private:simon or private:simon_delage
            $this->private_ns = cleanID($this->getConf('users_namespace').':'. $this->privateNamespace());
        }
        // ...:start.txt or ...:simon_delage.txt
        $this->private_page = $this->private_ns . ':' . $this->privateStart();
        // user:simon.txt
        $this->public_page = cleanID($this->getConf('public_pages_ns').':'. $_SERVER['REMOTE_USER']);
        // ACL
        $acl = new admin_plugin_acl();
        // For private namespace
        if (($this->getConf('create_private_ns')) && ($this->getConf('set_permissions'))) {
            // If use_name_string is enabled, we can't use ACL wildcard
            if ($this->getConf('use_name_string')) {
                $ns = $this->private_ns.':*';
                $acl->_acl_add($ns, $INFO['userinfo']['name'], AUTH_DELETE);
            } else {
                $acl->_acl_add(cleanID($this->getConf('users_namespace')).':%USER%:*', '%USER%', AUTH_DELETE);
            }
            $acl->_acl_add(cleanID($this->getConf('users_namespace')).':*', '@ALL', (int)$this->getConf('set_permissions_others'));
            $acl->_acl_add(cleanID($this->getConf('users_namespace')).':*', '@user', (int)$this->getConf('set_permissions_others'));
        }
        // For public user pages
        if (($this->getConf('create_public_page')) && ($this->getConf('set_permissions_public'))) {
            $acl->_acl_add(cleanID($this->getConf('public_pages_ns')).':%USER%', '%USER%', AUTH_EDIT);
            $acl->_acl_add(cleanID($this->getConf('public_pages_ns')).':*', '@ALL', AUTH_READ);
            $acl->_acl_add(cleanID($this->getConf('public_pages_ns')).':*', '@user', AUTH_READ);
        }
        // Some lines in conf/acl.auth.php file have probably been duplicated so let's read the file
        $lines = file(DOKU_INC.'conf/acl.auth.php');
        // And only keep unique lines (OK, we loose an empty comment line...)
        $lines = array_unique($lines);
        // Write things back to conf/acl.auth.php
        file_put_contents(DOKU_INC.'conf/acl.auth.php', implode($lines));
    }

    function redirect(&$event, $param) {
        global $conf;
        global $INFO;
        $created = array();
        // If user just logged in
        if (($_SERVER['REMOTE_USER']!=null)&&($_REQUEST['do']=='login')) {
            // if private page doesn't exists, create it (from template)
            if ($this->getConf('create_private_ns') && !page_exists($this->private_page) && !checklock($this->private_page) && !checkwordblock()) {
                // Target private start page template
                $this->private_page_template = DOKU_INC.$this->getConf('templates_path').'/userhomepage_private.txt';
                // Create private page
                lock($this->private_page);
                saveWikiText($this->private_page,$this->applyTemplate('private'),$lang['created']);
                unlock($this->private_page);
                // Note that we created private page
                $created['private'] = true;
            }
            // Public page?
            // If public page doesn't exists, create it (from template)
            if ($this->getConf('create_public_page') && !page_exists($this->public_page) && !checklock($this->public_page) && !checkwordblock()) {
                // Target public page template
                $this->public_page_template = DOKU_INC.$this->getConf('templates_path').'/userhomepage_public.txt';
                // Create public page
                lock($this->public_page);
                saveWikiText($this->public_page,$this->applyTemplate('public'),$lang['created']);
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
            $raw_string = cleanID($INFO['userinfo']['name']);
            // simon_delage
            return $raw_string;
        } else {
            // simon
            return strtolower($_SERVER['REMOTE_USER']);
        }
    }

    function privateStart() {
        if ($this->getConf('use_start_page')) {
            global $conf;
            return cleanID($conf['start']);
        } else {
            return $this->privateNamespace();
        }
    }

    function applyTemplate($type) {
        global $INFO;
        global $lang;
        if ($type == 'private') {
            $content = io_readFile($this->private_page_template, false);
        } elseif ($type == 'public') {
            $content = io_readFile($this->public_page_template, false);
        }
        $content = str_replace('@TARGETPRIVATENS@', $this->private_ns, $content);
        $content = str_replace('@TARGETPUBLICPAGE@', $this->public_page, $content);
        $content = str_replace('@TARGETPUBLICNS@', cleanID($this->getConf('public_pages_ns')), $content);
        // Improved template process to use standard replacement patterns from https://www.dokuwiki.org/namespace_templates based on code proposed by Christian Nancy
        // Build a fake data structure for the parser
        $data = array('tpl' => $content, 'id' => $this->private_page);
        // Use the built-in parser
        $content = parsePageTemplate($data);
        return $content;
    }

}
