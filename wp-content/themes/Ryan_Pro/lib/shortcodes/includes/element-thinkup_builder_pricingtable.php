<?php
$style  = NULL;
$image  = NULL;
$title  = NULL;
$price  = NULL;
$button = NULL;
$link   = NULL;
$target = NULL;
$width  = NULL;
$item   = NULL;
$icon   = NULL;

$style  = $atts['style'];
$image  = $atts['image'];
$title  = $atts['title'];
$price  = $atts['price'];
$button = $atts['button'];
$link   = $atts['link'];
$target = $atts['target'];
$width  = $atts['width'];

if ( empty( $style ) ) {
	$style = 'style 1';
}
if ( ! empty ( $image ) ) {
	$image = ' style="background: url( ' . $image . ' );background-size: cover;"';
}
if ( empty( $button ) ) {
	$button = 'Buy Now';
}
if ( ! is_numeric( $width ) ) {
	$width = '300';
}


// Output pricing table
$output .= '<div class="pricing-table ' . $style . '" style="max-width:' . $width . 'px">';

	$output .= '<div class="entry-header"' . $image . '>';
	$output .= '<div class="pricing-title">'.$title.'</div>';
	$output .= '<div class="pricing-price">'.$price.'</div>';
	$output .= '</div>';

	$output .= '<div class="entry-content">';
	$output .= '<ul class="pricing-features">';

		?><?php foreach((array) $groups['item'] as $increment=>$context){ ?><?php
		$item = $context['item'];
		$icon = $context['icon'];

		if ( ! empty( $icon ) ) {
			$icon = '<i class="fa fa-' . $icon . '"></i>';
		}

		$output .= '<li>' . $icon  . $item . '</li>';

		?><?php } ?><?php

	$output .= '</ul>';
	$output .= '</div>';

	$output .= '<div class="entry-footer">';
	$output .= '<div class="pricing-link"><a href="' . $link . '" class="themebutton">' . $button . '</a></div>';
	$output .= '</div>';

$output .= '</div>';

echo $output;


?>