<?php
/**
*
* fieldconfig for thinkupshortcodes/General Settings
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('General Settings','thinkupshortcodes'),
	'id' => '28811103',
	'master' => 'layout',
	'fields' => array(
		'layout'	=>	array(
			'label'		=> 	__('Layout','thinkupshortcodes'),
			'caption'	=>	__('Choose a button layout.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'standard,button_count,box_count',
		),
	),
	'multiple'	=> false,
);

