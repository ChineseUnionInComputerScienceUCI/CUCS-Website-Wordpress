<?php
/**
 * Portfolio functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	PORTFOLIO LAYOUT
---------------------------------------------------------------------------------- */

function thinkup_input_portfoliolayout() {
global $thinkup_portfolio_layout;

global $post;
global $thinkup_portfolio_pageid;
$_thinkup_meta_portfoliolayout = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliolayout', true );

	if ( empty( $_thinkup_meta_portfoliolayout ) or $_thinkup_meta_portfoliolayout == 'option1' ) {
		if ( empty( $thinkup_portfolio_layout ) ) {
			echo 'column-2';
		} else if ( $thinkup_portfolio_layout == 'option1' or $thinkup_portfolio_layout == 'option5' or $thinkup_portfolio_layout == 'option6' ) {
			echo 'column-1';
		} else if ( $thinkup_portfolio_layout == 'option2' or $thinkup_portfolio_layout == 'option7' or $thinkup_portfolio_layout == 'option8' ) {
			echo 'column-2';
		} else if ( $thinkup_portfolio_layout == 'option3' ) {
			echo 'column-3';
		} else if ( $thinkup_portfolio_layout == 'option4' ) {
			echo 'column-4';
		}
	} else if ( $_thinkup_meta_portfoliolayout == 'option2' ) {
		echo 'column-1';
	} else if ( $_thinkup_meta_portfoliolayout == 'option3' ) {
		echo 'column-2';
	} else if ( $_thinkup_meta_portfoliolayout == 'option4' ) {
		echo 'column-3';
	} else if ( $_thinkup_meta_portfoliolayout == 'option5' ) {
		echo 'column-4';
	}
}

function thinkup_input_portfoliosize() {
global $thinkup_portfolio_layout;
global $thinkup_portfolio_redirect;

global $post;
global $wp_embed;
global $thinkup_portfolio_pageid;
$_thinkup_meta_portfoliolayout = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliolayout', true );

$_thinkup_meta_featuredmedia     = get_post_meta( $post->ID, '_thinkup_meta_featuredmedia', true );
$_thinkup_meta_featuredmediatype = get_post_meta( $post->ID, '_thinkup_meta_featuredmediatype', true );
$_thinkup_meta_featuredmediamain = get_post_meta( $post->ID, '_thinkup_meta_featuredmediamain', true );

	$output = NULL;

	if ( ! empty( $_thinkup_meta_featuredmedia ) and $_thinkup_meta_featuredmediamain == 'option1' ) {

		// Remove http:// and https:// from video link
		if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
			$_thinkup_meta_featuredmedia = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
		} else {
			$_thinkup_meta_featuredmedia = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
		}

		// Determing featured media to input
		if ( $_thinkup_meta_featuredmediatype == 'option1' ) {
			$output = $wp_embed->run_shortcode('[embed]' . esc_url( $_thinkup_meta_featuredmedia ) . '[/embed]');
		} else {
			$output = '<iframe src="' . esc_url( $_thinkup_meta_featuredmedia ) . '"></iframe>';
		}

	} else {

		if ( empty( $_thinkup_meta_portfoliolayout ) or $_thinkup_meta_portfoliolayout == 'option1' ) {
			if ( empty( $thinkup_portfolio_layout ) ) {
				$output = get_the_post_thumbnail( $post->ID, 'column2-3/5' );
			} else if ( $thinkup_portfolio_layout == 'option1' or $thinkup_portfolio_layout == 'option5' or $thinkup_portfolio_layout == 'option6' ) {
				$output = get_the_post_thumbnail( $post->ID, 'column1-1/4' );
			} else if ( $thinkup_portfolio_layout == 'option2' or $thinkup_portfolio_layout == 'option7' or $thinkup_portfolio_layout == 'option8' ) {
				$output = get_the_post_thumbnail( $post->ID, 'column2-3/5' );
			} else if ( $thinkup_portfolio_layout == 'option3' ) {
				$output = get_the_post_thumbnail( $post->ID, 'column3-2/3' );
			} else if ( $thinkup_portfolio_layout == 'option4' ) {
				$output = get_the_post_thumbnail( $post->ID, 'column4-2/3' );
			}
		} else if ( $_thinkup_meta_portfoliolayout == 'option2' ) {
			$output = get_the_post_thumbnail( $post->ID, 'column1-1/4' );
		} else if ( $_thinkup_meta_portfoliolayout == 'option3' ) {
			$output = get_the_post_thumbnail( $post->ID, 'column2-3/5' );
		} else if ( $_thinkup_meta_portfoliolayout == 'option4' ) {
			$output = get_the_post_thumbnail( $post->ID, 'column3-2/3' );
		} else if ( $_thinkup_meta_portfoliolayout == 'option5' ) {
			$output = get_the_post_thumbnail( $post->ID, 'column4-2/3' );
		}

	}

	// Output media if set
	if ( ! empty( $output ) ) {
		if ( $thinkup_portfolio_redirect !== '1' ) {
			echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . $output . '</a>';
		} else {
			echo $output;
		}
	}
}


