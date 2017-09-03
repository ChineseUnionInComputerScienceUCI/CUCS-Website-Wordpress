<?php
/*
Plugin Name: WooCommerce Menu Cart
Plugin URI: www.wpovernight.com/plugins
Description: Extension for WooCommerce that places a cart icon with number of items and total cost in the menu bar. Activate the plugin, set your options and you're ready to go! Will automatically conform to your theme styles.
Version: 2.5.2
Author: Jeremiah Prummer, Ewout Fernhout
Author URI: www.wpovernight.com/
License: GPL2
*/

class thinkup_woo_WpMenuCart {

	/**
	 * Construct.
	 */
	public function __construct() {

		// load the localisation & classes
		add_action( 'init', array( $this, 'load_classes' ) );

		// enqueue scripts & ajax
		add_action( 'wp_ajax_wpmenucart_ajax', array( &$this, 'wpmenucart_ajax' ), 0 );
		add_action( 'wp_ajax_nopriv_wpmenucart_ajax', array( &$this, 'wpmenucart_ajax' ), 0 );
		add_filter( 'add_to_cart_fragments', array( &$this, 'woocommerce_ajax_fragments' ) );

		// add filters to selected menus to add cart item <li>
		add_action( 'init', array( $this, 'filter_nav_menus' ) );
	}

	/**
	 * Load classes
	 * @return void
	 */
	public function load_classes() {
		include_once( 'includes/wpmenucart-woocommerce.php' );
		$this->shop = new WPMenuCart_WooCommerce();
	}


	/**
	 * Add filters to selected menus to add cart item <li>
	 */
	public function filter_nav_menus() {
		// exit if no shop class is active
		if ( !isset($this->shop) )
			return;

		// Find name of menu that's assigned to header_menu location
		$menus          = wp_get_nav_menus();
		$menu_locations = get_nav_menu_locations();
		$location_id    = 'header_menu';
		if (isset($menu_locations[ $location_id ])) {
			foreach ($menus as $menu) {
				// If the ID of this menu is the ID associated with the location we're searching for
				if ($menu->term_id == $menu_locations[ $location_id ]) {
					// This is the correct menu
					$menu_cartitem = $menu->slug;
				}
			}	
		}

		// exit if no menus set
		if ( empty( $menu_cartitem ) )
			return;

		add_filter( 'wp_nav_menu_' . $menu_cartitem . '_items', array( &$this, 'add_itemcart_to_menu' ) , 10, 2 );
	}
	
	/**
	 * Add Menu Cart to menu
	 * 
	 * @return menu items + Menu Cart item
	 */
	public function add_itemcart_to_menu( $items ) {

		// DEPRICATED: These filters are now deprecated in favour of the more precise filters in the functions!
		$wpmenucart_menu_item = apply_filters( 'wpmenucart_menu_item_filter', $this->wpmenucart_menu_item() );
		$wpmenucart_menu_drop = $this->wpmenucart_menu_drop();

		$item_data = $this->shop->menu_item();

		$menu_item_li = '<li id="woo-cart-menu" class="woo-cart-menu-object">' . $wpmenucart_menu_item . $wpmenucart_menu_drop . '</li>';

		$items .= apply_filters( 'wpmenucart_menu_item_wrapper', $menu_item_li );

		return $items;
	}

	/**
	 * Ajaxify Menu Cart
	 */
	public function woocommerce_ajax_fragments( $fragments ) {
		$fragments['a.woo-cart-menu-item']    = $this->wpmenucart_menu_item();
		$fragments['.woo-cart-menu-dropdown'] = $this->wpmenucart_menu_drop();
		return $fragments;
	}

	/**
	 * Create HTML for Menu Cart item
	 */
	public function wpmenucart_menu_item() {

		// Set variables to avoid php non-object notice error
		$menu_item = NULL;

		$item_data = $this->shop->menu_item();

		//use regular WP i18n
		$viewing_cart = __('View your shopping cart', 'ryan');
		$start_shopping = __('Start shopping', 'ryan');
		$cart_contents = sprintf(_n('<span class="woo-cart-count-before">Cart (</span>%d<span class="woo-cart-count-after"> Item)</span>', '<span class="woo-cart-count-before">Cart (</span>%d<span class="woo-cart-count-after"> Items)</span>', $item_data['cart_contents_count'], 'ryan'), $item_data['cart_contents_count']);

		if ($item_data['cart_contents_count'] == 0) {
			$menu_item_href = apply_filters ('wpmenucart_emptyurl', $item_data['shop_page_url'] );
			$menu_item_title = apply_filters ('wpmenucart_emptytitle', $start_shopping );
		} else {
			$menu_item_href = apply_filters ('wpmenucart_fullurl', $item_data['cart_url'] );
			$menu_item_title = apply_filters ('wpmenucart_fulltitle', $viewing_cart );
		}

		$menu_item .= '<a class="woo-cart-menu-item" href="'.$menu_item_href.'" title="'.$menu_item_title.'">';
		
		$menu_item_a_content = '';	
		$menu_item_a_content .= '<span class="woo-cart-menu-wrap">';
		$menu_item_a_content .= '<span class="woo-cart-menu-wrap-inner">';
		$menu_item_a_content .= '<span class="woo-cart-menu-icon"><span class="woo-cart-menu-icon-inner"></span></span>';
		$menu_item_a_content .= '<span class="woo-cart-menu-content"><span class="woo-cart-menu-content-inner">'.$cart_contents.'</span></span>';
		$menu_item_a_content .= '</span>';
		$menu_item_a_content .= '</span>';

		$menu_item .= $menu_item_a_content . '</a>';

		if( !empty( $menu_item ) ) return $menu_item;
	}


	/**
	 * Create HTML for Menu Cart item
	 */
	public function wpmenucart_menu_drop() {

		// Set variables to avoid php non-object notice error
		$menu_item = NULL;

		$item_data = $this->shop->menu_item();

		// Dropdown menu to display cart items
		if ($item_data['cart_contents_count'] == 0) {
			$menu_drop_content = '';
			$menu_drop_content .= '<div class="woo-cart-menu-dropdown" style="display: none;">' . __('Cart: ', 'ryan' ) . ' <span class="amount">'.$item_data['cart_total'].'</span></div>';

			$menu_item .= $menu_drop_content;
		} else {
			$menu_drop_content = '';
			$menu_drop_content .= '<div class="woo-cart-menu-dropdown" style="display: none;">' . __('Cart: ', 'ryan' ) . ' <span class="amount">'.$item_data['cart_total'].'</span></div>';

			$menu_item .= $menu_drop_content;
		}

		if( !empty( $menu_item ) ) return $menu_item;
	}

	public function wpmenucart_ajax() {
		$variable = $this->wpmenucart_menu_item();
		echo $variable;
		die();
	}

}

$thinkup_woo_wpMenuCart = new thinkup_woo_WpMenuCart();
