<?php
/*
 * Userhomepage plugin, configuration metadata
 * FIXED by Simon Delage <simon.geekitude@gmail.com> on 2014-08-30
 */

$meta['use_name_string'] = array('onoff');      // use name string instead of login string for the user's namespace
$meta['use_start_page'] = array('onoff');      // use start page instead of namespace string for home page
$meta['set_permissions'] = array('onoff');      // configure permissions
$meta['set_permissions_others'] = array('multichoice','_choices'=>array('0','1','2','4','8','16')); // if enable set permission, what permission for other people?
$meta['templatepath'] = array('string'); // the location of the template file
$meta['users_namespace'] = array('string','_pattern' => '/^(|[a-zA-Z\-:]+)$/'); // the namespace containing user directories 
$meta['group_by_name'] = array('onoff');      // group people by the first character of name
$meta['edit_before_create'] = array('onoff');   // allow users to edit their home page before create.
