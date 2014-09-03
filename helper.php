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

    function getPrivateNs() {
        if ($this->getConf('group_by_name')) {
            // private:s:simon
            $this->private_ns = cleanID($this->getConf('users_namespace').':'.strtolower(substr($this->privateNamespace(), 0, 1)).':'. $this->privateNamespace());
        } else {
            // private:simon
            $this->private_ns = cleanID($this->getConf('users_namespace').':'. $this->privateNamespace());
        }
        // private:simon:start.txt
        return $this->private_page = cleanID($this->private_ns . ':' . $this->privatePage());

    }

    function getPublicPage() {
        return $this->public_page = cleanID($this->getConf('public_pages_ns').':'. $_SERVER['REMOTE_USER']);
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

//    //draws a home button, used by calls from main.php in template folder
//    function homeButton() {
//        $this->init();
//        if ($_SERVER['REMOTE_USER']!=null) {
//            echo '<form class="button btn_show" method="post" action="doku.php?id='.$this->private_page.'"><input class="button" type="submit" value="Home"/></form>';
//        }
//    }
//    //draws a home link, used by calls from main.php in template folder
//    function privateLink() {
//        $this->init();
//        if ($_SERVER['REMOTE_USER']!=null) {
//            echo '<li>'.$lang['loggedinas'].' : <a href="'.wl($privatens).'"  class="iw_user" rel="nofollow" title="Private NS">'.$INFO['userinfo']['name'].' ('.$_SERVER['REMOTE_USER'].')</a></li>';
//            echo '<a href="doku.php?id='.$this->private_page.'">Home</a>';
//        }
//    }

}
