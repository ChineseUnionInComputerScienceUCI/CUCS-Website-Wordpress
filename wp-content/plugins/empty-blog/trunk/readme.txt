=== Plugin Name ===
Contributors: dllh,BandonRandon
Tags: admin, posts, pages, dev
Requires at least: 4.0 
Tested up to: 4.6.1
Stable tag: 0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licensesgpl-2.0.html

Created with developers in mind, this plugin allows you to easily delete posts, tags, and categories.

== Description ==

Delete posts, pages, links, tags, and categories from your blog with one admin tool rather than having to handle deletion of all of these as separate actions.

Select from post types and tick a box to determine whether or not to delete tags, categories, and links. A javascript prompt will keep you from submitting by accident.

Users must have the "Manage Options" capability in order to use this.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `empty-blog.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. You should find an "Empty Blog" item under the "Options" menu.

Users must have the "Manage Options" capability.

== Changelog ==

= 0.8 =
* Uses get_terms() instead of deprecated get_all_category_ids()
* WordPress core verison bump 4.0

= 0.7 =
* Minor style tweaks.
* Adds link deletion.

= 0.6 =
* Adds jQuery script and a "select all post types" checkbox.
* As part of the "select all" addition, changes post types form control to a set of checkboxes and adds some styling.
* Fixes a typo in a header.
* Removes incorrect use of a variable within a call to __().

= 0.5 =
* The very first version. 
