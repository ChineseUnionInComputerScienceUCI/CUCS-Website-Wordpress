<?php
// ==================================================================================
// Set thumbnail content
// ==================================================================================

function thinkup_inputpbitem_portfoliosize( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ) {
global $wp_embed;

$_thinkup_meta_featuredmedia     = get_post_meta( $id, '_thinkup_meta_featuredmedia', true );
$_thinkup_meta_featuredmediatype = get_post_meta( $id, '_thinkup_meta_featuredmediatype', true );
$_thinkup_meta_featuredmediamain = get_post_meta( $id, '_thinkup_meta_featuredmediamain', true );

	if ( ! empty( $_thinkup_meta_featuredmedia ) and $_thinkup_meta_featuredmediamain == 'option1' ) {

		// Remove http:// and https:// from video link
		if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
			$_thinkup_meta_featuredmedia = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
		} else {
			$_thinkup_meta_featuredmedia = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
		}

		// Determing featured media to input
		if ( $_thinkup_meta_featuredmediatype == 'option1' ) {
			echo $wp_embed->run_shortcode('[embed]' . $_thinkup_meta_featuredmedia . '[/embed]');
		} else {
			echo '<iframe src="' . $_thinkup_meta_featuredmedia . '"></iframe>';
		}
	} else {

		$post_id = get_post_thumbnail_id( $id );
		$post_img = wp_get_attachment_image_src($post_id, $size, true);

		echo '<img src="' . $post_img[0] . '" />';
	}
}


// ==================================================================================
// Set hover content
// ==================================================================================

function thinkup_inputpbitem_portfoliohover( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ) {
global $thinkup_portfolio_lightbox;
global $thinkup_portfolio_link;
global $thinkup_portfolio_contentstyleswitch;

global $post;
global $wp_embed;
$_thinkup_meta_featuredmedia     = get_post_meta( $id, '_thinkup_meta_featuredmedia', true );
$_thinkup_meta_featuredmediatype = get_post_meta( $id, '_thinkup_meta_featuredmediatype', true );
$_thinkup_meta_featuredmediamain = get_post_meta( $id, '_thinkup_meta_featuredmediamain', true );

	$portfolio_lightbox = NULL;
	$portfolio_link     = NULL;
	$portfolio_class    = NULL;
	$overlay_class      = NULL;
	
	$output          = NULL;

	if ( ! empty( $_thinkup_meta_featuredmedia ) ) {

		// Remove http:// and https:// from media link
		if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
			$_thinkup_meta_featuredmedia = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
		} else {
			$_thinkup_meta_featuredmedia = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
		}

		// Determine featured media to input
		if ( $_thinkup_meta_featuredmediatype == 'option2' ) {
		
			// Add source embed code if not present
			if (strpos( $_thinkup_meta_featuredmedia, '&source=embed' ) !== false) {
			} else { 
				$_thinkup_meta_featuredmedia = $_thinkup_meta_featuredmedia . '&source=embed';
			}

			// Add iframe embed code if not present
			if (strpos( $_thinkup_meta_featuredmedia, 'output=svembed?iframe=true' ) !== false) {
			} else if (strpos( $_thinkup_meta_featuredmedia, 'output=svembed' ) !== false) {
				$_thinkup_meta_featuredmedia = str_replace( 'output=svembed', 'output=svembed?iframe=true', $_thinkup_meta_featuredmedia );
			} else {
				$_thinkup_meta_featuredmedia = $_thinkup_meta_featuredmedia . '&output=svembed?iframe=true';
			}

			$media = $_thinkup_meta_featuredmedia . '&width=75%&height=75%';
		} else {
			$media = $_thinkup_meta_featuredmedia;
		}
	} else {
		$media = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
		$media = $media[0];
	}

	// Determine whether to show lightbox
	if ( $lightbox_icon !== 'off' ) {
		$portfolio_lightbox = '<a class="hover-zoom prettyPhoto" href="' . $media . '"></a>';
	}

	// Determine whether to show link to project
	if ( $lightbox_icon !== 'off' ) {
		$portfolio_link = '<a class="hover-link" href="' . get_permalink( $id ) . '"></a>';
	}

	// Determine which if single link animation should be shown
	if ( ( empty( $portfolio_lightbox ) and ! empty( $portfolio_link ) ) 
		or ( ! empty( $portfolio_lightbox ) and empty( $portfolio_link ) ) ) {
		$portfolio_class = ' style2';
	}
	
	// Determine which overlay style to apply
	if ( $style == 'style2' ) {
		$overlay_class = ' overlay2';
	}

	// Output final content
	echo '<div class="image-overlay' . $portfolio_class . $overlay_class . '"><div class="image-overlay-inner"><div class="hover-icons">';
	echo thinkup_inputpbitem_portfoliocontent2( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size );
	echo $portfolio_lightbox;
	echo $portfolio_link;
	echo '</div></div></div>';
}


// ==================================================================================
// Set portfolio content
// ==================================================================================

function thinkup_inputpbitem_portfoliocontent( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ) {
$output       = NULL;
$output_final = NULL;

	// Determine whether title and / or excerpt should be output
	if ( $title == 'on' or $details == 'on' ) {

		if ( $title == 'on' ) {
			$output .= '<h4 class="port-title"><a href="' . get_permalink( $id ) . '">' . get_the_title( $id ) . '</a></h4>'; 
		}
		if ( $details == 'on' /* and thinkup_input_excerptbyid( $id ) !== '' */ ) {
			$output .= thinkup_input_excerptbyid( $id );
		}
	}

	// Output contents is required
	if ( ! empty( $output ) ) {
		$output_final .= '<div class="port-details">';
		$output_final .= $output;
		$output_final .= '</div>';	
		
		return $output_final;
	}
}


// ==================================================================================
// Set portfolio content - Style 1 Specific
// ==================================================================================

// Echo content is Content Style 1 is selected
function thinkup_inputpbitem_portfoliocontent1( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ) {

	if ( $style !== 'style2' ) {
		echo thinkup_inputpbitem_portfoliocontent( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size );
	}
}


// ==================================================================================
// Set portfolio content - Style 2 Specific
// ==================================================================================

// Return content is Content Style 2 is selected
function thinkup_inputpbitem_portfoliocontent2( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ) {

	if ( $style == 'style2' ) {
		return thinkup_inputpbitem_portfoliocontent( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size );
	}
}
?>