<?php
/**
*
* fieldconfig for thinkupshortcodes/General
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('General','thinkupshortcodes'),
	'id' => '1561373',
	'master' => 'id',
	'fields' => array(
		'id'	=>	array(
			'label'		=> 	__('Post ID','thinkupshortcodes'),
			'caption'	=>	__('Input the project ID number.','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'size'	=>	array(
			'label'		=> 	__('Size','thinkupshortcodes'),
			'caption'	=>	__('Add an image size (see media library for available sizes)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
	),
	'multiple'	=> false,
);

