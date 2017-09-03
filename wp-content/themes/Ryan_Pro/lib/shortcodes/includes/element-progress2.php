<?php
$style    = NULL;
$title    = NULL;
$progress = NULL;
$show     = NULL;
$animate  = NULL;
$delay    = NULL;

$style    = $atts['style'];
$title    = $atts['title'];
$progress = $atts['progress'];
$show     = $atts['show'];
$animate  = $atts['animate'];
$delay    = $atts['delay'];

$block       = NULL;
$class_text  = NULL;
$input_style = NULL;
$input_width = NULL;
$input_delay = NULL;
$output      = NULL;

if ( $style == 'info' ) {
	$style = ' bar-info';
} else if ($style == 'success' ) {
	$style = ' bar-success';
} else if ($style == 'warning' ) {
	$style = ' bar-warning';
} else if ($style == 'danger' ) {
	$style = ' bar-danger';
} else {
	$style = '';
}

if ( ! empty ( $title ) ) {
	$title = '<span class="bar-title">' . $title . '</span>';
}

if ( empty( $progress ) ) { 
	$progress = '50'; 
}

if ( $show == "on" ) {
	$show = '<span class="bar-per">' . $progress . '%</span>';
} else {
	$show = '';
}

if ( empty( $title ) and empty( $show ) ) {
	$block = ' display: block;';
}

if ( empty( $delay ) ) {
	$delay = 0;
}

if ( $animate == 'on' ) {
	$input_width = ' data-width="' . $progress . '"';
	$input_delay = ' data-delay="' . $delay . '"';
} else {
	$input_style = 'width: ' . $progress . '%;';
}

// Add text class if title or number is set to show
if ( ! empty ( $title ) or ! empty ( $show ) ) {
	$class_text = ' progress-text';
}

$output .= '<div class="sc-progress">';
$output .= '<div class="progress progress-striped' . $class_text . '">';
$output .= '<div class="bar' . $style . '" style="' . $input_style . $block . '"' . $input_width . $input_delay . '>' . $title . $show . '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;

?>