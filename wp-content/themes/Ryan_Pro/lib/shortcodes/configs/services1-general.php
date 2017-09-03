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
	'id' => '7721268',
	'master' => 'image',
	'fields' => array(
		'image'	=>	array(
			'label'		=> 	__('Image URL','thinkupshortcodes'),
			'caption'	=>	__('Input url to image','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'heading'	=>	array(
			'label'		=> 	__('Heading','thinkupshortcodes'),
			'caption'	=>	__('Add a title to your service box.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Link','thinkupshortcodes'),
			'caption'	=>	__('Add a url to link to. Include http:// for external links.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'link_text'	=>	array(
			'label'		=> 	__('Link Text','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
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
	),
	'multiple'	=> false,
);

