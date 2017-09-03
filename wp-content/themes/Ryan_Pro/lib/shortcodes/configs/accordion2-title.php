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
			'caption'	=>	__('Title of the accordion toggle box.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'tab'	=>	array(
			'label'		=> 	__('Tab','thinkupshortcodes'),
			'caption'	=>	__('Content to be shown in the accordion area.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'toggle'	=>	array(
			'label'		=> 	__('Toggle','thinkupshortcodes'),
			'caption'	=>	__('Toggle whether the tab should be open (on) or closed (off)','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'on,off',
		),
	),
	'multiple'	=> true,
);

