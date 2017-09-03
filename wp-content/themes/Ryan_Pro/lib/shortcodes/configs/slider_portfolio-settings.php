<?php
/**
*
* fieldconfig for thinkupshortcodes/Settings
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Settings','thinkupshortcodes'),
	'id' => '88514132',
	'master' => 'height',
	'fields' => array(
		'height'	=>	array(
			'label'		=> 	__('Slider Height','thinkupshortcodes'),
			'caption'	=>	__('Specify the maximum slider height (px).','thinkupshortcodes'),
			'type'		=>	'slider',
			'default'	=> 	'50,600|200',
			'inline'	=> 	true,
		),
		'link'	=>	array(
			'label'		=> 	__('Link Slide','thinkupshortcodes'),
			'caption'	=>	__('Link slide to portfolio project?','thinkupshortcodes'),
			'type'		=>	'checkbox',
			'default'	=> 	'',
		),
		'cat'	=>	array(
			'label'		=> 	__('Category','thinkupshortcodes'),
			'caption'	=>	__('Specify category ID for featured projects','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
	),
	'styles'	=> array(
		'simple-slider.css',
	),
	'scripts'	=> array(
		'simple-slider.min.js',
	),
	'multiple'	=> false,
);

