<?php
$size = NULL;

$size  = $atts['size'];

if ( $size == '10') {
	$size = 'margin10';
} else if ( $size == '20') {
	$size = 'margin20';
} else if ( $size == '30') {
	$size = 'margin30';
} else if ( $size == '40') {
	$size = 'margin40';
} else if ( $size == '50') {
	$size = 'margin50';
} else if ( $size == '60') {
	$size = 'margin60';
} else if ( $size == '70') {
	$size = 'margin70';
} else if ( $size == '80') {
	$size = 'margin80';
} else if ( $size == '90') {
	$size = 'margin90';
} else if ( $size == '100') {
	$size = 'margin100';
} else {	
	$size = 'margin10';
}


echo '<div class="' . $size . '"></div>';


?>