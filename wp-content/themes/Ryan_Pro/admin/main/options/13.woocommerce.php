<?php
/**
 * Custom styling functions.
 *
 * @package ThinkUpThemes
 */

//----------------------------------------------------------------------------------
//	REMOVE DEFAULT WOOCOMMERCE STYLING / REPLACE WITH THEME SPECIFIC STYLING
//----------------------------------------------------------------------------------

// Add additional php files
function thinkup_woo_addphpfiles() {

	// Add cart item to menu
	if ( ! class_exists( 'WpMenuCart' ) ) {
		require_once( get_template_directory() . '/woocommerce/woocommerce-menu-bar-cart/wp-menu-cart.php' );
	}
}
add_action( 'after_setup_theme', 'thinkup_woo_addphpfiles' );


// Remove WooCommerce default styles
function thinkup_remove_woocommercestyles( $enqueue_styles ) {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {
		unset( $enqueue_styles['woocommerce-general'] );
		unset( $enqueue_styles['woocommerce-layout'] );
		unset( $enqueue_styles['woocommerce-smallscreen'] );
		return $enqueue_styles;
	}
}
add_filter( 'woocommerce_enqueue_styles', 'thinkup_remove_woocommercestyles' );

// Add theme specific WooCommerce default styles
function thinkup_input_woocommercestyles() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {
		wp_enqueue_style( 'thinkup-woocommerce');
		wp_enqueue_style( 'thinkup-woocommerce-theme');

		if( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {
			wp_enqueue_script( 'jquery-masonry' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'thinkup_input_woocommercestyles', 11 );

// Remove start and end links from product on Shop page - Causes issues with lightbox and like buttons
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


//----------------------------------------------------------------------------------
//	SHOP PAGE (ARCHIVE PAGE) - STYLING
//----------------------------------------------------------------------------------

// Title of shop archive page - Used in intro and breadcrumbs
function thinkup_woo_titleshop_archive() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {
		$shop_page_id = wc_get_page_id( 'shop' );
		$page_title   = get_the_title( $shop_page_id );
		$page_title   = apply_filters( 'woocommerce_page_title', $page_title );
		return $page_title;
	}
}

// Add layout classes to post class
function thinkup_woo_layoutshop($classes) {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $post;
			global $thinkup_woocommerce_layout;

			if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
				$classes[] = 'woo-grid column-1';
			} else if ( $thinkup_woocommerce_layout == 'option2' or $thinkup_woocommerce_layout == 'option7' or $thinkup_woocommerce_layout == 'option8' ) {
				$classes[] = 'woo-grid column-2';
			} else if ( $thinkup_woocommerce_layout == 'option3' ) {
				$classes[] = 'woo-grid column-3';
			} else if ( $thinkup_woocommerce_layout == 'option4' ) {
				$classes[] = 'woo-grid column-4';
			}
		}
	}
	return $classes;
}
add_filter('post_class', 'thinkup_woo_layoutshop');

// Add grid class to body class
function thinkup_woo_layoutshopclass($classes) {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $post;
			global $thinkup_woocommerce_layout;

			if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
				$classes[] = '';
			} else if ( $thinkup_woocommerce_layout == 'option2' or $thinkup_woocommerce_layout == 'option7' or $thinkup_woocommerce_layout == 'option8' ) {
				$classes[] = 'woo-shop-grid';
			} else if ( $thinkup_woocommerce_layout == 'option3' ) {
				$classes[] = 'woo-shop-grid';
			} else if ( $thinkup_woocommerce_layout == 'option4' ) {
				$classes[] = 'woo-shop-grid';
			}
		}
	}
	return $classes;
}
add_filter('body_class', 'thinkup_woo_layoutshopclass');

// Determine number of products per page to display on shop page 
function thinkup_woo_countshop() {
$thinkup_woocommerce_styleswitch = thinkup_var_cookie( 'thinkup_woocommerce_styleswitch' );

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		$thinkup_woocommerce_countshop = thinkup_var_cookie( 'thinkup_woocommerce_countshop' );

		if ( ! empty( $thinkup_woocommerce_countshop ) ) {
			return $thinkup_woocommerce_countshop;
		}
	}
}
add_filter( 'loop_shop_per_page', 'thinkup_woo_countshop', 20 );

