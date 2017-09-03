<?php
$link    = NULL;
$counter = NULL;

$link    = $atts['link'];
$counter = $atts['counter'];


if ( $counter == 'top' ) {
	$counter = 'top';
} else if ( $counter == 'right' ) {
	$counter = 'right';
} else {
	$counter = '';
}

	echo '<script class="linkedin" type="IN/Share" data-url="' . $link . '" data-counter="' . $counter . '"></script>';
?>
