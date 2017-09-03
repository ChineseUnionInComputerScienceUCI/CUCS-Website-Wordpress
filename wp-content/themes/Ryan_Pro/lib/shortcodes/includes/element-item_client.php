<?php
$id       = NULL;
$size     = NULL;

$id       = $atts['id'];
$size     = $atts['size'];

if ( empty( $size ) ) $size = 'full';

$post_id = get_post_thumbnail_id( $id );
$post_img = wp_get_attachment_image_src($post_id, $size, true);

		echo '<div class="entry-header">',
			 '<img src="' . $post_img[0] . '" />',
			 '</div>';

?>