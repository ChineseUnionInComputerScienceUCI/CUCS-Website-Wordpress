<?php
/**
 * Add Title Page Builder Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Custom Post Item - Portfolio
---------------------------------------------------------------------------------- */

class thinkup_builder_itemportfoliotheme extends WP_Widget {

	/* Register widget description. */
	public function __construct() {
		$widget_ops = array('classname' => 'thinkup_builder_itemportfoliotheme', 'description' => 'Add a portfolio item to your content.' );
		parent::__construct('thinkup_builder_itemportfoliotheme', 'Portfolio (Item)', $widget_ops);
	}

	/* Add widget structure to Admin area. */
	function form($instance) {
		$default_entries = array( 
			'title'          => '', 
			'post_id'        => '', 
			'size'           => '', 
			'link_icon'      => '', 
			'lightbox_icon'  => '', 
			'toggle_title'   => '', 
			'toggle_details' => '',
			'content_style'  => '', 
			'animate'        => '',
			'delay'          => '',
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );

		// Create custom post pages array
		$args = array(
			'post_type'=>'portfolio',
		);
		$pages = get_pages( $args );

		// Create array for image sizes
		$image_sizes = get_intermediate_image_sizes();

		$title          = $instance['title'];
		$post_id        = $instance['post_id'];
		$size           = $instance['size'];
		$link_icon      = $instance['link_icon']; 
		$lightbox_icon  = $instance['lightbox_icon'];
		$toggle_title   = $instance['toggle_title'];
		$toggle_details = $instance['toggle_details'];
		$content_style  = $instance['content_style'];
		$animate        = $instance['animate'];
		$delay          = $instance['delay'];

		echo '<p><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 153px;">Module Title:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('post_id') . '" style="display: inline-block;width: 150px;" >Select Project:</label>
			<select name="' . $this->get_field_name('post_id') . '" id="' . $this->get_field_id('post_id') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			foreach ( $pages as $page ) {
			echo '<option '; ?><?php if( $post_id == $page->ID ) { echo "selected"; } ?><?php echo ' value="' . $page->ID . '">' . $page->post_title . '</option>';
			}
		echo '</select>',
		'</p>';

