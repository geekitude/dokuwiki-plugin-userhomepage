<?php
/*
 * Userhomepage plugin, configuration defaults
 * FIXED by Simon Delage <simon.geekitude@gmail.com> on 2014-08-30
 */

$conf['use_name_string'] = 0;    // use name string instead of login string for the user's ns
$conf['use_start_page'] = 1;    // use state page instead of namespace string for home page
$conf['set_permissions'] = 1;     // configure acl's 
$conf['set_permissions_others'] = '0';
$conf['templatepath'] = 'lib/plugins/userhomepage/_template.txt';   // the location of the template file
$conf['users_namespace'] = 'people'; // namespace storing the user namespaces
$conf['group_by_name'] = 1;    // use the first character of name to group people
$conf['edit_before_create'] = 1; // allow users to edit their home pages before create
