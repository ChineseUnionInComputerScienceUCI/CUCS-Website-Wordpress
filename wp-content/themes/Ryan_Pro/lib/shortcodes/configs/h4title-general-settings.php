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
	'id' => '15310762',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Enter the title you want to display.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'style'	=>	array(
			'label'		=> 	__('Style','thinkupshortcodes'),
			'caption'	=>	__('Add a background line style to your title.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'single,double,triple,quad,underline',
		),
		'size'	=>	array(
			'label'		=> 	__('Size (optional)','thinkupshortcodes'),
			'caption'	=>	__('Choose a size (px)  to easily target individual titles.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30',
		),
	),
	'multiple'	=> false,
);

