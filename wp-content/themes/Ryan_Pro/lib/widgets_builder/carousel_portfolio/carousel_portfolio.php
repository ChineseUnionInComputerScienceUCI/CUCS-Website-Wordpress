<?php
/**
 * Add Title Page Builder Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Categories
---------------------------------------------------------------------------------- */

class thinkup_builder_carouselportfoliotheme extends WP_Widget {

	/* Register widget description. */
	public function __construct() {
		$widget_ops = array('classname' => 'thinkup_builder_carouselportfoliotheme', 'description' => 'Add a portfolio carousel to your content.' );
		parent::__construct('thinkup_builder_carouselportfoliotheme', 'Portfolio (Carousel)', $widget_ops);
	}

	/* Add widget structure to Admin area. */
	function form($instance) {
		$default_entries = array( 
			'title'          => '',
			'items'          => '', 
			'scroll'         => '', 
			'speed'          => '', 
			'effect'         => '', 
			'link_icon'      => '', 
			'lightbox_icon'  => '', 
			'toggle_title'   => '', 
			'toggle_details' => '', 
			'content_style'  => '', 
			'category'       => '',
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title          = $instance['title'];
		$items          = $instance['items'];
		$scroll         = $instance['scroll'];
		$speed          = $instance['speed'];
		$effect         = $instance['effect'];
		$link_icon      = $instance['link_icon']; 
		$lightbox_icon  = $instance['lightbox_icon'];
		$toggle_title   = $instance['toggle_title'];
		$toggle_details = $instance['toggle_details'];
		$content_style  = $instance['content_style'];
		$category       = $instance['category'];

		echo '<p><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 150px;">Module Title:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('items') . '" style="display: inline-block;width: 150px;" >Items:</label>
			<select name="' . $this->get_field_name('items') . '" id="' . $this->get_field_id('items') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($items == "2") { echo "selected"; } ?><?php echo ' value="2">2</option>
			<option '; ?><?php if($items == "3") { echo "selected"; } ?><?php echo ' value="3">3</option>
			<option '; ?><?php if($items == "4") { echo "selected"; } ?><?php echo ' value="4">4</option>
			<option '; ?><?php if($items == "5") { echo "selected"; } ?><?php echo ' value="5">5</option>
			<option '; ?><?php if($items == "6") { echo "selected"; } ?><?php echo ' value="6">6</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('scroll') . '" style="display: inline-block;width: 150px;" >Scroll:</label>
			<select name="' . $this->get_field_name('scroll') . '" id="' . $this->get_field_id('scroll') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($scroll == "1") { echo "selected"; } ?><?php echo ' value="1">1</option>
			<option '; ?><?php if($scroll == "2") { echo "selected"; } ?><?php echo ' value="2">2</option>
			<option '; ?><?php if($scroll == "3") { echo "selected"; } ?><?php echo ' value="3">3</option>
			<option '; ?><?php if($scroll == "4") { echo "selected"; } ?><?php echo ' value="4">4</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('speed') . '" style="display: inline-block;width: 150px;">Speed:</label><input class="widefat" id="' . $this->get_field_id('speed') . '" name="' . $this->get_field_name('speed') . '" type="text" value="' . esc_attr($speed) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('effect') . '" style="display: inline-block;width: 150px;" >Effect:</label>
			<select name="' . $this->get_field_name('effect') . '" id="' . $this->get_field_id('effect') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($effect == "none") { echo "selected"; } ?><?php echo ' value="none">None</option>
			<option '; ?><?php if($effect == "scroll") { echo "selected"; } ?><?php echo ' value="scroll">Scroll</option>
			<option '; ?><?php if($effect == "directscroll") { echo "selected"; } ?><?php echo ' value="directscroll">Direct Scroll</option>
			<option '; ?><?php if($effect == "fade") { echo "selected"; } ?><?php echo ' value="fade">Fade</option>
			<option '; ?><?php if($effect == "crossfade") { echo "selected"; } ?><?php echo ' value="crossfade">Crossfade</option>
			<option '; ?><?php if($effect == "cover") { echo "selected"; } ?><?php echo ' value="cover">Cover</option>
			<option '; ?><?php if($effect == "cover-fade") { echo "selected"; } ?><?php echo ' value="cover-fade">Coverfade</option>
			<option '; ?><?php if($effect == "uncover") { echo "selected"; } ?><?php echo ' value="uncover">Uncover</option>
			<option '; ?><?php if($effect == "uncover-fade") { echo "selected"; } ?><?php echo ' value="uncover-fade">Uncover Fade</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('link_icon') . '" style="display: inline-block;width: 150px;">Hide Link Icon?</label>&nbsp;<input id="' . $this->get_field_id('link_icon') . '" name="' . $this->get_field_name('link_icon') . '" type="checkbox" '; ?><?php if($link_icon == "on") { echo 'checked=checked'; } ?><?php echo ' /></p>';
			
		echo '<p><label for="' . $this->get_field_id('lightbox_icon') . '" style="display: inline-block;width: 150px;">Hide Lightbox Icon?</label>&nbsp;<input id="' . $this->get_field_id('lightbox_icon') . '" name="' . $this->get_field_name('lightbox_icon') . '" type="checkbox" '; ?><?php if($lightbox_icon == "on") { echo 'checked=checked'; } ?><?php echo ' /></p>';

		echo '<p><label for="' . $this->get_field_id('toggle_title') . '" style="display: inline-block;width: 150px;" >Toggle Project Title:</label>
			<select name="' . $this->get_field_name('toggle_title') . '" id="' . $this->get_field_id('toggle_title') . '" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($toggle_title == "off") { echo "selected"; } ?><?php echo ' value="off">off</option>
			<option '; ?><?php if($toggle_title == "on") { echo "selected"; } ?><?php echo ' value="on">on</option>
			</select>
		</p>';
		
		echo '<p><label for="' . $this->get_field_id('toggle_details') . '" style="display: inline-block;width: 150px;" >Toggle Project Excerpt:</label>
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

		echo '<p><label for="' . $this->get_field_id('category') . '" style="display: inline-block;width: 150px;">Category ID ( 0 = all ):</label><input class="widefat" id="' . $this->get_field_id('category') . '" name="' . $this->get_field_name('category') . '" type="text" value="' . esc_attr($category) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		// enqueue script to hide default carousel portfolio option
		wp_enqueue_style( 'carousel-portfolio-backend', get_template_directory_uri() . '/lib/widgets_builder/carousel_portfolio/css/carousel-portfolio-backend.css', '', '1.0.0' );
	}

	/* Assign variable values. */
	function update($new_instance, $old_instance) {
		$instance                   = $old_instance;
		$instance['title']          = $new_instance['title'];
		$instance['items']          = $new_instance['items'];
		$instance['scroll']         = $new_instance['scroll'];
		$instance['speed']          = $new_instance['speed'];
		$instance['effect']         = $new_instance['effect'];
		$instance['link_icon']      = $new_instance['link_icon']; 
		$instance['lightbox_icon']  = $new_instance['lightbox_icon'];
		$instance['toggle_title']   = $new_instance['toggle_title'];
		$instance['toggle_details'] = $new_instance['toggle_details'];
		$instance['content_style']  = $new_instance['content_style'];
		$instance['category']       = $new_instance['category'];
		return $instance;
	}

	/* Output widget to front-end. */
	function widget($args, $instance) {

		$items          = $instance['items'];
		$scroll         = $instance['scroll'];
		$speed          = $instance['speed'];
		$effect         = $instance['effect'];
		$link_icon      = $instance['link_icon']; 
		$lightbox_icon  = $instance['lightbox_icon'];
		$toggle_title   = $instance['toggle_title'];
		$toggle_details = $instance['toggle_details'];
		$content_style  = $instance['content_style'];
		$category       = $instance['category'];
		
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

		echo '<div class="carousel-portfolio-builder">';

		echo do_shortcode( '[carousel_portfolio items="' . $items .'" scroll="' . $scroll . '" speed="' . $speed . '" effect="' . $effect . '" link_icon="' . $link_icon . '" lightbox_icon="' . $lightbox_icon . '" title="' . $toggle_title . '" details="' . $toggle_details . '" content_style="' . $content_style . '" category="' . $category . '"]' );

		echo '</div>';
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_builder_carouselportfoliotheme");') );

?>