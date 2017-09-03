<?php
$image        = NULL;
$video        = NULL;
$title        = NULL;
$description  = NULL;
$link         = NULL;
$button       = NULL;
$class        = NULL;

$height       = NULL;
$full_width   = NULL;
$style        = NULL;
$slider_speed = NULL;

$class_width = NULL;
$class_style = NULL;
$data_speed  = NULL;

$image        = $atts['image'];
$video        = $atts['video'];
$title        = $atts['title'];
$description  = $atts['description'];
$link         = $atts['link'];
$button       = $atts['button'];
$class        = $atts['class'];
$height       = $atts['height'];

$height       = $atts['height'];
$full_width   = $atts['full_width'];
$style        = $atts['style'];
$slider_speed = $atts['slider_speed'];

// Set height
if ( empty( $height ) or $height == '0' ) {
	$height = '200';
}

// Set full width of specified
if ( $full_width == 'on' ) {
	$full_width  = ' data-wide="on"';
	$class_width = ' full-width';	
} else {
	$full_width  = NULL;
	$class_width = NULL;
}

		// Set slider speed data attribute
		if ( empty( $slider_speed ) ) {
			$slider_speed = '6000';
		} else {
			$slider_speed = $slider_speed * 1000;
		}

		$data_speed = ' data-speed="' . $slider_speed . '"';

		// Set slider style class
		if ( empty( $style ) or $style == 'option1' ) {
			$class_style = ' style1';
		} else if ( $style == 'option2' ) {
			$class_style = ' style2';
		} else if ( $style == 'option3' ) {
			$class_style = ' style3';
		}
	
		echo	'<div class="thinkupslider-sc' . $class_style . $class_width . '" data-height="' .$height . '"' . $full_width . '><div id="' . $instanceID . '" class="thinkupslider-sc-core">';

			echo '<div class="rslides-container"' . $data_speed . '><div class="rslides-inner page-inner"><ul class="slides">';

			if ( empty( $style ) or $style == 'option1' ) {

				echo thinkup_inputpb_sliderstandard( $instanceID, $image, $video, $title, $description, $link, $button, $class, $style );
				
			} else if ( $style == 'option2' or $style == 'option3' ) {

				echo thinkup_inputpb_slidervideo( $instanceID, $image, $video, $title, $description, $link, $button, $class, $style );

			}

			echo '</ul></div></div>';

		echo '</div></div>';

		thinkup_inputpb_slidervideojs( $instanceID, $image, $video, $title, $description, $link, $button, $class, $style );
?>