// Products Page - Product Thumbnail
function thinkup_woo_thumbnailshop() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $post;
			global $thinkup_woocommerce_layout;
			global $thinkup_woocommerce_quickview;
			global $thinkup_woocommerce_lightbox;
			global $thinkup_woocommerce_likes;
			global $thinkup_woocommerce_sharing;

			// Reset variable values
			$product_thumbnail = NULL;
			$product_id        = NULL;
			$product_img       = NULL;
			$link              = NULL;
			$output            = NULL;

			// Determine thumbnail size
			if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
				$size = 'column2-1/1';
			} else if ( $thinkup_woocommerce_layout == 'option2' or $thinkup_woocommerce_layout == 'option7' or $thinkup_woocommerce_layout == 'option8' ) {
				$size = 'column2-1/1';
			} else if ( $thinkup_woocommerce_layout == 'option3' ) {
				$size = 'column3-1/1';
			} else if ( $thinkup_woocommerce_layout == 'option4' ) {
				$size = 'column4-1/1';
			}

			// Get thumbnail image or use default WooCommerce placeholder
			if ( has_post_thumbnail() ) {
				$product_thumbnail = get_the_post_thumbnail( $post->ID, $size );
			} else if ( wc_placeholder_img_src() ) {
				$product_thumbnail = wc_placeholder_img( $size );
			}

			// Determine url of thumbnail image
			$product_id = get_post_thumbnail_id( $post->ID );
			$product_img = wp_get_attachment_image_src($product_id,'full', true);
			$link  = $product_img[0];

			// Output thumbnail and Quick View button
			$output .= '<div class="woo-meta">';
			$output .= '<div class="woo-meta-row1">';

			// Output like button if set
			if ( $thinkup_woocommerce_likes == '1' ) {
				$output .= thinkup_woo_getPostLikeLink( $post->ID );
			} // else if ( $thinkup_woocommerce_sharing == '1' ) {
			  // $output .= '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
			  // $output .= thinkup_woo_socialshare();
			  // }

			// Output lightbox or social sharing button if set
			if ( $thinkup_woocommerce_lightbox == '1' ) {
				$output .= '<a href="' . $product_img[0] . '" class="prettyPhoto"><i class="fa fa-expand"></i></a>';
			}

			$output .= '<div class="clearboth"></div>';
			$output .= '</div>';

			// Output social sharing button if set (and not already output above.
			//if ( $thinkup_woocommerce_likes == '1' and $thinkup_woocommerce_sharing == '1' ) {
			//	$output .= '<div class="woo-meta-row2">';
			//	$output .= '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
			//	$output .= thinkup_woo_socialshare();
			//	$output .= '</div>';
			//}

			$output .= '</div>';

			$output .= '<a href="' . get_permalink() . '">' . $product_thumbnail .'</a>';

			if ( $thinkup_woocommerce_quickview == '1' ) {
				$output .= '<div class="image-overlay">';
				$output .= '<div class="image-overlay-inner">';
				$output .= '<div class="wrap-woo">';
				$output .= '<a href="' . $product_img[0] . '" class="prettyPhoto more-link style2 themebutton">';
				$output .= '<span class="more-text">QUICK VIEW</span>';
				$output .= '<span class="more-icon"><i class="fa fa-expand fa-lg"></i>';
				$output .= '</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
			}

			echo $output;

			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		}
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_thumbnailshop', 9 );

// Add title with link to individual product page
function thinkup_woo_titleshop() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $post;

			echo '<a href="' . get_permalink() . '"><h3>' . get_the_title() . '</h3></a>';
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item_title', 'thinkup_woo_titleshop', 9 );

// Reposition rating after title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 9 );

