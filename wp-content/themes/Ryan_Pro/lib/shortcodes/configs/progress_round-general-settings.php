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
	'id' => '145123114',
	'master' => 'color',
	'fields' => array(
		'color'	=>	array(
			'label'		=> 	__('Color','thinkupshortcodes'),
			'caption'	=>	__('Choose a color.','thinkupshortcodes'),
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Add a message to show in the progress bar.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'progress'	=>	array(
			'label'		=> 	__('Progress %','thinkupshortcodes'),
			'caption'	=>	__('Choose the total % for the progress bar.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100',
		),
		'delay'	=>	array(
			'label'		=> 	__('Delay','thinkupshortcodes'),
			'caption'	=>	__('Add a time delay before the progress bar fills up (ms).','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'0',
		),
	),
	'styles'	=> array(
		'minicolors.css',
	),
	'scripts'	=> array(
		'minicolors.js',
	),
	'multiple'	=> false,
);

