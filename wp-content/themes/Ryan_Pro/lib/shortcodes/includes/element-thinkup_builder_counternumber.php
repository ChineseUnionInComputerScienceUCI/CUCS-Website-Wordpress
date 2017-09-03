<?php
$number       = NULL;
$suffix       = NULL;
$title        = NULL;
$delay        = NULL;
$color_custom = NULL;
$color_number = NULL;
	
$number       = $atts['number'];
$suffix       = $atts['suffix'];
$title        = $atts['title'];
$delay        = $atts['delay'];
$color_custom = $atts['color_custom'];
$color_number = $atts['color_number'];

if ( empty( $number ) ) { 
	$number = '50'; 
}

if ( ! empty ( $title ) ) {	
	$title = '<h5 class="sc-knob-title">' . $title . '</h5>';
}

if ( empty( $delay ) ) { 
	$delay = '0'; 
}

echo '<div id="' . $instanceID . '" class="sc-knob sc-counter" >',
	 '<input class="sc-knob-dial" data-delay="' . $delay . '" type="text" value="0" data-value="' . $number . '" data-max="' . $number . '" data-suffix="' . $suffix . '">',
	 $title,
	 '</div>';

//====================================================================
// Output custom styling if set
//====================================================================

if ( $color_custom == 'on' ) {
	echo '<style>';
		echo '#' . $instanceID . ' .sc-knob-dial { color: ' . $color_number . ' !important; }';
	echo '</style>';
}

?>