// Add excerpt to product page
function thinkup_input_woo_excerptshop() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $post;
			global $thinkup_woocommerce_excerptshop;
			global $thinkup_woocommerce_excerptlength;

			if ( $thinkup_woocommerce_excerptshop == '1' ) {

				if ( !is_numeric( $thinkup_woocommerce_excerptlength ) ) {

					// Output full excerpt
					echo wpautop( get_post( $post->ID )->post_excerpt );

				} else {

					// Output excerpt upto user specified length
					$shop_excerpt = explode( ' ', get_the_excerpt() );
					$shop_excerpt = implode( ' ', array_splice( $shop_excerpt, 0, $thinkup_woocommerce_excerptlength ) );
					echo wpautop( $shop_excerpt . '<span class="woo-excerpt-end">...</span>' );;

				}
			}
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_input_woo_excerptshop', 5 );


//----------------------------------------------------------------------------------
//	SHOP PAGE (ARCHIVE PAGE) - PAGE LAYOUT
//----------------------------------------------------------------------------------

function thinkup_woo_layoutshopclass1() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {
	
		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
				echo '<div class="entry-header one_third">';
			}
		}
	}
}

function thinkup_woo_layoutshopclass2() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
				echo '</div><div class="entry-content two_third last">';
			}
		}
	}
}

function thinkup_woo_layoutshopclass3() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
				echo '</div><div class="clearboth">';
			}
		}
	}
}

add_action( 'woocommerce_before_shop_loop_item', 'thinkup_woo_layoutshopclass1', 11 );
add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_layoutshopclass2', 11 );
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_woo_layoutshopclass3', 11 );


// Add entry-header, entry-content, entry-footer section to shop page
function thinkup_woo_headershop() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( ! empty( $thinkup_woocommerce_layout ) and $thinkup_woocommerce_layout !== 'option1' and $thinkup_woocommerce_layout !== 'option5' and $thinkup_woocommerce_layout !== 'option6' ) {
				echo '<div class="woo-grid-wrap"><div class="entry-header">';
			}
		}
	}
}		
function thinkup_woo_contentshop() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( ! empty( $thinkup_woocommerce_layout ) and $thinkup_woocommerce_layout !== 'option1' and $thinkup_woocommerce_layout !== 'option5' and $thinkup_woocommerce_layout !== 'option6' ) {
				echo '</div><div class="entry-content">';
			}
		}
	}
}
function thinkup_woo_footershop() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( ! empty( $thinkup_woocommerce_layout ) and $thinkup_woocommerce_layout !== 'option1' and $thinkup_woocommerce_layout !== 'option5' and $thinkup_woocommerce_layout !== 'option6' ) {
				echo '</div><div class="entry-footer">';
			}
		}
	}
}
function thinkup_woo_footershopend() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

			global $thinkup_woocommerce_layout;

			if ( ! empty( $thinkup_woocommerce_layout ) and $thinkup_woocommerce_layout !== 'option1' and $thinkup_woocommerce_layout !== 'option5' and $thinkup_woocommerce_layout !== 'option6' ) {
				echo '</div></div>';
			}
		}
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_headershop', 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_contentshop', 11 );
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_woo_footershop', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_woo_footershopend', 11 );


//----------------------------------------------------------------------------------
//	PRODUCT PAGE (SINGLE PAGE) - STYLING
//----------------------------------------------------------------------------------

