<?php
/**
*
* fieldconfig for thinkupshortcodes/Page Attributes
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Page Attributes','thinkupshortcodes'),
	'id' => '1090129',
	'master' => 'template',
	'fields' => array(
		'template'	=>	array(
			'label'		=> 	__('Template','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'dropdown',
			'default'	=> 	'*default||Default,template-parallax||Parallax',
		),
	),
	'multiple'	=> false,
);

