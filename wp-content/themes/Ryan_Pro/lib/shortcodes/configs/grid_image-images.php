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
	'id' => '111227510',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Link','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
	),
	'scripts'	=> array(
		'image-modal.js',
	),
	'multiple'	=> true,
);

