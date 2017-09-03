<?php
/**
 * Setup theme functions for Ryan.
 *
 * @package ThinkUpThemes
 */

// Declare latest theme version
$GLOBALS['thinkup_theme_version'] = '1.2.5';

// WooCommerce API Manager Integration
if ( ! defined( 'THINKUP_UPDATE_THEME_UPRADE_URL' ) ) {
	define( 'THINKUP_UPDATE_THEME_UPRADE_URL', 'http://www.thinkupthemes.com/' );
}

if ( ! defined( 'THINKUP_UPDATE_THEME_RENEW_LICENSE_URL' ) ) {
	define( 'THINKUP_UPDATE_THEME_RENEW_LICENSE_URL', 'http://www.thinkupthemes.com/my-account' );
}

if ( ! defined( 'THINKUP_UPDATE_THEME_SETTINGS_MENU_TITLE' ) ) {
	define( 'THINKUP_UPDATE_THEME_SETTINGS_MENU_TITLE', 'API License Key' );
}

if ( ! defined( 'THINKUP_UPDATE_THEME_SETTINGS_TITLE' ) ) {
	define( 'THINKUP_UPDATE_THEME_SETTINGS_TITLE', 'Activate API License Key' );
}

if ( ! defined( 'THINKUP_UPDATE_THEME_TEXT_DOMAIN' ) ) {
	define( 'THINKUP_UPDATE_THEME_TEXT_DOMAIN', 'ryan' );
}

require_once( get_template_directory() . '/lib/update-api/am.php');

// Setup content width 
function thinkup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thinkup_content_width', 1170 );
}
add_action( 'after_setup_theme', 'thinkup_content_width', 0 );


//----------------------------------------------------------------------------------
//	Add Theme Options Panel & Assign Variable Values
//----------------------------------------------------------------------------------

	// Add Redux Framework
	require_once( get_template_directory() . '/admin/main/framework.php' );
	require_once( get_template_directory() . '/admin/main/options.php' );
	require_once( get_template_directory() . '/admin/main-extensions/extensions-init.php' );

	// Add theme options to page/post meta.
	require_once ( get_template_directory() . '/admin/meta/meta-functions.php' );

	// Load Theme Variables.
	require_once( get_template_directory() . '/admin/main/options/00.variables.php' ); 

	// Load demo functions if required.
	if( file_exists( get_template_directory() . '/demo/functions/demo-variable.php' ) )
		include get_template_directory() . '/demo/functions/demo-variable.php';

	// Add Theme Options Features.
	require_once( get_template_directory() . '/admin/main/options/00.theme-setup.php' ); 
	require_once( get_template_directory() . '/admin/main/options/01.general-settings.php' ); 
	require_once( get_template_directory() . '/admin/main/options/02.homepage.php' ); 
	require_once( get_template_directory() . '/admin/main/options/03.header.php' ); 
	require_once( get_template_directory() . '/admin/main/options/04.footer.php' );
	require_once( get_template_directory() . '/admin/main/options/05.blog.php' ); 
	require_once( get_template_directory() . '/admin/main/options/06.portfolio.php' ); 
	require_once( get_template_directory() . '/admin/main/options/07.contact-page.php' ); 
	require_once( get_template_directory() . '/admin/main/options/08.special-pages.php' ); 
	require_once( get_template_directory() . '/admin/main/options/09.notification-bar.php' ); 
	require_once( get_template_directory() . '/admin/main/options/10.seo.php' ); 
	require_once( get_template_directory() . '/admin/main/options/11.typography.php' ); 
	require_once( get_template_directory() . '/admin/main/options/12.custom-styling.php' );
	
	// Add WooCommerce functions if WooCommerce plugin is activated.
	if ( class_exists( 'Woocommerce' ) ) {
		if ( thinkup_var_cookie( 'thinkup_woocommerce_styleswitch' ) == '1' ) {
			require_once( get_template_directory() . '/admin/main/options/13.woocommerce.php' );
		}
	}

	// Add widget features.
	include_once( get_template_directory() . '/lib/widgets/categories.php' ); 
	include_once( get_template_directory() . '/lib/widgets/childmenu.php' ); 
	include_once( get_template_directory() . '/lib/widgets/flickr.php' ); 
	include_once( get_template_directory() . '/lib/widgets/logo_text.php' ); 
	include_once( get_template_directory() . '/lib/widgets/popularposts.php' ); 
	include_once( get_template_directory() . '/lib/widgets/recentcomments.php' ); 
	include_once( get_template_directory() . '/lib/widgets/recentposts.php' ); 
	include_once( get_template_directory() . '/lib/widgets/searchfield.php' ); 
	include_once( get_template_directory() . '/lib/widgets/tabs.php' );
	include_once( get_template_directory() . '/lib/widgets/tagscloud.php' );
	include_once( get_template_directory() . '/lib/widgets/twitterfeed.php' ); 

	// Add widget used in page builder.
	include_once( get_template_directory() . '/lib/widgets_builder/carousel_client/carousel_client.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/carousel_blog/carousel_blog.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/carousel_portfolio/carousel_portfolio.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/carousel_team/carousel_team.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/carousel_testimonial/carousel_testimonial.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/heading/heading.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/icons_fontawesome/icons_fontawesome.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/image/image.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/item_client/item_client.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/item_portfolio/item_portfolio.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/item_team/item_team.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/item_testimonial/item_testimonial.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/progress_round/progress_round.php' );
	include_once( get_template_directory() . '/lib/widgets_builder/services/services.php' );

	// Add unlimited sidebars.
	require_once( get_template_directory() . '/lib/extentions/unlimited-sidebars/class.SidebarGenerator.php' );

	// Add post like.
	require_once( get_template_directory() . '/lib/extentions/post-like/post-like.php');

	// Add shortcodes.
	if( file_exists( get_template_directory() . '/lib/shortcodes/framework.php' ) )
		require_once( get_template_directory() . '/lib/shortcodes/framework.php' );

	// Add Upgrade Notice
	if( file_exists( get_template_directory() . '/lib/update/update_notice_ryan.php' ) )
		require_once( get_template_directory() . '/lib/update/update_notice_ryan.php');
		
	// Add Demo Installer
	if( file_exists( get_template_directory() . '/lib/demoinstaller/init.php' ) )
		require_once( get_template_directory() . '/lib/demoinstaller/init.php' );

