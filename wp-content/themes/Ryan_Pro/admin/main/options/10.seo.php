<?php
/**
 * Search engine optimisation functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	SEO PAGE TITLE
---------------------------------------------------------------------------------- */

function thinkup_input_seotitle($title) {
global $thinkup_seo_switch;
global $thinkup_seo_sitetitle;

global $post;

// Set variables to avoid php non-object notice error
$_thinkup_meta_seoswitch = NULL;

// Assign meta data variable
if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_seoswitch = get_post_meta( $post->ID, '_thinkup_meta_seoswitch', true );
	$_thinkup_meta_seotitle  = get_post_meta( $post->ID, '_thinkup_meta_seotitle', true );
}
    if ( $thinkup_seo_switch == '1' and is_front_page() and ! empty( $thinkup_seo_sitetitle ) ) {
        $title = $thinkup_seo_sitetitle;
		return esc_html( $title );
	} else if ( $_thinkup_meta_seoswitch == 'on' and ! is_front_page() and ! empty( $_thinkup_meta_seotitle ) ) {
        $title = $_thinkup_meta_seotitle;
		return esc_html( $title );
	} else {
		return $title;
	}
}
add_filter( 'wp_title', 'thinkup_input_seotitle', 11 ); // pre WordPress v4.4 support
add_filter( 'pre_get_document_title', 'thinkup_input_seotitle', 11 ); // post WordPress v4.4 support


/* ----------------------------------------------------------------------------------
	SEO META TAGS
---------------------------------------------------------------------------------- */

function thinkup_input_metatags() {
global $thinkup_seo_switch;
global $thinkup_seo_homedescription;
global $thinkup_seo_sitekeywords;
global $thinkup_seo_noodp;
global $thinkup_seo_noydir;

global $post;

// Set variables to avoid php non-object notice error
$_thinkup_meta_seoswitch      = NULL;
$_thinkup_meta_seodescription = NULL;
$_thinkup_meta_seokeywords    = NULL;

// Assign meta data variable
if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_seoswitch       = get_post_meta( $post->ID, '_thinkup_meta_seoswitch', true );
	$_thinkup_meta_seodescription  = get_post_meta( $post->ID, '_thinkup_meta_seodescription', true );
	$_thinkup_meta_seokeywords     = get_post_meta( $post->ID, '_thinkup_meta_seokeywords', true );
}

    if ( $thinkup_seo_switch == '1') {	
		echo	'<!-- SEO optimised using built in premium theme features from ThinkUpThemes - http://www.thinkupthemes.com/ -->' . "\n";
		if ( $_thinkup_meta_seoswitch == 'on' and ! is_front_page() and ! empty( $_thinkup_meta_seodescription ) ) {	
			echo	'<meta name="description" content="' . esc_attr( $_thinkup_meta_seodescription ) . '"/>' . "\n";
		} else if ( ! empty( $thinkup_seo_homedescription ) ) {
			echo	'<meta name="description" content="' . esc_attr( $thinkup_seo_homedescription ) . '"/>' . "\n";
		}
		if ( $_thinkup_meta_seoswitch == 'on' and ! is_front_page() and ! empty( $_thinkup_meta_seokeywords ) ) {	
			echo	'<meta name="keywords" content="' . esc_attr( $_thinkup_meta_seokeywords ) . '"/>' . "\n";
		} else if ( ! empty( $thinkup_seo_sitekeywords ) ) {
			echo	'<meta name="keywords" content="' . esc_attr( $thinkup_seo_sitekeywords ) . '"/>' . "\n";
		}
		if ( $thinkup_seo_noodp == '1' or $thinkup_seo_noydir == '1' ) {	
			if ( $thinkup_seo_noodp == '1' and $thinkup_seo_noydir == '1' ) {	
				$thinkup_input_noodp = 'noodp,';
			} else if ( $thinkup_seo_noodp == '1' and $thinkup_seo_noydir <> '1' ) {	
				$thinkup_input_noodp = 'noodp';
			} else {
				$thinkup_input_noodp = '';
			}
			if ( $thinkup_seo_noydir == '1' ) {	
				$thinkup_input_noydir = 'noydir';
			} else {
				$thinkup_input_noydir = '';
			}
			echo	'<meta name="robots" content="' . $thinkup_input_noodp . $thinkup_input_noydir . '"/>' . "\n";
		}
		echo	'<!-- ThinkUpThemes SEO -->' . "\n" . "\n";
	}
}
add_action( 'wp_head', 'thinkup_input_metatags', 1 );


?>