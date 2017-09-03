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
	'id' => '6128377',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Add a title to your client carousel (e.g. Our Partners)','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'items'	=>	array(
			'label'		=> 	__('Total','thinkupshortcodes'),
			'caption'	=>	__('Choose the total number of recent posts to display. (Default = 10).','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*Default,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50',
		),
		'show'	=>	array(
			'label'		=> 	__('Items','thinkupshortcodes'),
			'caption'	=>	__('Choose the number of blog posts to display in carousel window','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'2,3,4,5,6',
		),
		'scroll'	=>	array(
			'label'		=> 	__('Scroll','thinkupshortcodes'),
			'caption'	=>	__('Choose the number of blog posts to scroll on click','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'1,2,3,4',
		),
		'speed'	=>	array(
			'label'		=> 	__('Scroll Duration','thinkupshortcodes'),
			'caption'	=>	__('Specify a duartion for the carousel scroll in milliseconds (default = 500)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'500',
		),
		'effect'	=>	array(
			'label'		=> 	__('Effect','thinkupshortcodes'),
			'caption'	=>	__('Choose a scroll effect (Default: scroll)','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'none,scroll,directscroll,fade,crossfade,cover,cover-fade,uncover,uncover-fade',
		),
		'category'	=>	array(
			'label'		=> 	__('Category','thinkupshortcodes'),
			'caption'	=>	__('Input the category ID number to display posts from a single category (i.e. 0 = all).','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'0',
		),
	),
	'multiple'	=> false,
);

