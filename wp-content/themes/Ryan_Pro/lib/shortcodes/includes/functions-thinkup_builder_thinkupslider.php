<?php
// Create standard image slides
function thinkup_inputpb_sliderstandard( $instanceID, $image, $video, $title, $description, $link, $button, $class, $style ) {

	foreach ( (array) $image as $increment=>$context ) {

		$slide_img         = $image[ $increment ];
		$slide_video       = $video[ $increment ];
		$slide_title       = $title[ $increment ];
		$slide_description = $description[ $increment ];
		$slide_link        = $link[ $increment ];
		$slide_button      = $button[ $increment ];
		$slide_class       = $class[ $increment ];

		// Get url of background image or set video overlay image
		if ( ! empty( $slide_video ) ) {
			$slide_image = 'background: url(' . get_template_directory_uri() . '/images/slideshow/overlay.png' . ') repeat center;';
		} else {
			$slide_image = 'background: url(' . $slide_img . ') no-repeat center; background-size: cover;';
		}

		// Get additional style classes if set by user
		if ( ! empty( $slide_class ) ) {
			$slide_class = ' ' . str_replace( ',', ' ', $slide_class );
		} else {
			$slide_class = NULL;		
		}

		// Determine whether to link slide or add button or no link
		if ( ! empty( $slide_link ) and empty( $slide_button ) ) {
			$slide_link_start = '<a href="' . $slide_link . '">';
			$slide_link_end   = '</a>';
		} else {
			$slide_link_start = NULL;
			$slide_link_end   = NULL;
		}

		echo '<li>',
			 '<img src="' . get_template_directory_uri() . '/images/transparent.png" style="' .$slide_image . '" alt="' . $slide_title . '" />',
			 '<div class="rslides-content' . $slide_class . '">',
			 $slide_link_start,
			 '<div class="wrap-safari">',
			 '<div class="rslides-content-inner">',
			 '<div class="featured">';

			if ( ! empty( $slide_title ) ) {
				echo '<div class="featured-title">',
					 '<span>' . $slide_title . '</span>',
					 '</div>';
			}
			if ( ! empty( $slide_description ) ) {
				$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide_description ));
				$slide_description = str_replace( '</p>', '</span></p>', $slide_description );
				echo '<div class="featured-excerpt">',
					 $slide_description,
					 '</div>';
			}
			if ( ! empty( $slide_link ) and ! empty( $slide_button ) ) {

				echo '<div class="featured-link">',
					 '<a href="' . $slide_link . '"><span>' . $slide_button . '</span></a>',
					 '</div>';
			}
		echo '</div>',
			  '</div>',
			  '</div>',
			  $slide_link_end,
			  '</div>',
			  '</li>';
	}
}

// Create video slides
function thinkup_inputpb_slidervideo( $instanceID, $image, $video, $title, $description, $link, $button, $class, $style ) {
global $post;
global $wp_embed;

	$thinkup_classvideo = NULL;
	$thinkup_classtext  = NULL;
		
	if ( $style == 'option2' ) {
		$thinkup_classvideo = ' one_half';
		$thinkup_classtext  = ' one_half last';
	} else if ( $style == 'option3' ) {
		$thinkup_classvideo = ' one_half last';
		$thinkup_classtext  = ' one_half';
	}

	foreach ( (array) $image as $increment=>$context ) {

		$output_text  = NULL;
		$output_video = NULL;

		$slide_img         = $image[ $increment ];
		$slide_video       = $video[ $increment ];
		$slide_title       = $title[ $increment ];
		$slide_description = $description[ $increment ];
		$slide_button      = $button[ $increment ];
		$slide_link        = $link[ $increment ];
		$slide_class       = $class[ $increment ];

		$output_text .= '<div class="featured' . $thinkup_classtext . '">';

		if ( ! empty( $slide_title ) ) {
			$output_text .= '<div class="featured-title">';
			$output_text .= '<span>' . $slide_title . '</span>';
			$output_text .= '</div>';
			}
		if ( ! empty( $slide_description ) ) {
			$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide_description ));
			$slide_description = str_replace( '</p>', '</span></p>', $slide_description );

			$output_text .= '<div class="featured-excerpt">' . $slide_description . '</div>';
		}
		if ( ! empty( $slide_link ) and ! empty( $slide_button ) ) {
			$output_text .= '<div class="featured-link">';
			$output_text .= '<a href="' . esc_url( $slide_link ) . '"><span>' . esc_html( $slide_button ) . '</span></a>';
			$output_text .= '</div>';
		}
	$output_text .= '</div>';

	$output_video .= '<div class="featured-video' . $thinkup_classvideo . '">';
		// Determing whether video is YouTube, Vimeo or html.
		if ( strpos( $slide_video, 'youtube.com' ) !== false or strpos( $slide_video, 'vimeo.com' ) !== false ) {
			$output_video .= $wp_embed->run_shortcode('[embed]' . $slide_video . '[/embed]');
		} else {
			$output_video .= do_shortcode('[video src="' . $slide_video . '"]');
		}
	$output_video .= '</div>';

		// Get url of background image
		$slide_image = 'background: url(' . $slide_img . ') no-repeat center; background-size: cover;';

		// Get additional style classes if set by user
		if ( ! empty( $slide_class ) ) {
			$slide_class = ' ' . str_replace( ',', ' ', $slide_class );
		} else {
			$slide_class = NULL;		
		}

		// Determine whether to link slide or add button or no link
		if ( ! empty( $slide_link ) and empty( $slide_button ) ) {
			$slide_link_start = '<a href="' . $slide_link . '">';
			$slide_link_end   = '</a>';
		} else {
			$slide_link_start = NULL;
			$slide_link_end   = NULL;
		}

		echo '<li>',
			 '<img src="' . get_template_directory_uri() . '/images/transparent.png" style="' .$slide_image . '" alt="' . $slide['slide_title']. '" />',
			 '<div class="rslides-content' . $slide_class . '">',
			 $slide_link_start,
			 '<div class="wrap-safari">',
			 '<div class="rslides-content-inner">';
			 
			if ( $style == 'option2' ) {
				echo $output_video;
				echo $output_text;
			} else if ( $style == 'option3' ) {
				echo $output_text;
				echo $output_video;
			}

		echo  '</div>',
			  '</div>',
			  $slide_link_end,
			  '</div>',
			  '</li>';
	}
}

