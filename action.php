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
//        $controller->register_hook('HTML_PAGE_FROMTEMPLATE', 'BEFORE', $this, 'page_template',array());
    }
    function redirect(&$event, $param) {
        global $conf;
        global $INFO;
        if (($_SERVER['REMOTE_USER']!=null)&&($_REQUEST['do']=='login')) {
            $this->init();
            $id = $this->private_page;
            // if page doesn't exists, create it
            if ($this->getConf('create_private_ns') && !page_exists($id) && !checklock($id) && !checkwordblock()) {
                // set acl's if requested
                if ( $this->getConf('set_permissions') == 1 ) {
                    $acl = new admin_plugin_acl();
                    // Old user-page ACL (version 3.0.4):
                    // $ns = cleanID($this->private_ns.':'.$this->privatePage());
                    // New user-namespace ACL:
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
                if (!$this->getConf('edit_before_create')) {
                    //writes the user info to private page
                    lock($id);
                    saveWikiText($id,$this->_template_private(),$lang['created']);
                    unlock($id);
                }
                // redirect to edit home page
                send_redirect(wl($id, array("do" => ($this->getConf('edit_before_create'))?"edit":"show"), false, "&"));
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
            // If the user was at a specific page (beside wiki start), then don't redirect to personal page.
            if (($_REQUEST['id']==$conf['start'])||(!isset($_REQUEST['id']))||($wikistart)) {
                send_redirect(wl($id));
            }
        }
    }
    function init() {
        global $conf;
        require_once (DOKU_INC.'inc/search.php');
        if($_SERVER['REMOTE_USER']!=null) {
            $this->doku_page_path = $conf['datadir'];
            $this->private_page_template = DOKU_INC . $this->getConf('templatepath');
            if ($this->getConf('group_by_name')) {
                // private:s:simon
                $this->private_ns = cleanID($this->getConf('users_namespace').':'.strtolower(substr($this->privateNamespace(), 0, 1)).':'. $this->privateNamespace());
            } else {
                // private:simon
                $this->private_ns = cleanID($this->getConf('users_namespace').':'. $this->privateNamespace());
            }
            // private:simon:start.txt
            $this->private_page= cleanID($this->private_ns . ':' . $this->privatePage());
            // Public page?
            if ($this->getConf('create_public_page')) {
				$this->public_page_template = DOKU_INC . $this->getConf('templatepathpublic');
                // user:simon.txt
				$this->public_page= cleanID($this->getConf('public_pages_ns').':'. $_SERVER['REMOTE_USER']);
				// if page doesn't exists, create it
				if ($this->getConf('create_public_page') && !page_exists($this->public_page) && !checklock($this->public_page) && !checkwordblock()) {
					//writes the user info to public page
					lock($this->public_page);
					saveWikiText($this->public_page,$this->_template_public(),$lang['created']);
					unlock($this->public_page);
				}
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
	    };
	}
    function _template_private() {
        global $INFO;
        $content = io_readFile($this->private_page_template, false);
        $name = $INFO['userinfo']['name'];
        $user = strtolower($_SERVER['REMOTE_USER']);
        $content = str_replace('@NAME@',$name,$content);
        $content = str_replace('@USER@',$user,$content);
        return $content;
    }
    function _template_public() {
        global $INFO;
        $content = io_readFile($this->public_page_template, false);
        $name = $INFO['userinfo']['name'];
        $user = strtolower($_SERVER['REMOTE_USER']);
        $content = str_replace('@NAME@',$name,$content);
        $content = str_replace('@USER@',$user,$content);
        return $content;
    }
    //draws a home button, used by calls from main.php in template folder
    function homeButton() {
        $this->init();
        if ($_SERVER['REMOTE_USER']!=null) {
            echo '<form class="button btn_show" method="post" action="doku.php?id='.$this->private_page.'"><input class="button" type="submit" value="Home"/></form>';
        }
    }
	//draws a home link, used by calls from main.php in template folder
    function homeLink() {
        $this->init();
        if ($_SERVER['REMOTE_USER']!=null) {
            echo '<a href="doku.php?id='.$this->private_page.'">Home</a>';
        }
    }
}
