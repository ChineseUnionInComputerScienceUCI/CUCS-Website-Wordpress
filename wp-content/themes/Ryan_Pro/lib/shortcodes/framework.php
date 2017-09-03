<?php
/**
 * @package   Thinkupshortcodes
 * @author    Think Up Themes Ltd <contact@thinkupthemes.com>
 * @license   GPL-2.0+
 * @link      www.thinkupthemes.com
 * @copyright 2017 Think Up Themes Ltd
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( get_template_directory() . '/lib/shortcodes/class-thinkupshortcodes.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/functions-item_portfolio.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/functions-thinkup_builder_buttontheme.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/functions-thinkup_builder_featuredtheme.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/functions-thinkup_builder_thinkupslider.php' );

require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_sliderimage.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_buttontheme.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_toggle.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_listfontawesome.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_blockquote.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_tabs.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_calltoaction.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_pricingtable.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_featuredtheme.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_gridportfolio.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_gridimage.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_thinkupslider.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_counternumber.php' );
require_once( get_template_directory() . '/lib/shortcodes/includes/widget-thinkup_builder_table.php' );



return Thinkupshortcodes::get_instance();
?>