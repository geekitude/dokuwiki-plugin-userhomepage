<?php
/**
 * Helper Component for the Userhomepage Plugin
 *
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class helper_plugin_userhomepage extends DokuWiki_Plugin {

    // Returns the ID of current user's private namespace start page (even if it doesn't exist)
    function getPrivateID() {
        if ($this->getConf('group_by_name')) {
            // private:s:simon or private:s:simon_delage
            $this->private_ns = cleanID($this->getConf('users_namespace').':'.strtolower(substr($this->privateNamespace(), 0, 1)).':'. $this->privateNamespace());
        } else {
            // private:simon or private:simon_delage
            $this->private_ns = cleanID($this->getConf('users_namespace').':'. $this->privateNamespace());
        }
        // ...:start.txt
        return $this->private_page = $this->private_ns.':'.$this->privateStart();
    }

    // Returns the ID of current user's public page (even if it doesn't exist)
    function getPublicID() {
        return $this->public_page = cleanID($this->getConf('public_pages_ns').':'. $_SERVER['REMOTE_USER']);
    }

    function getPrivateLink($param=null) {
        global $INFO;
        global $lang;
        if ($param == "loggedinas") {
            return '<li>'.$lang['loggedinas'].' <a href="'.wl($this->getPrivateID()).'"  class="uhp_private" rel="nofollow" title="'.$this->getLang('privatenamespace').'">'.$INFO['userinfo']['name'].' ('.$_SERVER['REMOTE_USER'].')</a></li>';
        } elseif ($param != null) {
            return '<a href="'.wl($this->getPrivateID()).'"  rel="nofollow" title="'.$this->getLang('privatenamespace').'">'.$param.'</a>';
        } else {
            return '<a href="'.wl($this->getPrivateID()).'"  rel="nofollow" title="'.$this->getLang('privatenamespace').'">'.$this->getLang('privatenamespace').'</a>';
        }
    }

    function getPublicLink($param=null) {
        global $INFO;
        global $lang;
        if ($param == "loggedinas") {
            return '<li>'.$lang['loggedinas'].' <a href="'.wl($this->getPublicID()).'"  class="uhp_public" rel="nofollow" title="'.$this->getLang('publicpage').'">'.$INFO['userinfo']['name'].' ('.$_SERVER['REMOTE_USER'].')</a></li>';
        } elseif ($param != null) {
            return '<a href="'.wl($this->getPublicID()).'"  rel="nofollow" title="'.$this->getLang('publicpage').'">'.$param.'</a>';
        } else {
            return '<a href="'.wl($this->getPublicID()).'"  rel="nofollow" title="'.$this->getLang('publicpage').'">'.$this->getLang('publicpage').'</a>';
        }
    }

    function getComplexLoggedInAs() {
        global $INFO;
        global $lang;
        // If user's private namespace and public page exist, return a 'Logged in as' string with both style links)
        if ((page_exists($this->getPrivateID())) && (page_exists($this->getPublicID()))) {
            return '<li>'.$lang['loggedinas'].' <a href="'.wl($this->getPrivateID()).'"  class="uhp_private" rel="nofollow" title="'.$this->getLang('privatenamespace').'">'.$INFO['userinfo']['name'].'</a> (<a href="'.wl($this->getPublicID()).'"  class="uhp_public" rel="nofollow" title="'.$this->getLang('publicpage').'">'.$_SERVER['REMOTE_USER'].'</a>)</li>';
        // Else if only private namespace exists, return 'Logged in as' string with private namespace link
        } elseif (page_exists($this->getPrivateID())) {
            return $this->getPrivateLink("loggedinas");
        // Else if only ppublic page exists, return 'Logged in as' string with public page link
        } elseif (page_exists($this->getPublicID())) {
            return $this->getPublicLink("loggedinas");
        // Else default back to standard string
        } else {
            echo '<li class="user">';
                tpl_userinfo(); /* 'Logged in as ...' */
            echo '</li>';
        }
    }

	function getButton($type="private") {
        global $INFO;
        global $lang;
		if ($type == "private") {
			echo '<form class="button btn_show" method="post" action="doku.php?id='.$this->getPrivateID().'"><input class="button" type="submit" value="'.$this->getLang('privatenamespace').'"/></form>';
        } elseif ($type == "public") {
			echo '<form class="button btn_show" method="post" action="doku.php?id='.$this->getPublicID().'"><input class="button" type="submit" value="'.$this->getLang('publicpage').'"/></form>';
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
        if ( $this->getConf('use_start_page')) {
            global $conf;
            return cleanID($conf['start']);
        } else {
            return $this->privateNamespace();
        }
    }

}
