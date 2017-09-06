<?php
/*
Plugin Name: Custom Background Changer
Plugin URI: https://wordpress.org/plugins/custom-background-changer/
Description: A WordPress plugin to change different background color or image on post or page.
Version: 2.0
Author: Anshul Labs
Author URI: http://anshullabs.xyz
textdomain: custom_background_changer
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
/*
Copyright 2012  Anshul Labs  (email : hello@anshullabs.xyz)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('CBC_VERSION', '2.0');
define('CBC_FILE', basename(__FILE__));
define('CBC_NAME', str_replace('.php', '', CBC_FILE));
define('CBC_PATH', plugin_dir_path(__FILE__));
define('CBC_URL', plugin_dir_url(__FILE__));
$textdomain = 'custom_background_changer';


/**
 * Loads the color picker and image upload javascript and css
 */
add_action( 'admin_enqueue_scripts', 'cbc_style_script_enqueue' );
function cbc_style_script_enqueue() {
	// add plugin css file.
    wp_enqueue_style( 'cbc-metabox-css', CBC_URL . 'assets/css/cbc-metabox.css' );

	//add color picker script
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'cbc-metabox-js', CBC_URL . 'assets/js/cbc-metabox.js', array( 'jquery','wp-color-picker' ) );

    // Add media uploader script
    wp_enqueue_media();
    wp_localize_script( 'cbc-metabox-js', 'meta_image',
        array(
            'title' => __( 'Choose or Upload an Image', $textdomain ),
            'button' => __( 'Use this image', $textdomain ),
        )
    );
}

/**
 * Adds Custom Background Changer meta box 
 */
add_action( 'add_meta_boxes', 'cbc_custom_background_changer_metabox' );
function cbc_custom_background_changer_metabox() {
    add_meta_box( 'cbc_metafield', __( 'Custom Background Changer', $textdomain ), 'cbc_meta_callback', array('post','page') );
    //add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
}

/*
 * Outputs the content of the meta box
 */
