<?php
$items    = NULL;
$show     = NULL;
$scroll   = NULL;
$speed    = NULL;
$effect   = NULL;
$style    = NULL;
$links    = NULL;
$category = NULL;

$selected   = NULL;
$link_start = NULL;
$link_end   = NULL;

$items    = $atts['items'];
$show     = $atts['items'];;
$scroll   = $atts['scroll'];
$speed    = $atts['speed'];
$effect   = $atts['effect'];
$style    = $atts['style'];
$links    = $atts['links'];
$category = $atts['category'];

// Set number of items to 1 if style1 is selected
if ( empty( $style ) or $style == 'style1' ) {
	$show = 1;
} else {
	$items = 0;
}

$args = array(
	'post_type'   => 'testimonial',
	'numberposts' => $items,
	'post_status' => 'publish',
	'category'    => $category,
	);

$recent_posts = wp_get_recent_posts( $args );

echo '<div class="sc-carousel carousel-testimonial ' . $style . '" data-show="' . $show . '" data-scroll="' . $scroll . '" data-speed="' . $speed . '" data-effect="' . $effect . '">';

	echo '<ul id="' . $instanceID . '">';
	$i = 0;
	foreach( $recent_posts as $recent ){
		$i = $i + 1;
		$post_id = get_post_thumbnail_id( $recent["ID"] );
		if ( ! empty( $post_id ) ) {
		echo '<li id="' . $instanceID . '-' . $i . '">';

		$_thinkup_meta_testimonialname    = get_post_meta( $recent["ID"], '_thinkup_meta_testimonialname', true );
		$_thinkup_meta_testimonialcompany = get_post_meta( $recent["ID"], '_thinkup_meta_testimonialcompany', true );

		if ( $links == 'off' ) {
			$link_start = NULL;
			$link_end   = NULL;
		} else {
			$link_start = '<a href="' . get_permalink( $recent["ID"] ) . '">';
			$link_end   = '</a>';
		}

		// Determine which content style should be output
		if ( empty( $style ) or $style == 'style1' ) {

			$post_img = wp_get_attachment_image_src($post_id, 'sc-testimonial-1', true);

			echo '<div class="entry-header">';
			echo '<div class="testimonial-excerpt">';
			echo wpautop( get_post( $recent["ID"] )->post_excerpt );
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
			echo wpautop( get_post( $recent["ID"] )->post_excerpt );
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
			echo wpautop( get_post( $recent["ID"] )->post_excerpt );
			echo '</div>';

			echo '<div class="testimonial-quote"></div>';
			
			echo '</div>';

		}

		echo '</li>';
		}
		$i++;
	}
	echo '</ul>';



	// Output pagination - Style 1 has image thumbnails
	if ( empty( $style ) or $style == 'style1' ) {

		echo '<div class="sc-carousel-thumbs testimonial-thumb">';
		$i = 0;
		foreach( $recent_posts as $recent ){
			$i = $i + 1;
			$post_id = get_post_thumbnail_id( $recent["ID"] );
			$post_img = wp_get_attachment_image_src($post_id, 'sc-testimonial-1', true);
			
			if ( $i == 1 ) { $selected = 'selected'; } else { $selected = ''; }
			
			echo '<a href="#' . $instanceID . '-' . $i . '" class="' . $selected . '"><img src="' . $post_img[0] . '" /></a>';
			$i++;
		}
		echo '</div>';

	} else {

		echo '<div class="caroufredsel_nav">',
			 '<a class="prev" id="' . $instanceID . '_prev" href="#"><i class="fa fa-angle-left"></i></a>',
			 '<a class="next" id="' . $instanceID . '_next" href="#"><i class="fa fa-angle-right"></i></a>',
	//		 '<div class="pagination" id="' . $instanceID . '_pag"></div>',
			 '</div>',
			 '<div class="clearboth"></div>';

	}

echo '</div>';

?>