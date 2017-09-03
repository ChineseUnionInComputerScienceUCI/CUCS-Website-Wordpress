<?php
/**
 * Add Categories Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Categories
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'thinkup_widget_childmenu' ) ) {
	class thinkup_widget_childmenu extends WP_Widget {

		/* Register widget description. */
		public function __construct() {
			$widget_ops = array('classname' => 'thinkup_widget_childmenu', 'description' => 'Display a menu of child pages.' );
			parent::__construct('thinkup_widget_childmenu', 'ThinkUpThemes: Child Pages Menu', $widget_ops);
		}

		/* Add widget structure to Admin area. */
		function form($instance) {
			$default_entries = array( 
				'parentpage' => '', 
			);
			$instance = wp_parse_args( (array) $instance, $default_entries );

			$parentpage      = $instance['parentpage'];

			echo '<p><label for="' . $this->get_field_id('parentpage') . '">Parent Page: 
				 <select name="' . $this->get_field_name('parentpage') . '" id="' . $this->get_field_id('parentpage') . '" >';
				 $pages = get_pages( array( 'parent' => 0 ) ); 
				 foreach ( $pages as $page ) {
					echo '<option '; ?><?php if( $parentpage == $page->ID ) { echo "selected"; } ?><?php echo ' value="' . $page->ID . '">' . $page->post_title . '</option>';
				 }
			echo '</select>
				 </label></p>';
		}

		/* Assign variable values. */
		function update($new_instance, $old_instance) {
			$instance               = $old_instance;
			$instance['parentpage'] = $new_instance['parentpage'];
			return $instance;
		}

		/* Output widget to front-end. */
		function widget($args, $instance) {

			$parentpage = $instance['parentpage'];

			extract($args, EXTR_SKIP);
		 
			echo $before_widget;

			$parentpage      = $instance['parentpage'];

			$pages = get_pages( array( 'child_of' => $parentpage ) ); 

			echo '<ul>';
				foreach ( $pages as $page ) {
					if( get_permalink( $page->ID ) == get_permalink() ) {
						$input_class = ' class="active"'; 
					} else { 
						$input_class = ''; 
					}
					echo '<li><a href="' . get_permalink( $page->ID ) . '"' . $input_class . '>' . $page->post_title . '</a></li>';
				}
			echo '</ul>';


			echo $after_widget;
		  }

	}
	add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_widget_childmenu");') );
}