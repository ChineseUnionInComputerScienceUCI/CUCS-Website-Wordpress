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
	'id' => '41115827',
	'master' => 'number',
	'fields' => array(
		'number'	=>	array(
			'label'		=> 	__('Number','thinkupshortcodes'),
			'caption'	=>	__('Specify a number for the maximum value of the counter.','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'suffix'	=>	array(
			'label'		=> 	__('Suffix','thinkupshortcodes'),
			'caption'	=>	__('Add a suffix to your number (e.g. %)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Add a message to show in the progress bar.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'delay'	=>	array(
			'label'		=> 	__('Delay','thinkupshortcodes'),
			'caption'	=>	__('Add a time delay before the progress bar fills up (ms).','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'0',
		),
		'color_custom'	=>	array(
			'label'		=> 	__('Custom Color?','thinkupshortcodes'),
			'caption'	=>	__('Switch on to use custom colors (configure below).','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on||On,*off||Off',
			'inline'	=> 	true,
		),
		'color_number'	=>	array(
			'label'		=> 	__('Color (Number)','thinkupshortcodes'),
			'caption'	=>	__('Specify a color for the counter number.','thinkupshortcodes'),
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
	),
	'styles'	=> array(
		'toggles.css',
		'minicolors.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
		'minicolors.js',
	),
	'multiple'	=> false,
);

