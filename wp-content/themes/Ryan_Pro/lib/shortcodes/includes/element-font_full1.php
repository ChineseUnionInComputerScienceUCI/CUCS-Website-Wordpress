<?php
$title       = NULL;
$link        = NULL;
$button      = NULL;
$icon        = NULL;
$size        = NULL; 
$color       = NULL;
$background  = NULL;
$border      = NULL;
$spin        = NULL;

$link_start       = NULL;
$link_end         = NULL; 
$link_class       = NULL;
$link_icon        = NULL;
$button_class     = NULL;
$background_class = NULL;
$background_color = NULL;
$border_color     = NULL;
$custom_color     = NULL;

$title       = $atts['title'];
$link        = $atts['link'];
$button      = $atts['button'];
$icon        = $atts['icon'];
$size        = $atts['size'];
$color       = $atts['color'];
$background  = $atts['background'];
$border      = $atts['border'];
$spin        = $atts['spin'];


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

if ( ! empty( $background ) or ! empty( $border ) ) {
	$background_class = ' iconbackground';

	if ( ! empty( $background ) ) {
		$background_color = ' background: ' . $background . ';';
	}
	if ( ! empty( $border ) ) {
		$border_color = ' border: ' . $border . ';';
	}
	$custom_color = ' style="' . $background_color . $border_color . ';"';

} else {
	$background_class = NULL;
	$custom_color     = NULL;
}

if ( $color == 'light' ) {
	$color        = ' fa-inverse';
//	$button_class = 'themebutton2';
} else {
	$color        = '';
//	$button_class = 'themebutton';
}
if ( $spin == 'on' ) {
	$spin = ' fa-spin';
} else {
	$spin = '';
}
if ( ! empty( $title ) ) {
	$title = '<h3>' . $title. '</h3>';
} else {
	$title = '';
}
if ( ! empty( $link ) ) {
	if ( ! empty( $button ) ) {
		$link_class = ' iconlink';
		$link_icon  = '<p class="iconurl"><a href="' . $link . '" class="' . $button_class . '">' . $button . '</a></p>';
	}
	$link_start = '<a href="' . $link . '">';
	$link_end   = '</a>';
}

echo     '<div class="iconfull style1' . $link_class .  $background_class . '"' . $custom_color . '>',
		     '<div class="iconimage">',
			     $link_start . '<i class="' . $icon . $size . $spin . $color .'"></i>' . $link_end,
		     '</div>',
	    	 '<div class="iconmain">',
				 $title,
	    		 '<p>' . $content . '</p>',
				 $link_icon,
	    	 '</div>',
	     '</div>';


?>