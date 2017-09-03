<?php
$image         = NULL;
$link          = NULL;
$columns       = NULL;
$link_icon     = NULL;
$lightbox_icon = NULL;
$wide          = NULL;
$mobile_hide   = NULL;
$animate       = NULL;
$delay         = NULL;
$delay_item    = NULL;

$columns       = $atts['columns'];
$link_icon     = $atts['link_icon'];
$lightbox_icon = $atts['lightbox_icon'];
$wide          = $atts['wide'];
$mobile_hide   = $atts['mobile_hide'];
$animate       = $atts['animate'];
$delay         = $atts['delay'];
$delay_item    = $atts['delay_item'];

$class_wide    = NULL;
$class_hide    = NULL;
$class_column  = NULL;

$count         = 0;

// Assign column layout class
if ( $columns == '2' ) {
	$class_column  = 'column-2';
} else if ( $columns == '3' ) {
	$class_column = 'column-3';
} else if ( $columns == '4' ) {
	$class_column = 'column-4';
} else if ( $columns == '5' ) {
	$class_column = 'column-5';
} else if ( $columns == '6' ) {
	$class_column = 'column-6';
} else {
	$class_column = 'column-4';
}

// Assign class for screen wide layout
if ( $wide == 'on' ) {
	$class_wide = ' grid-wide';
}

// Assign class to hide on mobile devices
if ( $mobile_hide == 'yes' ) {
	$class_hide = ' hidden-mobile';
}

echo '<div class="sc-grid grid-image items-' . $items . $class_wide . $class_hide . '">';

echo '<ul id="' . $instanceID . '" data-wide="' . $wide . '">';

	?><?php foreach((array) $groups['image'] as $increment=>$context){ ?><?php

		// Reset variable values
		$image          = NULL;
		$link           = NULL;
		$link_input     = NULL;
		$lightbox_input = NULL;
		$overlay_class  = NULL;
		$overlay_input  = NULL;

		$image  = $context['image'];
		$link   = $context['link'];

		$thinkup_input_featured  = '<img src="' . $context['image'] . '" />';
		$thinkup_input_link      = $context['image'];

		// Set link icon variable if user wants it to show
		if ( $link_icon !== 'off' and ! empty( $link ) ) {
			$link_input = '<a class="hover-link" href="'. $context['link'] . '"></a>';
		}

		// Set lightbox icon variable if user wants it to show
		if ( $lightbox_icon !== 'off' ) {
			$lightbox_input = '<a class="hover-zoom prettyPhoto" href="'. $thinkup_input_link . '"></a>';
		}

		// Determine which if single link animation should be shown
		if ( $link_icon == 'off' or $lightbox_icon == 'off' or empty( $link ) ) {
			$overlay_class = ' style2';
		}

		if ( ( $link_icon !== 'off' and ! empty( $link ) ) or $lightbox_icon !== 'off' ) {
			$overlay_input .= '<div class="image-overlay' . $overlay_class . '">';
			$overlay_input .= '<div class="image-overlay-inner">';
			$overlay_input .= '<div class="hover-icons">';
			$overlay_input .= $lightbox_input;
			$overlay_input .= $link_input;
			$overlay_input .= '</div>';
			$overlay_input .= '</div>';
			$overlay_input .= '</div>';
		}

		if ( ! empty( $image ) ) {

			$count++;

			// Assign last class to column layouts
			if ( $count % $columns == 0 ) {
				$class_column_last = ' last';
			} else {
				$class_column_last = NULL;
			}

			// Assign animation variables if set
			if ( ! empty( $animate ) and $animate !== 'none' ) {

				// Assign delay variable
				if ( ! empty( $delay_item ) and $count > 1 ) {
					$delay = $delay + $delay_item;
				}

				$animate_start = '<div class="animated start-' . $animate . '" title="' . $delay . '">';
				$animate_end   = '</div><div class="clearboth"></div>';
			}

			echo '<li class="' . $class_column . $class_column_last . ' ' . $columns . ' ' . $count . '">';

				echo $animate_start;

				echo '<div class="entry-header">',
					 '<a href="' . get_permalink( $recent["ID"] ) . '" >' . $thinkup_input_featured . '</a>',
					 $overlay_input,
					 '</div>';

				echo $animate_end;

			echo '</li>';
		}
	?><?php } ?><?php
echo '<li class="clearboth"></li>',
	 '</ul>',
	 '</div>';


// Load animation styles and scripts
if ( ! empty( $animate ) and $animate !== 'none' ) {
			
	if ( ! wp_script_is( 'animate-js', 'enqueued' ) ) {
	// Enque styles only if widget is being used
	wp_enqueue_style( 'animate-css', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/animate.css/animate.css', array(), '1.0' );
	wp_enqueue_style( 'animate-thinkup-css', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'widgets-builder/animation/css/animate-thinkup-panels.css', array(), '1.0' );

	if ( ! wp_script_is( 'waypoints', 'enqueued' ) ) {
	// Enque waypoints only if widget is being used
	wp_enqueue_script( 'waypoints', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '2.0.3', 'true'  );
	wp_enqueue_script( 'waypoints-sticky', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints-sticky.min.js', array( 'jquery' ), '2.0.3', 'true'  );
	}

	// Enque scripts only if widget is being used
	wp_enqueue_script( 'animate-js', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'widgets-builder/animation/js/animate-thinkup-panels.js', array( 'jquery' ), '1.1', true );
	}
}