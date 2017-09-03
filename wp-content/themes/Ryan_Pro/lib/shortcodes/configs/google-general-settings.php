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
	'master' => 'link',
	'fields' => array(
		'link'	=>	array(
			'label'		=> 	__('Link to Google+ page','thinkupshortcodes'),
			'caption'	=>	__('Link to your Google+ page. Start with http://.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'size'	=>	array(
			'label'		=> 	__('Button Size','thinkupshortcodes'),
			'caption'	=>	__('Choose a button layout.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'small,medium,standard,tall',
		),
		'counter'	=>	array(
			'label'		=> 	__('Show counter?','thinkupshortcodes'),
			'caption'	=>	__('Toggle Google+ counter.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'on,off',
		),
	),
	'multiple'	=> false,
);