function thinkup_woo_socialshare() {
	$output = NULL;
	
	global $post;

	$output .= '<div class="woo-meta-social">';

		$output .= '<a class="woo-meta-facebook" href="//www.facebook.com/sharer.php?u=' . urlencode(get_permalink( $post->ID )) . '&#38;t=' . urlencode(get_the_title( $post->ID )) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
		$output .= '<a class="woo-meta-twitter" href="//twitter.com/home?status=Check%20this%20out!%20' . urlencode(get_the_title( $post->ID )) . '%20at%20' . get_permalink( $post->ID ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
		$output .= '<a class="woo-meta-pinterest" href="//pinterest.com/pin/create/button/?url=' . urlencode(get_permalink( $post->ID )) . '&amp;description=' . urlencode(get_the_title( $post->ID )) . '&amp;media=' . urlencode(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';

	$output .= '</div>';

	return $output;
}


function thinkup_woo_thumbnailproduct() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {

			global $post, $woocommerce, $product;
			global $thinkup_woocommerce_likesproduct;
			global $thinkup_woocommerce_sharingproduct;

			// Assign meta data variable
			$_thinkup_meta_woocommercecontentcheckproduct = get_post_meta( $post->ID, '_thinkup_meta_woocommercecontentcheckproduct', true );

			// Convert meta data to array for migration of CMB to v1.2.0
			if ( !is_array( $_thinkup_meta_woocommercecontentcheckproduct ) )  {
				$_thinkup_meta_woocommercecontentcheckproduct = explode( ',', $_thinkup_meta_woocommercecontentcheckproduct );
			}

			// Output product meta data
			echo '<div class="woo-meta">';

				echo '<div class="woo-meta-row1">';

				// Output like button if set
				if ( ! in_array( 'option2', $_thinkup_meta_woocommercecontentcheckproduct ) ) {
					if ( $thinkup_woocommerce_likesproduct == '1' ) {
						echo thinkup_woo_getPostLikeLink( $post->ID );
					} // else if ( $thinkup_woocommerce_sharingproduct == '1' ) {
					  // echo '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
					  // echo thinkup_woo_socialshare();
					  // }

					echo '<div class="clearboth"></div>';
					echo '</div>';

					// Output social sharing button if set (and not already output above.
					// if ( $thinkup_woocommerce_likesproduct == '1' and $thinkup_woocommerce_sharingproduct == '1' ) {
					//	echo '<div class="woo-meta-row2">';
					//	echo '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
					//	echo thinkup_woo_socialshare();
					//	echo '</div>';
					// }
				} else {
					if ( in_array( 'option2', $_thinkup_meta_woocommercecontentcheckproduct ) ) {
						echo thinkup_woo_getPostLikeLink( $post->ID );
					} else if ( in_array( 'option3', $_thinkup_meta_woocommercecontentcheckproduct ) ) {
						echo '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
						echo thinkup_woo_socialshare();
					}

					echo '<div class="clearboth"></div>';
					echo '</div>';

					// Output social sharing button if set (and not already output above.
					// if ( in_array( 'option2', $_thinkup_meta_woocommercecontentcheckproduct ) and in_array( 'option3', $_thinkup_meta_woocommercecontentcheckproduct ) ) {
					//	echo '<div class="woo-meta-row2">';
					//	echo '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
					//	echo thinkup_woo_socialshare();
					//	echo '</div>';
					// }
				}

			echo '</div>';

			// Output product image
			echo '<div class="images">';

				if ( has_post_thumbnail() ) {

					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
					$image       = get_the_post_thumbnail( $post->ID, 'column2-1/1', array(
						'title' => $image_title
						) );

					$attachment_count = count( $product->get_gallery_attachment_ids() );

					if ( $attachment_count > 0 ) {
						$gallery = '[gallery]';
					} else {
						$gallery = '';
					}

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom prettyPhoto" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

				}

				do_action( 'woocommerce_product_thumbnails' );

			echo '</div>';

			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		}
	}
}
add_action( 'woocommerce_before_single_product_summary', 'thinkup_woo_thumbnailproduct', 19 );

// Move price to before rating (action disabled in current theme)
function thinkup_woo_priceproduct() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {

			global $post, $product;
			?>
			<div class="offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

				<p class="price"><?php echo $product->get_price_html(); ?></p>

				<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
				<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
				<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

			</div>
			<?php

			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		}
	}
}
//add_action( 'woocommerce_single_product_summary', 'thinkup_woo_priceproduct', 9 );

// Add To Cart - Simple Product
function woocommerce_simple_add_to_cart() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {
		wc_get_template( 'single-product/add-to-cart/simple.php' );
	}
}

// Add To Cart - Grouped Product
function woocommerce_grouped_add_to_cart() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		global $product;

		wc_get_template( 'single-product/add-to-cart/grouped.php', array(
			'grouped_product'    => $product,
			'grouped_products'   => $product->get_children(),
			'quantites_required' => false
		) );
	}
}

