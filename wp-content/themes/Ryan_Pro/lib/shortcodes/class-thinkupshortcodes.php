<?php
/**
 * ThinkUpShortcodes.
 *
 * @package   Thinkupshortcodes
 * @author    Think Up Themes Ltd <contact@thinkupthemes.com>
 * @license   GPL-2.0+
 * @link      www.thinkupthemes.com
 * @copyright 2017 Think Up Themes Ltd
 */

/**
 * Plugin class.
 * @package Thinkupshortcodes
 * @author  Think Up Themes Ltd <contact@thinkupthemes.com>
 */
class Thinkupshortcodes {

	/**
	 * @var     string
	 */
	const VERSION = '2.10';
	/**
	 * @var      string
	 */
	protected $plugin_slug = 'thinkupshortcodes';
	/**
	 * @var      object
	 */
	protected static $instance = null;
	/**
	 * @var      array
	 */
	protected $element_instances = array();
	/**
	 * @var      array
	 */
	protected $element_css_once = array();
	/**
	 * @var      array
	 */
	protected $elements = array();
	/**
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;
	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_stylescripts' ) );
		
		add_action('wp_footer', array( $this, 'footer_scripts' ) );

		// Detect element before rendering the page so that we can enque scripts and styles needed
//		if(!is_admin()){
//			add_action( 'wp', array( $this, 'detect_elements' ) );
//		}

		add_action( 'init', array( $this, 'activate_metaboxes' ) );
if(is_admin()){
			add_action( 'media_buttons', array($this, 'shortcode_insert_button' ), 11 );
			add_action( 'admin_footer', array( $this, 'shortcode_modal_template' ) );
		}
// Add shortcodes
		add_shortcode('animate', array($this, 'render_element'));
		add_shortcode('button1', array($this, 'render_element'));
		add_shortcode('carousel_blog', array($this, 'render_element'));
		add_shortcode('five_sixth_last', array($this, 'render_element'));
		add_shortcode('one_sixth_last', array($this, 'render_element'));
		add_shortcode('one_sixth', array($this, 'render_element'));
		add_shortcode('four_fifth_last', array($this, 'render_element'));
		add_shortcode('four_fifth', array($this, 'render_element'));
		add_shortcode('three_fifth_last', array($this, 'render_element'));
		add_shortcode('three_fifth', array($this, 'render_element'));
		add_shortcode('two_fifth_last', array($this, 'render_element'));
		add_shortcode('two_fifth', array($this, 'render_element'));
		add_shortcode('one_fifth_last', array($this, 'render_element'));
		add_shortcode('two_third', array($this, 'render_element'));
		add_shortcode('one_third_last', array($this, 'render_element'));
		add_shortcode('one_third', array($this, 'render_element'));
		add_shortcode('one_half_last', array($this, 'render_element'));
		add_shortcode('one_half', array($this, 'render_element'));
		add_shortcode('one_fifth', array($this, 'render_element'));
		add_shortcode('three_fourth_last', array($this, 'render_element'));
		add_shortcode('three_fourth', array($this, 'render_element'));
		add_shortcode('one_fourth_last', array($this, 'render_element'));
		add_shortcode('one_fourth', array($this, 'render_element'));
		add_shortcode('two_third_last', array($this, 'render_element'));
		add_shortcode('five_sixth', array($this, 'render_element'));
		add_shortcode('margin', array($this, 'render_element'));
		add_shortcode('divider', array($this, 'render_element'));
		add_shortcode('divider_top', array($this, 'render_element'));
		add_shortcode('icon', array($this, 'render_element'));
		add_shortcode('icon_full', array($this, 'render_element'));
		add_shortcode('icon_text', array($this, 'render_element'));
		add_shortcode('font', array($this, 'render_element'));
		add_shortcode('font_text', array($this, 'render_element'));
		add_shortcode('font_full2', array($this, 'render_element'));
		add_shortcode('image', array($this, 'render_element'));
		add_shortcode('youtube', array($this, 'render_element'));
		add_shortcode('vimeo', array($this, 'render_element'));
		add_shortcode('list_font', array($this, 'render_element'));
		add_shortcode('notification', array($this, 'render_element'));
		add_shortcode('pricing1', array($this, 'render_element'));
		add_shortcode('progress1', array($this, 'render_element'));
		add_shortcode('progress2', array($this, 'render_element'));
		add_shortcode('progress3', array($this, 'render_element'));
		add_shortcode('facebook', array($this, 'render_element'));
		add_shortcode('google', array($this, 'render_element'));
		add_shortcode('linkedin', array($this, 'render_element'));
		add_shortcode('twitterfollow', array($this, 'render_element'));
		add_shortcode('twittertweet', array($this, 'render_element'));
		add_shortcode('tabs2', array($this, 'render_element'));
		add_shortcode('h1title', array($this, 'render_element'));
		add_shortcode('h2title', array($this, 'render_element'));
		add_shortcode('h3title', array($this, 'render_element'));
		add_shortcode('h4title', array($this, 'render_element'));
		add_shortcode('h5title', array($this, 'render_element'));
		add_shortcode('h6title', array($this, 'render_element'));
		add_shortcode('accordion1', array($this, 'render_element'));
		add_shortcode('accordion2', array($this, 'render_element'));
		add_shortcode('slider_image', array($this, 'render_element'));
		add_shortcode('carousel_portfolio', array($this, 'render_element'));
		add_shortcode('carousel_clients', array($this, 'render_element'));
		add_shortcode('carousel_testimonial', array($this, 'render_element'));
		add_shortcode('carousel_team', array($this, 'render_element'));
		add_shortcode('slider_blog', array($this, 'render_element'));
		add_shortcode('slider_portfolio', array($this, 'render_element'));
		add_shortcode('item_portfolio', array($this, 'render_element'));
		add_shortcode('item_team', array($this, 'render_element'));
		add_shortcode('item_client', array($this, 'render_element'));
		add_shortcode('font_full1', array($this, 'render_element'));
		add_shortcode('progress_round', array($this, 'render_element'));
		add_shortcode('services1', array($this, 'render_element'));
		add_shortcode('services2', array($this, 'render_element'));
		add_shortcode('item_testimonial', array($this, 'render_element'));
		add_shortcode('button2', array($this, 'render_element'));
		add_shortcode('button3', array($this, 'render_element'));
		add_shortcode('button4', array($this, 'render_element'));
		add_shortcode('list_font_adv', array($this, 'render_element'));
		add_shortcode('blockquote1', array($this, 'render_element'));
		add_shortcode('blockquote2', array($this, 'render_element'));
		add_shortcode('tabs1', array($this, 'render_element'));
		add_shortcode('calltoaction', array($this, 'render_element'));
		add_shortcode('pricing2', array($this, 'render_element'));
		add_shortcode('grid_portfolio', array($this, 'render_element'));
		add_shortcode('grid_image', array($this, 'render_element'));
		add_shortcode('counter_number', array($this, 'render_element'));
		add_shortcode('table1', array($this, 'render_element'));
		add_shortcode('table2', array($this, 'render_element'));
		$this->elements = array_merge($this->elements, array(
			'shortcodes'			=>	array(
				'animate' 			=> '2',
				'button1' 			=> '2',
				'carousel_blog' 			=> '1',
				'five_sixth_last' 			=> '2',
				'one_sixth_last' 			=> '2',
				'one_sixth' 			=> '2',
				'four_fifth_last' 			=> '2',
				'four_fifth' 			=> '2',
				'three_fifth_last' 			=> '2',
				'three_fifth' 			=> '2',
				'two_fifth_last' 			=> '2',
				'two_fifth' 			=> '2',
				'one_fifth_last' 			=> '2',
				'two_third' 			=> '2',
				'one_third_last' 			=> '2',
				'one_third' 			=> '2',
				'one_half_last' 			=> '2',
				'one_half' 			=> '2',
				'one_fifth' 			=> '2',
				'three_fourth_last' 			=> '2',
				'three_fourth' 			=> '2',
				'one_fourth_last' 			=> '2',
				'one_fourth' 			=> '2',
				'two_third_last' 			=> '2',
				'five_sixth' 			=> '2',
				'margin' 			=> '1',
				'divider' 			=> '1',
				'divider_top' 			=> '1',
				'icon' 			=> '1',
				'icon_full' 			=> '2',
				'icon_text' 			=> '2',
				'font' 			=> '1',
				'font_text' 			=> '2',
				'font_full2' 			=> '2',
				'image' 			=> '1',
				'youtube' 			=> '1',
				'vimeo' 			=> '1',
				'list_font' 			=> '1',
				'notification' 			=> '2',
				'pricing1' 			=> '1',
				'progress1' 			=> '1',
				'progress2' 			=> '1',
				'progress3' 			=> '1',
				'facebook' 			=> '1',
				'google' 			=> '1',
				'linkedin' 			=> '1',
				'twitterfollow' 			=> '1',
				'twittertweet' 			=> '1',
				'tabs2' 			=> '1',
				'h1title' 			=> '1',
				'h2title' 			=> '1',
				'h3title' 			=> '1',
				'h4title' 			=> '1',
				'h5title' 			=> '1',
				'h6title' 			=> '1',
				'accordion1' 			=> '1',
				'accordion2' 			=> '1',
				'slider_image' 			=> '1',
				'carousel_portfolio' 			=> '1',
				'carousel_clients' 			=> '1',
				'carousel_testimonial' 			=> '1',
				'carousel_team' 			=> '1',
				'slider_blog' 			=> '1',
				'slider_portfolio' 			=> '1',
				'item_portfolio' 			=> '1',
				'item_team' 			=> '1',
				'item_client' 			=> '1',
				'font_full1' 			=> '2',
				'progress_round' 			=> '1',
				'services1' 			=> '2',
				'services2' 			=> '2',
				'item_testimonial' 			=> '1',
				'button2' 			=> '2',
				'button3' 			=> '2',
				'button4' 			=> '2',
				'list_font_adv' 			=> '1',
				'blockquote1' 			=> '2',
				'blockquote2' 			=> '2',
				'tabs1' 			=> '1',
				'calltoaction' 			=> '1',
				'pricing2' 			=> '1',
				'grid_portfolio' 			=> '1',
				'grid_image' 			=> '1',
				'counter_number' 			=> '1',
				'table1' 			=> '1',
				'table2' 			=> '1',
			)
		));

	}

	/**
	 * Return an instance of this class.
	 *
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide  ) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_activate();
				}
				restore_current_blog();
			} else {
				self::single_activate();
			}
		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_deactivate();
				}
				restore_current_blog();
			} else {
				self::single_deactivate();
			}
		} else {
			self::single_deactivate();
		}
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 *
	 * @param	int	$blog_id ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {
		if ( 1 !== did_action( 'wpmu_new_blog' ) )
			return;

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();
	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 *
	 * @return	array|false	The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {
		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";
		return $wpdb->get_col( $sql );
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 */
	private static function single_activate() {
		// TODO: Define activation functionality here if needed
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 */
	private static function single_deactivate() {
		// TODO: Define deactivation functionality here needed
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 */
	public function load_plugin_textdomain() {
		// TODO: Add translations as need in /languages
		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 *
	 * @return    null
	 */
	public function enqueue_admin_stylescripts() {

		$screen = get_current_screen();

		
		if($screen->base == 'post'){
			wp_enqueue_script( $this->plugin_slug . '-shortcode-modal-script', self::get_url( 'assets/js/shortcode-modal.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-panel-script', self::get_url( 'assets/js/panel.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			wp_enqueue_style( $this->plugin_slug . '-panel-styles', self::get_url( 'assets/css/panel.css', __FILE__ ), array(), self::VERSION );
			wp_enqueue_style( $this->plugin_slug . '-onoff-styles-toggles-css', self::get_url( 'assets/css/toggles.css', __FILE__ ), array(), self::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-onoff-script-toggles-min-js', self::get_url( 'assets/js/toggles.min.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			wp_enqueue_style( $this->plugin_slug . '-colorpicker-styles-minicolors-css', self::get_url( 'assets/css/minicolors.css', __FILE__ ), array(), self::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-colorpicker-script-minicolors-js', self::get_url( 'assets/js/minicolors.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			wp_enqueue_style( $this->plugin_slug . '-slider-styles-simple-slider-css', self::get_url( 'assets/css/simple-slider.css', __FILE__ ), array(), self::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-slider-script-simple-slider-min-js', self::get_url( 'assets/js/simple-slider.min.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-image-script-image-modal-js', self::get_url( 'assets/js/image-modal.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		}
		

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		if ( in_array( $screen->id, $this->plugin_screen_hook_suffix ) ) {
			$slug = array_search( $screen->id, $this->plugin_screen_hook_suffix );
			//$configfiles = glob( self::get_path( __FILE__ ) .'configs/'.$slug.'-*.php' );
			if(file_exists(self::get_path( __FILE__ ) .'configs/fieldgroups-'.$slug.'.php')){
				include self::get_path( __FILE__ ) .'configs/fieldgroups-'.$slug.'.php';
			}else{
				return;
			}

			if( !empty( $configfiles ) ) {
				// Always good to have.
				wp_enqueue_media();
				wp_enqueue_script('media-upload');

				foreach ($configfiles as $key=>$fieldfile) {
					include $fieldfile;
					if(!empty($group['scripts'])){
						foreach($group['scripts'] as $script){
							if( is_array( $script ) ){
								foreach($script as $remote=>$location){
									$infoot = false;
									if($location == 'footer'){
										$infoot = true;
									}
									if( false !== strpos($remote, '.')){
										wp_enqueue_script( $this->plugin_slug . '-' . strtok(basename($remote), '.'), $remote , array('jquery'), false, $infoot );
									}else{
										wp_enqueue_script( $remote, false , array(), false, $infoot );
									}
								}
							}else{
								if( false !== strpos($script, '.')){
									wp_enqueue_script( $this->plugin_slug . '-' . strtok($script, '.'), self::get_url( 'assets/js/'.$script , __FILE__ ) , array('jquery'), false, true );					
								}else{
									wp_enqueue_script( $script );
								}
							}
						}
					}
					if(!empty($group['styles'])){
						foreach($group['styles'] as $style){
							if( is_array( $style ) ){
								foreach($style as $remote){
									wp_enqueue_style( $this->plugin_slug . '-' . strtok(basename($remote), '.'), $remote );
								}
							}else{
								wp_enqueue_style( $this->plugin_slug . '-' . strtok($style, '.'), self::get_url( 'assets/css/'.$style , __FILE__ ) );
							}
						}
					}
				}
			}	
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', self::get_url( 'assets/css/panel.css', __FILE__ ), array(), self::VERSION );
			wp_enqueue_script( $this->plugin_slug .'-admin-scripts', self::get_url( 'assets/js/panel.js', __FILE__ ), array(), self::VERSION );
		}

	}

	
	
	
	/**
	 * Process a field value
	 *
	 */
	public function process_value($type, $value){

		switch ($type){
			default:
				return $value;
				break;
			case "image":
				$attachment = explode(',',$value);
				if(floatval($attachment[0]) > 0){
					$image = wp_get_attachment_image_src($attachment[0], $attachment[1]);
					$value = $image[0];
				}
			break;
			
		}

		return $value;	

	}

	
	/**
	 * Register metaboxes.
	 *
	 *
	 * @return    null
	 */
	public function activate_metaboxes() {
		add_action('add_meta_boxes', array($this, 'add_metaboxes'), 5, 4);
		add_action('save_post', array($this, 'save_post_metaboxes'), 1, 2);

	}

	

	/**
	 * setup meta boxes.
	 *
	 *
	 * @return    null
	 */
	function add_metaboxes( $slug, $post = false ){
		// Always good to have.
		wp_enqueue_media();
		wp_enqueue_script('media-upload');
		
		if(!empty($post)){
			if(!in_array($post->post_type, array('post','page','product','client','portfolio','team','testimonial'))){return;}
		}else{
				$screen = get_current_screen();
				if(!in_array($screen->base, array('post','page','product','client','portfolio','team','testimonial'))){return;}
			}

		wp_enqueue_style( $this->plugin_slug . '-panel-styles', self::get_url( 'assets/css/panel.css', __FILE__ ), array(), self::VERSION );
		wp_enqueue_script( $this->plugin_slug . '-panel-script', self::get_url( 'assets/js/panel.js', __FILE__ ), array( 'jquery' ), self::VERSION );

		
		wp_enqueue_script( $this->plugin_slug . '-image-script-image-modal-js', self::get_url( 'assets/js/image-modal.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		wp_enqueue_style( $this->plugin_slug . '-slider-styles-simple-slider-css', self::get_url( 'assets/css/simple-slider.css', __FILE__ ), array(), self::VERSION );
		wp_enqueue_script( $this->plugin_slug . '-slider-script-simple-slider-min-js', self::get_url( 'assets/js/simple-slider.min.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		wp_enqueue_style( $this->plugin_slug . '-onoff-styles-toggles-css', self::get_url( 'assets/css/toggles.css', __FILE__ ), array(), self::VERSION );
		wp_enqueue_script( $this->plugin_slug . '-onoff-script-toggles-min-js', self::get_url( 'assets/js/toggles.min.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		add_meta_box('_thinkup_meta_sliderimages', 'ThinkUpSlider', array($this, 'render_metaboxes'), 'post', 'normal', 'core', array( 'slug' => '_thinkup_meta_sliderimages', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_sliderimages', 'ThinkUpSlider', array($this, 'render_metaboxes'), 'page', 'normal', 'core', array( 'slug' => '_thinkup_meta_sliderimages', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_sliderimages', 'ThinkUpSlider', array($this, 'render_metaboxes'), 'client', 'normal', 'core', array( 'slug' => '_thinkup_meta_sliderimages', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_sliderimages', 'ThinkUpSlider', array($this, 'render_metaboxes'), 'portfolio', 'normal', 'core', array( 'slug' => '_thinkup_meta_sliderimages', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_sliderimages', 'ThinkUpSlider', array($this, 'render_metaboxes'), 'team', 'normal', 'core', array( 'slug' => '_thinkup_meta_sliderimages', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_sliderimages', 'ThinkUpSlider', array($this, 'render_metaboxes'), 'testimonial', 'normal', 'core', array( 'slug' => '_thinkup_meta_sliderimages', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_featuredgallery', 'Featured Gallery', array($this, 'render_metaboxes'), 'post', 'side', 'low', array( 'slug' => '_thinkup_meta_featuredgallery', 'groups' => array('Slides','Height') ) );
		add_meta_box('_thinkup_meta_pagetemplates', 'Page Attributes', array($this, 'render_metaboxes'), 'portfolio', 'side', 'core', array( 'slug' => '_thinkup_meta_pagetemplates', 'groups' => array('Page-Attributes') ) );
		//{{shortcode}}
		//thinkupshortcodes
		//thinkupshortcodes
	}




	/**
	 * render attribute based meta boxes.
	 *
	 *
	 * @return    null
	 */
	function render_metaboxes($post, $args){
		// include the metabox view
		echo '<input type="hidden" name="thinkupshortcodes_metabox" id="thinkupshortcodes_metabox" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
		echo '<input type="hidden" name="thinkupshortcodes_metabox_prefix[]" value="'.$args['args']['slug'].'" />';

		// setup tabbing if any
		$current_tab = 0;
		$panelsetsize = 'full';
		foreach($args['args']['groups'] as $group){
			include self::get_path( __FILE__ ) . 'configs/' . $args['args']['slug'] . '-' . strtolower( $group ) . '.php';
			$group['id'] = uniqid('thinkupshortcodes');
			$groups[] = $group;
		}
		// no groups so exit
		if(empty($groups)){
			return;
		}

		if(!empty($post)){
			$instance = get_post_meta($post->ID, $args['args']['slug'], true);
		}else{
			$instance = get_option($args['args']['slug']);
		}

		
				
		if( count( $groups ) > 1){
			if(!empty($post)){
				$current_tab = get_post_meta($post->ID, 'thinkupshortcodes__cur_tab__', true);
			}else{
				$current_tab = get_option('thinkupshortcodes__cur_tab__');
			}

			if(empty($current_tab)){
				$current_tab = 0;
			}
			echo "<input type=\"hidden\" name=\"thinkupshortcodes[__cur_tab__]\" id=\"thinkupshortcodes__cur_tab__\" value=\"".(!empty($current_tab) ? $current_tab : 0)."\">";
			echo "<div class=\"thinkupshortcodes-metabox-config-nav\">\r\n";
			echo "	<ul>\r\n";
			foreach ($groups as $key=>$group) {
					echo "		<li class=\"" . ( !empty($current_tab) ? ($$current_tab == $key ? "current" : "") : ($key === 0 ? "current" : "" )) . "\">\r\n";
					echo "			<a data-tabkey=\"".$key."\" data-tabset=\"thinkupshortcodes__cur_tab__\" title=\"".$group['label']."\" href=\"#".$group['id']."\"><strong>".$group['label']."</strong></a>\r\n";
					echo "		</li>\r\n";
			}
			echo "	</ul>\r\n";
			echo "</div>\r\n";
			$panelsetsize = null;
		}
		// build instance
		foreach ($groups as $key=>$group) {
			echo "<div class=\"thinkupshortcodes-metabox-config-content " . $panelsetsize . " group\" id=\"".$group['id']."\" ". ( $current_tab == $key ? '' : 'style="display:none;"' ) .">\r\n";

			if(count($groups) > 1 || empty($panelsetsize)){
				echo "<h3 class=\"metaheader\">".$group['label']."</h3>";
			}			
			
			$depth = 1;
			if(!empty($group['multiple'])){
				foreach($group['fields'] as $field=>$settings){
					if(isset($instance[$field])){
						if(count($instance[$field]) > $depth){
							$depth = count($instance[$field]);
						}
					}
				}
			}
			for( $i=0; $i<$depth;$i++ ){
				
				if($i > 0){
					echo '  <div class="button button-primary right thinkupshortcodes-removeRow" style="margin-top:5px;">'.__('Remove', 'thinkupshortcodes').'</div>';
				}

				echo "<table class=\"form-table rowGroup groupitems\" ref=\"items\" >\r\n";
				echo "	<tbody>\r\n";
					foreach($group['fields'] as $field=>$settings){
						//dump($settings);
						$id = 'field_'.$field;
						$groupid = $args['id'];
						$name = $args['args']['slug'].'['.$field.']';
						$single = true;
						$value = $settings['default'];
						if(!empty($group['multiple'])){
							$name = $args['args']['slug'].'['.$field.']['.$i.']';
							if(isset($instance[$field][$i])){
								$value = $instance[$field][$i];
							}
						}else{
							if(isset($instance[$field])){
								$value = $instance[$field];
							}
						}
						$label = $settings['label'];
						$caption = $settings['caption'];
						echo "<tr valign=\"top\">\r\n";
							echo "<th scope=\"row\">\r\n";
								echo "<label for=\"".$id."\">".$label."</label>\r\n";
							echo "</th>\r\n";
							echo "<td>\r\n";					
								include self::get_path( __FILE__ ) . 'includes/field-'.$settings['type'].'.php';
								if(!empty($caption)){
									echo '<p class="description">'.$caption.'</p>';
								}
							echo "</td>\r\n";
						echo "</tr>\r\n";

					}
				echo "	</tbody>\r\n";
				echo "</table>\r\n";
			}
			if(!empty($group['multiple'])){
				echo "<div class=\"toolrow\"><button class=\"button thinkupshortcodes-add-group-row\" type=\"button\" data-rowtemplate=\"group-".$args['id']."-tmpl\">".__('Add Another', 'thinkupshortcodes')."</button></div>\r\n";
			}
			echo "</div>\r\n";
			// Place html template for repeated fields.
			if(!empty($group['multiple'])){
				echo "<script type=\"text/html\" id=\"group-".$args['id']."-tmpl\">\r\n";
				echo '  <div class="button button-primary right thinkupshortcodes-removeRow" style="margin-top:5px;">'.__('Remove', 'thinkupshortcodes').'</div>';
				echo "	<table class=\"form-table rowGroup groupitems\" id=\"groupitems\" ref=\"items\">\r\n";
				echo "		<tbody>\r\n";
					foreach($group['fields'] as $field=>$settings){
						//dump($settings);
						$id = 'field_{{id}}';
						$groupid = $args['id'];
						$name = $args['args']['slug'].'['.$field.']';
						$single = true;
						if(!empty($group['multiple'])){
							$name = $args['args']['slug'].'['.$field.'][__count__]';
						}
						$label = $settings['label'];
						$caption = $settings['caption'];
						$value = $settings['default'];
						echo "<tr valign=\"top\">\r\n";
							echo "<th scope=\"row\">\r\n";
								echo "<label for=\"".$id."\">".$label."</label>\r\n";
							echo "</th>\r\n";
							echo "<td>\r\n";
								include self::get_path( __FILE__ ) . 'includes/field-'.$settings['type'].'.php';
								if(!empty($caption)){
									echo '<p class="description">'.$caption.'</p>';
								}

							echo "</td>\r\n";
						echo "</tr>\r\n";

					}
				echo "		</tbody>\r\n";
				echo "	</table>\r\n";	
				echo "</script>";
			}
		}
	}
	
	/**
	 * Insert shortcode media button
	 *
	 *
	 */
	function shortcode_insert_button(){
		global $post;
		if(!empty($post)){
			echo "<a id=\"thinkupshortcodes-shortcodeinsert\" title=\"".__('ThinkUpShortcodes Shortcode Builder','thinkupshortcodes')."\" style=\"padding-left: 0.4em;\" class=\"button thinkupshortcodes-editor-button\" href=\"#inst\">\n";
			echo "	<img src=\"". self::get_url( __FILE__ ) . "assets/images/icon.png\" alt=\"".__("Insert Shortcode","thinkupshortcodes")."\" style=\"padding:0 2px 1px;\" /> ".__('ThinkUpShortcodes', 'thinkupshortcodes')."\n";
			echo "</a>\n";
		}
	}

	/**
	 * render shortcode config panel.
	 *
	 *
	 * @return    null
	 */
	function render_shortcode_panel($shortcode, $type = 1, $template = false){


		if(!empty($template)){
			echo "<script type=\"text/html\" id=\"thinkupshortcodes-".$shortcode."-config-tmpl\">\r\n";
		}
		echo "<input id=\"thinkupshortcodes-shortcodekey\" class=\"configexclude\" type=\"hidden\" value=\"".$shortcode."\">\r\n";
		echo "<input id=\"thinkupshortcodes-shortcodetype\" class=\"configexclude\" type=\"hidden\" value=\"".$type."\">\r\n";
		echo "<input id=\"thinkupshortcodes-default-content\" class=\"configexclude\" type=\"hidden\" value=\" ".__('Your content goes here','thinkupshortcodes')." \">\r\n";

		if(!empty($this->elements['posttypes'][$shortcode])){
			$posts = get_posts(array('post_type' => $shortcode));

			if(empty($posts)){
				echo 'No items available';
			}else{
				foreach($posts as $post){
					echo '<div class="posttype-item"><label><input type="radio" value="'.$post->ID.'" name="id"> '.$post->post_title.'</label></div>';
				}
			}
			if(!empty($template)){
				echo "</script>\r\n";
			}
			return;
		}
	
		if(file_exists(self::get_path( __FILE__ ) .'configs/fieldgroups-'.$shortcode.'.php')){
			include self::get_path( __FILE__ ) .'configs/fieldgroups-'.$shortcode.'.php';		
		}else{
			if(!empty($template)){
				echo "</script>\r\n";
			}
			return;
		}

		$groups = array();
		echo "<div class=\"thinkupshortcodes-shortcode-config-nav\">\r\n";
		echo "	<ul>\r\n";
		foreach ($configfiles as $key=>$fieldfile) {
			include $fieldfile;
			$groups[] = $group;
				echo "		<li class=\"" . ( $key === 0 ? "current" : "" ) . "\">\r\n";
				echo "			<a title=\"".$group['label']."\" href=\"#row".$group['master']."\"><strong>".$group['label']."</strong></a>\r\n";
				echo "		</li>\r\n";
		}
		echo "	</ul>\r\n";
		echo "</div>\r\n";

		echo "<div class=\"thinkupshortcodes-shortcode-config-content " . ( count($configfiles) > 1 ? "" : "full" ) . "\">\r\n";
			foreach($groups as $key=>$group){
				echo "<div class=\"group\" " . ( $key === 0 ? "" : "style=\"display:none;\"" ) . " id=\"row".$group['master']."\">\r\n";
				echo "<h3 class=\"thinkupshortcodes-config-header\">".$group['label']."</h3>\r\n";
				echo "<table class=\"form-table rowGroup groupitems\" id=\"groupitems\" ref=\"items\">\r\n";
				echo "	<tbody>\r\n";
					foreach($group['fields'] as $field=>$settings){
						//dump($settings);
						$id = 'field_'.$field;
						$groupid = $group['id'];
						$name = $field;
						$single = true;
						if(!empty($group['multiple'])){
							$name = $field.'[]';
						}
						$label = $settings['label'];
						$caption = $settings['caption'];
						$value = $settings['default'];
						echo "<tr valign=\"top\">\r\n";
							echo "<th scope=\"row\">\r\n";
								echo "<label for=\"".$id."\">".$label."</label>\r\n";
							echo "</th>\r\n";
							echo "<td>\r\n";
							include self::get_path( __FILE__ ) . 'includes/field-'.$settings['type'].'.php';
							if(!empty($caption)){
								echo "<p class=\"description\">".$caption."</p>\r\n";
							}
							echo "</td>\r\n";
						echo "</tr>\r\n";
					}
				echo "	</tbody>\r\n";
				echo "</table>\r\n";

				if(!empty($group['multiple'])){
					echo "<div class=\"toolrow\"><button class=\"button thinkupshortcodes-add-group-row\" type=\"button\" data-rowtemplate=\"group-".$group['id']."-tmpl\">".__('Add Another','thinkupshortcodes')."</button></div>\r\n";
				}
				echo "</div>\r\n";
			}
		echo "</div>\r\n";

		if(!empty($template)){
			echo "</script>\r\n";
		}
		// go get the loop templates
		foreach($groups as $group){
			// Place html template for repeated fields.
			if(!empty($group['multiple'])){
				echo "<script type=\"text/html\" id=\"group-".$group['id']."-tmpl\">\r\n";
				echo '  <div class="button button-primary right thinkupshortcodes-removeRow" style="margin:5px 5px 0;">'.__('Remove','thinkupshortcodes').'</div>';
				echo "	<table class=\"form-table rowGroup groupitems\" id=\"groupitems\" ref=\"items\">\r\n";
				echo "		<tbody>\r\n";
					foreach($group['fields'] as $field=>$settings){
						//dump($settings);
						$id = 'field_{{id}}';
						$groupid = $group['id'];
						$name = $field.'[__count__]';
						$single = true;
						$label = $settings['label'];
						$caption = $settings['caption'];
						$value = $settings['default'];
						echo "<tr valign=\"top\">\r\n";
							echo "<th scope=\"row\">\r\n";
								echo "<label for=\"".$id."\">".$label."</label>\r\n";
							echo "</th>\r\n";
							echo "<td>\r\n";
							include self::get_path( __FILE__ ) . 'includes/field-'.$settings['type'].'.php';
							if(!empty($caption)){
								echo "<p class=\"description\">".$caption."</p>\r\n";
							}
							echo "</td>\r\n";
						echo "</tr>\r\n";

					}
				echo "		</tbody>\r\n";
				echo "	</table>\r\n";
				echo "</script>";
			}
		}
	}

	/**
	 * Insert shortcode modal template
	 *
	 *
	 */
	function shortcode_modal_template(){
		$screen = get_current_screen();

		if($screen->base != 'post'){return;}

		echo "<script type=\"text/html\" id=\"thinkupshortcodes-shortcode-panel-tmpl\">\r\n";
		echo "	<div tabindex=\"0\" id=\"thinkupshortcodes-shortcode-panel\" class=\"hidden\">\r\n";
		echo "		<div class=\"media-modal-backdrop\"></div>\r\n";
		echo "		<div class=\"thinkupshortcodes-modal-modal\">\r\n";
		echo "			<div class=\"thinkupshortcodes-modal-content\">\r\n";
		echo "				<div class=\"thinkupshortcodes-modal-header\">\r\n";
		echo "					<a title=\"Close\" href=\"#\" class=\"media-modal-close\">\r\n";
		echo "						<span class=\"media-modal-icon\"></span>\r\n";
		echo "					</a>\r\n";
		echo "					<h2 style=\"background: url(".self::get_url( '/assets/images/icon.png', __FILE__ ) . ") no-repeat scroll 0px 2px transparent; padding-left: 20px;\">".__('ThinkUpShortcodes','thinkupshortcodes')." <small>".__("Shortcode Builder","thinkupshortcodes")."</small></h2>\r\n";
		echo "				</div>\r\n";
		echo "				<div class=\"thinkupshortcodes-modal-body\">\r\n";
		echo "					<span id=\"thinkupshortcodes-categories\">\r\n";
		echo "						Category: <span id=\"thinkupshortcodes-categories\"><select id=\"thinkupshortcodes-category-selector\"><option value=\"\"></option><option value=\"animation\">animation</option><option value=\"buttons\">buttons</option><option value=\"carousel\">carousel</option><option value=\"columns\">columns</option><option value=\"dividers\">dividers</option><option value=\"iconscolored\">icons (colored)</option><option value=\"iconsfontawesome\">icons (font awesome)</option><option value=\"lightbox\">lightbox</option><option value=\"lists\">lists</option><option value=\"notificationboxes\">notification boxes</option><option value=\"pricingtable\">pricing table</option><option value=\"progressbars\">progress bars</option><option value=\"socialmedia\">social media</option><option value=\"tabs\">tabs</option><option value=\"titles\">titles</option><option value=\"toggles\">toggles</option><option value=\"slideshow\">slideshow</option><option value=\"metaoptions\">meta options</option><option value=\"custompostitem\">custom post item</option><option value=\"services\">services</option><option value=\"pagebuildermodules\">page builder modules</option><option value=\"quotes\">quotes</option><option value=\"calltoaction\">call to action</option><option value=\"grid\">grid</option><option value=\"counter\">counter</option><option value=\"table\">table</option></select></span>&nbsp;Shortcode: <span id=\"thinkupshortcodes-elements\"><span class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector\">Select Category</span></span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-animation\">				<option value=\"\"></option><option value=\"animate\">".__('Animation','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-buttons\">				<option value=\"\"></option><option value=\"button1\">".__('Style 1','thinkupshortcodes')."</option>
<option value=\"button2\">".__('Style 2','thinkupshortcodes')."</option>
<option value=\"button3\">".__('Style 3','thinkupshortcodes')."</option>
<option value=\"button4\">".__('Style 4','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-carousel\">				<option value=\"\"></option><option value=\"carousel_blog\">".__('Blog','thinkupshortcodes')."</option>
<option value=\"carousel_portfolio\">".__('Portfolio','thinkupshortcodes')."</option>
<option value=\"carousel_clients\">".__('Clients','thinkupshortcodes')."</option>
<option value=\"carousel_testimonial\">".__('Testimonials','thinkupshortcodes')."</option>
<option value=\"carousel_team\">".__('Team','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-columns\">				<option value=\"\"></option><option value=\"five_sixth_last\">".__('6 Column - 5/6 last','thinkupshortcodes')."</option>
<option value=\"one_sixth_last\">".__('6 Column - 1/6 last','thinkupshortcodes')."</option>
<option value=\"one_sixth\">".__('6 Column - 1/6','thinkupshortcodes')."</option>
<option value=\"four_fifth_last\">".__('5 Column - 4/5 last','thinkupshortcodes')."</option>
<option value=\"four_fifth\">".__('5 Column - 4/5','thinkupshortcodes')."</option>
<option value=\"three_fifth_last\">".__('5 Column - 3/5 last','thinkupshortcodes')."</option>
<option value=\"three_fifth\">".__('5 Column - 3/5','thinkupshortcodes')."</option>
<option value=\"two_fifth_last\">".__('5 Column - 2/5 last','thinkupshortcodes')."</option>
<option value=\"two_fifth\">".__('5 Column - 2/5','thinkupshortcodes')."</option>
<option value=\"one_fifth_last\">".__('5 Column - 1/5 last','thinkupshortcodes')."</option>
<option value=\"two_third\">".__('3 Column - 2/3','thinkupshortcodes')."</option>
<option value=\"one_third_last\">".__('3 Column - 1/3 last','thinkupshortcodes')."</option>
<option value=\"one_third\">".__('3 Column - 1/3','thinkupshortcodes')."</option>
<option value=\"one_half_last\">".__('2 Column - 1/2 last','thinkupshortcodes')."</option>
<option value=\"one_half\">".__('2 Column - 1/2','thinkupshortcodes')."</option>
<option value=\"one_fifth\">".__('5 Column - 1/5','thinkupshortcodes')."</option>
<option value=\"three_fourth_last\">".__('4 Column - 3/4 last','thinkupshortcodes')."</option>
<option value=\"three_fourth\">".__('4 Column - 3/4','thinkupshortcodes')."</option>
<option value=\"one_fourth_last\">".__('4 Column - 1/4 last','thinkupshortcodes')."</option>
<option value=\"one_fourth\">".__('4 Column - 1/4','thinkupshortcodes')."</option>
<option value=\"two_third_last\">".__('3 Column - 2/3 last','thinkupshortcodes')."</option>
<option value=\"five_sixth\">".__('6 Column - 5/6','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-dividers\">				<option value=\"\"></option><option value=\"margin\">".__('Margin','thinkupshortcodes')."</option>
<option value=\"divider\">".__('Line Divider','thinkupshortcodes')."</option>
<option value=\"divider_top\">".__('Line Divider (Top)','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-iconscolored\">				<option value=\"\"></option><option value=\"icon\">".__('Icon','thinkupshortcodes')."</option>
<option value=\"icon_full\">".__('Icon (title & text)','thinkupshortcodes')."</option>
<option value=\"icon_text\">".__('Icon (text)','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-iconsfontawesome\">				<option value=\"\"></option><option value=\"font\">".__('Icon','thinkupshortcodes')."</option>
<option value=\"font_text\">".__('Icon (text)','thinkupshortcodes')."</option>
<option value=\"font_full2\">".__('Icon (title & text) - Style 2','thinkupshortcodes')."</option>
<option value=\"font_full1\">".__('Icon (title & text) - Style 1','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-lightbox\">				<option value=\"\"></option><option value=\"image\">".__('Image','thinkupshortcodes')."</option>
<option value=\"youtube\">".__('Youtube','thinkupshortcodes')."</option>
<option value=\"vimeo\">".__('Vimeo','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-lists\">				<option value=\"\"></option><option value=\"list_font\">".__('Custom list (Font Awesome)','thinkupshortcodes')."</option>
<option value=\"list_font_adv\">".__('Advanced list (Font Awesome)','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-notificationboxes\">				<option value=\"\"></option><option value=\"notification\">".__('Notification','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-pricingtable\">				<option value=\"\"></option><option value=\"pricing1\">".__('Style 1','thinkupshortcodes')."</option>
<option value=\"pricing2\">".__('Style 2','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-progressbars\">				<option value=\"\"></option><option value=\"progress1\">".__('Basic','thinkupshortcodes')."</option>
<option value=\"progress2\">".__('Striped','thinkupshortcodes')."</option>
<option value=\"progress3\">".__('Animated','thinkupshortcodes')."</option>
<option value=\"progress_round\">".__('Round','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-socialmedia\">				<option value=\"\"></option><option value=\"facebook\">".__('Facebook (Like)','thinkupshortcodes')."</option>
<option value=\"google\">".__('Google+','thinkupshortcodes')."</option>
<option value=\"linkedin\">".__('LinkedIn','thinkupshortcodes')."</option>
<option value=\"twitterfollow\">".__('Twitter (follow)','thinkupshortcodes')."</option>
<option value=\"twittertweet\">".__('Twitter (tweet)','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-tabs\">				<option value=\"\"></option><option value=\"tabs2\">".__('Style 2','thinkupshortcodes')."</option>
<option value=\"tabs1\">".__('Style 1','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-titles\">				<option value=\"\"></option><option value=\"h1title\">".__('h1 Title','thinkupshortcodes')."</option>
<option value=\"h2title\">".__('h2 Title','thinkupshortcodes')."</option>
<option value=\"h3title\">".__('h3 Title','thinkupshortcodes')."</option>
<option value=\"h4title\">".__('h4 Title','thinkupshortcodes')."</option>
<option value=\"h5title\">".__('h5 Title','thinkupshortcodes')."</option>
<option value=\"h6title\">".__('h6 Title','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-toggles\">				<option value=\"\"></option><option value=\"accordion1\">".__('Accordion 1','thinkupshortcodes')."</option>
<option value=\"accordion2\">".__('Accordion 2','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-slideshow\">				<option value=\"\"></option><option value=\"slider_image\">".__('Image Slider','thinkupshortcodes')."</option>
<option value=\"slider_blog\">".__('Blog Slider','thinkupshortcodes')."</option>
<option value=\"slider_portfolio\">".__('Portfolio Slider','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-metaoptions\">				<option value=\"\"></option></select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-custompostitem\">				<option value=\"\"></option><option value=\"item_portfolio\">".__('Portfolio Item','thinkupshortcodes')."</option>
<option value=\"item_team\">".__('Team Item','thinkupshortcodes')."</option>
<option value=\"item_client\">".__('Client Item','thinkupshortcodes')."</option>
<option value=\"item_testimonial\">".__('Testimonial Item','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-services\">				<option value=\"\"></option><option value=\"services1\">".__('Style 1','thinkupshortcodes')."</option>
<option value=\"services2\">".__('Style 2','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-pagebuildermodules\">				<option value=\"\"></option></select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-quotes\">				<option value=\"\"></option><option value=\"blockquote1\">".__('Blockquote (Style 1)','thinkupshortcodes')."</option>
<option value=\"blockquote2\">".__('Blockquote (Style 2)','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-calltoaction\">				<option value=\"\"></option><option value=\"calltoaction\">".__('Call To Action','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-grid\">				<option value=\"\"></option><option value=\"grid_portfolio\">".__('Portfolio','thinkupshortcodes')."</option>
<option value=\"grid_image\">".__('Image','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-counter\">				<option value=\"\"></option><option value=\"counter_number\">".__('Number','thinkupshortcodes')."</option>
</select>
</span>
 <select style=\"display:none;\" class=\"thinkupshortcodes-elements-selector\" id=\"thinkupshortcodes-elements-selector-table\">				<option value=\"\"></option><option value=\"table1\">".__('Style 1','thinkupshortcodes')."</option>
<option value=\"table2\">".__('Style 2','thinkupshortcodes')."</option>
</select>
</span>
\r\n";
		echo "					</span>\r\n";
		echo "					<div id=\"thinkupshortcodes-shortcode-config\" class=\"thinkupshortcodes-shortcode-config\">\r\n";
		echo "					</div>\r\n";
		echo "				</div>\r\n";
		echo "				<div class=\"thinkupshortcodes-modal-footer\">\r\n";
		echo "					<button class=\"button button-primary button-large\" id=\"thinkupshortcodes-insert-shortcode\">".__("Insert Shortcode","thinkupshortcodes")."</button>\r\n";
		echo "				</div>\r\n";
		echo "			</div>\r\n";
		echo "		</div>\r\n";
		echo "	</div>\r\n";
		echo "</script>\r\n";

		foreach($this->elements['shortcodes'] as $shortcode=>$type){
			$this->render_shortcode_panel($shortcode, $type, true);
		}
		
	}

	/**
	 * Gets a list of shorcodes used within the content provided
	 *
	 * @return 	array
	 */
	function get_regex(){

	// this makes it easier to cycle through and get the used codes for inclusion
	$validcodes = join( '|', array_map('preg_quote', array_keys($this->elements['shortcodes'])) );
	return
			  '\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($validcodes)"                    // 2: selected codes only
			. '\\b'                              // Word boundary
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			. ')'
			. '(?:'
			.     '(\\/)'                        // 4: Self closing tag ...
			.     '\\]'                          // ... and closing bracket
			. '|'
			.     '\\]'                          // Closing bracket
			.     '(?:'
			.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.         ')'
			.         '\\[\\/\\2\\]'             // Closing shortcode tag
			.     ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]

	}

	function get_used_shortcodes($content, $return = array(), $internal = true, $preview = false){

		$regex = self::get_regex();

		preg_match_all('/' . $regex . '/s', $content, $found);

		foreach($found[5] as $innerContent){
			if(!empty($innerContent)){
			   $new = self::get_used_shortcodes($innerContent, $found, $internal);
				if(!empty($new)){
					foreach($new as $key=>$val){
						$found[$key] = array_merge($found[$key], $val);
					}
				}
			}
		}

		return $found;
	}


	/**
	 * setup meta boxes.
	 *
	 *
	 * @return    null
	 */
	public function get_post_meta($id, $key = null, $single = false){
		
		if(!empty($key)){

			//$configfiles = glob(self::get_path( __FILE__ ) .'configs/*.php');
			if(file_exists(self::get_path( __FILE__ ) .'configs/fieldgroups-thinkupshortcodes.php')){
				include self::get_path( __FILE__ ) .'configs/fieldgroups-thinkupshortcodes.php';		
			}else{
				return;
			}

			$field_type = 'text';
			foreach( $configfiles as $config=>$file ){
				include $file;
				if(isset($group['fields'][$key]['type'])){
					$field_type = $group['fields'][$key]['type'];
					break;
				}
			}
			$key = 'thinkupshortcodes_' . $key;
		}
		if( false === $single){
			$metas = get_post_meta( $id, $key );
			foreach ($metas as $key => &$value) {
				$value = $this->process_value( $field_type, $value );
			}
			return $metas;
		}
		return $this->process_value( $field_type, get_post_meta( $id, $key, $single ) );

	}


	/**
	 * save metabox data
	 *
	 *
	 */
	function save_post_metaboxes($pid, $post){

		if(!isset($_POST['thinkupshortcodes_metabox']) || !isset($_POST['thinkupshortcodes_metabox_prefix'])){return;}


		if(!wp_verify_nonce($_POST['thinkupshortcodes_metabox'], plugin_basename(__FILE__))){
			return $post->ID;
		}
		if(!current_user_can( 'edit_post', $post->ID)){
			return $post->ID;
		}
		if($post->post_type == 'revision' ){return;}
		
		foreach( $_POST['thinkupshortcodes_metabox_prefix'] as $prefix ){
			if(!isset($_POST[$prefix])){continue;}

			
			delete_post_meta($post->ID, $prefix);
			add_post_meta($post->ID, $prefix, $_POST[$prefix]);
			//foreach($_POST['thinkupshortcodes'] as $field=>$data){
				
				//if(is_array($data)){
				//	foreach($data as $item){
				//		add_post_meta($post->ID, 'thinkupshortcodes_'.$field, $item);
				//	}
				//}else{
				
				//}
			//}
		}
	}	
	/**
	 * create and register an instance ID
	 *
	 */
	public function element_instance_id($id, $process){

		$this->element_instances[$id][$process][] = true;
		$count = count($this->element_instances[$id][$process]);
		if($count > 1){
			return $id.($count-1);
		}
		return $id;
	}

	/**
	 * Render the element
	 *
	 */
	public function render_element($atts, $content, $slug, $head = false) {
		
		$raw_atts = $atts;
		

		if(!empty($head)){
			$instanceID = $this->element_instance_id('thinkupshortcodes'.$slug, 'header');
		}else{
			$instanceID = $this->element_instance_id('thinkupshortcodes'.$slug, 'footer');
		}

		//$configfiles = glob(self::get_path( __FILE__ ) .'configs/'.$slug.'-*.php');
		if(file_exists(self::get_path( __FILE__ ) .'configs/fieldgroups-'.$slug.'.php')){
			include self::get_path( __FILE__ ) .'configs/fieldgroups-'.$slug.'.php';		
		
			$defaults = array();
			foreach($configfiles as $file){

				include $file;
				foreach($group['fields'] as $variable=>$conf){
					if(!empty($group['multiple'])){
						$value = array($this->process_value($conf['type'],$conf['default']));
					}else{
						$value = $this->process_value($conf['type'],$conf['default']);
					}
					if(!empty($group['multiple'])){
						if(isset($atts[$variable.'_1'])){
							$index = 1;
							$value=array();
							while(isset($atts[$variable.'_'.$index])){
								$value[] = $this->process_value($conf['type'],$atts[$variable.'_'.$index]);
								$index++;
							}
						}elseif (isset($atts[$variable])) {
							if(is_array($atts[$variable])){
								foreach($atts[$variable] as &$varval){
									$varval = $this->process_value($conf['type'],$varval);
								}
								$value = $atts[$variable];
							}else{
								$value[] = $this->process_value($conf['type'],$atts[$variable]);
							}
						}
					}else{
						if(isset($atts[$variable])){
							$value = $this->process_value($conf['type'],$atts[$variable]);
						}
					}
					
					if(!empty($group['multiple']) && !empty($value)){
						foreach($value as $key=>$val){
							//if(is_array($val)){
								$groups[$group['master']][$key][$variable] = $val;
							//}elseif(strlen($val) > 0){
							//	$groups[$group['master']][$key][$variable] = $val;
							//}
						}
					}
					$defaults[$variable] = $value;
					/*if(is_array($value)){
						foreach($value as $varkey=>&$varval){
							if(is_array($val)){
								if(!empty($val)){
									unset($value[$varkey]);
								}
							}elseif(strlen($varval) === 0){
								unset($value[$varkey]);
							}
						}
						if(!empty($value)){
							$defaults[$variable] = implode(', ', $value);
						}
					}else{
						if(strlen($value) > 0){
							$defaults[$variable] = $value;
						}
					}*/
				}
			}
			//dump($atts,0);
			//dump($defaults,0);
			$atts = $defaults;
		}
		// pull in the assets
		$assets = array();
		if(file_exists(self::get_path( __FILE__ ) . 'assets/assets-'.$slug.'.php')){
			include self::get_path( __FILE__ ) . 'assets/assets-'.$slug.'.php';
		}

		ob_start();
		if(file_exists(self::get_path( __FILE__ ) . 'includes/element-'.$slug.'.php')){
			include self::get_path( __FILE__ ) . 'includes/element-'.$slug.'.php';
		}else if( file_exists(self::get_path( __FILE__ ) . 'includes/element-'.$slug.'.html')){
			include self::get_path( __FILE__ ) . 'includes/element-'.$slug.'.html';
		}
		$out = ob_get_clean();


		if(!empty($head)){

			// process headers - CSS
			if(file_exists(self::get_path( __FILE__ ) . 'assets/css/styles-'.$slug.'.php')){
				ob_start();
				include self::get_path( __FILE__ ) . 'assets/css/styles-'.$slug.'.php';
				$this->element_header_styles[] = ob_get_clean();
				add_action('wp_head', array( $this, 'header_styles' ) );
			}else if( file_exists(self::get_path( __FILE__ ) . 'assets/css/styles-'.$slug.'.css')){
				wp_enqueue_style( $this->plugin_slug . '-'.$slug.'-styles', self::get_url( 'assets/css/styles-'.$slug.'.css', __FILE__ ), array(), self::VERSION );
			}
			// process headers - JS
			if(file_exists(self::get_path( __FILE__ ) . 'assets/js/scripts-'.$slug.'.php')){
				ob_start();
				include self::get_path( __FILE__ ) . 'assets/js/scripts-'.$slug.'.php';				
				$this->element_footer_scripts[] = ob_get_clean();
			}else if( file_exists(self::get_path( __FILE__ ) . 'assets/js/scripts-'.$slug.'.js')){
				wp_enqueue_script( $this->plugin_slug . '-'.$slug.'-script', self::get_url( 'assets/js/scripts-'.$slug.'.js', __FILE__ ), array( 'jquery' ), self::VERSION , true );
			}
			// get clean do shortcode for header checking
			ob_start();
			do_shortcode( $out );
			ob_get_clean();			
			return;
		}
		
		// CHECK FOR EMBEDED ELEMENTS
		/*foreach($elements as $subelement){
			if(empty($subelement['state']) || $subelement['shortcode'] == $element['_shortcode']){continue;}
			if(false !== strpos($out, '{{:'.$subelement['shortcode'].':}}')){
				$out = str_replace('{{:'.$subelement['shortcode'].':}}', caldera_doShortcode(array(), $out, $subelement['shortcode']), $out);
			}
		}*/


		/*if(!empty($element['_removelinebreaks'])){
			add_filter( 'the_content', 'wpautop' );
		}*/

		return do_shortcode($out);
	}

	/**
	 * Detect elements used on the page to allow us to enqueue needed styles and scripts
	 *
	 */
	public function detect_elements() {
		global $wp_query;

		
	
		// find used shortcodes within posts
		foreach ($wp_query->posts as $key => &$post) {
			$shortcodes = self::get_used_shortcodes($post->post_content);
			if(!empty($shortcodes[2])){
				foreach($shortcodes[2] as $foundkey=>$shortcode){
					$atts = array();
					if(!empty($shortcodes[3][$foundkey])){
						$atts = shortcode_parse_atts($shortcodes[3][$foundkey]);
					}
					wp_enqueue_script( 'google-plusonejs', '//apis.google.com/js/plusone.js', false , false, true );
					wp_enqueue_script( 'linkedin-injs', '//platform.linkedin.com/in.js', false , false, true );
					wp_enqueue_script( 'twitterfollow-widgetsjs', '//platform.twitter.com/widgets.js', false , false, true );
					wp_enqueue_script( 'twittertweet-widgetsjs', '//platform.twitter.com/widgets.js', false , false, true );
					
					// process header portion
					$this->render_element($atts, $post->post_content, $shortcode, true);
				}
			}
		}


	}

	/**
	 * Render any header styles
	 *
	 */
	public function header_styles() {
		if(!empty($this->element_header_styles)){
			echo "<style type=\"text/css\">\r\n";
			foreach($this->element_header_styles as $styles){
				echo $styles."\r\n";
			}			
			echo "</style>\r\n";
		}
	}
	
	/**
	 * Render any footer scripts
	 *
	 */
	public function footer_scripts() {

		if(!empty($this->element_footer_scripts)){
			echo "<script type=\"text/javascript\">\r\n";
				foreach($this->element_footer_scripts as $script){
					echo $script."\r\n";
				}
			echo "</script>\r\n";
		}
	}

	

	/***
	 * Get the current URL
	 *
	 */
	static function get_url($src = null, $path = null) {
		if(!empty($path)){			
			return get_template_directory_uri() . '/lib/shortcodes/' . $src;
		}		
		return get_template_directory_uri() . '/lib/shortcodes/';

	}

	/***
	 * Get the current URL
	 *
	 */
	static function get_path($src = null) {
		return dirname( $src ) . '/';

	}
	
	
}
