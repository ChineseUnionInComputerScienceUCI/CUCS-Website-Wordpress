<?php
/**
 * Add Tags Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Tags
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'thinkup_widget_logotext' ) ) {
	class thinkup_widget_logotext extends WP_Widget {

		/* Register widget description. */
		public function __construct() {
			$widget_ops = array('classname' => 'thinkup_widget_logotext', 'description' => 'Add a logo with text.' );
			parent::__construct('thinkup_widget_logotext', 'ThinkUpThemes: Logo + Text', $widget_ops);
		}

		/* Add widget structure to Admin area. */
		function form($instance) {
			$default_entries = array( 'logo' => '', 'text' => '' );
			$instance = wp_parse_args( (array) $instance, $default_entries );

			$logo = $instance['logo'];
			$text = $instance['text'];

			echo '<p><label for="' . $this->get_field_id('logo') . '">Logo link: <input class="widefat" id="' . $this->get_field_id('logo') . '" name="' . $this->get_field_name('logo') . '" type="text" value="' . esc_attr($logo) . '"/></label></p>';

			echo '<p><label for="' . $this->get_field_id('text') . '">Text: <textarea class="widefat" rows="16" cols="20" ' . $this->get_field_id('text') . '" name="' . $this->get_field_name('text') . '">' . esc_attr($text) . '</textarea></label></p>';
		}

		/* Assign variable values. */
		function update($new_instance, $old_instance) {
			$instance         = $old_instance;
			$instance['logo'] = $new_instance['logo'];
			$instance['text'] = $new_instance['text'];
			return $instance;
		}

		/* Output widget to front-end. */
		function widget($args, $instance) {		
			extract($args, EXTR_SKIP);
		 
			$logo = empty($instance['logo']) ? __( 'Tags', 'ryan' ) : apply_filters('widget_title', $instance['logo']);
			$text = $instance['text'];

			echo $before_widget;

			/* Title widget area */
			if (!empty($logo))
			  echo $before_title . '<img src="' . $logo . '">' . $after_title;

			/* Main widget area */

			echo '<div class="textwidget">';
			echo wpautop( $text );
			echo '</div>';

			echo $after_widget;
		  }

	}
	add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_widget_logotext");') );
}