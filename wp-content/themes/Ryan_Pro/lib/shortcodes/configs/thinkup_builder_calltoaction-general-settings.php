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
	'id' => '1585702',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Title','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'teaser'	=>	array(
			'label'		=> 	__('Teaser','thinkupshortcodes'),
			'caption'	=>	__('Teaser','thinkupshortcodes'),
			'type'		=>	'textbox',
			'default'	=> 	'',
		),
		'button'	=>	array(
			'label'		=> 	__('Button Text','thinkupshortcodes'),
			'caption'	=>	__('Button Text','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Button Link','thinkupshortcodes'),
			'caption'	=>	__('Button Link','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Button Target','thinkupshortcodes'),
			'caption'	=>	__('Button Target','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*current||Current Tab ,new||New Tab',
		),
		'color_custom'	=>	array(
			'label'		=> 	__('Custom Colors (Set below):','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'onoff',
			'default'	=> 	'on||On,*off||Off',
			'inline'	=> 	true,
		),
		'color_title'	=>	array(
			'label'		=> 	__('Title Color:','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_teaser'	=>	array(
			'label'		=> 	__('Teaser Color:','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_button_text'	=>	array(
			'label'		=> 	__('Buttton Text Color:','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_button_text_hover'	=>	array(
			'label'		=> 	__('Buttton Text Color (Hover):','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_button_bg'	=>	array(
			'label'		=> 	__('Button BG Color','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_button_bg_hover'	=>	array(
			'label'		=> 	__('Button BG Color (Hover)','thinkupshortcodes'),
          'caption'   =>  '',
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

