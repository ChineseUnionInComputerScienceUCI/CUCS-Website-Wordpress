<?php
/**
*
* fieldconfig for thinkupshortcodes/Toggle Buttons
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Toggle Buttons','thinkupshortcodes'),
	'id' => '108211112',
	'master' => 'position',
	'fields' => array(
		'position'	=>	array(
			'label'		=> 	__('Position','thinkupshortcodes'),
			'caption'	=>	__('Choose how to position the toggle buttons.','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*left||Left,center||Center,right||Right,full||Full Width',
			'inline'	=> 	true,
		),
	),
	'styles'	=> array(
		'toggles.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
	),
	'multiple'	=> false,
);

