<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
<div id="thinkupshortcodestabswoo" class="tabs style1">
	<div class="tab-buttons tab-buttons-left">
		<ul class="nav nav-tabs">

		<?php $count = NULL; $class = NULL; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>

			<?php $count = $count + 1; ?>
			<?php if ( $count == '1' ) { $class = ' active'; } else { $class = NULL; } ?>

				<li class="<?php echo $key ?>_tab<?php echo $class; ?>">
					<a href="#tab-<?php echo $key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>
			<?php endforeach; ?>
		<?php $count = NULL; $class = NULL; ?>

		</ul>
	</div>

	<div class="tab-content">
	
		<?php $count = NULL; $class = NULL; ?>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<?php $count = $count + 1; ?>
			<?php if ( $count == '1' ) { $class = ' active in'; } else { $class = NULL; } ?>

			<div class="tab-pane fade<?php echo $class; ?>" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>
		<?php endforeach; ?>
		<?php $count = NULL; $class = NULL; ?>

	</div>
</div>
<?php endif; ?>