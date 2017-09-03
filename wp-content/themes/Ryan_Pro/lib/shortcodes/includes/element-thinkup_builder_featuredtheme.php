<?php
$image   = NULL;
$overlay = NULL;
$icon    = NULL;
$title   = NULL;
$text    = NULL;
$link    = NULL;
$animate = NULL;
$delay   = NULL;

$icon_output          = NULL;
$overlay_output       = NULL;
$delay_header         = NULL;
$delay_title          = NULL;
$delay_text           = NULL;
$animate_header_start = NULL;
$animate_header_end   = NULL;
$animate_title_start  = NULL;
$animate_title_end    = NULL;
$animate_text_start   = NULL;
$animate_text_end     = NULL;

$image   = $atts['image'];
$overlay = $atts['overlay'];
$icon    = $atts['icon'];
$title   = $atts['title'];
$text    = $atts['text'];
$link    = $atts['link'];
$animate = $atts['animate'];
$delay   = $atts['delay'];


if ( ! empty( $icon ) ) {
	$icon_output = '<i class="fa fa-' . $icon . '"></i>';
}
	
if ( $overlay == 'on' ) {
	$overlay_output .= '<div class="image-overlay overlay2">';
	$overlay_output .= '<div class="image-overlay-inner">';
	$overlay_output .= '<div class="prettyphoto-wrap">';
	$overlay_output .= '<span>' . $icon_output . '</span>';
	$overlay_output .= '</div>';
	$overlay_output .= '</div>';
	$overlay_output .= '</div>';
}

// Determing whether user has chosen any animation effect
if ( empty( $delay ) ) {
	$delay_header = '0';
	$delay_title  = '150';
	$delay_text   = '300';
} else {
	$delay_header = $delay;
	$delay_title  = $delay + 150;
	$delay_text   = $delay + 300;
}

if ( ! empty( $animate ) and $animate !== 'none' ) {
	$animate_header_start = '<div class="animated start-' . $animate . '" title="' . $delay_header . '">';
	$animate_header_end   = '</div><div class="clearboth"></div>';
	$animate_title_start  = '<div class="animated start-' . $animate . '" title="' . $delay_title . '">';
	$animate_title_end    = '</div><div class="clearboth"></div>';
	$animate_text_start   = '<div class="animated start-' . $animate . '" title="' . $delay_text . '">';
	$animate_text_end     = '</div><div class="clearboth"></div>';
}


echo '<div class="sc-featured sc-carousel">';

	if ( empty( $link ) ) {
		echo $animate_header_start;
		echo '<div class="entry-header"><img src="' . $image . '" />' . $overlay_output . '</div>';
		echo $animate_header_end;
	} else {
		echo $animate_header_start;
		echo '<div class="entry-header"><a href="' . $link . '"><img src="' . $image . '" />' . $overlay_output . '</a></div>';
		echo $animate_header_end;
	}

	if ( ! empty( $title ) ) {
		echo $animate_title_start;
		echo '<h3>' . $title . '</h3>';
		echo $animate_title_end;
	}
	if ( ! empty( $text ) ) {
		echo $animate_text_start;
		echo wpautop( $text );
		echo $animate_text_end;
	}

echo '</div>';

// enqueue required scripts
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

?>