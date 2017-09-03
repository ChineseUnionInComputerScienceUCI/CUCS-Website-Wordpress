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
	'id' => '1011019',
	'master' => 'size',
	'fields' => array(
		'size'	=>	array(
			'label'		=> 	__('Size','thinkupshortcodes'),
			'caption'	=>	__('Add a gap after your content.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'10,20,30,40,50,60,70,80,90,100',
		),
	),
	'multiple'	=> false,
);

