<?php
function thinkup_builder_featuredtheme_remove_pbcss() {
	$output = NULL;

	$output .= '<style>';
	$output .= '.thinkup_builder_featured {';
	$output .= 'display: none !important;';
	$output .= '}';
	$output .= '</style>';

	echo $output;
}
add_action( 'admin_head', 'thinkup_builder_featuredtheme_remove_pbcss' );
?>