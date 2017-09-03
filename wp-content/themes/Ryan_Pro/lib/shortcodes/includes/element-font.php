<?php
$icon   = NULL;
$size   = NULL;
$color  = NULL;
$border = NULL;
$spin   = NULL;

$icon   = $atts['icon'];
$size   = $atts['size'];
$color  = $atts['color'];
$border = $atts['border'];
$spin   = $atts['spin	'];


if ( empty( $icon )  ) {
	$icon = 'fa fa-file';
} else {
	$icon = 'fa fa-' . $icon;
}
if ( empty( $size ) or $size == 'small' ) {
	$size = ' fa-lg';
} else if ( $size == 'medium' ) {
	$size = ' fa-2x';
} else if ( $size == 'large' ) {
	$size = ' fa-3x';
} else if ( $size == 'extra large' ) {
	$size = ' fa-4x';
}
if ( $color == 'light' ) {
	$color = ' fa-inverse';
} else {
	$color = '';
}
if ( $border == 'on' ) {
	$border = ' fa-border';
} else {
	$border = '';
}
if ( $spin == 'on' ) {
	$spin = ' fa-spin';
} else {
	$spin = '';
}

echo '<i class="' . $icon . $size . $border . $spin . $color .'"></i>';


?>