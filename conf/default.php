<?php
$conf['set_permissions'] =  true;     // configure acl's 
$conf['set_permissions_others'] = '0';
$conf['use_name_string'] =  false;    // use name string instead of login string for the user's ns
$conf['use_start_page']  =  true;    // use state page instead of namespace string for home page
$conf['templatepath']    = 'lib/plugins/userhomepage/_template.txt';   // the location of the template file
$conf['users_namespace'] = 'people'; // namespace storing the user namespaces
$conf['group_by_name']   =  true;    // use the first character of name to group people
$conf['edit_before_create'] = true; // allow users to edit their home pages before create
?>