//----------------------------------------------------------------------------------
//	Assign Theme Specific Functions
//----------------------------------------------------------------------------------

// Setup theme features, register menus and scripts.
if ( ! function_exists( 'thinkup_themesetup' ) ) {

	function thinkup_themesetup() {

		// Load required files
		require_once ( get_template_directory() . '/admin/meta/init.php' );
		require_once ( get_template_directory() . '/lib/functions/extras.php' );
		require_once ( get_template_directory() . '/lib/functions/template-tags.php' );

		// Register Custom Post Types
		require_once ( get_template_directory() . '/lib/custom_posts/client/register-client.php' ); 
		require_once ( get_template_directory() . '/lib/custom_posts/portfolio/register-portfolio.php' ); 
		require_once ( get_template_directory() . '/lib/custom_posts/team/register-team.php' ); 
		require_once ( get_template_directory() . '/lib/custom_posts/testimonial/register-testimonial.php' ); 

		// Make theme translation ready.
		load_theme_textdomain( 'ryan', get_template_directory() . '/languages' );

		// Add default theme functions.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'status', 'quote', 'link', 'chat' ) );
		add_theme_support( 'title-tag' );

		// Add support for custom background
		add_theme_support( 'custom-background' );

		// Add support for custom header
		$thinkup_header_args = apply_filters( 'thinkup_custom_header', array( 'height' => 200, 'width'  => 1600, 'header-text' => false, 'flex-height' => true ) );
		add_theme_support( 'custom-header', $thinkup_header_args );

		// Add support for custom logo
		add_theme_support( 'custom-logo', array( 'height' => 90, 'width' => 200, 'flex-width' => true, 'flex-height' => true ) );

		// Add WooCommerce functions.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add excerpt support to pages.
		add_post_type_support( 'page', 'excerpt' );

		// Register theme menu's.
		register_nav_menus( array( 'pre_header_menu' => __( 'Pre Header Menu', 'ryan' ) ) );
		register_nav_menus( array( 'header_menu'     => __( 'Primary Header Menu', 'ryan' ) ) );
		register_nav_menus( array( 'sub_footer_menu' => __( 'Footer Menu', 'ryan' ) ) );
	}
}
add_action( 'after_setup_theme', 'thinkup_themesetup' );


//----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts
//----------------------------------------------------------------------------------

