<?php
// AUTHOR James Lin
// Version 3.0.4 
// FIXED by Simon Delage <simon.geekitude@gmail.com> on 2014-08-30

if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
 
require_once (DOKU_PLUGIN . 'action.php');
require_once (DOKU_PLUGIN . '/acl/admin.php');
 
class action_plugin_userhomepage extends DokuWiki_Action_Plugin
{
        private $userHomePagePath = '';
        private $userHomePageTemplate = '';
	private $home_wiki_page = '';
	private $home_wiki_ns = '';
	private $doku_page_path = '';
	private $home_page_template = '';

	function init()
	{
		global $conf;
		require_once (DOKU_INC.'inc/search.php');
		if($_SERVER['REMOTE_USER']!=null)
                {
                        //$this->doku_page_path = DOKU_INC . 'data/pages';
			$this->doku_page_path = $conf['datadir'];
                        $this->home_page_template = DOKU_INC . $this->getConf('templatepath');
                        if ($this->getConf('group_by_name'))
                        {
                                // people:g:gme']li8600
                                $this->home_wiki_ns = cleanID($this->getConf('users_namespace').':'.strtolower(substr($this->homeNamespace(), 0, 1)).':'. $this->homeNamespace());
                        }
                        else
                        {
                                // people:gli8600
                                $this->home_wiki_ns = cleanID($this->getConf('users_namespace').':'. $this->homeNamespace());
                        }
                        // people:gli8600:start.txt
                        $this->home_wiki_page= cleanID($this->home_wiki_ns . ':' . $this->homePage());
                }	
	}
	
	//draws a home link, used by calls from main.php in template folder
	function homeButton()
	{
		$this->init();
		if ($_SERVER['REMOTE_USER']!=null)
		{
			echo '<form class="button btn_show" method="post" action="doku.php?id='.$this->home_wiki_page.'"><input class="button" type="submit" value="Home"/></form>';
		}
	}
	
	//draws a home button, used by calls from main.php in template folder
	function homeLink()
	{
		$this->init();
		if ($_SERVER['REMOTE_USER']!=null)
		{
			echo '<a href="doku.php?id='.$this->home_wiki_page.'">Home</a>';
		}
	}

	function homeNamespace() {
	    if ( $this->getConf('use_name_string')) {
	        global $INFO;
                $raw_string = $INFO['userinfo']['name'];
		//james_lin
	        return $raw_string;
	    } else {
		//gli8600
                return strtolower($_SERVER['REMOTE_USER']);
	    };
	}

	function homePage() {
	    if ( $this->getConf('use_start_page')) {
	        global $conf;
                return $conf['start'];
	    } else {
	        return $this->homeNamespace();
	    };
	}

        function _template() {
            global $INFO;
            $content = io_readFile($this->home_page_template, false);
            $name = $INFO['userinfo']['name'];
            $user = strtolower($_SERVER['REMOTE_USER']);
            $content = str_replace('@NAME@',$name,$content);
            $content = str_replace('@USER@',$user,$content);
            return $content;
        }

        function page_template(&$event, $param)
        {
            $this->init();
            if($this->home_wiki_page && $this->home_wiki_page == $event->data[0]) {
                    if(!$event->result) // FIXME: another template applied?
                        $event->result = $this->_template();
                    $event->preventDefault();
            }
        }

        function redirect(&$event, $param)
        {
            global $conf;
	    global $INFO;

            if (($_SERVER['REMOTE_USER']!=null)&&($_REQUEST['do']=='login'))
            {
		$this->init();
		$id = $this->home_wiki_page;

                //check if page not exists, create it
                if (!page_exists($id) && !checklock($id) && !checkwordblock())
                {
		    // set acl's if requested
                    if ( $this->getConf('set_permissions') == 1 )
                    {
                        $acl = new admin_plugin_acl();
                        // Old user-page ACL:
                        // $ns = cleanID($this->home_wiki_ns.':'.$this->homePage());
                        // New user-namespace ACL:
                        $ns = cleanID($this->home_wiki_ns).':*';
                        $acl->_acl_add($this->getConf('users_namespace').':*', '@ALL', (int)$this->getConf('set_permissions_others'));
                        $acl->_acl_add($this->getConf('users_namespace').':*', '@user', (int)$this->getConf('set_permissions_others'));
                        $acl->_acl_add($ns, strtolower($_SERVER['REMOTE_USER']), AUTH_DELETE);                    }
                        // If the 2 lines concerning set_permissions_others above allready existed in conf/acl.auth.php file they've been duplicated so let's read the file
                        $lines = file(DOKU_INC.'conf/acl.auth.php');
                        // Only keep unique lines (OK, we loose an empty comment line...)
                        $lines = array_unique($lines);
                        // Write things back to conf/acl.auth.php
                        file_put_contents(DOKU_INC.'conf/acl.auth.php', implode($lines));;
                    if (!$this->getConf('edit_before_create'))
                    {
                        //writes the user info to page
                        lock($id);
                        saveWikiText($id,$this->_template(),$lang['created']);
                        unlock($id);
                    }
		    // redirect to edit home page
                    send_redirect(wl($id, array("do" => ($this->getConf('edit_before_create'))?"edit":"show"), false, "&"));
                }
		// if the user was at a specific page, then don't redirect to personal page.
		if (($_REQUEST['id']==$conf['start'])||(!isset($_REQUEST['id'])))
		{
                    send_redirect(wl($id));
		}
            }
        }
 
        function getInfo()
        {
                return  array
                (
                        'name' => 'User Home Page',
                        'email' => 'simon.geekitude@gmail.com',
                        'date' => '2009-05-28',
                        'author' => 'Simon Delage (previously James GuanFeng Lin, Mikhail I. Izmestev & Daniel Stonier)',
                        'desc' => 'auto redirects users to <create> their homepage',
                        'url' => 'https://www.dokuwiki.org/plugin:userhomepage'
                );
        }
 
        function register(&$controller)
        {
                $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'redirect',array());
                $controller->register_hook('HTML_PAGE_FROMTEMPLATE', 'BEFORE', $this, 'page_template',array());
        }
}
