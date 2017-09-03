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
			'label'		=> 	__('Link to LinkedIn page','thinkupshortcodes'),
			'caption'	=>	__('Link to your LinkedIn page. Start with http://.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'counter'	=>	array(
			'label'		=> 	__('Counter Position','thinkupshortcodes'),
			'caption'	=>	__('Choose the position of the LinkedIn counter .','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'none,top,right',
		),
	),
	'multiple'	=> false,
);

