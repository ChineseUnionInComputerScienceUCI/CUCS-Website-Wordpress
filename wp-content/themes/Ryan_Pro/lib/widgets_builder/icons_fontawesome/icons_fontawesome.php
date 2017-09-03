<?php
/**
 * Add Font Awesome Icon to Page Builder Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Categories
---------------------------------------------------------------------------------- */

include_once( plugin_dir_path(__FILE__) . 'icons_fontawesome_icons_theme.php' );

class thinkup_builder_iconfatheme extends WP_Widget {

	/* Register widget description. */
	public function __construct() {
		$widget_ops = array('classname' => 'thinkup_builder_iconfatheme', 'description' => 'Add a Font Awesome icon to your content.' );
		parent::__construct('thinkup_builder_iconfatheme', 'Icon (Font Awesome)', $widget_ops);
	}

	/* Add widget structure to Admin area. */
	function form($instance) {
		$default_entries = array( 
			'title'        => '', 
			'icon_title'   => '', 
			'icon_content' => '', 
			'icon_link'    => '', 
			'icon_button'  => '', 
			'icon_icon'    => '', 
			'icon_color'   => '',
			'icon_size'    => '', 
			'icon_style'   => '', 
			'icon_bg'      => '', 
			'icon_border'  => '', 
			'icon_animate' => '', 
			'icon_delay'   => '', 
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );
	
		$title        = $instance['title'];
		$icon_title   = $instance['icon_title'];
		$icon_content = $instance['icon_content'];
		$icon_link    = $instance['icon_link'];
		$icon_button  = $instance['icon_button'];
		$icon_icon    = $instance['icon_icon'];
		$icon_color   = $instance['icon_color'];
		$icon_size    = $instance['icon_size'];
		$icon_style   = $instance['icon_style'];
		$icon_bg      = $instance['icon_bg'];
		$icon_border  = $instance['icon_border'];
		$icon_animate = $instance['icon_animate'];
		$icon_delay   = $instance['icon_delay'];

		// Assign global variable for icons used in icon php file
		$GLOBALS['icon_icon'] = $instance['icon_icon'];

		echo '<p><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 150px;">Module Title:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('icon_title') . '" style="display: inline-block;width: 150px;">Title:</label><input class="widefat" id="' . $this->get_field_id('icon_title') . '" name="' . $this->get_field_name('icon_title') . '" type="text" value="' . esc_attr($icon_title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('icon_content') . '" >Content:</label><textarea for="' . $this->get_field_id('icon_content') . '" id="' . $this->get_field_id('icon_content') . '" name="' . $this->get_field_name('icon_content') . '" style="display: block; width: 100%; height: 100px;" >' . esc_attr($icon_content) . '</textarea></p>';

		echo '<p><label for="' . $this->get_field_id('icon_link') . '" style="display: inline-block;width: 150px;">Link:</label><input class="widefat" id="' . $this->get_field_id('icon_link') . '" name="' . $this->get_field_name('icon_link') . '" type="text" value="' . esc_attr($icon_link) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('icon_button') . '" style="display: inline-block;width: 150px;">Link Text:</label><input class="widefat" id="' . $this->get_field_id('icon_button') . '" name="' . $this->get_field_name('icon_button') . '" type="text" value="' . esc_attr($icon_button) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('icon_icon') . '" style="display: inline-block;width: 150px;" >Icon:</label>
			<select name="' . $this->get_field_name('icon_icon') . '" id="' . $this->get_field_id('icon_icon') . '" style="display: inline-block;width: 200px;margin: 0;" >',
			thinkup_builder_fontawesomeicons_theme(),
			'</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('icon_color') . '" style="display: inline-block;width: 150px;">Icon Color:</label>
			<select name="' . $this->get_field_name('icon_color') . '" id="' . $this->get_field_id('icon_color') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($icon_color == "dark") { echo "selected"; } ?><?php echo ' value="dark">Dark</option>
			<option '; ?><?php if($icon_color == "light") { echo "selected"; } ?><?php echo ' value="light">Light</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('icon_size') . '" style="display: inline-block;width: 150px;">Icon Size:</label>
			<select name="' . $this->get_field_name('icon_size') . '" id="' . $this->get_field_id('icon_size') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($icon_size == "small") { echo "selected"; } ?><?php echo ' value="small">Small</option>
			<option '; ?><?php if($icon_size == "medium") { echo "selected"; } ?><?php echo ' value="medium">Medium</option>
			<option '; ?><?php if($icon_size == "large") { echo "selected"; } ?><?php echo ' value="large">Large</option>
			<option '; ?><?php if($icon_size == "extra large") { echo "selected"; } ?><?php echo ' value="extra large">Extra Large</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('icon_style') . '" style="display: inline-block;width: 150px;">Icon Style:</label>
			<select name="' . $this->get_field_name('icon_style') . '" id="' . $this->get_field_id('icon_style') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($icon_style == "style1") { echo "selected"; } ?><?php echo ' value="style1">Style 1</option>
			<option '; ?><?php if($icon_style == "style2") { echo "selected"; } ?><?php echo ' value="style2">Style 2</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('icon_bg') . '" style="display: inline-block;width: 150px;">Background Color:</label><input class="widefat" id="' . $this->get_field_id('icon_bg') . '" name="' . $this->get_field_name('icon_bg') . '" type="text" value="' . $icon_bg . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('icon_border') . '" style="display: inline-block;width: 150px;">Border (Inline CSS):</label><input class="widefat" id="' . $this->get_field_id('icon_border') . '" name="' . $this->get_field_name('icon_border') . '" type="text" value="' . $icon_border . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		

		echo '<p><label for="' . $this->get_field_id('icon_animate') . '" style="display: inline-block;width: 150px;">Animation:</label>
			<select name="' . $this->get_field_name('icon_animate') . '" id="' . $this->get_field_id('icon_animate') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($icon_animate == "none") { echo "selected"; } ?><?php echo ' value="none">None</option>
			<option '; ?><?php if($icon_animate == "bounceIn") { echo "selected"; } ?><?php echo ' value="bounceIn">bounceIn</option>
			<option '; ?><?php if($icon_animate == "bounceInDown") { echo "selected"; } ?><?php echo ' value="bounceInDown">bounceInDown</option>
			<option '; ?><?php if($icon_animate == "bounceInUp") { echo "selected"; } ?><?php echo ' value="bounceInUp">bounceInUp</option>
			<option '; ?><?php if($icon_animate == "bounceInLeft") { echo "selected"; } ?><?php echo ' value="bounceInLeft">bounceInLeft</option>
			<option '; ?><?php if($icon_animate == "bounceInRight") { echo "selected"; } ?><?php echo ' value="bounceInRight">bounceInRight</option>
			<option '; ?><?php if($icon_animate == "bounceOut") { echo "selected"; } ?><?php echo ' value="bounceOut">bounceOut</option>
			<option '; ?><?php if($icon_animate == "bounceOutDown") { echo "selected"; } ?><?php echo ' value="bounceOutDown">bounceOutDown</option>
			<option '; ?><?php if($icon_animate == "bounceOutUp") { echo "selected"; } ?><?php echo ' value="bounceOutUp">bounceOutUp</option>
			<option '; ?><?php if($icon_animate == "bounceOutLeft") { echo "selected"; } ?><?php echo ' value="bounceOutLeft">bounceOutLeft</option>
			<option '; ?><?php if($icon_animate == "bounceOutRight") { echo "selected"; } ?><?php echo ' value="bounceOutRight">bounceOutRight</option>
			<option '; ?><?php if($icon_animate == "flipInX") { echo "selected"; } ?><?php echo ' value="flipInX">flipInX</option>
			<option '; ?><?php if($icon_animate == "flipOutX") { echo "selected"; } ?><?php echo ' value="flipOutX">flipOutX</option>
			<option '; ?><?php if($icon_animate == "flipInY") { echo "selected"; } ?><?php echo ' value="flipInY">flipInY</option>
			<option '; ?><?php if($icon_animate == "flipOutY") { echo "selected"; } ?><?php echo ' value="flipOutY">flipOutY</option>
			<option '; ?><?php if($icon_animate == "fadeIn") { echo "selected"; } ?><?php echo ' value="fadeIn">fadeIn</option>
			<option '; ?><?php if($icon_animate == "fadeInUp") { echo "selected"; } ?><?php echo ' value="fadeInUp">fadeInUp</option>
			<option '; ?><?php if($icon_animate == "fadeInDown") { echo "selected"; } ?><?php echo ' value="fadeInDown">fadeInDown</option>
			<option '; ?><?php if($icon_animate == "fadeInLeft") { echo "selected"; } ?><?php echo ' value="fadeInLeft">fadeInLeft</option>
			<option '; ?><?php if($icon_animate == "fadeInRight") { echo "selected"; } ?><?php echo ' value="fadeInRight">fadeInRight</option>
			<option '; ?><?php if($icon_animate == "fadeInUpBig") { echo "selected"; } ?><?php echo ' value="fadeInUpBig">fadeInUpBig</option>
			<option '; ?><?php if($icon_animate == "fadeInDownBig") { echo "selected"; } ?><?php echo ' value="fadeInDownBig">fadeInDownBig</option>
			<option '; ?><?php if($icon_animate == "fadeInLeftBig") { echo "selected"; } ?><?php echo ' value="fadeInLeftBig">fadeInLeftBig</option>
			<option '; ?><?php if($icon_animate == "fadeInRightBig") { echo "selected"; } ?><?php echo ' value="fadeInRightBig">fadeInRightBig</option>
			<option '; ?><?php if($icon_animate == "fadeOut") { echo "selected"; } ?><?php echo ' value="fadeOut">fadeOut</option>
			<option '; ?><?php if($icon_animate == "fadeOutUp") { echo "selected"; } ?><?php echo ' value="fadeOutUp">fadeOutUp</option>
			<option '; ?><?php if($icon_animate == "fadeOutDown") { echo "selected"; } ?><?php echo ' value="fadeOutDown">fadeOutDown</option>
			<option '; ?><?php if($icon_animate == "fadeOutLeft") { echo "selected"; } ?><?php echo ' value="fadeOutLeft">fadeOutLeft</option>
			<option '; ?><?php if($icon_animate == "fadeOutRight") { echo "selected"; } ?><?php echo ' value="fadeOutRight">fadeOutRight</option>
			<option '; ?><?php if($icon_animate == "fadeOutUpBig") { echo "selected"; } ?><?php echo ' value="fadeOutUpBig">fadeOutUpBig</option>
			<option '; ?><?php if($icon_animate == "fadeOutDownBig") { echo "selected"; } ?><?php echo ' value="fadeOutDownBig">fadeOutDownBig</option>
			<option '; ?><?php if($icon_animate == "fadeOutLeftBig") { echo "selected"; } ?><?php echo ' value="fadeOutLeftBig">fadeOutLeftBig</option>
			<option '; ?><?php if($icon_animate == "fadeOutRightBig") { echo "selected"; } ?><?php echo ' value="fadeOutRightBig">fadeOutRightBig</option>
			<option '; ?><?php if($icon_animate == "hinge") { echo "selected"; } ?><?php echo ' value="hinge">hinge</option>
			<option '; ?><?php if($icon_animate == "lightSpeedIn") { echo "selected"; } ?><?php echo ' value="lightSpeedIn">lightSpeedIn</option>
			<option '; ?><?php if($icon_animate == "lightSpeedOut") { echo "selected"; } ?><?php echo ' value="lightSpeedOut">lightSpeedOut</option>
			<option '; ?><?php if($icon_animate == "rollIn") { echo "selected"; } ?><?php echo ' value="rollIn">rollIn</option>
			<option '; ?><?php if($icon_animate == "rollOut") { echo "selected"; } ?><?php echo ' value="rollOut">rollOut</option>
			<option '; ?><?php if($icon_animate == "rotateIn") { echo "selected"; } ?><?php echo ' value="rotateIn">rotateIn</option>
			<option '; ?><?php if($icon_animate == "rotateInDownLeft") { echo "selected"; } ?><?php echo ' value="rotateInDownLeft">rotateInDownLeft</option>
			<option '; ?><?php if($icon_animate == "rotateInDownRight") { echo "selected"; } ?><?php echo ' value="rotateInDownRight">rotateInDownRight</option>
			<option '; ?><?php if($icon_animate == "rotateInUpLeft") { echo "selected"; } ?><?php echo ' value="rotateInUpLeft">rotateInUpLeft</option>
			<option '; ?><?php if($icon_animate == "rotateInUpRight") { echo "selected"; } ?><?php echo ' value="rotateInUpRight">rotateInUpRight</option>
			<option '; ?><?php if($icon_animate == "rotateOut") { echo "selected"; } ?><?php echo ' value="rotateOut">rotateOut</option>
			<option '; ?><?php if($icon_animate == "rotateOutDownLeft") { echo "selected"; } ?><?php echo ' value="rotateOutDownLeft">rotateOutDownLeft</option>
			<option '; ?><?php if($icon_animate == "rotateOutDownRight") { echo "selected"; } ?><?php echo ' value="rotateOutDownRight">rotateOutDownRight</option>
			<option '; ?><?php if($icon_animate == "rotateOutUpLeft") { echo "selected"; } ?><?php echo ' value="rotateOutUpLeft">rotateOutUpLeft</option>
			<option '; ?><?php if($icon_animate == "rotateOutUpRight") { echo "selected"; } ?><?php echo ' value="rotateOutUpRight">rotateOutUpRight</option>
			<option '; ?><?php if($icon_animate == "slideInDown") { echo "selected"; } ?><?php echo ' value="slideInDown">slideInDown</option>
			<option '; ?><?php if($icon_animate == "slideInLeft") { echo "selected"; } ?><?php echo ' value="slideInLeft">slideInLeft</option>
			<option '; ?><?php if($icon_animate == "slideInRight") { echo "selected"; } ?><?php echo ' value="slideInRight">slideInRight</option>
			<option '; ?><?php if($icon_animate == "slideOutUp") { echo "selected"; } ?><?php echo ' value="slideOutUp">slideOutUp</option>
			<option '; ?><?php if($icon_animate == "slideOutLeft") { echo "selected"; } ?><?php echo ' value="slideOutLeft">slideOutLeft</option>
			<option '; ?><?php if($icon_animate == "slideOutRight") { echo "selected"; } ?><?php echo ' value="slideOutRight">slideOutRight</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('icon_delay') . '" style="display: inline-block;width: 153px;">Animation Delay (ms):</label><input class="widefat" id="' . $this->get_field_id('icon_delay') . '" name="' . $this->get_field_name('icon_delay') . '" type="text" value="' . esc_attr($icon_delay) . '" style="display: inline-block;  width: 200px;margin: 0;" /></p>';

	// enqueue script to hide default carousel portfolio option
	wp_enqueue_style( 'icons_fontawesome-backend', get_template_directory_uri() . '/lib/widgets_builder/icons_fontawesome/css/icons_fontawesome-backend.css', '', '1.0.0' );
	}

