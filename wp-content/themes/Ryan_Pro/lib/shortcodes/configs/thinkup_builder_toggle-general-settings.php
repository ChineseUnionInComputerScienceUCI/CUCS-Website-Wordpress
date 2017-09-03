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
	'id' => '11121115127',
	'master' => 'style',
	'fields' => array(
		'style'	=>	array(
			'label'		=> 	__('Style','thinkupshortcodes'),
			'caption'	=>	__('Style','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*style1||Style 1,style2||Style 2',
		),
	),
	'multiple'	=> false,
);

