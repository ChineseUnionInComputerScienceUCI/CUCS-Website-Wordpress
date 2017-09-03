<?php
/**
*
* fieldconfig for thinkupshortcodes/Slides
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Slides','thinkupshortcodes'),
	'id' => '1090129',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image','thinkupshortcodes'),
			'caption'	=>	__('Add images from the media library.','thinkupshortcodes'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
	),
	'scripts'	=> array(
		'image-modal.js',
	),
	'multiple'	=> true,
);

