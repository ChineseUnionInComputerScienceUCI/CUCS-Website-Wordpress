<?php
$style = NULL;
$text  = NULL;

$style = $atts['style'];
$text  = $atts['text'];

if ( empty ( $style ) ) {
	$style = 'style1';
}

echo '<blockquote class="' . $style . '">' . $text . '</blockquote>';
?>