// Add To Cart - Variable Product
function woocommerce_variable_add_to_cart() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		global $product;

		// Enqueue variation scripts
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		// Load the template
		wc_get_template( 'single-product/add-to-cart/variable.php', array(
				'available_variations'  => $product->get_available_variations(),
				'attributes'   			=> $product->get_variation_attributes(),
				'selected_attributes' 	=> $product->get_variation_default_attributes()
			) );
	}
}

// Add To Cart - Variable Product Single Variation
function thinkup_single_variation() {
		global $product;
		?>
		<div class="variations_button">
			<div class="entry-header">
			<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
			<div class="single_variation"></div>
			</div>
		</div>

		<div class="entry-content">
			<button type="submit" class="single_add_to_cart_button button alt more-link themebutton">
					<span class="more-text"><?php echo $product->single_add_to_cart_text(); ?></span>
					<span class="more-icon"><i class="fa fa-shopping-cart fa-lg"></i></span>
			</button>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
		</div>

		<?php
		remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
		remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
}
add_action( 'woocommerce_single_variation', 'thinkup_single_variation', 9 );

// Add To Cart - External Product
function woocommerce_external_add_to_cart() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		global $product;

		if ( ! $product->get_product_url() )
			return;

		wc_get_template( 'single-product/add-to-cart/external.php', array(
				'product_url' => $product->get_product_url(),
				'button_text' => $product->single_add_to_cart_text()
			) );
	}
}


//----------------------------------------------------------------------------------
//	PRODUCT PAGE (SINGLE PAGE) - VARIATION BUTTONS
//----------------------------------------------------------------------------------

// Determine whether to use select or button variations
function thinkup_woo_variationstyle() {
global $thinkup_woocommerce_variation;
global $thinkup_woocommerce_styleswitch;

global $post;
$_thinkup_meta_woocommercevariation = get_post_meta( $post->ID, '_thinkup_meta_woocommercevariation', true );

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {
		if ( empty( $_thinkup_meta_woocommercevariation ) or $_thinkup_meta_woocommercevariation == 'option1' ) {
			if ( $thinkup_woocommerce_variation == 'option2' ) {
				return 'option2';
			}
		} else if ( $_thinkup_meta_woocommercevariation == 'option3' ) {
			return 'option2';	
		}
	}
}

// Output radio buttons for variations - Not default dropdown
function thinkup_woo_variationscripts() {
global $thinkup_woocommerce_variation;
global $thinkup_woocommerce_styleswitch;

global $post;
$_thinkup_meta_woocommercevariation = get_post_meta( $post->ID, '_thinkup_meta_woocommercevariation', true );

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		if ( empty( $_thinkup_meta_woocommercevariation ) or $_thinkup_meta_woocommercevariation == 'option1' ) {
			if ( $thinkup_woocommerce_variation == 'option2' ) {
				wp_deregister_script('wc-add-to-cart-variation'); 
				wp_dequeue_script('wc-add-to-cart-variation'); 
		  
				wp_register_script( 'wc-add-to-cart-variation', get_stylesheet_directory_uri() . '/woocommerce/js/radio-variations/add-to-cart-variation.min.js', array( 'jquery'), false, true ); 
				wp_enqueue_script('wc-add-to-cart-variation'); 
			}
		} else if ( $_thinkup_meta_woocommercevariation == 'option3' ) {
				wp_deregister_script('wc-add-to-cart-variation'); 
				wp_dequeue_script('wc-add-to-cart-variation'); 
		  
				wp_register_script( 'wc-add-to-cart-variation', get_stylesheet_directory_uri() . '/woocommerce/js/radio-variations/add-to-cart-variation.min.js', array( 'jquery'), false, true ); 
				wp_enqueue_script('wc-add-to-cart-variation'); 
		}

	}
} 
add_action( 'wp_enqueue_scripts', 'thinkup_woo_variationscripts' ); 

