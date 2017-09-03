<?php
/**
*
* fieldconfig for thinkupshortcodes/Package
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Package','thinkupshortcodes'),
	'id' => '1314412611',
	'master' => 'style',
	'fields' => array(
		'style'	=>	array(
			'label'		=> 	__('Style','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'dropdown',
			'default'	=> 	'*style1||Style 1,style2||Style 2',
		),
		'image'	=>	array(
			'label'		=> 	__('Image (style 2)','thinkupshortcodes'),
			'caption'	=>	__('Image (style 2)','thinkupshortcodes'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Package Name','thinkupshortcodes'),
			'caption'	=>	__('Package Name','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'price'	=>	array(
			'label'		=> 	__('Package Price','thinkupshortcodes'),
			'caption'	=>	__('Package Price','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
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
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Target','thinkupshortcodes'),
			'caption'	=>	__('Target','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*current||Current Tab,new||New Tab',
		),
		'width'	=>	array(
			'label'		=> 	__('Table Width (px)','thinkupshortcodes'),
			'caption'	=>	__('Table Width (px)','thinkupshortcodes'),
			'type'		=>	'slider',
			'default'	=> 	'0,500|300',
			'inline'	=> 	true,
		),
	),
	'styles'	=> array(
		'simple-slider.css',
	),
	'scripts'	=> array(
		'image-modal.js',
		'simple-slider.min.js',
	),
	'multiple'	=> false,
);

