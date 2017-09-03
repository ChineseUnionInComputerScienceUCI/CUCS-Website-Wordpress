<?php
/**
*
* fieldconfig for thinkupshortcodes/Height
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Height','thinkupshortcodes'),
	'id' => '119814141',
	'master' => 'height',
	'fields' => array(
		'height'	=>	array(
			'label'		=> 	__('Slider Height','thinkupshortcodes'),
			'caption'	=>	__('Slider Height','thinkupshortcodes'),
			'type'		=>	'slider',
			'default'	=> 	'100,1000|200',
			'inline'	=> 	true,
		),
		'full_width'	=>	array(
			'label'		=> 	__('Enable Full-Width Slider','thinkupshortcodes'),
			'caption'	=>	__('Slider Width','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on,*off',
			'inline'	=> 	true,
		),
		'style'	=>	array(
			'label'		=> 	__('Slider Style','thinkupshortcodes'),
			'caption'	=>	__('Slider Style','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*option1||Standard,option2||Video on left,option3||Video on right',
		),
		'slider_speed'	=>	array(
			'label'		=> 	__('Slider Speed','thinkupshortcodes'),
			'caption'	=>	__('Slider Speed','thinkupshortcodes'),
			'type'		=>	'slider',
			'default'	=> 	'0,30|6',
			'inline'	=> 	true,
		),
	),
	'styles'	=> array(
		'simple-slider.css',
		'toggles.css',
	),
	'scripts'	=> array(
		'simple-slider.min.js',
		'toggles.min.js',
	),
	'multiple'	=> false,
);