/* ----------------------------------------------------------------------------------
	PORTFOLIO FILTER
---------------------------------------------------------------------------------- */

function thinkup_input_portfoliofilter() {
global $thinkup_portfolio_filter;

global $thinkup_portfolio_pageid;
$_thinkup_meta_portfoliofilter = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliofilter', true );

	if ( empty( $_thinkup_meta_portfoliofilter ) or $_thinkup_meta_portfoliofilter == 'option1' ) {
		if ( empty( $thinkup_portfolio_filter ) or $thinkup_portfolio_filter == 'option1' ) {
			$output .= '<section id="portfolio-options" class="style1">';
			$output .= '<ul id="filter" class="portfolio-filter"></ul>';
			$output .= '</section><div class="clearboth"></div>';
		} else if ( $thinkup_portfolio_filter == 'option2' ) {
			$output .= '<section id="portfolio-options" class="style2">';
			$output .= '<ul id="filter" class="portfolio-filter"></ul>';
			$output .= '</section><div class="clearboth"></div>';
		}
	} else if ( $_thinkup_meta_portfoliofilter == 'option2' ) {
		$output .= '<section id="portfolio-options" class="style1">';
		$output .= '<ul id="filter" class="portfolio-filter"></ul>';
		$output .= '</section><div class="clearboth"></div>';
	} else if ( $_thinkup_meta_portfoliofilter == 'option3' ) {
		$output .= '<section id="portfolio-options" class="style2">';
		$output .= '<ul id="filter" class="portfolio-filter"></ul>';
		$output .= '</section><div class="clearboth"></div>';
	}

	// Output filter style
	if ( ! empty ( $output ) ) echo $output;
}


/* ----------------------------------------------------------------------------------
	PORTFOLIO CONTENT 1
---------------------------------------------------------------------------------- */

