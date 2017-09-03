<?php
$color    = NULL;
$title    = NULL;
$progress = NULL;
$delay    = NULL;

$color    = $atts['color'];
$title    = $atts['title'];
$progress = $atts['progress'];
$delay    = $atts['delay'];

if ( ! empty ( $title ) ) {	
	$title = '<h5 class="sc-knob-title">' . $title . '</h5>';
}

if ( empty( $progress ) ) { 
	$progress = '50'; 
}

if ( empty( $delay ) ) { 
	$delay = '0'; 
}

echo '<div class="sc-knob" >',
	 '<input class="sc-knob-dial" data-delay="' . $delay . '" type="text" value="0" data-value="' . $progress . '" data-thickness=".1" data-width="140" data-height="140" data-fgColor="' . $color . '">',
	 $title,
	 '</div>';

?>