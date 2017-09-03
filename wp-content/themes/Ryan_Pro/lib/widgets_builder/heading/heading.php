<?php
/**
 * Add Title Page Builder Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Categories
---------------------------------------------------------------------------------- */

class thinkup_builder_headingtheme extends WP_Widget {

	/* Register widget description. */
	public function __construct() {
		$widget_ops = array('classname' => 'thinkup_builder_headingtheme', 'description' => 'Add a heading to your content.' );
		parent::__construct('thinkup_builder_headingtheme', 'Heading', $widget_ops);
	}

	/* Add widget structure to Admin area. */
	function form($instance) {
		$default_entries = array( 
			'title' => '', 
			'heading_text'    => '', 
			'heading_type'    => '', 
			'heading_size'    => '', 
			'heading_weight'  => '', 
			'heading_style'   => '', 
			'heading_margin'  => '', 
			'heading_animate' => '', 
			'heading_delay'   => '' 
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title             = $instance['title'];
		$heading_text      = $instance['heading_text'];
		$heading_type      = $instance['heading_type'];
		$heading_size      = $instance['heading_size'];
		$heading_underline = $instance['heading_underline'];
		$heading_weight    = $instance['heading_weight'];
		$heading_style     = $instance['heading_style'];
		$heading_margin    = $instance['heading_margin'];
		$heading_animate   = $instance['heading_animate'];
		$heading_delay     = $instance['heading_delay'];

		echo '<p><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 150px;">Module Title:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('heading_text') . '" style="display: inline-block;width: 150px;">Heading Text:</label><input class="widefat" id="' . $this->get_field_id('heading_text') . '" name="' . $this->get_field_name('heading_text') . '" type="text" value="' . esc_attr($heading_text) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('heading_type') . '" style="display: inline-block;width: 150px;" >Heading Type:</label>
			<select name="' . $this->get_field_name('heading_type') . '" id="' . $this->get_field_id('heading_type') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($heading_type == "1") { echo "selected"; } ?><?php echo ' value="1">H1</option>
			<option '; ?><?php if($heading_type == "2") { echo "selected"; } ?><?php echo ' value="2">H2</option>
			<option '; ?><?php if($heading_type == "3") { echo "selected"; } ?><?php echo ' value="3">H3</option>
			<option '; ?><?php if($heading_type == "4") { echo "selected"; } ?><?php echo ' value="4">H4</option>
			<option '; ?><?php if($heading_type == "5") { echo "selected"; } ?><?php echo ' value="5">H5</option>
			<option '; ?><?php if($heading_type == "6") { echo "selected"; } ?><?php echo ' value="6">H6</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('heading_size') . '" style="display: inline-block;width: 150px;" >Heading Size (px):</label>
			<select name="' . $this->get_field_name('heading_size') . '" id="' . $this->get_field_id('heading_size') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			echo '<option '; ?><?php if($heading_size == "0") { echo "selected"; } ?><?php echo ' value="0">Default</option>';
			foreach ( range(10,80) as $k ) {
				echo '<option '; ?><?php if( $heading_size == $k ) { echo "selected"; } ?><?php echo ' value="' . $k . '">' . $k . '</option>';
			}
		echo '</select>',
			 '</p>';

		echo '<p><label for="' . $this->get_field_id('heading_underline') . '" style="display: inline-block;width: 150px;" >Heading Underline:</label>
			<select name="' . $this->get_field_name('heading_underline') . '" id="' . $this->get_field_id('heading_underline') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			echo '<option '; ?><?php if($heading_underline == "off") { echo "selected"; } ?><?php echo ' value="off">Off</option>';
			echo '<option '; ?><?php if($heading_underline == "on") { echo "selected"; } ?><?php echo ' value="on">On</option>';
		echo '</select>',
			 '</p>';

		echo '<p><label for="' . $this->get_field_id('heading_weight') . '" style="display: inline-block;width: 150px;" >Heading Weight:</label>
			<select name="' . $this->get_field_name('heading_weight') . '" id="' . $this->get_field_id('heading_weight') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			echo '<option '; ?><?php if($heading_weight == "0") { echo "selected"; } ?><?php echo ' value="0">Default</option>';
			echo '<option '; ?><?php if($heading_weight == "300") { echo "selected"; } ?><?php echo ' value="300">300</option>';
			echo '<option '; ?><?php if($heading_weight == "400") { echo "selected"; } ?><?php echo ' value="400">400</option>';
			echo '<option '; ?><?php if($heading_weight == "500") { echo "selected"; } ?><?php echo ' value="500">500</option>';
			echo '<option '; ?><?php if($heading_weight == "600") { echo "selected"; } ?><?php echo ' value="600">600</option>';
			echo '<option '; ?><?php if($heading_weight == "700") { echo "selected"; } ?><?php echo ' value="700">700</option>';
		echo '</select>',
			 '</p>';

		echo '<p><label for="' . $this->get_field_id('heading_style') . '" style="display: inline-block;width: 150px;" >Heading Style:</label>
			<select name="' . $this->get_field_name('heading_style') . '" id="' . $this->get_field_id('heading_style') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			echo '<option '; ?><?php if($heading_style == "normal") { echo "selected"; } ?><?php echo ' value="normal">Normal</option>';
			echo '<option '; ?><?php if($heading_style == "italic") { echo "selected"; } ?><?php echo ' value="italic">Italic</option>';
			echo '<option '; ?><?php if($heading_style == "oblique") { echo "selected"; } ?><?php echo ' value="oblique">Oblique</option>';
		echo '</select>',
			 '</p>';

		echo '<p><label for="' . $this->get_field_id('heading_margin') . '" style="display: inline-block;width: 150px;" >Margin Bottom (px):</label>
			<select name="' . $this->get_field_name('heading_margin') . '" id="' . $this->get_field_id('heading_margin') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			echo '<option '; ?><?php if($heading_margin == "0") { echo "selected"; } ?><?php echo ' value="0">Default</option>';
			foreach ( range(1,100) as $k ) {
				echo '<option '; ?><?php if( $heading_margin == $k ) { echo "selected"; } ?><?php echo ' value="' . $k . '">' . $k . '</option>';
			}
		echo '</select>',
			 '</p>';

		echo '<p><label for="' . $this->get_field_id('heading_animate') . '" style="display: inline-block;width: 150px;">Animation:</label>
			<select name="' . $this->get_field_name('heading_animate') . '" id="' . $this->get_field_id('heading_animate') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($heading_animate == "none") { echo "selected"; } ?><?php echo ' value="none">None</option>
			<option '; ?><?php if($heading_animate == "bounceIn") { echo "selected"; } ?><?php echo ' value="bounceIn">bounceIn</option>
			<option '; ?><?php if($heading_animate == "bounceInDown") { echo "selected"; } ?><?php echo ' value="bounceInDown">bounceInDown</option>
			<option '; ?><?php if($heading_animate == "bounceInUp") { echo "selected"; } ?><?php echo ' value="bounceInUp">bounceInUp</option>
			<option '; ?><?php if($heading_animate == "bounceInLeft") { echo "selected"; } ?><?php echo ' value="bounceInLeft">bounceInLeft</option>
			<option '; ?><?php if($heading_animate == "bounceInRight") { echo "selected"; } ?><?php echo ' value="bounceInRight">bounceInRight</option>
			<option '; ?><?php if($heading_animate == "bounceOut") { echo "selected"; } ?><?php echo ' value="bounceOut">bounceOut</option>
			<option '; ?><?php if($heading_animate == "bounceOutDown") { echo "selected"; } ?><?php echo ' value="bounceOutDown">bounceOutDown</option>
			<option '; ?><?php if($heading_animate == "bounceOutUp") { echo "selected"; } ?><?php echo ' value="bounceOutUp">bounceOutUp</option>
			<option '; ?><?php if($heading_animate == "bounceOutLeft") { echo "selected"; } ?><?php echo ' value="bounceOutLeft">bounceOutLeft</option>
			<option '; ?><?php if($heading_animate == "bounceOutRight") { echo "selected"; } ?><?php echo ' value="bounceOutRight">bounceOutRight</option>
			<option '; ?><?php if($heading_animate == "flipInX") { echo "selected"; } ?><?php echo ' value="flipInX">flipInX</option>
			<option '; ?><?php if($heading_animate == "flipOutX") { echo "selected"; } ?><?php echo ' value="flipOutX">flipOutX</option>
			<option '; ?><?php if($heading_animate == "flipInY") { echo "selected"; } ?><?php echo ' value="flipInY">flipInY</option>
			<option '; ?><?php if($heading_animate == "flipOutY") { echo "selected"; } ?><?php echo ' value="flipOutY">flipOutY</option>
			<option '; ?><?php if($heading_animate == "fadeIn") { echo "selected"; } ?><?php echo ' value="fadeIn">fadeIn</option>
			<option '; ?><?php if($heading_animate == "fadeInUp") { echo "selected"; } ?><?php echo ' value="fadeInUp">fadeInUp</option>
			<option '; ?><?php if($heading_animate == "fadeInDown") { echo "selected"; } ?><?php echo ' value="fadeInDown">fadeInDown</option>
			<option '; ?><?php if($heading_animate == "fadeInLeft") { echo "selected"; } ?><?php echo ' value="fadeInLeft">fadeInLeft</option>
			<option '; ?><?php if($heading_animate == "fadeInRight") { echo "selected"; } ?><?php echo ' value="fadeInRight">fadeInRight</option>
			<option '; ?><?php if($heading_animate == "fadeInUpBig") { echo "selected"; } ?><?php echo ' value="fadeInUpBig">fadeInUpBig</option>
			<option '; ?><?php if($heading_animate == "fadeInDownBig") { echo "selected"; } ?><?php echo ' value="fadeInDownBig">fadeInDownBig</option>
			<option '; ?><?php if($heading_animate == "fadeInLeftBig") { echo "selected"; } ?><?php echo ' value="fadeInLeftBig">fadeInLeftBig</option>
			<option '; ?><?php if($heading_animate == "fadeInRightBig") { echo "selected"; } ?><?php echo ' value="fadeInRightBig">fadeInRightBig</option>
			<option '; ?><?php if($heading_animate == "fadeOut") { echo "selected"; } ?><?php echo ' value="fadeOut">fadeOut</option>
			<option '; ?><?php if($heading_animate == "fadeOutUp") { echo "selected"; } ?><?php echo ' value="fadeOutUp">fadeOutUp</option>
			<option '; ?><?php if($heading_animate == "fadeOutDown") { echo "selected"; } ?><?php echo ' value="fadeOutDown">fadeOutDown</option>
			<option '; ?><?php if($heading_animate == "fadeOutLeft") { echo "selected"; } ?><?php echo ' value="fadeOutLeft">fadeOutLeft</option>
			<option '; ?><?php if($heading_animate == "fadeOutRight") { echo "selected"; } ?><?php echo ' value="fadeOutRight">fadeOutRight</option>
			<option '; ?><?php if($heading_animate == "fadeOutUpBig") { echo "selected"; } ?><?php echo ' value="fadeOutUpBig">fadeOutUpBig</option>
			<option '; ?><?php if($heading_animate == "fadeOutDownBig") { echo "selected"; } ?><?php echo ' value="fadeOutDownBig">fadeOutDownBig</option>
			<option '; ?><?php if($heading_animate == "fadeOutLeftBig") { echo "selected"; } ?><?php echo ' value="fadeOutLeftBig">fadeOutLeftBig</option>
			<option '; ?><?php if($heading_animate == "fadeOutRightBig") { echo "selected"; } ?><?php echo ' value="fadeOutRightBig">fadeOutRightBig</option>
			<option '; ?><?php if($heading_animate == "hinge") { echo "selected"; } ?><?php echo ' value="hinge">hinge</option>
			<option '; ?><?php if($heading_animate == "lightSpeedIn") { echo "selected"; } ?><?php echo ' value="lightSpeedIn">lightSpeedIn</option>
			<option '; ?><?php if($heading_animate == "lightSpeedOut") { echo "selected"; } ?><?php echo ' value="lightSpeedOut">lightSpeedOut</option>
			<option '; ?><?php if($heading_animate == "rollIn") { echo "selected"; } ?><?php echo ' value="rollIn">rollIn</option>
			<option '; ?><?php if($heading_animate == "rollOut") { echo "selected"; } ?><?php echo ' value="rollOut">rollOut</option>
			<option '; ?><?php if($heading_animate == "rotateIn") { echo "selected"; } ?><?php echo ' value="rotateIn">rotateIn</option>
			<option '; ?><?php if($heading_animate == "rotateInDownLeft") { echo "selected"; } ?><?php echo ' value="rotateInDownLeft">rotateInDownLeft</option>
			<option '; ?><?php if($heading_animate == "rotateInDownRight") { echo "selected"; } ?><?php echo ' value="rotateInDownRight">rotateInDownRight</option>
			<option '; ?><?php if($heading_animate == "rotateInUpLeft") { echo "selected"; } ?><?php echo ' value="rotateInUpLeft">rotateInUpLeft</option>
			<option '; ?><?php if($heading_animate == "rotateInUpRight") { echo "selected"; } ?><?php echo ' value="rotateInUpRight">rotateInUpRight</option>
			<option '; ?><?php if($heading_animate == "rotateOut") { echo "selected"; } ?><?php echo ' value="rotateOut">rotateOut</option>
			<option '; ?><?php if($heading_animate == "rotateOutDownLeft") { echo "selected"; } ?><?php echo ' value="rotateOutDownLeft">rotateOutDownLeft</option>
			<option '; ?><?php if($heading_animate == "rotateOutDownRight") { echo "selected"; } ?><?php echo ' value="rotateOutDownRight">rotateOutDownRight</option>
			<option '; ?><?php if($heading_animate == "rotateOutUpLeft") { echo "selected"; } ?><?php echo ' value="rotateOutUpLeft">rotateOutUpLeft</option>
			<option '; ?><?php if($heading_animate == "rotateOutUpRight") { echo "selected"; } ?><?php echo ' value="rotateOutUpRight">rotateOutUpRight</option>
			<option '; ?><?php if($heading_animate == "slideInDown") { echo "selected"; } ?><?php echo ' value="slideInDown">slideInDown</option>
			<option '; ?><?php if($heading_animate == "slideInLeft") { echo "selected"; } ?><?php echo ' value="slideInLeft">slideInLeft</option>
			<option '; ?><?php if($heading_animate == "slideInRight") { echo "selected"; } ?><?php echo ' value="slideInRight">slideInRight</option>
			<option '; ?><?php if($heading_animate == "slideOutUp") { echo "selected"; } ?><?php echo ' value="slideOutUp">slideOutUp</option>
			<option '; ?><?php if($heading_animate == "slideOutLeft") { echo "selected"; } ?><?php echo ' value="slideOutLeft">slideOutLeft</option>
			<option '; ?><?php if($heading_animate == "slideOutRight") { echo "selected"; } ?><?php echo ' value="slideOutRight">slideOutRight</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('heading_delay') . '" style="display: inline-block;width: 153px;">Animation Delay (ms):</label><input class="widefat" id="' . $this->get_field_id('heading_delay') . '" name="' . $this->get_field_name('heading_delay') . '" type="text" value="' . esc_attr($heading_delay) . '" style="display: inline-block;  width: 200px;margin: 0;" /></p>';

		// enqueue script to hide default carousel portfolio option
		wp_enqueue_style( 'heading-backend', get_template_directory_uri() . '/lib/widgets_builder/heading/css/heading-backend.css', '', '1.0.0' );
	}

	/* Assign variable values. */
	function update($new_instance, $old_instance) {
		$instance                      = $old_instance;
		$instance['title']             = $new_instance['title'];		
		$instance['heading_text']      = $new_instance['heading_text'];
		$instance['heading_type']      = $new_instance['heading_type'];
		$instance['heading_size']      = $new_instance['heading_size'];
		$instance['heading_underline'] = $new_instance['heading_underline'];
		$instance['heading_weight']    = $new_instance['heading_weight'];
		$instance['heading_style']     = $new_instance['heading_style'];
		$instance['heading_margin']    = $new_instance['heading_margin'];
		$instance['heading_animate']   = $new_instance['heading_animate'];
		$instance['heading_delay']     = $new_instance['heading_delay'];
		return $instance;
	}

	/* Output widget to front-end. */
	function widget($args, $instance) {

		$heading_text      = $instance['heading_text'];
		$heading_type      = $instance['heading_type'];
		$heading_size      = $instance['heading_size'];
		$heading_underline = $instance['heading_underline'];
		$heading_weight    = $instance['heading_weight'];
		$heading_style     = $instance['heading_style'];
		$heading_margin    = $instance['heading_margin'];
		$heading_animate   = $instance['heading_animate'];
		$heading_delay     = $instance['heading_delay'];

		$output          = NULL;
		$animate_start   = NULL;
		$animate_end     = NULL;
		$underline_start = NULL;
		$underline_end   = NULL;

		extract($args, EXTR_SKIP);

		if ( ! empty( $heading_text ) ) {

			if ( $heading_size !== '0' or $heading_weight !== '0' or $heading_style !== '0' ) {

				$output .= ' style="';

				if ( $heading_size !== '0' ) {
					$output .= 'font-size: ' . $heading_size . 'px;';
				}

				if ( $heading_weight !== '0' ) {
					$output .= 'font-weight: ' . $heading_weight . ';';
				}

				if ( $heading_style !== '0' ) {
					$output .= 'font-style: ' . $heading_style . ';';
				}

				if ( $heading_margin !== '0' ) {
					$output .= 'margin-bottom: ' . $heading_margin . 'px;';
				}

				$output .= '"';

			}

			// Determing whether user has selected for underline style
			if ( $heading_underline == 'on' ) {
				$underline_start = '<div class="customtitle style5">';
				$underline_end = '</div>';			
			}

			// Determing whether user has chosen any animation effect
			if ( ! empty( $heading_animate ) and $heading_animate !== 'none' ) {
				$animate_start = '<div class="animated start-' . $heading_animate . '" title="' . $heading_delay . '">';
				$animate_end = '</div><div class="clearboth"></div>';
			}

			if ( empty( $heading_delay ) ) {
				$delay = '0';
			}

			echo $animate_start;
				echo $underline_start;
					echo '<h' . $heading_type . $output . '><span>' . $heading_text . '</span></h' . $heading_type . '>';
				echo $underline_end;
			echo $animate_end;

			if ( ! empty( $heading_animate ) and $heading_animate !== 'none' ) {
			
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
}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_builder_headingtheme");') );

?>