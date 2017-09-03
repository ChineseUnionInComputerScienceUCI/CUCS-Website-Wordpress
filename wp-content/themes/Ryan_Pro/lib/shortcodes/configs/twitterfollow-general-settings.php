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
	'master' => 'username',
	'fields' => array(
		'username'	=>	array(
			'label'		=> 	__('Username','thinkupshortcodes'),
			'caption'	=>	__('Link to your Twitter page. Start with http://.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'counter'	=>	array(
			'label'		=> 	__('Show counter?','thinkupshortcodes'),
			'caption'	=>	__('Toggle Twitter counter.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'on,off',
		),
	),
	'multiple'	=> false,
);

