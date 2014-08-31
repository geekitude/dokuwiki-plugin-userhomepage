<?php
/*
 * Userhomepage plugin, configuration metadata
 * FIXED by Simon Delage <simon.geekitude@gmail.com> on 2014-08-30
 */

$meta['use_name_string'] = array('onoff','_caution' => 'warning');
$meta['use_start_page'] = array('onoff');
$meta['users_namespace'] = array('string','_pattern' => '/^(|[a-zA-Z\-:]+)$/');
$meta['set_permissions'] = array('onoff');
$meta['set_permissions_others'] = array('multichoice','_choices'=>array('0','1','2','4','8','16'));
$meta['group_by_name'] = array('onoff');
$meta['templatepath'] = array('string','_pattern' => '/^(|[a-zA-Z\-]+)$/');
$meta['edit_before_create'] = array('onoff');