function thinkup_frontscripts() {

	global $thinkup_theme_version;

	// Add 3rd party stylesheets
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/lib/extentions/prettyPhoto/css/prettyPhoto.css', '', '3.1.6' );

	// Add 3rd party stylesheets - Prefixed to prevent conflict between library versions
	wp_enqueue_style( 'thinkup-bootstrap', get_template_directory_uri() . '/lib/extentions/bootstrap/css/bootstrap.min.css', '', '2.3.2' );

	// Add 3rd party Font Packages
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/extentions/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

	// Add 3rd party scripts
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'prettyPhoto', ( get_template_directory_uri().'/lib/extentions/prettyPhoto/js/jquery.prettyPhoto.js' ), array( 'jquery' ), '3.1.6', 'true' );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/lib/scripts/modernizr.js', array( 'jquery' ), '2.6.2', 'true'  );
	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/lib/scripts/plugins/sticky/jquery.sticky.js', '1.0.0', 'true' );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/lib/scripts/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '2.0.3', 'true'  );
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/lib/scripts/plugins/waypoints/waypoints-sticky.min.js', array( 'jquery' ), '2.0.3', 'true'  );	
	wp_enqueue_script( 'videobg', get_template_directory_uri() . '/lib/scripts/plugins/videoBG/jquery.videoBG.js', array( 'jquery' ), '0.2', '' );
	wp_enqueue_script( 'jquery-scrollup', get_template_directory_uri() . '/lib/scripts/plugins/scrollup/jquery.scrollUp.min.js', array( 'jquery' ), '2.4.1', 'true' );

	// Add 3rd party scripts - Prefixed to prevent conflict between library versions
	wp_enqueue_script( 'thinkup-bootstrap', get_template_directory_uri() . '/lib/extentions/bootstrap/js/bootstrap.js', array( 'jquery' ), '2.3.2', 'true' );

	// Register 3rd party scripts
	wp_register_script( 'retina', get_template_directory_uri() . '/lib/scripts/retina.js', array( 'jquery' ), '0.0.2', '', true );

	// Add theme stylesheets
	wp_enqueue_style( 'thinkup-shortcodes', get_template_directory_uri() . '/styles/style-shortcodes.css', '', $thinkup_theme_version );
	wp_enqueue_style( 'thinkup-style', get_stylesheet_uri(), '', $thinkup_theme_version );

	// Add theme scripts
	wp_enqueue_script( 'thinkup-frontend', get_template_directory_uri() . '/lib/scripts/main-frontend.js', array( 'jquery' ), $thinkup_theme_version, 'true' );

	// Register theme stylesheets
	wp_register_style( 'thinkup-responsive', get_template_directory_uri() . '/styles/style-responsive.css', '', $thinkup_theme_version );

	// Register WooCommerce (theme specific) stylesheets
	wp_register_style( 'thinkup-woocommerce', get_template_directory_uri() . '/styles/woocommerce/css/woocommerce.css', '', $thinkup_theme_version );
	wp_register_style( 'thinkup-woocommerce-theme', get_template_directory_uri() . '/styles/woocommerce/css/woocommerce-theme.css', '', $thinkup_theme_version );

	// Add Masonry script to all archive pages
	if ( thinkup_check_isblog() or is_page_template( 'template-blog.php' ) or is_archive() 
			or is_page_template( 'template-portfolio.php' ) or is_post_type_archive( 'portfolio' )
			or is_page_template( 'template-client.php' ) or is_post_type_archive( 'client' )
			or is_page_template( 'template-team.php' ) or is_post_type_archive( 'team' )
			or is_page_template( 'template-testimonial.php' ) or is_post_type_archive( 'testimonial' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	// Add Portfolio styles & scripts
	if ( is_post_type_archive( 'portfolio' ) or is_page_template( 'template-portfolio.php' ) or is_singular( 'portfolio' ) ) {
		wp_enqueue_style( 'thinkup-portfolio', get_template_directory_uri() . '/styles/style-portfolio.css', '', $thinkup_theme_version );
	}
	if ( is_post_type_archive( 'portfolio' ) or is_page_template( 'template-portfolio.php' ) ) {
		wp_enqueue_script( 'thinkup-portfolio', get_template_directory_uri() . '/lib/custom_posts/portfolio/js/portfolio.js', array( 'jquery' ), $thinkup_theme_version, true );
		wp_enqueue_script( 'thinkup-quicksand', get_template_directory_uri() . '/lib/scripts/plugins/quicksand/jquery.quicksand.js', array( 'jquery' ), array( 'jquery' ), '1.3', true );
		wp_enqueue_script( 'thinkup-quicksand-scale', get_template_directory_uri() . '/lib/scripts/plugins/quicksand/jquery-animate-css-rotate-scale.js', array( 'jquery' ), array( 'jquery' ), '1.3', true );
	}

	// Add ThinkUpSlider scripts
	if ( is_front_page() ) {
		wp_enqueue_script( 'responsiveslides', get_template_directory_uri() . '/lib/scripts/plugins/ResponsiveSlides/responsiveslides.min.js', array( 'jquery' ), '1.54', 'true' );
		wp_enqueue_script( 'thinkup-responsiveslides', get_template_directory_uri() . '/lib/scripts/plugins/ResponsiveSlides/responsiveslides-call.js', array( 'jquery' ), $thinkup_theme_version, 'true' );
	}

	// Add comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thinkup_frontscripts', 10 );


//----------------------------------------------------------------------------------
//	Register Back-End Styles And Scripts
//----------------------------------------------------------------------------------

function thinkup_adminscripts() {

	global $thinkup_theme_version;

	// Load scripts only used on Demo Content page.
	if( get_current_screen()->id == 'appearance_page_easint' ) {
		wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css', '', '' );
		wp_enqueue_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js', array( 'jquery' ), '' );
		wp_enqueue_script( 'thinkup-confirm', get_template_directory_uri() . '/lib/scripts/plugins/confirm/jquery.confirm.js', array( 'jquery' ), '2.3.1' );
	}

	// Add theme stylesheets
	wp_enqueue_style( 'thinkup-backend', get_template_directory_uri() . '/styles/backend/style-backend.css', '', $thinkup_theme_version );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/extentions/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

	// Add theme scripts
	wp_enqueue_script( 'thinkup-backend', get_template_directory_uri() . '/lib/scripts/main-backend.js', array( 'jquery' ), $thinkup_theme_version );
}
add_action( 'admin_enqueue_scripts', 'thinkup_adminscripts' );


//----------------------------------------------------------------------------------
//	Register Shortcodes Styles And Scripts
//----------------------------------------------------------------------------------

function thinkup_shortcodescripts() {

	global $thinkup_theme_version;

	// Add shortcode Styles
	wp_enqueue_style( 'thinkup-portfolio', get_template_directory_uri() . '/styles/style-portfolio.css', '', $thinkup_theme_version );

	// Add shortcode Scripts
	wp_enqueue_script( 'carouFredSel', ( get_template_directory_uri(). '/lib/scripts/plugins/carouFredSel/jquery.carouFredSel-6.2.1.js' ), array( 'jquery' ), '', '6.2.1', true );
	wp_enqueue_script( 'responsiveslides', get_template_directory_uri() . '/lib/scripts/plugins/ResponsiveSlides/responsiveslides.min.js', array( 'jquery' ), '1.54', 'true' );
	wp_enqueue_script( 'thinkup-responsiveslides', get_template_directory_uri() . '/lib/scripts/plugins/ResponsiveSlides/responsiveslides-call.js', array( 'jquery' ), $thinkup_theme_version, 'true' );
	wp_enqueue_script( 'knob', get_template_directory_uri() . '/lib/scripts/plugins/knob/jquery.knob.js', array( 'jquery' ), '1.2.8', 'false' );
}
add_action( 'wp_enqueue_scripts', 'thinkup_shortcodescripts', 10 );

//----------------------------------------------------------------------------------
//	Register Theme Widgets
//----------------------------------------------------------------------------------

function thinkup_widgets_init() {

	// Register default sidebar
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register footer sidebars
    register_sidebar( array(
        'name'          => 'Footer Column 1',
        'id'            => 'footer-w1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
 
    register_sidebar( array(
        'name'          => 'Footer Column 2',
        'id'            => 'footer-w2',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 3',
        'id'            => 'footer-w3',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 4',
        'id'            => 'footer-w4',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 5',
        'id'            => 'footer-w5',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 6',
        'id'            => 'footer-w6',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

	// Register sub-footer sidebars
    register_sidebar( array(
        'name'          => 'Sub-Footer Column 1',
        'id'            => 'sub-footer-w1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="sub-footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Sub-Footer Column 2',
        'id'            => 'sub-footer-w2',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="sub-footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'thinkup_widgets_init' );