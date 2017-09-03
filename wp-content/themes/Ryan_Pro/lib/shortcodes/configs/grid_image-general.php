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
	'id' => '66131242',
	'master' => 'columns',
	'fields' => array(
		'columns'	=>	array(
			'label'		=> 	__('Columns','thinkupshortcodes'),
			'caption'	=>	__('Number of projects per row','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*2||2,3||3,4||4,5||5,6||6',
		),
		'link_icon'	=>	array(
			'label'		=> 	__('Show link?','thinkupshortcodes'),
			'caption'	=>	__('Show link icon?','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*on||on,off||off',
			'inline'	=> 	true,
		),
		'lightbox_icon'	=>	array(
			'label'		=> 	__('Show lightbox?','thinkupshortcodes'),
			'caption'	=>	__('Show lightbox icon?','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*on||on,off||off',
			'inline'	=> 	true,
		),
		'wide'	=>	array(
			'label'		=> 	__('Screen Wide?','thinkupshortcodes'),
			'caption'	=>	__('Only works with Parallax Page Template','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on||on,*off||off',
			'inline'	=> 	true,
		),
		'mobile_hide'	=>	array(
			'label'		=> 	__('Mobile Hide?','thinkupshortcodes'),
			'caption'	=>	__('Hide on mobile device?','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*yes||yes,no||no',
			'inline'	=> 	true,
		),
		'animate'	=>	array(
			'label'		=> 	__('Animate','thinkupshortcodes'),
			'caption'	=>	__('Add an animation style.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*none,bounceIn,bounceInDown,bounceInUp,bounceInLeft,bounceInRight,bounceOut,bounceOutDown,bounceOutUp,bounceOutLeft,bounceOutRight,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInDown,fadeInLeft,fadeInRight,fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutUp,fadeOutDown,fadeOutLeft,fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,fadeOutRightBig,hinge,lightSpeedIn,lightSpeedOut,rollIn,rollOut,rotateIn,rotateInDownLeft,rotateInDownRight,rotateInUpLeft,rotateInUpRight,rotateOut,rotateOutDownLeft,rotateOutDownRight,rotateOutUpLeft,rotateOutUpRight,slideInDown,slideInLeft,slideInRight,slideOutUp,slideOutLeft,slideOutRight',
		),
		'delay'	=>	array(
			'label'		=> 	__('Delay','thinkupshortcodes'),
			'caption'	=>	__('Add a delay to the animation effect (ms)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'delay_item'	=>	array(
			'label'		=> 	__('Delay (per item)','thinkupshortcodes'),
			'caption'	=>	__('Delay between individual projects (ms)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
	),
	'styles'	=> array(
		'toggles.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
	),
	'multiple'	=> false,
);