// Output radio buttons css
function thinkup_woo_variationcss() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		global $thinkup_woocommerce_variationtitle;
		global $thinkup_woocommerce_skuswitch;

		global $post;
		$_thinkup_meta_woocommercevariationtitle = get_post_meta( $post->ID, '_thinkup_meta_woocommercevariationtitle', true );
		$_thinkup_meta_woocommerceskuswitch      = get_post_meta( $post->ID, '_thinkup_meta_woocommerceskuswitch', true );

		$output = NULL;

		// Output css to hide variation title
		if ( empty( $_thinkup_meta_woocommercevariationtitle ) or $_thinkup_meta_woocommercevariationtitle == 'option1' ) {
			if ( $thinkup_woocommerce_variationtitle == '1' ) {
				$output .= '.single-product .variations .label { display: none; }' . "\n";
			}
		} else if ( $_thinkup_meta_woocommercevariationtitle == 'option3' ) {
			$output .= '.single-product .variations .label { display: none; }' . "\n";		
		}

		// Output css to hide SKU ID
		if ( empty( $_thinkup_meta_woocommerceskuswitch ) or $_thinkup_meta_woocommerceskuswitch == 'option1' ) {
			if ( $thinkup_woocommerce_skuswitch == '1' ) {
				$output .= '.single-product .product_meta { display: none; }' . "\n";
			}
		} else if ( $_thinkup_meta_woocommerceskuswitch == 'option3' ) {
			$output .= '.single-product .product_meta { display: none; }' . "\n";		
		}

		// Output custom css if required
		if ( ! empty ( $output ) ) {
			echo "\n" .'<style type="text/css">' . "\n";
			echo $output;
			echo '</style>' . "\n";
		}
	}
}
add_action( 'wp_footer', 'thinkup_woo_variationcss' ); 


//----------------------------------------------------------------------------------
//	PRODUCT PAGE (SINGLE PAGE) - RELATED PRODUCTS
//----------------------------------------------------------------------------------

// Add layout classes to post class
function thinkup_woo_layoutrelated($classes) {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_singular( 'product' ) ) {

			global $post;
			global $thinkup_woocommerce_layoutrelated;

			if ( empty( $thinkup_woocommerce_layoutrelated ) or $thinkup_woocommerce_layoutrelated == 'option1' ) {
				$classes[] = ' column-2';
			} else if ( $thinkup_woocommerce_layoutrelated == 'option2' ) {
				$classes[] = ' column-3';
			} else if ( $thinkup_woocommerce_layoutrelated == 'option3' ) {
				$classes[] = ' column-4';
			}
		}
	}
	return $classes;
}
add_filter('post_class', 'thinkup_woo_layoutrelated');

// Determine the number of related posts to be shown
function thinkup_woo_countrelated() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		global $thinkup_woocommerce_countrelated;

		// Output number of related posts
		if ( ! empty( $thinkup_woocommerce_countrelated ) ) {
			return $thinkup_woocommerce_countrelated;
		} else {
			return '2';		
		}
	}
}


