<?php
/**
 * Configuration metadata file for Userhomepage plugin
 * Previous authors: James GuanFeng Lin, Mikhail I. Izmestev, Daniel Stonier
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

$meta['use_name_string'] = array('onoff','_caution' => 'warning');
$meta['use_start_page'] = array('onoff');
$meta['users_namespace'] = array('string','_pattern' => '/^(|[a-zA-Z\-:]+)$/');
$meta['set_permissions'] = array('onoff');
$meta['set_permissions_others'] = array('multichoice','_choices'=>array('0','1','2','4','8','16'));
$meta['group_by_name'] = array('onoff');
$meta['templatepath'] = array('string','_pattern' => '/^(|[a-zA-Z\-]+)$/');
$meta['edit_before_create'] = array('onoff');