		echo '<p><label for="' . $this->get_field_id('size') . '" style="display: inline-block;width: 150px;" >Image Size:</label>
			<select name="' . $this->get_field_name('size') . '" id="' . $this->get_field_id('size') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			foreach ($image_sizes as $size_name ){
				echo '<option '; ?><?php if($size == $size_name) { echo "selected"; } ?><?php echo ' value="' . $size_name . '">' . $size_name . '</option>';
			}
		echo '</select>',
		'</p>';

		echo '<p><label for="' . $this->get_field_id('link_icon') . '" style="display: inline-block;width: 150px;">Hide Link Icon?</label>&nbsp;<input id="' . $this->get_field_id('link_icon') . '" name="' . $this->get_field_name('link_icon') . '" type="checkbox" '; ?><?php if($link_icon == "on") { echo 'checked=checked'; } ?><?php echo ' /></p>';
			
		echo '<p><label for="' . $this->get_field_id('lightbox_icon') . '" style="display: inline-block;width: 150px;">Hide Lightbox Icon?</label>&nbsp;<input id="' . $this->get_field_id('lightbox_icon') . '" name="' . $this->get_field_name('lightbox_icon') . '" type="checkbox" '; ?><?php if($lightbox_icon == "on") { echo 'checked=checked'; } ?><?php echo ' /></p>';

		echo '<p><label for="' . $this->get_field_id('toggle_title') . '" style="display: inline-block;width: 150px;" >Toggle Project Title:</label>
			<select name="' . $this->get_field_name('toggle_title') . '" id="' . $this->get_field_id('toggle_title') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($toggle_title == "off") { echo "selected"; } ?><?php echo ' value="off">off</option>
			<option '; ?><?php if($toggle_title == "on") { echo "selected"; } ?><?php echo ' value="on">on</option>
			</select>
		</p>';
			
		echo '<p><label for="' . $this->get_field_id('toggle_details') . '" style="display: inline-block;width: 150px;" >Toggle Project Description:</label>
			<select name="' . $this->get_field_name('toggle_details') . '" id="' . $this->get_field_id('toggle_details') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($toggle_details == "off") { echo "selected"; } ?><?php echo ' value="off">off</option>
			<option '; ?><?php if($toggle_details == "on") { echo "selected"; } ?><?php echo ' value="on">on</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('content_style') . '" style="display: inline-block;width: 150px;" >Content Style:</label>
			<select name="' . $this->get_field_name('content_style') . '" id="' . $this->get_field_id('content_style') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($content_style == "style1") { echo "selected"; } ?><?php echo ' value="style1">Style 1</option>
			<option '; ?><?php if($content_style == "style2") { echo "selected"; } ?><?php echo ' value="style2">Style 2</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('animate') . '" style="display: inline-block;width: 150px;">Animation:</label>
			<select name="' . $this->get_field_name('animate') . '" id="' . $this->get_field_id('animate') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($animate == "none") { echo "selected"; } ?><?php echo ' value="none">None</option>
			<option '; ?><?php if($animate == "bounceIn") { echo "selected"; } ?><?php echo ' value="bounceIn">bounceIn</option>
			<option '; ?><?php if($animate == "bounceInDown") { echo "selected"; } ?><?php echo ' value="bounceInDown">bounceInDown</option>
			<option '; ?><?php if($animate == "bounceInUp") { echo "selected"; } ?><?php echo ' value="bounceInUp">bounceInUp</option>
			<option '; ?><?php if($animate == "bounceInLeft") { echo "selected"; } ?><?php echo ' value="bounceInLeft">bounceInLeft</option>
			<option '; ?><?php if($animate == "bounceInRight") { echo "selected"; } ?><?php echo ' value="bounceInRight">bounceInRight</option>
			<option '; ?><?php if($animate == "bounceOut") { echo "selected"; } ?><?php echo ' value="bounceOut">bounceOut</option>
			<option '; ?><?php if($animate == "bounceOutDown") { echo "selected"; } ?><?php echo ' value="bounceOutDown">bounceOutDown</option>
			<option '; ?><?php if($animate == "bounceOutUp") { echo "selected"; } ?><?php echo ' value="bounceOutUp">bounceOutUp</option>
			<option '; ?><?php if($animate == "bounceOutLeft") { echo "selected"; } ?><?php echo ' value="bounceOutLeft">bounceOutLeft</option>
			<option '; ?><?php if($animate == "bounceOutRight") { echo "selected"; } ?><?php echo ' value="bounceOutRight">bounceOutRight</option>
			<option '; ?><?php if($animate == "flipInX") { echo "selected"; } ?><?php echo ' value="flipInX">flipInX</option>
			<option '; ?><?php if($animate == "flipOutX") { echo "selected"; } ?><?php echo ' value="flipOutX">flipOutX</option>
			<option '; ?><?php if($animate == "flipInY") { echo "selected"; } ?><?php echo ' value="flipInY">flipInY</option>
			<option '; ?><?php if($animate == "flipOutY") { echo "selected"; } ?><?php echo ' value="flipOutY">flipOutY</option>
			<option '; ?><?php if($animate == "fadeIn") { echo "selected"; } ?><?php echo ' value="fadeIn">fadeIn</option>
			<option '; ?><?php if($animate == "fadeInUp") { echo "selected"; } ?><?php echo ' value="fadeInUp">fadeInUp</option>
			<option '; ?><?php if($animate == "fadeInDown") { echo "selected"; } ?><?php echo ' value="fadeInDown">fadeInDown</option>
			<option '; ?><?php if($animate == "fadeInLeft") { echo "selected"; } ?><?php echo ' value="fadeInLeft">fadeInLeft</option>
			<option '; ?><?php if($animate == "fadeInRight") { echo "selected"; } ?><?php echo ' value="fadeInRight">fadeInRight</option>
			<option '; ?><?php if($animate == "fadeInUpBig") { echo "selected"; } ?><?php echo ' value="fadeInUpBig">fadeInUpBig</option>
			<option '; ?><?php if($animate == "fadeInDownBig") { echo "selected"; } ?><?php echo ' value="fadeInDownBig">fadeInDownBig</option>
			<option '; ?><?php if($animate == "fadeInLeftBig") { echo "selected"; } ?><?php echo ' value="fadeInLeftBig">fadeInLeftBig</option>
			<option '; ?><?php if($animate == "fadeInRightBig") { echo "selected"; } ?><?php echo ' value="fadeInRightBig">fadeInRightBig</option>
			<option '; ?><?php if($animate == "fadeOut") { echo "selected"; } ?><?php echo ' value="fadeOut">fadeOut</option>
			<option '; ?><?php if($animate == "fadeOutUp") { echo "selected"; } ?><?php echo ' value="fadeOutUp">fadeOutUp</option>
			<option '; ?><?php if($animate == "fadeOutDown") { echo "selected"; } ?><?php echo ' value="fadeOutDown">fadeOutDown</option>
			<option '; ?><?php if($animate == "fadeOutLeft") { echo "selected"; } ?><?php echo ' value="fadeOutLeft">fadeOutLeft</option>
			<option '; ?><?php if($animate == "fadeOutRight") { echo "selected"; } ?><?php echo ' value="fadeOutRight">fadeOutRight</option>
			<option '; ?><?php if($animate == "fadeOutUpBig") { echo "selected"; } ?><?php echo ' value="fadeOutUpBig">fadeOutUpBig</option>
			<option '; ?><?php if($animate == "fadeOutDownBig") { echo "selected"; } ?><?php echo ' value="fadeOutDownBig">fadeOutDownBig</option>
			<option '; ?><?php if($animate == "fadeOutLeftBig") { echo "selected"; } ?><?php echo ' value="fadeOutLeftBig">fadeOutLeftBig</option>
			<option '; ?><?php if($animate == "fadeOutRightBig") { echo "selected"; } ?><?php echo ' value="fadeOutRightBig">fadeOutRightBig</option>
			<option '; ?><?php if($animate == "hinge") { echo "selected"; } ?><?php echo ' value="hinge">hinge</option>
			<option '; ?><?php if($animate == "lightSpeedIn") { echo "selected"; } ?><?php echo ' value="lightSpeedIn">lightSpeedIn</option>
			<option '; ?><?php if($animate == "lightSpeedOut") { echo "selected"; } ?><?php echo ' value="lightSpeedOut">lightSpeedOut</option>
			<option '; ?><?php if($animate == "rollIn") { echo "selected"; } ?><?php echo ' value="rollIn">rollIn</option>
			<option '; ?><?php if($animate == "rollOut") { echo "selected"; } ?><?php echo ' value="rollOut">rollOut</option>
			<option '; ?><?php if($animate == "rotateIn") { echo "selected"; } ?><?php echo ' value="rotateIn">rotateIn</option>
			<option '; ?><?php if($animate == "rotateInDownLeft") { echo "selected"; } ?><?php echo ' value="rotateInDownLeft">rotateInDownLeft</option>
			<option '; ?><?php if($animate == "rotateInDownRight") { echo "selected"; } ?><?php echo ' value="rotateInDownRight">rotateInDownRight</option>
			<option '; ?><?php if($animate == "rotateInUpLeft") { echo "selected"; } ?><?php echo ' value="rotateInUpLeft">rotateInUpLeft</option>
			<option '; ?><?php if($animate == "rotateInUpRight") { echo "selected"; } ?><?php echo ' value="rotateInUpRight">rotateInUpRight</option>
			<option '; ?><?php if($animate == "rotateOut") { echo "selected"; } ?><?php echo ' value="rotateOut">rotateOut</option>
			<option '; ?><?php if($animate == "rotateOutDownLeft") { echo "selected"; } ?><?php echo ' value="rotateOutDownLeft">rotateOutDownLeft</option>
			<option '; ?><?php if($animate == "rotateOutDownRight") { echo "selected"; } ?><?php echo ' value="rotateOutDownRight">rotateOutDownRight</option>
			<option '; ?><?php if($animate == "rotateOutUpLeft") { echo "selected"; } ?><?php echo ' value="rotateOutUpLeft">rotateOutUpLeft</option>
			<option '; ?><?php if($animate == "rotateOutUpRight") { echo "selected"; } ?><?php echo ' value="rotateOutUpRight">rotateOutUpRight</option>
			<option '; ?><?php if($animate == "slideInDown") { echo "selected"; } ?><?php echo ' value="slideInDown">slideInDown</option>
			<option '; ?><?php if($animate == "slideInLeft") { echo "selected"; } ?><?php echo ' value="slideInLeft">slideInLeft</option>
			<option '; ?><?php if($animate == "slideInRight") { echo "selected"; } ?><?php echo ' value="slideInRight">slideInRight</option>
			<option '; ?><?php if($animate == "slideOutUp") { echo "selected"; } ?><?php echo ' value="slideOutUp">slideOutUp</option>
			<option '; ?><?php if($animate == "slideOutLeft") { echo "selected"; } ?><?php echo ' value="slideOutLeft">slideOutLeft</option>
			<option '; ?><?php if($animate == "slideOutRight") { echo "selected"; } ?><?php echo ' value="slideOutRight">slideOutRight</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('delay') . '" style="display: inline-block;width: 153px;">Animation Delay (ms):</label><input class="widefat" id="' . $this->get_field_id('delay') . '" name="' . $this->get_field_name('delay') . '" type="text" value="' . esc_attr($delay) . '" style="display: inline-block;  width: 200px;margin: 0;" /></p>';

		// enqueue script to hide default item portfolio option
		wp_enqueue_style( 'item-portfolio-backend', get_template_directory_uri() . '/lib/widgets_builder/item_portfolio/css/item-portfolio-backend.css', '', '1.0.0' );
	}

	/* Assign variable values. */
	function update($new_instance, $old_instance) {
		$instance                   = $old_instance;
		$instance['title']          = $new_instance['title'];
		$instance['post_id']        = $new_instance['post_id'];
		$instance['size']           = $new_instance['size'];
		$instance['link_icon']      = $new_instance['link_icon']; 
		$instance['lightbox_icon']  = $new_instance['lightbox_icon'];
		$instance['toggle_title']   = $new_instance['toggle_title'];
		$instance['toggle_details'] = $new_instance['toggle_details'];
		$instance['content_style']  = $new_instance['content_style'];
		$instance['animate']        = $new_instance['animate'];
		$instance['delay']          = $new_instance['delay'];
		return $instance;
	}

	/* Output widget to front-end. */
	function widget($args, $instance) {

		$post_id        = $instance['post_id'];
		$size           = $instance['size'];
		$link_icon      = $instance['link_icon']; 
		$lightbox_icon  = $instance['lightbox_icon'];
		$toggle_title   = $instance['toggle_title'];
		$toggle_details = $instance['toggle_details'];
		$content_style  = $instance['content_style'];
		$animate        = $instance['animate'];
		$delay          = $instance['delay'];

		$animate_start = NULL;
		$animate_end   = NULL;

		extract($args, EXTR_SKIP);
			
		if ( empty( $speed ) ) {
			$speed = '500';
		}
		if ( empty( $category ) ) {
			$category = '0';
		}

		// Determind which (if any) icon links should show
		if ( $link_icon == 'on' ) {
			$link_icon = 'off';
		}
		if ( $lightbox_icon == 'on' ) {
			$lightbox_icon = 'off';
		}

		// Assign animation variables
		if ( ! empty( $animate ) and $animate !== 'none' ) {
			$animate_start = '<div class="animated start-' . $animate . '" title="' . $delay . '">';
			$animate_end   = '</div><div class="clearboth"></div>';
		}

		echo $animate_start;

		echo do_shortcode( '[item_portfolio id="' . $post_id . '" link_icon="' . $link_icon . '" lightbox_icon="' . $lightbox_icon . '" title="' . $toggle_title . '" details="' . $toggle_details . '" style="' . $content_style . '" size="' . $size . '"]' );

		echo $animate_end;

		if ( ! empty( $animate ) and $animate !== 'none' ) {
				
			if ( ! wp_script_is( 'animate-js', 'enqueued' ) ) {
			// Enque styles only if widget is being used
			wp_enqueue_style( 'animate-css', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/animate.css/animate.css', array(), '1.0' );
			wp_enqueue_style( 'animate-thinkup-css', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'widgets-builder/animation/css/animate-thinkup-panels.css', array(), '1.0' );

			if ( ! wp_script_is( 'waypoints', 'enqueued' ) ) {
			// Enque waypoints only if widget is being used
			wp_enqueue_script( 'waypoints', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '2.0.3', 'true'  );
			wp_enqueue_script( 'waypoints-sticky', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints-sticky.min.js', array( 'jquery' ), '2.0.3', 'true'  );
			}

			// Enque scripts only if widget is being used
			wp_enqueue_script( 'animate-js', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'widgets-builder/animation/js/animate-thinkup-panels.js', array( 'jquery' ), '1.1', true );
			}
		}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_builder_itemportfoliotheme");') );


?>