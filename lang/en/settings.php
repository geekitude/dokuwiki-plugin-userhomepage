<?php
/**
 * English settings file for Userhomepage plugin
 * Previous authors: James GuanFeng Lin, Mikhail I. Izmestev, Daniel Stonier
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

$lang['use_name_string'] = 'Use user\'s full name instead of login for his namespace and homepage (will break <code>%USER%</code> wildcard in ACL for that namespace).';
$lang['use_start_page'] = 'Use the wiki\'s start page string instead of the user\'s namespace string set above for the start page of his namespace.';
$lang['users_namespace'] = 'Namespace under which user namespaces are created (can be anything but <code>user</code> without messing up with Dokuwiki default behaviour).';
$lang['set_permissions'] = 'Automatically configure acl for the namespace set above and give full rights to users on their own namespace.';
$lang['set_permissions_others'] = 'If set permission is enabled, what permission for other people (both <code>@ALL</code> and <code>@user</code> groups) ?';
$lang['set_permissions_others_o_0'] = 'None';
$lang['set_permissions_others_o_1'] = 'Read';
$lang['set_permissions_others_o_2'] = 'Edit';
$lang['set_permissions_others_o_4'] = 'Create';
$lang['set_permissions_others_o_8'] = 'Upload';
$lang['set_permissions_others_o_16'] = 'Delete';
$lang['group_by_name'] = 'Group users\' namespaces by the first character of user name ?';
$lang['templatepath'] = 'Doku relative path to the template file for user\'s namespace start page.';
$lang['edit_before_create'] = 'Allow users to edit their namespace start page before create (note that template will not be used if you enable this option).';