// Products Page - Product Thumbnail
function thinkup_woo_thumbnailrelated() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_singular( 'product' ) ) {

			global $post;
			global $thinkup_woocommerce_layoutrelated;
			global $thinkup_woocommerce_quickviewrelated;
			global $thinkup_woocommerce_lightboxrelated;
			global $thinkup_woocommerce_likesrelated;
			global $thinkup_woocommerce_sharingrelated;

			// Reset variable values
			$product_thumbnail = NULL;
			$product_id        = NULL;
			$product_img       = NULL;
			$link              = NULL;
			$output            = NULL;

			// Determine thumbnail size
			if ( empty( $thinkup_woocommerce_layoutrelated ) or $thinkup_woocommerce_layoutrelated == 'option1' ) {
				$size = 'column2-1/1';
			} else if ( $thinkup_woocommerce_layoutrelated == 'option2' ) {
				$size = 'column3-1/1';
			} else if ( $thinkup_woocommerce_layoutrelated == 'option3' ) {
				$size = 'column4-1/1';
			}

			// Get thumbnail image or use default WooCommerce placeholder
			if ( has_post_thumbnail() ) {
				$product_thumbnail = get_the_post_thumbnail( $post->ID, $size );
			} else if ( wc_placeholder_img_src() ) {
				$product_thumbnail = wc_placeholder_img( $size );
			}

			// Determine url of thumbnail image
			$product_id = get_post_thumbnail_id( $post->ID );
			$product_img = wp_get_attachment_image_src($product_id,'full', true);
			$link  = $product_img[0];

			// Output thumbnail and Quick View button
			$output .= '<div class="woo-meta">';
			$output .= '<div class="woo-meta-row1">';

			// Output like button if set
			if ( $thinkup_woocommerce_likesrelated == '1' ) {
				$output .= thinkup_woo_getPostLikeLink( $post->ID );
			} // else if ( $thinkup_woocommerce_sharingrelated == '1' ) {
			  // $output .= '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
			  // $output .= thinkup_woo_socialshare();
			  // }

			// Output lightbox or social sharing button if set
			if ( $thinkup_woocommerce_lightboxrelated == '1' ) {
				$output .= '<a href="' . $product_img[0] . '" class="prettyPhoto"><i class="fa fa-expand"></i></a>';
			}

			$output .= '<div class="clearboth"></div>';
			$output .= '</div>';

			// Output social sharing button if set (and not already output above.
			// if ( $thinkup_woocommerce_likesrelated == '1' and $thinkup_woocommerce_sharingrelated == '1' ) {
			//	$output .= '<div class="woo-meta-row2">';
			//	$output .= '<a class="woo-share"><i class="fa fa-share-alt"></i></a>';
			//	$output .= thinkup_woo_socialshare();
			//	$output .= '</div>';
			//  }

			$output .= '</div>';

			$output .= '<a href="' . get_permalink() . '">' . $product_thumbnail .'</a>';

			if ( $thinkup_woocommerce_quickviewrelated == '1' ) {
				$output .= '<div class="image-overlay">';
				$output .= '<div class="image-overlay-inner">';
				$output .= '<div class="wrap-woo">';
				$output .= '<a href="' . $product_img[0] . '" class="prettyPhoto more-link style2 themebutton">';
				$output .= '<span class="more-icon"><i class="fa fa-expand fa-lg"></i>';
				$output .= '</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
			}

			echo $output;

			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		}
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_thumbnailrelated', 9 );


// Add title with link to individual product page
function thinkup_woo_relatedtitle() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {

			global $post;

			echo '<a href="' . get_permalink() . '"><h3>' . get_the_title() . '</h3></a>';

		}
	}
}
// Add excerpt of individual product page
function thinkup_woo_relatedexcerpt() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {

			global $post;
			global $thinkup_woocommerce_excerptrelated;

			// Only show for column 1 layout
			if ( $thinkup_woocommerce_excerptrelated == '1' ) {
				echo wpautop( get_post( $post->ID )->post_excerpt );
			}
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item_title', 'thinkup_woo_relatedtitle', 8 );
add_action( 'woocommerce_after_shop_loop_item_title', 'thinkup_woo_relatedexcerpt', 11 );

// Add theme specific buy now button
function thinkup_woo_addtocartrelated() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on main shop page
		if ( is_singular( 'product' ) ) {

			global $product;

			echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<p class="more-link style2"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="themebutton">' . __( 'Add To Cart', 'ryan' ) . '</a></p>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				esc_attr( $product->product_type ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );

			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_woo_addtocartrelated', 9 );


//----------------------------------------------------------------------------------
//	PRODUCT PAGE (SINGLE PAGE) - PAGE LAYOUT
//----------------------------------------------------------------------------------

// Add two column layout to product page
function thinkup_woo_layoutproductclass1() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '<div class="entry-header one_half">';
		}
	}
}
function thinkup_woo_layoutproductclass2() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '</div><div class="entry-content one_half last">';
		}
	}
}
function thinkup_woo_layoutproductclass3() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '</div><div class="clearboth"></div>';
		}
	}
}
add_action( 'woocommerce_before_single_product_summary', 'thinkup_woo_layoutproductclass1', 1 );	
add_action( 'woocommerce_before_single_product_summary', 'thinkup_woo_layoutproductclass2', 99 );	
add_action( 'woocommerce_after_single_product_summary', 'thinkup_woo_layoutproductclass3', 1 );	


