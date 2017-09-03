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
	'id' => '1090129',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image','thinkupshortcodes'),
			'caption'	=>	__('Add images from the media library.','thinkupshortcodes'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'video'	=>	array(
			'label'		=> 	__('Video URL','thinkupshortcodes'),
			'caption'	=>	__('Add a url to the video you want to display. Start with http:// or https://','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'description'	=>	array(
			'label'		=> 	__('Description','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textbox',
			'default'	=> 	'',
		),
		'button'	=>	array(
			'label'		=> 	__('Button Text','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Link','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'class'	=>	array(
			'label'		=> 	__('Style Classes','thinkupshortcodes'),
			'caption'	=>	__('Add additional style classes. (comma separated - see documentation)','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
	),
	'scripts'	=> array(
		'image-modal.js',
	),
	'multiple'	=> true,
);

