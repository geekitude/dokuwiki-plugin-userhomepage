<?php
/**
 * Configuration defaults file for Userhomepage plugin
 * Previous authors: James GuanFeng Lin, Mikhail I. Izmestev, Daniel Stonier
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

$conf['create_private_ns'] = 1;
$conf['use_name_string'] = 0;
$conf['use_start_page'] = 1;
$conf['users_namespace'] = 'private';
$conf['set_permissions'] = 1;
$conf['set_permissions_others'] = '0';
$conf['group_by_name'] = 1;
$conf['templatepath'] = 'lib/plugins/userhomepage/_template_private.txt';
$conf['edit_before_create'] = 0;
$conf['create_public_page'] = 0;
$conf['public_pages_ns'] = 'user';
$conf['templatepathpublic'] = 'lib/plugins/userhomepage/_template_public.txt';
