<?php
$link    = NULL;
$icon    = NULL;
$size    = NULL; 
$color   = NULL;
$border  = NULL;
$spin    = NULL;

$link_class = NULL;
$link_icon  = NULL;

$link       = $atts['link'];
$icon       = $atts['icon'];
$size       = $atts['size'];
$color      = $atts['color'];
$border     = $atts['border'];
$spin       = $atts['spin'];


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
if ( ! empty( $link ) ) {
	$link_class = ' iconlink';
	$link_icon  = '</p class="iconurl"><a href="' . $link . '">Read More</a></p>';
}

echo     '<div class="icontext' . $link_class . '">',
	     '<div class="iconimage">',
	     '<i class="' . $icon . $size .  $border . $spin . $color .'"></i>',
	     '</div>',
	     '<div class="iconmain">',
	     '<p>' . $content . '</p>',
		 $link_icon,
	     '</div>',
	     '</div>';


?>