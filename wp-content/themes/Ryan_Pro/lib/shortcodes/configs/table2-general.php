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
	'id' => '94154114',
	'master' => 'delimiter',
	'fields' => array(
		'delimiter'	=>	array(
			'label'		=> 	__('Delimiter','thinkupshortcodes'),
			'caption'	=>	__('Select a delimiter to separate row content into different columns.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*pipe||Pipe (|),semi-colon||Semi-Colon (;),colon||Colon (:),tilde||Tilde (~)',
		),
	),
	'multiple'	=> false,
);