// Output jQuery for video backgrounds
function thinkup_inputpb_slidervideojs( $instanceID, $image, $video, $title, $description, $link, $button, $class, $style ) {

	$output = NULL;

	if ( empty( $style ) or $style == 'option1' ) {

		if ( isset( $image ) and is_array( $image ) ) {

			foreach ( (array) $image as $increment=>$context ) {

				if ( ! empty( $video[ $increment ] ) ) {

				// Reset slide url variable values
				$slide_video      = NULL;
				$slide_video_mp4  = NULL;
				$slide_video_ogv  = NULL;
				$slide_video_webm = NULL;
				$slide_video_jpg  = NULL;

				// Remove suffix for url's
				$slide_video = $video[ $increment ];
				$slide_video = str_replace( '.mp4',  '', $slide_video );
				$slide_video = str_replace( '.ogv',  '', $slide_video );
				$slide_video = str_replace( '.webm', '', $slide_video );
				$slide_video = str_replace( '.jpg',  '', $slide_video );
				
				// Assign suffix for url's
				$slide_video_mp4  = $slide_video . '.mp4';
				$slide_video_ogv  = $slide_video . '.ogv';
				$slide_video_webm = $slide_video . '.webm';
				$slide_video_jpg  = $slide_video . '.jpg';

					$output .= '$("#' . $instanceID . ' .rslides > li:nth-child(' . ( $increment + 1 ) . ')").videoBG({' . "\n";
					$output .= 'mp4:"' . $slide_video_mp4 . '",' . "\n";
					$output .= 'ogv:"' . $slide_video_ogv . '",' . "\n";
					$output .= 'webm:"' . $slide_video_webm . '",' . "\n";
					$output .= 'poster:"' . $slide_video_jpg . '",' . "\n";
					$output .= 'scale:true,' . "\n";
					$output .= 'loop:true,' . "\n";
					$output .= 'opacity: 1,' . "\n";
					$output .= 'zIndex:0,' . "\n";
					$output .= '});' . "\n";
					$output .= '$( "#' . $instanceID . ' .rslides > li:nth-child(' . ( $increment + 1 ) . ')" ).find( ".videoBG_wrapper > li" ).css({ opacity: 1 });' . "\n";
					$output .= '$( "#' . $instanceID . ' .rslides > li:nth-child(' . ( $increment + 1 ) . ')" ).find( ".videoBG_wrapper > li" ).removeClass();' . "\n";
					$output .= '$( "#' . $instanceID . ' .rslides > li:nth-child(' . ( $increment + 1 ) . ')" ).find( ".videoBG_wrapper > li" ).removeAttr( "id" );' . "\n";
				}
			}
		}
	}
	
	// Output video js if required
	if ( ! empty( $output ) ) {
		echo '<script>(function ( $ ) { $(window).load(function() {' . $output . '}) }( jQuery ));</script>';
	}
}
?>