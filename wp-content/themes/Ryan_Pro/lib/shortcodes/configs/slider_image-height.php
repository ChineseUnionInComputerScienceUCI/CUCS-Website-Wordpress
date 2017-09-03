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
	),
	'styles'	=> array(
		'simple-slider.css',
	),
	'scripts'	=> array(
		'simple-slider.min.js',
	),
	'multiple'	=> false,
);

