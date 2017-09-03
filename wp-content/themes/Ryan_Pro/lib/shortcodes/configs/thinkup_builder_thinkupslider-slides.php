<?php
/**
*
* fieldconfig for thinkupshortcodes/Slides
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Slides','thinkupshortcodes'),
	'id' => '22714615',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image','thinkupshortcodes'),
			'caption'	=>	__('Slider Image','thinkupshortcodes'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'video'	=>	array(
			'label'		=> 	__('Video URL','thinkupshortcodes'),
			'caption'	=>	__('Video URL','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Title','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'description'	=>	array(
			'label'		=> 	__('Description','thinkupshortcodes'),
			'caption'	=>	__('Description','thinkupshortcodes'),
			'type'		=>	'textbox',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Link','thinkupshortcodes'),
			'caption'	=>	__('Link','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'button'	=>	array(
			'label'		=> 	__('Button Text','thinkupshortcodes'),
			'caption'	=>	__('Button Text','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'class'	=>	array(
			'label'		=> 	__('Style Classes','thinkupshortcodes'),
			'caption'	=>	__('Style Classes','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
	),
	'scripts'	=> array(
		'image-modal.js',
	),
	'multiple'	=> true,
);

