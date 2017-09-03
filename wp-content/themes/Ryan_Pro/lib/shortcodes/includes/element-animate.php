<?php

$style   = NULL;
$delay   = NULL;

$style   = $atts['style'];
$delay   = $atts['delay'];

if ( $style == 'right' ) {
	$style = 'anim-start-ltr';
} else if ( $style == 'left' ) {
	$style = 'anim-start-rtl';
} else if ( $style == 'up' ) {
	$style = 'anim-start-btt';
} else if ( $style == 'down' ) {
	$style = 'anim-start-ttb';
} else if ( $style == 'big' ) {
	$style = 'anim-start-stb';
} else {
	$style = 'anim-start-ltr';
}

if ( empty( $delay ) ) {
	$delay = '0';
}

echo '<div id="animate-' . $instanceID . '" title="' . $delay . '" class="sc-anim">',
	 '<div class="' . $style . '">',
	 $content,
	 '</div><div class="clearboth"></div>',
	 '</div>';
	
	
?>