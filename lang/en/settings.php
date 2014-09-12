<?php
/**
 * English settings file for Userhomepage plugin
 * Previous authors: James GuanFeng Lin, Mikhail I. Izmestev, Daniel Stonier
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

    $lang['create_private_ns'] = 'Create user\'s private namespace (double-check all options before enabling)?';
    $lang['use_name_string'] = 'Use user\'s full name instead of login for his private namespace.';
    $lang['use_start_page'] = 'Use the wiki\'s start page name for the start page of each private namespace (otherwise, the private namespace name will be used).';
    $lang['users_namespace'] = 'Namespace under which user namespaces are created.';
    $lang['set_permissions'] = 'Automatically configure ACL for the namespace set above and give full rights to users on their own namespace.';
    $lang['set_permissions_others'] = 'If [set_permissions] is enabled, what permission for others?';
    $lang['set_permissions_others_o_0'] = 'None';
    $lang['set_permissions_others_o_1'] = 'Read';
    $lang['set_permissions_others_o_2'] = 'Edit';
    $lang['set_permissions_others_o_4'] = 'Create';
    $lang['set_permissions_others_o_8'] = 'Upload';
    $lang['set_permissions_others_o_16'] = 'Delete';
    $lang['group_by_name'] = 'Group users\' namespaces by the first character of user name?';
    $lang['edit_before_create'] = 'Allow users to edit the start page of their private namespace on creation (will only work if a public page isn\'t generated at the same time).';
    $lang['create_public_page'] = 'Create a public page for each user?';
    $lang['public_pages_ns'] = 'Namespace under wich public pages are created.';
    $lang['set_permissions_public'] = 'Automatically configure ACL for the public pages (anyone can read but only user can edit his own).';
    $lang['templates_path'] = 'Path where templates will be stored (userhomepage_private.txt and userhomepage_public.txt). Examples: <code>data/pages/wiki</code> (makes templates editable within DokuWiki) or <code>lib/plugins/userhomepage</code> (to protect templates or centralize them in a farm setup).';
    $lang['set_permissions_templates'] = 'If templates are stored in <code>data/pages...</code>, automatically set following ACL for @ALL)';
    $lang['set_permissions_templates_o_0'] = 'None';
    $lang['set_permissions_templates_o_1'] = 'Read';
    $lang['set_permissions_templates_o_2'] = 'Edit';
    $lang['templatepath'] = 'Template path from version 3.0.4 if it was installed before. If this file exists, it will be used as default source for new private namespace start page template (clear the path if you don\'t want to).';
