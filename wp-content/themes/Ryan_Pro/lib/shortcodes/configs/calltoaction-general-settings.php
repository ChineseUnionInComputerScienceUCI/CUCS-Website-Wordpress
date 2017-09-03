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
			'caption'	=>	__('Add a title message to the call to action.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'teaser'	=>	array(
			'label'		=> 	__('Teaser','thinkupshortcodes'),
			'caption'	=>	__('Add a teaser message to the call to action.','thinkupshortcodes'),
			'type'		=>	'textbox',
			'default'	=> 	'',
		),
		'button'	=>	array(
			'label'		=> 	__('Button Text','thinkupshortcodes'),
			'caption'	=>	__('Specify the text you want displayed on the button (Default: Read More)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Button Link','thinkupshortcodes'),
			'caption'	=>	__('Specify where you want the button to link (Add http:// for external links).','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Button Target','thinkupshortcodes'),
			'caption'	=>	__('Specify whether the link should open in the same tab or a new tab.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*current||Current Tab ,new||New Tab',
		),
	),
	'multiple'	=> false,
);