// Add entry-header, entry-content, entry-footer section to product summary
function thinkup_woo_layoutsummaryclass1() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {
			echo '<div class="entry-header">';
		}
	}
}
function thinkup_woo_layoutsummaryclass2() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {
			echo '</div>';
		}
	}
}
function thinkup_woo_layoutsummaryclass3() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {
			echo '<div class="entry-content">';
		}
	}
}
function thinkup_woo_layoutsummaryclass4() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {
			echo '</div>';
		}
	}
}
function thinkup_woo_layoutsummaryclass5() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {
			echo '<div class="entry-footer">';
		}
	}
}
function thinkup_woo_layoutsummaryclass6() {
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on product page
		if ( is_singular( 'product' ) ) {
			echo '</div>';
		}
	}
}

add_action( 'woocommerce_single_product_summary', 'thinkup_woo_layoutsummaryclass1', 4 );
add_action( 'woocommerce_single_product_summary', 'thinkup_woo_layoutsummaryclass2', 11 );
add_action( 'woocommerce_single_product_summary', 'thinkup_woo_layoutsummaryclass3', 19 );
add_action( 'woocommerce_single_product_summary', 'thinkup_woo_layoutsummaryclass4', 22 );
add_action( 'woocommerce_single_product_summary', 'thinkup_woo_layoutsummaryclass5', 29 );
add_action( 'woocommerce_single_product_summary', 'thinkup_woo_layoutsummaryclass6', 51 );

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 21 );


// Add entry-header, entry-content, entry-footer section to related products
function thinkup_woo_layoutrelatedclass1() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '<div class="entry-header">'; 
		}
	}
}
function thinkup_woo_layoutrelatedclass2() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '</div><div class="entry-content">'; 
		}
	}
}
function thinkup_woo_layoutrelatedclass3() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '</div><div class="entry-footer">'; 
		}
	}
}
function thinkup_woo_layoutrelatedclass4() { 
global $thinkup_woocommerce_styleswitch;

	// Output custom styling if specified by user
	if ( $thinkup_woocommerce_styleswitch == '1' ) {

		// Only output on individual product page
		if ( is_singular( 'product' ) ) {
			echo '</div>'; 
		}
	}
}

add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_layoutrelatedclass1', 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'thinkup_woo_layoutrelatedclass2', 11 );
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_woo_layoutrelatedclass3', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'thinkup_woo_layoutrelatedclass4', 11 );


//----------------------------------------------------------------------------------
//	SHOP & PRODUCT PAGE (ARCHIVE & SINGLE PAGE)
//----------------------------------------------------------------------------------

// Disable WooCommerce wrapper ID's and classes
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Replace WooCommerce pagination with theme specific pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'thinkup_input_pagination', 10 );

// Disable WooCommerce breadcrumb function
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Disable WooCommerce sidebar function - Handled by theme options
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Organise header section - After page intro
function thinkup_woo_introshop() {

	// Only output on main shop page
	if ( is_post_type_archive( 'product' ) or is_tax( 'product_cat' ) or is_tax( 'product_tag' ) ) {

		echo '<div id="intro-woo">';
		echo '<div class="wrap-safari">';
		echo '<div id="intro-woo-core">';
		
		echo '<div id="intro-woo-count">';
		echo woocommerce_result_count();
		echo '</div>';
		
		echo '<div id="intro-woo-order">';
		echo woocommerce_catalog_ordering();
		echo '</div>';
		
		echo '<div id="intro-woo-search"><div id="intro-woo-search-core">';
		echo get_product_search_form();
		echo '</div></div>';

		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}
add_action( 'thinkup_hook_custom_intro', 'thinkup_woo_introshop' );


// Remove default ordering and results count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


?>