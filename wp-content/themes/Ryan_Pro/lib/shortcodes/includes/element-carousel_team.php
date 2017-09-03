<?php
$items         = NULL;
$scroll        = NULL;
$style         = NULL;
$speed         = NULL;
$effect        = NULL;
$show_link     = NULL;
$show_name     = NULL;
$show_position = NULL;
$show_excerpt  = NULL;
$show_social   = NULL;
$center        = NULL;
$tag           = NULL;

$items         = $atts['items'];
$scroll        = $atts['scroll'];
$style         = $atts['style'];
$speed         = $atts['speed'];
$effect        = $atts['effect'];
$show_link     = $atts['show_link'];
$show_name     = $atts['show_name'];
$show_position = $atts['show_position'];
$show_excerpt  = $atts['show_excerpt'];
$show_social   = $atts['show_social'];
$center        = $atts['center'];
$tag           = $atts['tag'];

$center_start    = NULL;
$center_end      = NULL;
$output          = NULL;
$output_social   = NULL;
$team_styleclass = NULL;

// Determine which style to use
if ( $style !== 'style2' ) {
	$team_styleclass = ' style1';
} else {
	$team_styleclass = ' style2';
}

// Add extra div to align text in center
if ( $center == 'on' ) {
	$center_start = '<div id="' . $instanceID . '">';;
	$center_end   = '</div>';
}

$args = array(
	'post_type'   => 'team',
	'numberposts' => 10,
	'post_status' => 'publish',
);
$recent_posts = wp_get_recent_posts( $args );

$output .= '<div class="sc-carousel carousel-team' . $team_styleclass . '" data-show="' . $items . '" data-scroll="' . $scroll . '" data-speed="' . $speed . '" data-effect="' . $effect . '">';

