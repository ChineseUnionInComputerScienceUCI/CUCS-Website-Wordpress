<?php
/**
*
* fieldconfig for thinkupshortcodes/Images
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2017 Think Up Themes Ltd
*/


$group = array(
	'label' => __('Images','thinkupshortcodes'),
	'id' => '115041314',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image URL','thinkupshortcodes'),
			'caption'	=>	__('Select images from your media library.','thinkupshortcodes'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
	),
	'scripts'	=> array(
		'image-modal.js',
	),
	'multiple'	=> true,
);