function cbc_meta_callback( $post ) {
	$cbc_storedmeta = get_post_meta( $post->ID );	
	wp_nonce_field( 'cbc_nonce_action', 'cbc_nonce' );
    ?>
    <p>
   		<label for="cbc-bg-option" class="cbc-row-title">
    		<?php _e( 'Background Option :', $textdomain );?>
    	</label>
	    <span class="cbc-row-content" style="display: inline;">
	        <label for="cbc-bg-option-one">
	            <input type="radio" name="cbc-bgoption" id="cbc-bg-option-one" value="on" <?php if ( isset ( $cbc_storedmeta['cbc-bgoption'] ) ) checked( $cbc_storedmeta['cbc-bgoption'][0], 'on' ); ?>>
	            <?php _e( 'On', $textdomain );?>
	        </label>
	        <label for="cbc-bg-option-two">
	            <input type="radio" name="cbc-bgoption" id="cbc-bg-option-two" value="off" <?php if ( isset ( $cbc_storedmeta['cbc-bgoption'] ) ) checked( $cbc_storedmeta['cbc-bgoption'][0], 'off' ); ?>>
	            <?php _e( 'Off', $textdomain );?>
	        </label> 
	    	<span style="clear: both;"></span>
	    </span>
	</p> 
    <p>
    	<label for="cbc-bgcolor" class="cbc-row-title">
    		<?php _e( 'Background Color :', $textdomain );?>
    	</label>
    	<input name="cbc-bgcolor" type="text" value="<?php if ( isset ( $cbc_storedmeta['cbc-bgcolor'] ) ) echo $cbc_storedmeta['cbc-bgcolor'][0]; ?>" class="cbc-bgcolor" />
	</p>
	<p>
	    <label for="cbc-bgimage" class="cbc-row-title">
	    	<?php _e( 'Background Image :', $textdomain );?>
	    </label>
	    <input type="text" name="cbc-bgimage" id="cbc-bgimage" value="<?php if ( isset ( $cbc_storedmeta['cbc-bgimage'] ) ) echo $cbc_storedmeta['cbc-bgimage'][0]; ?>" />
	    <input type="button" id="cbc-bgimage-button" class="button" value="<?php _e( 'Choose or Upload an Image', $textdomain )?>" />
	</p>
	<p>
   		<label for="cbc-bg-attach" class="cbc-row-title">
    		<?php _e( 'Background Attachment :', $textdomain );?>
    	</label>
	    <span class="cbc-row-content" style="display: inline;">
	        <label for="cbc-bg-attach-one">
	            <input type="radio" name="cbc-bgattach" id="cbc-bg-attach-one" value="scroll" <?php if ( isset ( $cbc_storedmeta['cbc-bgattach'] ) ) checked( $cbc_storedmeta['cbc-bgattach'][0], 'scroll' ); ?>>
	            <?php _e( 'Scroll', $textdomain );?>
	        </label>
	        <label for="cbc-bg-attach-two">
	            <input type="radio" name="cbc-bgattach" id="cbc-bg-attach-two" value="fixed" <?php if ( isset ( $cbc_storedmeta['cbc-bgattach'] ) ) checked( $cbc_storedmeta['cbc-bgattach'][0], 'fixed' ); ?>>
	            <?php _e( 'Fixed', $textdomain );?>
	        </label> 
	    	<span style="clear: both;"></span>
	    </span>
	</p>
	<p>
	    <label for="cbc-bgrepeat" class="cbc-row-title">
	    	<?php _e( 'Background Repeat :', $textdomain );?>
	   	</label>
	    <select name="cbc-bgrepeat" id="cbc-bgrepeat">
	        <option value="no-repeat" <?php if ( isset ( $cbc_storedmeta['cbc-bgrepeat'] ) ) selected( $cbc_storedmeta['cbc-bgrepeat'][0], 'no-repeat' ); ?>>
	        	<?php _e( 'No Repeat', $textdomain );?>
	        </option>';
	        <option value="repeat" <?php if ( isset ( $cbc_storedmeta['cbc-bgrepeat'] ) ) selected( $cbc_storedmeta['cbc-bgrepeat'][0], 'repeat' ); ?>>
	        	<?php _e( 'Repeated', $textdomain ); ?>
	        </option>';
	        <option value="repeat-x" <?php if ( isset ( $cbc_storedmeta['cbc-bgrepeat'] ) ) selected( $cbc_storedmeta['cbc-bgrepeat'][0], 'repeat-x' ); ?>>
	        	<?php _e( 'Repeated Horizontally', $textdomain );?>
	        </option>';
	        <option value="repeat-y" <?php if ( isset ( $cbc_storedmeta['cbc-bgrepeat'] ) ) selected( $cbc_storedmeta['cbc-bgrepeat'][0], 'repeat-y' ); ?>>
	        	<?php _e( 'Repeated Vertically', $textdomain );?>
	        </option>';
	    </select>
	</p>

	<p>
	    <label for="cbc-bgposition" class="cbc-row-title">
	    	<?php _e( 'Background Position :', $textdomain );?>
	    </label>
	    <select name="cbc-bgposition" id="cbc-bgposition">
	        <option value="left" <?php if ( isset ( $cbc_storedmeta['cbc-bgposition'] ) ) selected( $cbc_storedmeta['cbc-bgposition'][0], 'left' ); ?>> <?php _e( 'Left', $textdomain );?> </option>';
	        <option value="center" <?php if ( isset ( $cbc_storedmeta['cbc-bgposition'] ) ) selected( $cbc_storedmeta['cbc-bgposition'][0], 'center' ); ?>><?php _e( 'Center', $textdomain );?> </option>';
	        <option value="right" <?php if ( isset ( $cbc_storedmeta['cbc-bgposition'] ) ) selected( $cbc_storedmeta['cbc-bgposition'][0], 'right' ); ?>><?php _e( 'Right', $textdomain );?> </option>';        
	    </select>
	</p>
<?php
}

/**
 * Saves the custom meta input
 */