$output .= '<ul>';

	foreach( $recent_posts as $recent ){
	$post_id = get_post_thumbnail_id( $recent["ID"] );
	
	// Determine which image size to use
	if ( $style !== 'style2' ) {
		$post_img = wp_get_attachment_image_src($post_id, 'column2-2/3', true);
	} else {
		$post_img = wp_get_attachment_image_src($post_id, 'column2-2/3', true);
	}

	// Do not show post if default WordPress image is being used (e.g. no feautured image set)
	if ( strpos( $post_img[0], 'wp-includes/images/media/default.png' ) !== false ) {
		$post_id = NULL;
	}

	// Do not show if tag ID is set and post does not have specified tag
	if( !empty( $tag ) ) {
		$teamtags = wp_get_post_terms( $recent["ID"], 'team_tag', array('fields' => 'ids') );

		$indicator_tag = NULL;

		foreach( $teamtags as $teamtag ) {
			if ( $tag == $teamtag ) {
				$indicator_tag = 1;
			}
		}

		if ( $indicator_tag == NULL ) {
			$post_id = NULL;
		}
	}

	$_thinkup_meta_teamposition  = get_post_meta( $recent["ID"], '_thinkup_meta_teamposition', true );

	if ( ! empty( $post_id ) ) {

		// Reset output variables
		$output_social   = NULL;

		$output .= '<li>';
		$output .= '<div class="entry-header"><div class="team-thumb">';
		$output .= '<a href="'. get_permalink( $recent["ID"] ) . '"><img src="' . $post_img[0] . '" /></a>';

			// Output excerpt if set
			if( $show_social == 'on' ) {
				$_thinkup_meta_teamfacebook  = get_post_meta( $recent["ID"], '_thinkup_meta_teamfacebook', true );
				$_thinkup_meta_teamtwitter   = get_post_meta( $recent["ID"], '_thinkup_meta_teamtwitter', true );
				$_thinkup_meta_teamgoogle    = get_post_meta( $recent["ID"], '_thinkup_meta_teamgoogle', true );
				$_thinkup_meta_teamlinkedin  = get_post_meta( $recent["ID"], '_thinkup_meta_teamlinkedin', true );
				$_thinkup_meta_teaminstagram = get_post_meta( $recent["ID"], '_thinkup_meta_teaminstagram', true );
				$_thinkup_meta_teamdribbble  = get_post_meta( $recent["ID"], '_thinkup_meta_teamdribbble', true );
				$_thinkup_meta_teamflickr    = get_post_meta( $recent["ID"], '_thinkup_meta_teamflickr', true );
		
				// Reset count values used in foreach loop
				$i = 0;
				$j = 0;
		
				// Assign social media link to an array
				$social_links = array( 
					array( 'social' => 'Facebook',    'link' => $_thinkup_meta_teamfacebook ),
					array( 'social' => 'Twitter',     'link' => $_thinkup_meta_teamtwitter ),
					array( 'social' => 'Google-plus', 'link' => $_thinkup_meta_teamgoogle ),
					array( 'social' => 'LinkedIn',    'link' => $_thinkup_meta_teamlinkedin ),
					array( 'social' => 'Instagram',   'link' => $_thinkup_meta_teaminstagram ),
					array( 'social' => 'Dribbble',    'link' => $_thinkup_meta_teamdribbble ),
					array( 'social' => 'Flickr',      'link' => $_thinkup_meta_teamflickr ),
				);
		
				// Output social media links if any link is set
				foreach( $social_links as $social ) {	
					if ( ! empty( $social['link'] ) and $j == 0 ) { $output_social .= '<div class="team-social"><ul>'; $j = 1; }
		
					if ( ! empty( $social['link'] ) ) {
						$output_social .= '<li class="social ' . strtolower( $social['social'] ) .'">';
						$output_social .= '<a href="' . $social['link'] . '">';
						$output_social .= '<i class="fa fa-' . strtolower( $social['social'] ) . '"></i>';
						$output_social .= '</a>';
						$output_social .= '</li>';
					}
				}
		
				// Close list output of social media links if any link is set
				if ( $j == 1 ) { $output_social .= '</ul></div>'; }
			}


		// Output overlay link to team page if set
		if ( $show_link !== 'off' ) {
			$output .= '<div class="image-overlay style2">';
			$output .= '<div class="image-overlay-inner">';
			$output .= '<div class="hover-icons">';
			$output .= '<a class="hover-link" href="'. get_permalink( $recent["ID"] ) . '"></a>';
			$output .= '</div>';
		 	$output .= '</div>';
			$output .= '</div>';
		}

		$output .= '</div></div>';

		$output .= '<div class="entry-content">';

			if ( $show_name == 'on' or $show_position == 'on' or $show_excerpt == 'on' or $show_social == 'on' ) {
		
				// Output team member name if set
				if( $show_name == 'on' ) {
					$output .= '<h4><a href="'. get_permalink( $recent["ID"] ) . '">' . get_the_title( $recent["ID"] ) . '</a></h4>';
				}
				
				// Output team member position if set
				if( $show_position == 'on' and ! empty( $_thinkup_meta_teamposition ) ) {
					$output .= '<h5>' . $_thinkup_meta_teamposition . '</h5>';
				}
		
				// Output excerpt if set
				if ( thinkup_input_excerptbyid( $recent["ID"] ) !== '' and $show_excerpt == 'on' ) {
					$output .= thinkup_input_excerptbyid( $recent["ID"] );
				}

				// Output social media if set
				if ( $show_social == 'on' ) {
					$output .= $output_social;
				}

			}

		$output .= '</div>';

		$output .= '</li>';
	}
}

$output .= '</ul>';

$output .= '<div class="caroufredsel_nav">';
$output .= '<a class="prev" id="' . $instanceID . '_prev" href="#"><i class="fa fa-angle-left"></i></a>';
$output .= '<a class="next" id="' . $instanceID . '_next" href="#"><i class="fa fa-angle-right"></i></a>';
//	 '<div class="pagination" id="' . $instanceID . '_pag"></div>';
$output .= '</div>';
$output .= '<div class="clearboth"></div>';
$output .= '</div>';

// Output content
echo $center_start . $output . $center_end;

//====================================================================
// Output custom styling if set
//====================================================================

if ( $center  == 'on' ) {
	echo '<style>';
		echo '#' . $instanceID . ' .carousel-team li { text-align: center; }';
		echo '#' . $instanceID . ' .team-social ul { margin: 0 auto; }';
	echo '</style>';
}

?>