function thinkup_input_portfoliohover() {
global $thinkup_portfolio_lightbox;
global $thinkup_portfolio_link;
global $thinkup_portfolio_contentstyleswitch;

global $post;
global $wp_embed;
$_thinkup_meta_featuredmedia     = get_post_meta( $post->ID, '_thinkup_meta_featuredmedia', true );
$_thinkup_meta_featuredmediatype = get_post_meta( $post->ID, '_thinkup_meta_featuredmediatype', true );
$_thinkup_meta_featuredmediamain = get_post_meta( $post->ID, '_thinkup_meta_featuredmediamain', true );

global $thinkup_portfolio_pageid;

// Set meta data for this specific page
$_thinkup_meta_portfoliolinks         = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliolinks', true );
$_thinkup_meta_portfoliocontentswitch = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliocontentswitch', true );

// Convert meta data to array for migration of CMB to v1.2.0
if ( !is_array( $_thinkup_meta_portfoliolinks ) )  {
	$_thinkup_meta_portfoliolinks = explode( ',', $_thinkup_meta_portfoliolinks );
}

	$portfolio_lightbox = NULL;
	$portfolio_link     = NULL;
	$portfolio_class    = NULL;
	$overlay_class      = NULL;
	
	$output          = NULL;
	$output_content2 = NULL;

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
		$media = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$media = $media[0];
	}

	// Determine whether to show lightbox
	if ( empty( $_thinkup_meta_portfoliolinks[0] ) or in_array( 'option1', $_thinkup_meta_portfoliolinks ) ) {
		if ( $thinkup_portfolio_lightbox =='1' ) {
			$portfolio_lightbox = '<a class="hover-zoom prettyPhoto" href="' . esc_url( $media ) . '"></a>';
		}
	} else if ( in_array( 'option2', $_thinkup_meta_portfoliolinks ) ) {
		$portfolio_lightbox = '<a class="hover-zoom prettyPhoto" href="' . esc_url( $media ) . '"></a>';
	}

	// Determine whether to show link to project
	if ( empty( $_thinkup_meta_portfoliolinks[0] ) or in_array( 'option1', $_thinkup_meta_portfoliolinks ) ) {
		if ( $thinkup_portfolio_link =='1' ) {
			$portfolio_link = '<a class="hover-link" href="' . esc_url( get_permalink() ) . '"></a>';
		}
	} else if ( in_array( 'option3', $_thinkup_meta_portfoliolinks ) ) {
		$portfolio_link = '<a class="hover-link" href="' . esc_url( get_permalink() ) . '"></a>';
	}

	// Determine which if single link animation should be shown
	if ( ( empty( $portfolio_lightbox ) and ! empty( $portfolio_link ) ) 
		or ( ! empty( $portfolio_lightbox ) and empty( $portfolio_link ) ) ) {
		$portfolio_class = ' style2';
	}

	// Determine which overlay style to apply
	if ( empty( $_thinkup_meta_portfoliocontentswitch ) or $_thinkup_meta_portfoliocontentswitch == 'option1' ) {
		if ( $thinkup_portfolio_contentstyleswitch == 'option2' ) {
			$overlay_class    = ' overlay2';
			$output_content2 = thinkup_input_portfoliocontent2();
		}
	} else if ( $_thinkup_meta_portfoliocontentswitch == 'option3' ) {
		$overlay_class = ' overlay2';
		$output_content2 = thinkup_input_portfoliocontent2();
	}

	// Output final content
	if ( ! empty( $output_content2 ) or ! empty( $portfolio_lightbox ) or ! empty( $portfolio_link ) ) {
		$output .= '<div class="image-overlay' . esc_attr( $portfolio_class ) . esc_attr( $overlay_class ) . '"><div class="image-overlay-inner"><div class="hover-icons">';
		$output .= $output_content2;
		$output .= $portfolio_lightbox;
		$output .= $portfolio_link;
		$output .= '</div></div></div>';
	}

	echo $output;
}


/* ----------------------------------------------------------------------------------
	PORTFOLIO CONTENT 2
---------------------------------------------------------------------------------- */

/* Add portfolio style class to body tag */
function thinkup_input_portfoliocontentclass($classes) {
global $thinkup_portfolio_contentstyleswitch;

global $post;

// Assign meta data variable
if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_portfoliocontentswitch = get_post_meta( $post->ID, '_thinkup_meta_portfoliocontentswitch', true );
}

	if( is_post_type_archive( 'portfolio' ) or get_page_template_slug( $thinkup_portfolio_pageid ) == 'template-portfolio.php' ) {

		if ( empty( $_thinkup_meta_portfoliocontentswitch ) or $_thinkup_meta_portfoliocontentswitch == 'option1' ) {
			if ( empty( $thinkup_portfolio_contentstyleswitch ) or $thinkup_portfolio_contentstyleswitch == 'option1' ) {
					$classes[] = 'portfolio-style1';
			} else {
				$classes[] = 'portfolio-style2';
			}
		} else if ( $_thinkup_meta_portfoliocontentswitch == 'option2' ) {
				$classes[] = 'portfolio-style1';
		} else if ( $_thinkup_meta_portfoliocontentswitch == 'option3' ) {
			$classes[] = 'portfolio-style2';
		}
	}
	return $classes;
}
add_action( 'body_class', 'thinkup_input_portfoliocontentclass');

