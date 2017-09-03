<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
//$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

// ThinkUpThemes Specific - Clear floating elements
//	global $post;
global $thinkup_woocommerce_layout;
global $thinkup_woocommerce_layoutrelated;

$class_clear = NULL;		

if ( is_singular( 'product' ) ) {
	if ( $thinkup_woocommerce_layoutrelated == 'option1' ) {
		if( ( $woocommerce_loop['loop'] + 1 ) % 2 == 0) {
			$class_clear = '<div class="clearboth"></div>';
		}
	} else if ( empty( $thinkup_woocommerce_layoutrelated ) or $thinkup_woocommerce_layoutrelated == 'option2' ) {
		if( ( $woocommerce_loop['loop'] + 1 ) % 3 == 0) {
			$class_clear = '<div class="clearboth"></div>';
		}	
	} else if ( $thinkup_woocommerce_layoutrelated == 'option3' ) {
		if( ( $woocommerce_loop['loop'] + 1 ) % 4 == 0) {
			$class_clear = '<div class="clearboth"></div>';
		}
	}
} else {
	if ( empty( $thinkup_woocommerce_layout ) or $thinkup_woocommerce_layout == 'option1' or $thinkup_woocommerce_layout == 'option5' or $thinkup_woocommerce_layout == 'option6' ) {
		if( $woocommerce_loop['loop'] % 1 == 0) {
			$class_clear = NULL;
		}
	} else if ( $thinkup_woocommerce_layout == 'option2' or $thinkup_woocommerce_layout == 'option7' or $thinkup_woocommerce_layout == 'option8' ) {
		if( $woocommerce_loop['loop'] % 2 == 0) {
//			$class_clear = '<div class="clearboth"></div>'; // Disabled as grid layout is now added by Masonry script
		}
	} else if ( $thinkup_woocommerce_layout == 'option3' ) {
		if( $woocommerce_loop['loop'] % 3 == 0) {
//			$class_clear = '<div class="clearboth"></div>'; // Disabled as grid layout is now added by Masonry script
		}	
	} else if ( $thinkup_woocommerce_layout == 'option4' ) {
		if( $woocommerce_loop['loop'] % 4 == 0) {
//			$class_clear = '<div class="clearboth"></div>'; // Disabled as grid layout is now added by Masonry script
		}
	}
}
?>
<li <?php post_class( $classes ); ?>>

	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
//	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>

</li><?php echo $class_clear; ?>