	/* Assign variable values. */
	function update($new_instance, $old_instance) {
		$instance                 = $old_instance;
		$instance['title']        = $new_instance['title'];
		$instance['icon_title']   = $new_instance['icon_title'];
		$instance['icon_content'] = $new_instance['icon_content'];
		$instance['icon_link']    = $new_instance['icon_link'];
		$instance['icon_button']  = $new_instance['icon_button'];
		$instance['icon_icon']    = $new_instance['icon_icon'];
		$instance['icon_color']   = $new_instance['icon_color'];
		$instance['icon_size']    = $new_instance['icon_size'];
		$instance['icon_style']   = $new_instance['icon_style'];
		$instance['icon_bg']      = $new_instance['icon_bg'];
		$instance['icon_border']  = $new_instance['icon_border'];
		$instance['icon_animate'] = $new_instance['icon_animate'];
		$instance['icon_delay']   = $new_instance['icon_delay'];
		return $instance;
	}

	/* Output widget to front-end. */
	function widget($args, $instance) {

		$icon_title   = $instance['icon_title'];
		$icon_content = $instance['icon_content'];
		$icon_link    = $instance['icon_link'];
		$icon_button  = $instance['icon_button'];
		$icon_icon    = $instance['icon_icon'];
		$icon_color   = $instance['icon_color'];
		$icon_size    = $instance['icon_size'];
		$icon_style   = $instance['icon_style'];
		$icon_bg      = $instance['icon_bg'];
		$icon_border  = $instance['icon_border'];
		$icon_animate = $instance['icon_animate'];
		$icon_delay   = $instance['icon_delay'];

		extract($args, EXTR_SKIP);

		if ( empty( $icon_delay ) ) {
			$delay = '0';
		}

		if ( empty( $icon_animate ) or $icon_animate == 'none' ) {
			if ( $icon_style == 'style1' ) {
				echo '[font_full1 title="' . $icon_title . '" link="' . $icon_link . '" button="' . $icon_button . '" icon="' . $icon_icon . '" color="' . $icon_color . '" size="' . $icon_size . '" background="' . $icon_bg . '" border="' . $icon_border . '" spin="off"]' . $icon_content . '[/font_full1]';
			} else if ( $icon_style == 'style2' ) {
				echo '[font_full2 title="' . $icon_title . '" link="' . $icon_link . '" button="' . $icon_button . '" icon="' . $icon_icon . '" color="' . $icon_color . '" size="' . $icon_size . '" background="' . $icon_bg . '" border="' . $icon_border . '" spin="off"]' . $icon_content . '[/font_full2]';
			}
		} else  {
			echo '<div class="animated start-' . $icon_animate . '" title="' . $icon_delay . '">';
			if ( $icon_style == 'style1' ) {
				echo '[font_full1 title="' . $icon_title . '" link="' . $icon_link . '" button="' . $icon_button . '" icon="' . $icon_icon . '" color="' . $icon_color . '" size="' . $icon_size . '" background="' . $icon_bg . '" border="' . $icon_border . '" spin="off"]' . $icon_content . '[/font_full1]';
			} else if ( $icon_style == 'style2' ) {
				echo '[font_full2 title="' . $icon_title . '" link="' . $icon_link . '" button="' . $icon_button . '" icon="' . $icon_icon . '" color="' . $icon_color . '" size="' . $icon_size . '" background="' . $icon_bg . '" border="' . $icon_border . '" spin="off"]' . $icon_content . '[/font_full2]';
			}
			echo '</div><div class="clearboth"></div>';
		}

		if ( ! empty( $icon_animate ) and $icon_animate !== 'none' ) {
			
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
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_builder_iconfatheme");') );


?>