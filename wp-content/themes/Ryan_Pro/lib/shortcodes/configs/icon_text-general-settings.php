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
	'id' => '14411121013',
	'master' => 'icon',
	'fields' => array(
		'icon'	=>	array(
			'label'		=> 	__('Icon','thinkupshortcodes'),
			'caption'	=>	__('Choose and icon to display.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'Address-book,Arrow,Arrow-back,Arrow-back-red,Arrow-red,Bookmark,Briefcase,Chat,Checkmark,Clock,Config,Database,Database-add,Database-warning,Database-x,Exclamation,Folder,Folder-add,Folder-remove,Graph,Heart,Heart-add,Heart-x,Home,Info,Lifesaver,List,Mail,Mail_forward,Mail_reply,Mail-add,Mail-spam,Mail-x,Music,No,Paper,Paper-add,Paper-arrow,Paper-arrow-back,Paper-pencil,Paper-warning,Paper-x,Pencil,Person,Person-add,Person-add-black,Person-black,Person-group,Person-group-add,Person-group-warning,Person-group-x,Person-warning,Person-warning-black,Person-white,Person-white-add,Person-white-warning,Person-white-x,Person-x,Person-x-black,Person-x-white,Photo,Piechart,Plus,Questions,Refresh,Rss,Screen,Search,Speech-Bubble,Speech-Bubble-add,Speech-Bubble-x,Warning,World,World-download,World-search,X',
		),
		'link'	=>	array(
			'label'		=> 	__('Link url?','thinkupshortcodes'),
			'caption'	=>	__('Add a link url. For external links start with http://.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
	),
	'multiple'	=> false,
);

