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
	'id' => '6513528',
	'master' => 'id',
	'fields' => array(
		'id'	=>	array(
			'label'		=> 	__('Vimeo ID','thinkupshortcodes'),
			'caption'	=>	__('Specify the Vimeo video ID.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'thumb'	=>	array(
			'label'		=> 	__('Thumbnail URL','thinkupshortcodes'),
			'caption'	=>	__('Specify the URL to your thumbnail image. Leave blank to show Vimeo video thumbnail.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Add a title to be shown in the pop-out box.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'details'	=>	array(
			'label'		=> 	__('Video Details','thinkupshortcodes'),
			'caption'	=>	__('Add a description to be shown in the pop-out box.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
	),
	'multiple'	=> false,
);

