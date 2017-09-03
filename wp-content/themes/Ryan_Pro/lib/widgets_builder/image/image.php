<?php
/**
 * Add TinyMCE Widget. This has been forked from http://wordpress.org/extend/plugins/image-widget/.
 * All copyright notices for Modern Tribe have remained intact. 
 * IDs, classes and layout have been changed to best meet the needs of Think Up Themes Ltd. 
 * Change have been made within the restrictions of the GPL license under which the Modern Tribe Image Widget has been released.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	Image Widget
//----------------------------------------------------------------------------------

class thinkup_builder_imagetheme extends WP_Widget {

	const VERSION = '4.0.6';
	const CUSTOM_IMAGE_SIZE_SLUG = 'thinkup_builder_imagetheme_custom';

	// Register widget description.
	public function __construct() {
		$widget_ops = array( 'classname' => 'thinkup_builder_imagetheme', 'description' => __( 'Add an image from the media library.', 'ryan' ) );
		$control_ops = array( 'id_base' => 'thinkup_builder_imagetheme' );
		parent::__construct('thinkup_builder_imagetheme', __('Image', 'ryan'), $widget_ops, $control_ops);

		// Add scripts to admin area
		add_action('admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_setup' ) );
	}

	//Enqueue all the javascript.
	function admin_setup() {
		wp_enqueue_media();
		wp_enqueue_script( 'thinkup-builder-image', get_template_directory_uri() . '/lib/widgets_builder/image/js/image.js', array( 'jquery', 'media-upload' ), time() );

		wp_localize_script( 'thinkup-builder-image', 'ThinkupBuilderImage', array(
			'frame_title' => __( 'Select an Image', 'ryan' ),
			'button_title' => __( 'Insert Into Widget', 'ryan' ),
		) );
	}

	//Enqueue all the css.
	function admin_head() {

		echo '<style type="text/css">',
			 '.uploader input.button { width: 100%; height: 34px; line-height: 33px; margin: 8px 0; }',
			 '.thinkup_builder_imagetheme .aligncenter { display: block; margin-left: auto !important; margin-right: auto !important; }',
			 '.thinkup_builder_imagetheme { overflow: hidden; max-height: 300px; }',
			 '.thinkup_builder_imagetheme img { width: 100%; height: auto; margin: 10px 0; }',
			 '</style>';
	}

	// Add widget structure to Admin area.
	function form( $instance ) {

		$default_entries = array( 
			'title'           => '', 
			'uploader_button' => '', 
			'attachment_id'   => '', 
			'imageurl'        => '', 
			'size'            => '',
			'align'           => '',
			'link'            => '', 
			'overlay_enable'  => '',
			'lightbox'        => '', 
			'text_alt'        => '', 
			'animate'         => '', 
			'delay'           => '', 	
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$align          = $instance['align'];
		$overlay_enable = $instance['overlay_enable'];
		$lightbox       = $instance['lightbox'];
		$text_alt       = $instance['text_alt'];
		$animate        = $instance['animate'];
		$delay          = $instance['delay'];
//		$instance       = wp_parse_args( (array) $instance, self::get_defaults() );

		$id_prefix = $this->get_field_id('');

		echo '<p style="margin-bottom: 20px;"><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 100px;" >' . __('Widget Title', 'ryan') . ':</label>',
			 '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr(strip_tags($instance['title'])) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<div class="uploader">',
			 '<input type="submit" class="button" name="' . $this->get_field_name('uploader_button') . '" id="' . $this->get_field_id('uploader_button') . '" value="' . __('Select an Image', 'ryan') . '" onclick="imageWidget.uploader( &#39;' . $id_prefix . '&#39;, &#39;' . $id_prefix . '&#39; ); return false;" />',
			 '<div class="thinkup_builder_imagetheme" id="' . $this->get_field_id('preview') . '">',
			 wp_get_attachment_image( $instance['attachment_id'], $instance['size'] ),
			 '<img class="image-builder-urlout" src="" />',
			 '</div>',
			 '<input type="hidden" id="' . $this->get_field_id('attachment_id') .'" name="' . $this->get_field_name('attachment_id') .'" value="' . abs($instance['attachment_id']) .'" />',
			 '<input type="hidden" id="' . $this->get_field_id('imageurl') . '" class="image-builder-urlin" name="' . $this->get_field_name('imageurl') . '" value="' . $instance['imageurl'] . '" />',
			 '</div>',
			 '<span clear="all" /></span>';

		echo '<div id="' . $this->get_field_id('fields') . '" class="image-builder-fields">';
		echo '<div id="' . $this->get_field_id('custom_size_selector') . '" class="image-image-size" >',
			 '<p style="margin-bottom: 20px;"><label for="' . $this->get_field_id('size') . '" style="display: inline-block;width: 150px;">' . __('Size', 'ryan') . ':</label>',
			 '<select name="' . $this->get_field_name('size') . '" id="' . $this->get_field_id('size') . '" onChange="imageWidget.toggleSizes( &#39;' . $id_prefix . '&#39;, &#39;' . $id_prefix . '&#39; );" style="display: inline-block;width: 200px;margin: 0;">';

					// Note: this is dumb. We shouldn't need to have to do this. There should really be a centralized function in core code for this.
					$possible_sizes = apply_filters( 'image_size_names_choose', array(
						'full'      => __('Full Size', 'ryan'),
						'thumbnail' => __('Thumbnail', 'ryan'),
						'medium'    => __('Medium', 'ryan'),
						'large'     => __('Large', 'ryan'),
					) );
	//				$possible_sizes[self::CUSTOM_IMAGE_SIZE_SLUG] = __('Custom', 'ryan');

					foreach( $possible_sizes as $size_key => $size_label ) {
						echo '<option value="' . $size_key . '" .' . selected( $instance['size'], $size_key ) . '>' . $size_label . '</option>';
					}
		echo '</select>',
			 '</p>',
			 '</div>',
			 '</div>';

		echo '<div id="' . $this->get_field_id('custom_size_fields') . '">';

		echo '<p><label for="' . $this->get_field_id('align') . '" style="display: inline-block;width: 150px;">Alignment:</label>
			<select name="' . $this->get_field_name('align') . '" id="' . $this->get_field_id('align') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($align == "auto") { echo "selected"; } ?><?php echo ' value="auto">Auto</option>
			<option '; ?><?php if($align == "left") { echo "selected"; } ?><?php echo ' value="left">Left</option>
			<option '; ?><?php if($align == "right") { echo "selected"; } ?><?php echo ' value="right">Right</option>
			<option '; ?><?php if($align == "center") { echo "selected"; } ?><?php echo ' value="center">Center</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('link') . '" style="display: inline-block;width: 150px;" >' . __('Link', 'ryan') . ':</label>',
			 '<input class="widefat" id="' . $this->get_field_id('link') . '" name="' . $this->get_field_name('link') . '" type="text" value="' . esc_attr(strip_tags($instance['link'])) . '" style="display: inline-block;width: 200px;margin: 0;" /><br />';

		echo '</div>';

		echo '<p><label for="' . $this->get_field_id('overlay_enable') . '" style="display: inline-block;width: 150px;">Enable Overlay:</label>
			<select name="' . $this->get_field_name('overlay_enable') . '" id="' . $this->get_field_id('overlay_enable') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($overlay_enable == "off") { echo "selected"; } ?><?php echo ' value="off">Off</option>
			<option '; ?><?php if($overlay_enable == "on") { echo "selected"; } ?><?php echo ' value="on">On</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('lightbox') . '" style="display: inline-block;width: 150px;">Add Lightbox?</label>&nbsp;<input id="' . $this->get_field_id('lightbox') . '" name="' . $this->get_field_name('lightbox') . '" type="checkbox" '; ?><?php if($lightbox == "on") { echo 'checked=checked'; } ?><?php echo ' /></p>';

		echo '<p><label for="' . $this->get_field_id('text_alt') . '" style="display: inline-block;width: 153px;">Alt Tag Text:</label><input class="widefat" id="' . $this->get_field_id('text_alt') . '" name="' . $this->get_field_name('text_alt') . '" type="text" value="' . esc_attr($text_alt) . '" style="display: inline-block;  width: 200px;margin: 0;" /></p>';

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

		// enqueue script to hide default carousel portfolio option
		wp_enqueue_style( 'image-backend', get_template_directory_uri() . '/lib/widgets_builder/image/css/image-backend.css', '', '1.0.0' );
	}

	// Assign variable values.
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, self::get_defaults() );
		$instance['title']          = strip_tags($new_instance['title']);
		$instance['align']          = $new_instance['align'];
		$instance['link']           = $new_instance['link'];
		$instance['overlay_enable'] = $new_instance['overlay_enable'];
		$instance['size']           = $new_instance['size'];
		$instance['lightbox']       = $new_instance['lightbox'];
		$instance['text_alt']       = $new_instance['text_alt'];
		$instance['animate']        = $new_instance['animate'];
		$instance['delay']          = $new_instance['delay'];

		// Reverse compatibility with $image, now called $attachement_id
		$instance['attachment_id'] = abs( $new_instance['attachment_id'] );
		$instance['imageurl'] = $new_instance['imageurl']; // deprecated

		$instance['aspect_ratio'] = $this->get_image_aspect_ratio( $instance );

		return $instance;
	}

	// Output widget to front-end.
	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );
		if ( !empty( $instance['imageurl'] ) || !empty( $instance['attachment_id'] ) ) {

			$align         = NULL;
			$lightbox      = NULL;
			$animate       = NULL;
			$delay         = NULL;
			$animate_start = NULL;
			$animate_end   = NULL;

			$instance['title']       = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
			$instance['align']       = $instance['align'];
			$instance['link']        = apply_filters( 'image_widget_image_link', esc_url( $instance['link'] ), $args, $instance );
			$overlay_enable          = $instance['overlay_enable'];
			$lightbox                = $instance['lightbox'];
			$text_alt                = $instance['text_alt'];
			$animate                 = $instance['animate'];
			$delay                   = $instance['delay'];

			if ( !defined( 'IMAGE_WIDGET_COMPATIBILITY_TEST' ) ) {
				$instance['attachment_id'] = ( $instance['attachment_id'] > 0 ) ? $instance['attachment_id'] : $instance['image'];
				$instance['attachment_id'] = apply_filters( 'image_widget_image_attachment_id', abs( $instance['attachment_id'] ), $args, $instance );
				$instance['size']          = apply_filters( 'image_widget_image_size', esc_attr( $instance['size'] ), $args, $instance );
			}
			$instance['imageurl'] = apply_filters( 'image_widget_image_url', esc_url( $instance['imageurl'] ), $args, $instance );

			// No longer using extracted vars. This is here for backwards compatibility.
			extract( $instance );
			
			// Assign animation variables
			if ( ! empty( $animate ) and $animate !== 'none' ) {
				$animate_start = '<div class="animated start-' . $animate . '" title="' . $delay . '">';
				$animate_end   = '</div><div class="clearboth"></div>';
			}
			
			$image_img = wp_get_attachment_image_src( $attachment_id, $size, true );
			$image_img_full = wp_get_attachment_image_src( $attachment_id, 'full', true );

			if ( $align == 'left' ) {
				$align = ' style="text-align: left;"';
			} else if ( $align == 'right' ) {
				$align = ' style="text-align: right;"';
			} else if ( $align == 'center' ) {
				$align = ' style="text-align: center;"';
			} else {
				$align = NULL;				
			}

			echo $animate_start;

			if ( $lightbox == 'on' ) {
				echo do_shortcode( '[image image="' . $image_img_full[0] . '" thumb="' . $image_img[0] . '" title="' . $text_alt . '"]' );
			} else if ( empty( $link ) ) {
				echo '<p' . $align .'><img src="' . $image_img[0] . '" alt="' . $text_alt . '" / ></p>';					
			} else if ( $overlay_enable == 'on' ) {
				echo '<div' . $align . ' class="sc-image sc-carousel">';
				echo '<div class="entry-header">';
				echo '<a href="' . $link . '"><img src="' . $image_img[0] . '" alt="' . $text_alt . '" /></a>';
				echo '<div class="image-overlay style2">';
				echo '<div class="image-overlay-inner">';
				echo '<div class="hover-icons">';
				echo '<a class="hover-link" href="' . $link . '"></a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			} else {
				echo '<a href="' . $link . '"><img src="' . $image_img[0] . '" alt="' . $text_alt . '" / ></a>';
			}

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

	// Render an array of default values.
	private static function get_defaults() {

		$defaults = array(
			'title'       => '',
			'link'        => '',
			'image'       => 0, // reverse compatible - now attachement_id
			'imageurl'    => '', // reverse compatible.
		);

		return $defaults;
	}

	// Establish the aspect ratio of the image.
	private function get_image_aspect_ratio( $instance ) {
		if ( !empty( $instance['aspect_ratio'] ) ) {
			return abs( $instance['aspect_ratio'] );
		} else {
			$attachment_id = ( !empty($instance['attachment_id']) ) ? $instance['attachment_id'] : $instance['image'];
			if ( !empty($attachment_id) ) {
				$image_details = wp_get_attachment_image_src( $attachment_id, 'full' );
				if ($image_details) {
					return ( $image_details[1]/$image_details[2] );
				}
			}
		}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_builder_imagetheme");') );


?>