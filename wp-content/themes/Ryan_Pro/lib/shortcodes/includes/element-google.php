<?php
$link     = NULL;
$counter  = NULL;
$size     = NULL;

$link     = $atts['link'];
$counter  = $atts['counter'];
$size     = $atts['size'];


if ( empty( $link ) ) {
	$link = '#';
}

if ( $counter == 'on' ) {
	$counter = 'true';	
} else {	
	$counter = 'false';	
}

if ( empty( $size ) ) {
	$size = 'standard';
}
	
	echo '<div class="g-plusone" data-size="' . $size . '" data-count="' . $counter . '" href="' . $link . '"></div>';
?>
