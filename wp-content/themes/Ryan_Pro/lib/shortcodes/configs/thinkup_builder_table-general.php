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
	'id' => '15129637',
	'master' => 'style',
	'fields' => array(
		'style'	=>	array(
			'label'		=> 	__('Style','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'dropdown',
			'default'	=> 	'*style1||Style 1,style2||Style 2',
		),
		'delimiter'	=>	array(
			'label'		=> 	__('Delimiter','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'dropdown',
			'default'	=> 	'*pipe||Pipe (|),semi-colon||Semi-Colon (;),colon||Colon (:),tilde||Tilde (~)',
		),
	),
	'multiple'	=> false,
);

