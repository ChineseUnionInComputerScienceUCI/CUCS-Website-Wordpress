<?php
$id    = NULL;
$style = NULL;
$links = NULL;

$link_start = NULL;
$link_end   = NULL;

$id    = $atts['id'];
$style = $atts['style'];
$links = $atts['links'];

	echo '<div class="sc-carousel carousel-testimonial sc-postitem ' . $style . '">';

		$post_id = get_post_thumbnail_id( $id );

		$_thinkup_meta_testimonialname    = get_post_meta( $id, '_thinkup_meta_testimonialname', true );
		$_thinkup_meta_testimonialcompany = get_post_meta( $id, '_thinkup_meta_testimonialcompany', true );

		if ( $links == 'off' ) {
			$link_start = NULL;
			$link_end   = NULL;
		} else {
			$link_start = '<a href="' . get_permalink( $id ) . '">';
			$link_end   = '</a>';
		}

		// Determine which content style should be output
		if ( empty( $style ) or $style == 'style1' ) {

			$post_img = wp_get_attachment_image_src($post_id, 'sc-testimonial-1', true);

			echo '<div class="entry-header">';
			echo '<div class="testimonial-thumb">';
			echo $link_start . '<img src="' . $post_img[0] . '" />' . $link_end;
			echo '</div>';
			echo '</div>';

			echo '<div class="entry-content">';

			echo '<div class="testimonial-excerpt">';
			echo wpautop( get_post( $id )->post_excerpt );
			echo '</div>';

			echo '<div class="testimonial-name">';
			echo '<h3>' . $link_start . $_thinkup_meta_testimonialname . $link_end . '</h3>';
			echo '</div>';

			echo '<div class="testimonial-position">';
			echo $_thinkup_meta_testimonialcompany;
			echo '</div>';

			echo '</div>';

		} else if ( $style == 'style2' ) {

			$post_img = wp_get_attachment_image_src($post_id, 'sc-testimonial-2', true);

			echo '<div class="entry-header">';
			echo '<div class="testimonial-thumb">';
			echo $link_start . '<img src="' . $post_img[0] . '" />' . $link_end;
			echo '</div>';
			echo '</div>';

			echo '<div class="entry-content">';

			echo '<div class="testimonial-name">';
			echo '<h3>' . $link_start . $_thinkup_meta_testimonialname . $link_end . '</h3>';
			echo '</div>';

			echo '<div class="testimonial-position">';
			echo $_thinkup_meta_testimonialcompany;
			echo '</div>';

			echo '<div class="testimonial-excerpt">';
			echo wpautop( get_post( $id )->post_excerpt );
			echo '</div>';

			echo '<div class="testimonial-quote"></div>';

			echo '</div>';

		} else if ( $style == 'style3' ) {

			$post_img = wp_get_attachment_image_src($post_id, 'thumbnail', true);

			echo '<div class="entry-header">';
			echo '<div class="testimonial-thumb">';
			echo $link_start . '<img src="' . $post_img[0] . '" />' . $link_end;
			echo '</div>';
			echo '</div>';

			echo '<div class="entry-content">';

			echo '<div class="testimonial-name">';
			echo '<h3>' . $link_start . $_thinkup_meta_testimonialname . $link_end . '</h3>';
			echo '</div>';

			echo '<div class="testimonial-position">';
			echo $_thinkup_meta_testimonialcompany;
			echo '</div>';

			echo '<div class="testimonial-excerpt">';
			echo wpautop( get_post( $id )->post_excerpt );
			echo '</div>';

			echo '<div class="testimonial-quote"></div>';
			
			echo '</div>';

		}

	echo '</div>';

?>