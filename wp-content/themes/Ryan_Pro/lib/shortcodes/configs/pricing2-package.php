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
	'id' => '00113138',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image','thinkupshortcodes'),
			'caption'	=>	__('Choose a background image from the media library.','thinkupshortcodes'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Package name.','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'price'	=>	array(
			'label'		=> 	__('Package Price','thinkupshortcodes'),
			'caption'	=>	__('Package price.','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'button'	=>	array(
			'label'		=> 	__('Button Text','thinkupshortcodes'),
			'caption'	=>	__('Specify the button text (Default: Buy Now).','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Button Link','thinkupshortcodes'),
			'caption'	=>	__('Specify a link for the button text.','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Target','thinkupshortcodes'),
			'caption'	=>	__('Specify whether the link should open in the current or a new tab.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*current||Current Tab,new||New Tab',
		),
		'width'	=>	array(
			'label'		=> 	__('Table Width (px)','thinkupshortcodes'),
			'caption'	=>	__('Width of the whole pricing table in px.','thinkupshortcodes'),
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

