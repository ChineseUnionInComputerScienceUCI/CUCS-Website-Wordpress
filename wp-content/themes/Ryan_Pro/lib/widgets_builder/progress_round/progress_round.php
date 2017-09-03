<?php
/**
 * Add Progress - Round Page Builder Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	PROGRESS BAR - ROUND
---------------------------------------------------------------------------------- */

class thinkup_builder_progressround extends WP_Widget {

	/* Register widget description. */
	public function __construct() {
		$widget_ops = array('classname' => 'thinkup_builder_progressround', 'description' => 'Add a circular progress bar to your content.' );
		parent::__construct('thinkup_builder_progressround', 'Progress Bar (Round)', $widget_ops);
	}

	/* Add widget structure to Admin area. */
	function form($instance) {
		$default_entries = array( 
			'title'    => '', 
			'color'    => '', 
			'heading'  => '', 
			'progress' => '', 
			'delay'    => ''
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title         = $instance['title'];
		$color         = $instance['color'];
		$heading       = $instance['heading'];
		$progress      = $instance['progress'];
		$delay         = $instance['delay'];

		echo '<p><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 150px;">Module Title:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('color') . '" style="display: inline-block;width: 150px;">Color:</label><input class="widefat" id="' . $this->get_field_id('color') . '" name="' . $this->get_field_name('color') . '" type="text" value="' . esc_attr($color) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('heading') . '" style="display: inline-block;width: 150px;">Heading:</label><input class="widefat" id="' . $this->get_field_id('heading') . '" name="' . $this->get_field_name('heading') . '" type="text" value="' . esc_attr($heading) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('progress') . '" style="display: inline-block;width: 150px;" >Progress (%):</label>
			<select name="' . $this->get_field_name('progress') . '" id="' . $this->get_field_id('progress') . '" style="display: inline-block;width: 200px;margin: 0;" >';
			foreach ( range(1,100) as $k ) {
				echo '<option '; ?><?php if( $progress == $k ) { echo "selected"; } ?><?php echo ' value="' . $k . '">' . $k . '</option>';
			}
		echo '</select>',
			 '</p>';

		echo '<p><label for="' . $this->get_field_id('delay') . '" style="display: inline-block;width: 150px;">Delay (ms):</label><input class="widefat" id="' . $this->get_field_id('delay') . '" name="' . $this->get_field_name('delay') . '" type="text" value="' . esc_attr($delay) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';
	}

	/* Assign variable values. */
	function update($new_instance, $old_instance) {
		$instance                   = $old_instance;
		$instance['title']          = $new_instance['title'];		
		$instance['color']          = $new_instance['color'];
		$instance['heading']        = $new_instance['heading'];
		$instance['progress']       = $new_instance['progress'];
		$instance['delay']          = $new_instance['delay'];
		return $instance;
	}

	/* Output widget to front-end. */
	function widget($args, $instance) {

		$color          = $instance['color'];
		$heading        = $instance['heading'];
		$progress       = $instance['progress'];
		$delay          = $instance['delay'];

		extract($args, EXTR_SKIP);

		echo do_shortcode( '[progress_round color="' . $color . '" title="' . $heading . '" progress="' . $progress . '" delay="' . $delay . '"]' );

		if ( ! wp_script_is( 'waypoints', 'enqueued' ) ) {
			// Enque waypoints only if widget is being used
			wp_enqueue_script( 'waypoints', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '2.0.3', 'true'  );
			wp_enqueue_script( 'waypoints-sticky', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints-sticky.min.js', array( 'jquery' ), '2.0.3', 'true'  );
		}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_builder_progressround");') );

?>