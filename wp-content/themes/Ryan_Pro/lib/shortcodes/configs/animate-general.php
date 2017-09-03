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
	'id' => '4105395',
	'master' => 'style',
	'fields' => array(
		'style'	=>	array(
			'label'		=> 	__('style','thinkupshortcodes'),
			'caption'	=>	__('Add the direction of the animation','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'right,left,up,down,big',
		),
		'delay'	=>	array(
			'label'		=> 	__('delay','thinkupshortcodes'),
			'caption'	=>	__('Add a time delay before the animation shows (ms)','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'0',
		),
	),
	'multiple'	=> false,
);

