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
	'id' => '163332',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Specify the page title. This will be shown in the Tweet box.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'username'	=>	array(
			'label'		=> 	__('Username','thinkupshortcodes'),
			'caption'	=>	__('Username of the author. Tweet will end with @username.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'counter'	=>	array(
			'label'		=> 	__('Counter style','thinkupshortcodes'),
			'caption'	=>	__('Choose a layout for the Tweets counter.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'off,right,top',
		),
	),
	'multiple'	=> false,
);

