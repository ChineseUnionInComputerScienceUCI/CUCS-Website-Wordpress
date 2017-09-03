<?php
/**
*
* fieldconfig for thinkupshortcodes/Title
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Title','thinkupshortcodes'),
	'id' => '127211125',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Title','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'tab'	=>	array(
			'label'		=> 	__('Tab','thinkupshortcodes'),
			'caption'	=>	__('Content','thinkupshortcodes'),
			'type'		=>	'textbox',
			'default'	=> 	'',
		),
		'toggle'	=>	array(
			'label'		=> 	__('Toggle','thinkupshortcodes'),
			'caption'	=>	__('Tab Toggle (on / off)','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on||on,*off||off',
			'inline'	=> 	true,
		),
	),
	'styles'	=> array(
		'toggles.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
	),
	'multiple'	=> true,
);

