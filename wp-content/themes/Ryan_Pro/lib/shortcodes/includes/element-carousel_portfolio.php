<?php
$items         = NULL;
$show          = NULL;
$scroll        = NULL;
$speed         = NULL;
$effect        = NULL;
$link_icon     = NULL;
$lightbox_icon = NULL;
$title         = NULL;
$details       = NULL;
$content_style = NULL;
$category      = NULL;

$link_input           = NULL;
$lightbox_input       = NULL;
$overlay_class        = NULL;
$portfolio_styleclass = NULL;
$output_content       = NULL;

$items         = $atts['items'];
$show          = $atts['items'];
$scroll        = $atts['scroll'];
$speed         = $atts['speed'];
$effect        = $atts['effect'];
$link_icon     = $atts['link_icon'];
$lightbox_icon = $atts['lightbox_icon'];
$title         = $atts['title'];
$details       = $atts['details'];
$content_style = $atts['content_style'];
$category      = $atts['category'];

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

// Determine which portfolio content style is selected
if ( $content_style !== 'style2' ) {
	$portfolio_styleclass = ' style1';
} else {
	$portfolio_styleclass = ' style2';
}

$args = array(
	'post_type'   => 'portfolio',
	'numberposts' => 10,
	'post_status' => 'publish',
	'category'    => $category,
	);

$recent_posts = wp_get_recent_posts( $args );

echo '<div class="sc-carousel carousel-portfolio' . $portfolio_styleclass . ' items-' . $show . '" data-show="' . $show . '" data-scroll="' . $scroll . '" data-speed="' . $speed . '" data-effect="' . $effect . '">';

echo '<ul id="' . $instanceID . '">';

global $wp_embed;

	 foreach( $recent_posts as $recent ){
	 $post_id = get_post_thumbnail_id( $recent["ID"] );
	 $post_img = wp_get_attachment_image_src($post_id, $items, true);
	 $post_img_full = wp_get_attachment_image_src($post_id, 'full', true);

	 // Do not show post if default WordPress image is being used (e.g. no feautured image set)
	 if ( strpos( $post_img[0], 'wp-includes/images/media/default.png' ) !== false ) {
		$post_id = NULL;
	 }

	 $_thinkup_meta_featuredmedia     = get_post_meta( $recent["ID"], '_thinkup_meta_featuredmedia', true );
	 $_thinkup_meta_featuredmediatype = get_post_meta( $recent["ID"], '_thinkup_meta_featuredmediatype', true );
	 $_thinkup_meta_featuredmediamain = get_post_meta( $recent["ID"], '_thinkup_meta_featuredmediamain', true );

		// Input featured media as the main featured item if specified
		if ( ! empty( $_thinkup_meta_featuredmedia ) and $_thinkup_meta_featuredmediamain == 'option1' ) {

			// Remove http:// and https:// from video link
			if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
				$thinkup_input_featured = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
			} else {
				$thinkup_input_featured = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
			}

			// Determing featured media to input
			if ( $_thinkup_meta_featuredmediatype == 'option1' ) {
				$thinkup_input_featured = $wp_embed->run_shortcode('[embed]' . $thinkup_input_featured . '[/embed]');
			} else {
				$thinkup_input_featured = '<iframe src="' . $thinkup_input_featured . '"></iframe>';
			}
		} else {
			$thinkup_input_featured = '<img src="' . $post_img[0] . '" />';
		}

		// Input featured media as the lightbox item if specified
		if ( ! empty( $_thinkup_meta_featuredmedia ) ) {
	
			// Remove http:// and https:// from media link
			if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
				$thinkup_input_link = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
			} else {
				$thinkup_input_link = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
			}
	
			// Determine featured media to input
			if ( $_thinkup_meta_featuredmediatype == 'option2' ) {
			
				// Add source embed code if not present
				if (strpos( $thinkup_input_link, '&source=embed' ) !== false) {
				} else { 
					$thinkup_input_link = $thinkup_input_link . '&source=embed';
				}
	
				// Add iframe embed code if not present
				if (strpos( $thinkup_input_link, 'output=svembed?iframe=true' ) !== false) {
				} else if (strpos( $thinkup_input_link, 'output=svembed' ) !== false) {
					$thinkup_input_link = str_replace( 'output=svembed', 'output=svembed?iframe=true', $thinkup_input_link );
				} else {
					$thinkup_input_link = $thinkup_input_link . '&output=svembed?iframe=true';
				}
	
				$thinkup_input_link = $thinkup_input_link . '&width=75%&height=75%';
			} else {
				$thinkup_input_link = $thinkup_input_link;
			}
		} else {
			$thinkup_input_link = $post_img_full[0];
		}

	// Set link icon variable if user wants it to show
	if ( $link_icon !== 'off' ) {
		$link_input = '<a class="hover-link" href="'. get_permalink( $recent["ID"] ) . '"></a>';
	}

	// Set lightbox icon variable if user wants it to show
	if ( $lightbox_icon !== 'off' ) {
		$lightbox_input = '<a class="hover-zoom prettyPhoto" href="'. $thinkup_input_link . '"></a>';
	}

	// Determine which if single link animation should be shown
	if ( $link_icon == 'off' or $lightbox_icon == 'off' ) {
		$portfolio_class = ' style2';
	}

	// Determine which overlay style to apply
	if ( $content_style == 'style2' ) {
		$overlay_class = ' overlay2';
	}

	if ( ! empty( $post_id ) ) {
		
		// Reset output variables
		$overlay_input   = NULL;
		$output_content  = NULL;
		$output_content1 = NULL;
		$output_content2 = NULL;

		echo '<li>';

		if ( $title == 'on' or $details == 'on' ) {

			$output_content .= '<div class="port-details">';

			if ( $title == 'on' ) {
				$output_content .= '<h4 class="port-title"><a href="' . get_permalink( $recent["ID"] ) . '">' . get_the_title( $recent["ID"] ) . '</a></h4>'; 
			}
			if ( $details == 'on' and thinkup_input_excerptbyid( $recent["ID"] ) !== '' ) {
				$output_content .= thinkup_input_excerptbyid( $recent["ID"] );
			}

			$output_content .= '</div>';
		}

		if ( $content_style == 'style1' ) {
			$output_content1 = $output_content;
		} else if ( $content_style == 'style2' ) {
			$output_content2 = $output_content;
		}

		if ( $link_icon !== 'off' or $lightbox_icon !== 'off' ) {
			$overlay_input .= '<div class="image-overlay' . $portfolio_class . $overlay_class . '">';
			$overlay_input .= '<div class="image-overlay-inner">';
			$overlay_input .= '<div class="hover-icons">';
			$overlay_input .= $output_content2;
			$overlay_input .= $lightbox_input;
			$overlay_input .= $link_input;
			$overlay_input .= '</div>';
			$overlay_input .= '</div>';
			$overlay_input .= '</div>';
		}

		echo '<div class="entry-header">',
			 '<a href="' . get_permalink( $recent["ID"] ) . '" >' . $thinkup_input_featured . '</a>',
			 $overlay_input,
			 '</div>',
			 $output_content1;

		echo '</li>';
	}
}
echo '</ul>',
	 '<div class="caroufredsel_nav">',
	 '<a class="prev" id="' . $instanceID . '_prev" href="#"><i class="fa fa-angle-left"></i></a>',
	 '<a class="next" id="' . $instanceID . '_next" href="#"><i class="fa fa-angle-right"></i></a>',
//	 '<div class="pagination" id="' . $instanceID . '_pag"></div>',
	 '</div>',
	 '<div class="clearboth"></div>',
	 '</div>';

?>