function thinkup_input_portfoliostyleclass() {
global $thinkup_portfolio_contentstyleswitch;

global $thinkup_portfolio_pageid;

// Assign meta data variable
$_thinkup_meta_portfoliocontentswitch = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliocontentswitch', true );

$output = NULL;

	// Determine which portfolio style is selected
	if( empty( $_thinkup_meta_portfoliocontentswitch ) or $_thinkup_meta_portfoliocontentswitch == 'option1' ) {
		if ( $thinkup_portfolio_contentstyleswitch !== 'option2' ) {
			$output = ' style1';
		} else {
			$output = ' style2';
		}
	} else if( $_thinkup_meta_portfoliocontentswitch == 'option2' ) {
		$output = ' style1';
	} else if( $_thinkup_meta_portfoliocontentswitch == 'option3' ) {
		$output = ' style2';
	}
	
	// Output style class
	echo $output;

}

function thinkup_input_portfoliocontent() {
global $thinkup_portfolio_title;
global $thinkup_portfolio_excerpt;
global $thinkup_portfolio_excerptlength;
global $thinkup_portfolio_redirect;
global $infos;

global $post;
global $thinkup_portfolio_pageid;

// Assign meta data variable
$_thinkup_meta_portfoliocontent       = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliocontent', true );
$_thinkup_meta_portfolioexcerpts      = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfolioexcerpts', true );

// Convert meta data to array for migration of CMB to v1.2.0
if ( !is_array( $_thinkup_meta_portfoliocontent ) )  {
	$_thinkup_meta_portfoliocontent = explode( ',', $_thinkup_meta_portfoliocontent );
}

$output         = NULL;
$output_final   = NULL;
$output_excerpt = NULL;

	// Determine excerpt length
	if ( !is_numeric( $thinkup_portfolio_excerptlength ) and !is_numeric( $_thinkup_meta_portfolioexcerpts) and get_the_excerpt() !== '' ) {

		// Output full excerpt
		$output_excerpt = get_the_excerpt();

	} else {

		// Reassign portfolio lenth variable if set in page meta
		if( is_numeric( $_thinkup_meta_portfolioexcerpts ) ) {
			$thinkup_portfolio_excerptlength = $_thinkup_meta_portfolioexcerpts;
		}

		// Output excerpt upto user specified length
		$output_excerpt = explode( ' ', get_the_excerpt() );
		$output_excerpt = implode( ' ', array_splice( $output_excerpt, 0, $thinkup_portfolio_excerptlength ) );
		$output_excerpt = wpautop( $output_excerpt . '<span class="port-excerpt-end">&hellip;</span>' );;

	}

	// Determine whether title and / or excerpt should be output
	if ( empty( $_thinkup_meta_portfoliocontent[0] ) or in_array( 'option1', $_thinkup_meta_portfoliocontent ) ) {

		if ( $thinkup_portfolio_title == '1' or $thinkup_portfolio_excerpt == '1' ) {

			if ( $thinkup_portfolio_title == '1' ) {
				if ( $thinkup_portfolio_redirect !== '1' ) {
					$output .= '<h4 class="port-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h4>';
				} else {
					$output .= '<h4 class="port-title">' . get_the_title() . '</h4>';
				}
			}
			if ( $thinkup_portfolio_excerpt == '1' and get_the_excerpt() !== '' ) {
				$output .= '<p class="port-tags">' . $output_excerpt . '</p>';
			}

		}

	} else if ( in_array( 'option2', $_thinkup_meta_portfoliocontent ) or in_array( 'option3', $_thinkup_meta_portfoliocontent ) ) {
		
		if ( in_array( 'option2', $_thinkup_meta_portfoliocontent ) ) {
			if ( $thinkup_portfolio_redirect !== '1' ) {
				$output .= '<h4 class="port-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h4>';
			} else {
				$output .= '<h4 class="port-title">' . get_the_title() . '</h4>';
			}
		}
		if ( in_array( 'option3', $_thinkup_meta_portfoliocontent ) and get_the_excerpt() !== '' ) {
			$output .= '<p class="port-tags">' . $output_excerpt . '</p>';
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

// Echo content is Content Style 1 is selected
function thinkup_input_portfoliocontent1() {
global $thinkup_portfolio_contentstyleswitch;

global $thinkup_portfolio_pageid;

$_thinkup_meta_portfoliocontentswitch = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliocontentswitch', true );

	if( empty( $_thinkup_meta_portfoliocontentswitch ) or $_thinkup_meta_portfoliocontentswitch == 'option1' ) {
		if ( $thinkup_portfolio_contentstyleswitch !== 'option2' ) {
			echo thinkup_input_portfoliocontent();
		}
	} else if( $_thinkup_meta_portfoliocontentswitch == 'option2' ) {
		echo thinkup_input_portfoliocontent();
	}
}

// Return content is Content Style 1 is selected
function thinkup_input_portfoliocontent2() {
global $thinkup_portfolio_contentstyleswitch;

global $thinkup_portfolio_pageid;

$_thinkup_meta_portfoliocontentswitch = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliocontentswitch', true );

	if( empty( $_thinkup_meta_portfoliocontentswitch ) or $_thinkup_meta_portfoliocontentswitch == 'option1' ) {
		if ( $thinkup_portfolio_contentstyleswitch == 'option2' ) {
			return thinkup_input_portfoliocontent();
		}
	} else if( $_thinkup_meta_portfoliocontentswitch == 'option3' ) {
		return thinkup_input_portfoliocontent();
	}
}

/* ----------------------------------------------------------------------------------
	ENABLE PORTFOLIO SLIDER
---------------------------------------------------------------------------------- */

function thinkup_input_portfolioslider() {
global $thinkup_portfolio_sliderswitch;
global $thinkup_portfolio_slidercategory;
global $thinkup_portfolio_sliderheight;

global $thinkup_portfolio_pageid;
$_thinkup_meta_portfoliosliderswitch   = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliosliderswitch', true );
$_thinkup_meta_portfolioslidercategory = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfolioslidercategory', true );
$_thinkup_meta_portfoliosliderheight   = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliosliderheight', true );

	if( $_thinkup_meta_portfoliosliderswitch == 'on' ) {

		// Set default slider height
		if ( empty( $_thinkup_meta_portfoliosliderheight ) ) { $sliderheight = '300'; } else { $sliderheight = $_thinkup_meta_portfoliosliderheight; }

		// Output slider shortcode
		echo '<div id="port-slider">';
		echo do_shortcode( '[slider_portfolio cat="' . esc_html( $_thinkup_meta_portfolioslidercategory ) . '" height="' . esc_html( $sliderheight ) .'"]' ); 
		echo '</div>';

	} else if( $thinkup_portfolio_sliderswitch == '1' ) {

		// Set default slider height
		if ( empty( $thinkup_portfolio_sliderheight ) ) { $sliderheight = '300'; } else { $sliderheight = $thinkup_portfolio_sliderheight; }

		// Output slider shortcode
		echo '<div id="port-slider">';
		echo do_shortcode( '[slider_portfolio cat="' . esc_html( $thinkup_portfolio_slidercategory ) . '" height="' . esc_html( $sliderheight ) .'"]' ); 
		echo '</div>';

	}
}


/* ----------------------------------------------------------------------------------
	ENABLE PORTFOLIO FEATURED ITEMS
---------------------------------------------------------------------------------- */

function thinkup_input_portfoliofeatured() {
global $thinkup_portfolio_featuredswitch;
global $thinkup_portfolio_featuredcategory;
global $thinkup_portfolio_featuredcategoryitems;
global $thinkup_portfolio_featuredcategoryscroll;
global $thinkup_portfolio_excerpt;

global $thinkup_portfolio_pageid;
$_thinkup_meta_portfoliofeaturedswitch   = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliofeaturedswitch', true );
$_thinkup_meta_portfoliofeaturedcategory = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliofeaturedcategory', true );
$_thinkup_meta_portfoliofeatureditems    = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliofeatureditems', true );
$_thinkup_meta_portfoliofeaturedscroll   = get_post_meta( $thinkup_portfolio_pageid, '_thinkup_meta_portfoliofeaturedscroll', true );

	if( $_thinkup_meta_portfoliofeaturedswitch == 'on' ) {

		echo '<div id="port-featured">';

		// Add margin if tags projects tags are not displayed
		if ( $thinkup_portfolio_excerpt !== '1' ) {
			echo '<div class="margin30"></div>';
		}

		echo '<h4 class="port-title">' . __( 'Featured Projects', 'ryan' ) . '</h4>';

		echo do_shortcode( '[carousel_portfolio items="' . esc_html( $_thinkup_meta_portfoliofeatureditems ) . '" scroll="' . esc_html( $_thinkup_meta_portfoliofeaturedscroll ) . '" speed="500" effect="scroll" title="off" tags="off" style="default" category="' . esc_html( $_thinkup_meta_portfoliofeaturedcategory ) . '"]' ); 

		echo '</div>';

	} else if( $thinkup_portfolio_featuredswitch == '1' ) {

		echo '<div id="port-featured">';

		// Add margin if tags projects tags are not displayed
		if ( $thinkup_portfolio_excerpt !== '1' ) {
			echo '<div class="margin30"></div>';
		}

		echo '<h4 class="port-title">' . __( 'Featured Projects', 'ryan' ) . '</h4>';

		echo do_shortcode( '[carousel_portfolio items="' . esc_html( $thinkup_portfolio_featuredcategoryitems ) . '" scroll="' . esc_html( $thinkup_portfolio_featuredcategoryscroll ) . '" speed="500" effect="scroll" title="off" tags="off" style="default" category="' . esc_html( $thinkup_portfolio_featuredcategory ) . '"]' ); 

		echo '</div>';
	}
}


/* ----------------------------------------------------------------------------------
	PORTFOLIO REDIRECT
---------------------------------------------------------------------------------- */

function thinkup_portfolio_redirect() {
global $thinkup_portfolio_redirect;

	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = rtrim($pageURL, '/') . '/';

	$pageURL = str_replace( "www.", "", $pageURL );
	$siteURL = str_replace( "www.", "", site_url( '/' ) );
		
	if ( $thinkup_portfolio_redirect == '1' and strpos( $pageURL, $siteURL . 'portfolio/' ) !== false and $pageURL !== $siteURL . 'portfolio/' ) {
		wp_redirect(get_option('siteurl').'/portfolio/');
	}
}
add_action( 'wp_head', 'thinkup_portfolio_redirect', 1 );


/* ----------------------------------------------------------------------------------
	PROJECT NAVIGATION
---------------------------------------------------------------------------------- */

function thinkup_input_projectnavigation() {
global $thinkup_project_navigationswitch;

	if ( $thinkup_project_navigationswitch == '1' ) {
		thinkup_input_nav( 'nav-below' );
	}
}


/* ----------------------------------------------------------------------------------
	RECENT PROJECTS
---------------------------------------------------------------------------------- */

function thinkup_input_projectrelated() {
global $thinkup_project_recent;
global $thinkup_project_recentitems;
global $thinkup_project_recentscroll;

$items  = NULL;
$scroll = NULL;

	// Set default items to equal 2
	if ( empty( $thinkup_project_recentitems ) ) {
		$items = 2;
	} else {
		$items = $thinkup_project_recentitems;
	}

	// Set default scroll to equal 1
	if ( empty( $thinkup_project_recentscroll ) ) {
		$scroll = 1;
	} else {
		$scroll = $thinkup_project_recentscroll;
	}

	if ( $thinkup_project_recent == '1' ) {
		echo do_shortcode( '[carousel_portfolio items="' . esc_html( $items ) . '" scroll="' . esc_html( $scroll ) . '" speed="500" effect="scroll" title="off" details="off" category="0"]' );
	}

}
?>