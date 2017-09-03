<?php
$items          = NULL;
$title          = NULL;
$excerpt        = NULL;
$date           = NULL;
$comments       = NULL;
$show           = NULL;
$scroll         = NULL;
$speed          = NULL;
$effect         = NULL;
$center         = NULL;
$category       = NULL;
$link_icon      = NULL;
$lightbox_icon  = NULL;
$overlay_style  = NULL;
$excerpt_length = NULL;

$link_input     = NULL;
$lightbox_input = NULL;
$overlay_class  = NULL;
$overlay_style  = NULL;
$center_start   = NULL;
$center_end     = NULL;
$post_excerpt   = NULL;

$items          = $atts['items'];
$title          = $atts['title'];
$excerpt        = $atts['excerpt'];
$date           = $atts['date'];
$comments       = $atts['comments'];
$show           = $atts['items'];
$scroll         = $atts['scroll'];
$speed          = $atts['speed'];
$effect         = $atts['effect'];
$center         = $atts['center'];
$category       = $atts['category'];
$link_icon      = $atts['link_icon'];
$lightbox_icon  = $atts['lightbox_icon'];
$overlay_style  = $atts['overlay_style'];
$excerpt_length = $atts['excerpt_length'];

if ( $items == '1' ) {
	$items  = 'column1-2/3';
} else if ( $items == '2' ) {
	$items  = 'column2-2/3';
} else if ( $items == '3' ) {
	$items  = 'column3-2/3';
} else if ( $items >= '4' ) {
	$items  = 'column4-2/3';
} else {
	$items  = 'column2-1/2';
}

// Determine which overlay style to use
if ( $overlay_style == 'style2' ) {
	$overlay_style = ' overlay2';
} else {
	$overlay_style = NULL;		
}

// Add extra div to align text in center
if ( $center == 'on' ) {
	$center_start = '<div id="' . $instanceID . '">';;
	$center_end   = '</div>';
}

$args = array(
	'post_type'   => 'post',
	'numberposts' => 10,
	'post_status' => 'publish',
	'category'    => $category,
	);
$recent_posts = wp_get_recent_posts( $args );

echo $center_start;

echo '<div class="sc-carousel carousel-blog" data-show="' . $show . '" data-scroll="' . $scroll . '" data-speed="' . $speed . '" data-effect="' . $effect . '">';

echo '<ul>';
	 foreach( $recent_posts as $recent ){
	 $post_id = get_post_thumbnail_id( $recent["ID"] );
	 $post_img = wp_get_attachment_image_src($post_id, $items, true);
	 $post_img_full = wp_get_attachment_image_src($post_id, 'full', true);

	 // Do not show post if default WordPress image is being used (e.g. no feautured image set)
	 if ( strpos( $post_img[0], 'wp-includes/images/media/default.png' ) !== false ) {
		$post_id = NULL;
	 }
	 
	// Set link icon variable if user wants it to show
	if ( $link_icon !== 'off' ) {
		$link_input = '<a class="hover-link" href="'. get_permalink( $recent["ID"] ) . '"></a>';
	}

	// Set lightbox icon variable if user wants it to show
	if ( $lightbox_icon !== 'off' ) {
		$lightbox_input = '<a class="hover-zoom prettyPhoto" href="'. $post_img_full[0] . '"></a>';
	}

	// Determine which if single link animation should be shown
	if ( $link_icon == 'off' or $lightbox_icon == 'off' ) {
		$overlay_class = ' style2';
	}

	if ( $link_icon !== 'off' or $lightbox_icon !== 'off' ) {
		$overlay_input  = NULL;
		$overlay_input .= '<div class="image-overlay' . $overlay_style . $overlay_class . '">';
		$overlay_input .= '<div class="image-overlay-inner">';
		$overlay_input .= '<div class="hover-icons">';
		$overlay_input .= $lightbox_input;
		$overlay_input .= $link_input;
		$overlay_input .= '</div>';
		$overlay_input .= '</div>';
		$overlay_input .= '</div>';
	}

	if ( ! empty( $post_id ) ) {
		echo '<li class="blog-article">',
			 '<div class="entry-header">',
			 '<a href="' . get_permalink( $recent["ID"] ) . '" ><img src="' . $post_img[0] . '" /></a>',
			 $overlay_input,
			 '</div>';

		if ( $title == 'on' or $excerpt == 'on' or $date == 'on' or $comments == 'on' ) {

			echo '<div class="entry-content">';

			// Input post meta
			if ( $date == 'on' or $comments == 'on' ) {

				echo '<div class="entry-meta">';

				// Input post date
				if ( $date == 'on' ) {
					echo '<span class="date">';
	
					printf( __( '<a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a>', 'ryan' ),
						esc_url( get_permalink() ),
						esc_attr( get_the_title() ),
						esc_attr( get_the_date( 'c', $recent["ID"] ) ),
						esc_html( get_the_date( 'M j, Y', $recent["ID"] ) )
					);
		
	
					echo '</span>';
				}

				// Input post comments
				if ( $comments == 'on' ) {
					 $comment_count = (int) get_comments_number( $recent["ID"] );
					 echo	'<span class="comment">',
							'<a href="' . get_comments_link( $recent["ID"] ) . '">' . $comment_count .' comments</a>',
							'</span>';
				}

				echo '</div>';
			}

			// Input post title
			if ( $title == 'on' ) {
				echo '<h4><a href="' . get_permalink( $recent["ID"] ) . '" >' . $recent["post_title"] . '</a></h4>';
			}

			// Input post excerpt
			if ( $excerpt == 'on' and thinkup_input_excerptbyid( $recent["ID"] ) !== '' ) {

				if ( empty( $excerpt_length ) or $excerpt_length == '0' ) {

					echo thinkup_input_excerptbyid( $recent["ID"] );
					
				} else {

					$post_excerpt = explode( ' ', thinkup_input_excerptbyid( $recent["ID"] ) );
					$post_excerpt = implode( ' ', array_splice( $post_excerpt, 0, $excerpt_length ) );
					echo $post_excerpt . '<span class="carousel-excerpt-end">...</span>';

				}

			}

			echo '</div>';
		}
		echo '</li>';
	}
}
echo '</ul>';

echo '<div class="caroufredsel_nav">',
	 '<a class="prev" id="' . $instanceID . '_prev" href="#"><i class="fa fa-angle-left"></i></a>',
	 '<a class="next" id="' . $instanceID . '_next" href="#"><i class="fa fa-angle-right"></i></a>',
//	 '<div class="pagination" id="' . $instanceID . '_pag"></div>',
	 '</div>',
	 '<div class="clearboth"></div>',
	 '</div>';

echo $center_end;

//====================================================================
// Output custom styling if set
//====================================================================

if ( $center  == 'on' ) {
	echo '<style>';
		echo '#' . $instanceID . ' .entry-content { text-align: center; }';
	echo '</style>';
}

?>