add_action( 'save_post', 'cbc_metafield_save' );
function cbc_metafield_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'cbc_nonce' ] ) && wp_verify_nonce( $_POST[ 'cbc_nonce' ], 'cbc_nonce_action' ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks and save CBC Background Option.
	if( isset( $_POST[ 'cbc-bgoption' ] ) ) {
	    update_post_meta( $post_id, 'cbc-bgoption', sanitize_text_field( $_POST['cbc-bgoption'] ) );
	}

	// Checks and Save CBC Background Color Code.
	if( isset( $_POST[ 'cbc-bgcolor' ] ) ) {
	    update_post_meta( $post_id, 'cbc-bgcolor', sanitize_text_field( $_POST['cbc-bgcolor'] ) );
	}

	// Checks and save CBC Background Image URL
	if( isset( $_POST[ 'cbc-bgimage' ] ) ) {
	    update_post_meta( $post_id, 'cbc-bgimage', esc_url($_POST['cbc-bgimage']) );
	}


	// Checks and save CBC Background Attachment type.
	if( isset( $_POST[ 'cbc-bgattach' ] ) ) {
	    update_post_meta( $post_id, 'cbc-bgattach', sanitize_text_field( $_POST['cbc-bgattach'] ) );
	}

	// Checks and save CBC Background Repeat.
	if( isset( $_POST[ 'cbc-bgrepeat' ] ) ) {
	    update_post_meta( $post_id, 'cbc-bgrepeat', sanitize_text_field( $_POST['cbc-bgrepeat'] ) );
	}

	// Checks and save CBC Background Position.
	if( isset( $_POST[ 'cbc-bgposition' ] ) ) {
	    update_post_meta( $post_id, 'cbc-bgposition', sanitize_text_field( $_POST['cbc-bgposition'] ) );
	}
}

/*
 * Add Custom Background Changer CSS class in body by filter
 */
add_filter( 'body_class', 'cbc_add_body_class' );
function cbc_add_body_class( $classes ) {
	// add 'class-name' to the $classes array
	$classes[] = 'cbc-page';
	// return the $classes array
	return $classes;
}

/*
 * add background property in color header file.
 */
add_action( 'wp_head', 'cbc_call_style_header' );
function cbc_call_style_header() {
	global $post;
	$cbc['bgoption']   =  get_post_meta( $post->ID, 'cbc-bgoption', true );
	$cbc['bgcolor']    =  get_post_meta( $post->ID, 'cbc-bgcolor', true );
	$cbc['bgimage']    =  get_post_meta( $post->ID, 'cbc-bgimage', true );
	$cbc['bgattach']   =  get_post_meta( $post->ID, 'cbc-bgattach', true );
	$cbc['bgrepeat']   =  get_post_meta( $post->ID, 'cbc-bgrepeat', true );
	$cbc['bgposition'] =  get_post_meta( $post->ID, 'cbc-bgposition', true );

	if ( $cbc['bgoption']=='off' || empty($cbc['bgoption']) || $cbc['bgoption'] =='' || is_home() || is_category() || is_archive() ) {
		return;
	}

	$out = '';
	if ( $cbc['bgoption']=='on' ){
		$out .= '<style type="text/css">';
		$out .= 'html body.cbc-page{';

		// check and set background color
		if (!empty($cbc['bgcolor'])) {
			$out .= 'background-color: '.sanitize_text_field($cbc['bgcolor']).';';
		}

		// check and set background image
		if (!empty($cbc['bgimage'])) {
			$out .= 'background-image: url("'.esc_url($cbc['bgimage']).'");';
		}

		// check and set background attachment type.
		if (!empty($cbc['bgattach'])) {
			$out .= 'background-attachment: '.sanitize_text_field($cbc['bgattach']).';';
		}

		// check and set background repeat style
		if (!empty($cbc['bgrepeat'])) {
			$out .= 'background-repeat: '.sanitize_text_field($cbc['bgrepeat']).';';
		}

		// check and set background position.
		if (!empty($cbc['bgposition'])) {
			$out .= 'background-position: top '.sanitize_text_field($cbc['bgposition']).';';
		}

		$out .= '}';
		$out .= '</style>';
	}
	echo $out;
}	
?>