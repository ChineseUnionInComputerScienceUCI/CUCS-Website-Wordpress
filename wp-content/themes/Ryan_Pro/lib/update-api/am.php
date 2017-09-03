<?php

/**
 ******************************************************************************************************
 *	Todd Lahman support staff will integrate this code into your product for a small fee.
 *
 *	Visit https://www.toddlahman.com/shop/api-code-integration/ to get started.
 ******************************************************************************************************
 *
 *	Intellectual Property rights, and copyright, reserved by Todd Lahman, LLC as allowed by law include,
 *	but are not limited to, the working concept, function, and behavior of this plugin,
 *	the logical code structure and expression as written.
 *
 *
 * @author      Todd Lahman LLC https://www.toddlahman.com
 * @copyright   Copyright (c) Todd Lahman LLC
 */

/**
 * Displays an inactive message if the API License Key has not yet been activated
 */
if ( get_option( ThinkUp_Update_Theme_API_Class::theme_name() . '_activated' ) != 'Activated' ) {
	add_action( 'admin_notices', 'ThinkUp_Update_Theme_API_Class::thinkup_update_theme_inactive_notice' );

	// Remove theme mods (if set) when API key is not activated
	remove_theme_mod( $tut_message_API );
}

/**
* ThinkUpThemes customization
* Adding tut_message admin messages
*/

if ( get_option( ThinkUp_Update_Theme_API_Class::theme_name() . '_activated' ) == 'Activated' ) {
	add_action( 'admin_notices', 'ThinkUp_Update_Theme_API_Class::thinkup_update_theme_tut_message_notice' );
}

// Remove theme mods (if set) on theme switch
function thinkup_apikey_remove_mods () {
	remove_theme_mod( $tut_message_API );
}
add_action('switch_theme', 'thinkup_apikey_remove_mods');

/**
* End of customization
*/

class ThinkUp_Update_Theme_API_Class {

	/**
	 * Self Upgrade Values
	 */
	// Base URL to the remote upgrade API server
	public $upgrade_url; // URL to access the Update API Manager.

	/**
	 * @var string
	 * This version is saved after an upgrade to compare this db version to $version
	 */
	public $thinkup_update_theme_version_name;

	/**
	 * @var string
	 */
	public $theme_url;

	/**
	 * @var string
	 */
	public $theme_name;

	/**
	 * @var string
	 */
	public $version;

	/**
	 * @var ojb
	 */
	private $my_theme;

	/**
	 * @var string
	 * used to defined localization for translation, but a string literal is preferred
	 *
	 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/issues/59
	 * http://markjaquith.wordpress.com/2011/10/06/translating-wordpress-plugins-and-themes-dont-get-clever/
	 * http://ottopress.com/2012/internationalization-youre-probably-doing-it-wrong/
	 */
	public $text_domain;

	/**
	 * Data defaults
	 * @var mixed
	 */
	private $ame_software_product_id;

	public $ame_data_key;
	public $ame_api_key;
	public $ame_activation_email;
	public $ame_product_id_key;
	public $ame_instance_key;
	public $ame_deactivate_checkbox_key;
	public $ame_activated_key;

	public $ame_deactivate_checkbox;
	public $ame_activation_tab_key;
	public $ame_deactivation_tab_key;
	public $ame_settings_menu_title;
	public $ame_settings_title;
	public $ame_menu_tab_activation_title;
	public $ame_menu_tab_deactivation_title;

	public $ame_options;
	public $ame_plugin_name;
	public $ame_product_id;
	public $ame_renew_license_url;
	public $ame_instance_id;
	public $ame_domain;
	public $ame_software_version;
	public $ame_plugin_or_theme;

	public $ame_update_version;

	public $ame_update_check = 'thinkup_update_theme_update_check';

	public $api_manager_theme_example_key;

	/**
	 * Used to send any extra information.
	 * @var mixed array, object, string, etc.
	 */
	public $ame_extra;

    /**
     * @var The single instance of the class
     */
    protected static $_instance = null;

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
        	self::$_instance = new self();
        }

        return self::$_instance;
    }

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.2
	 */
	private function __clone() {}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.2
	 */
	private function __wakeup() {}

	public function __construct() {

		if ( is_admin() ) {

			// Check for external connection blocking
			add_action( 'admin_notices', array( $this, 'check_external_blocking' ) );

			add_action( 'admin_init', array( $this, 'activation' ) );

			$this->upgrade_url = THINKUP_UPDATE_THEME_UPRADE_URL;

			$this->text_domain = THINKUP_UPDATE_THEME_TEXT_DOMAIN;

			$this->child_theme = wp_get_theme(); // Get theme data
            $this->my_theme    = wp_get_theme( $this->child_theme['Template'] ); // ThinkUpThemes Customization - Use parent theme name if child theme is activated

			$this->theme_name = strtolower( str_replace(' ', '', $this->my_theme->get( 'Name' ) ) );

			// Get folder name of parent theme - ThinkUpThemes Customization
			if ( $this->child_theme->get( 'Template' ) != '' ) {
				$this->theme_folder = $this->child_theme->get( 'Template' );
			} else {
				$this->theme_folder = get_stylesheet();
			}

			// Set the version based on the style.css Version
			$this->version = $this->my_theme->get( 'Version' );

			// This version is saved after an upgrade to compare this db version to $version
			$this->thinkup_update_theme_version_name = $this->theme_name . '_version';

			/**
			 * Set all data defaults here
			 */
			$this->ame_data_key 				= $this->theme_name;
			$this->ame_api_key 					= 'api_key';
			$this->ame_activation_email 		= 'activation_email';
			$this->ame_product_id_key 			= $this->theme_name . '_product_id';
			$this->ame_instance_key 			= $this->theme_name . '_instance';
			$this->ame_deactivate_checkbox_key 	= $this->theme_name . '_deactivate_checkbox';
			$this->ame_activated_key 			= $this->theme_name . '_activated';

			/**
			 * Set all admin menu data
			 */
			$this->ame_deactivate_checkbox 			= 'am_deactivate_example_checkbox';
			$this->ame_activation_tab_key 			= $this->theme_name . '_dashboard';
			$this->ame_deactivation_tab_key 		= $this->theme_name . '_deactivation';
			$this->ame_settings_menu_title 			= THINKUP_UPDATE_THEME_SETTINGS_MENU_TITLE;
			$this->ame_settings_title 				= THINKUP_UPDATE_THEME_SETTINGS_TITLE;
			$this->ame_menu_tab_activation_title 	= __( 'License Activation', 'api-manager-example' );
			$this->ame_menu_tab_deactivation_title 	= __( 'License Deactivation', 'api-manager-example' );

			/**
			 * Set all software update data here
			 */
			$this->ame_options 				= get_option( $this->ame_data_key );
//			$this->ame_plugin_name 			= get_stylesheet();
			$this->ame_plugin_name 			= $this->theme_folder; // ThinkUpThemes Customization - Allows updates when using child theme

			// Gets the Theme Name from the stylesheet
			$this->ame_product_id 			= trim( $this->my_theme->get( 'Name' ) ); // Software Title
			$this->ame_renew_license_url 	= THINKUP_UPDATE_THEME_RENEW_LICENSE_URL; // URL to renew a license
			$this->ame_instance_id 			= get_option( $this->ame_instance_key ); // Instance ID (unique to each blog activation)

			/**
			 * Some web hosts have security policies that block the : (colon) and // (slashes) in http://,
			 * so only the host portion of the URL can be sent. For example the host portion might be
			 * www.example.com or example.com. http://www.example.com includes the scheme http,
			 * and the host www.example.com.
			 * Sending only the host also eliminates issues when a client site changes from http to https,
			 * but their activation still uses the original scheme.
			 * To send only the host, use a line like the one below:
			 *
			 * $this->ame_domain = str_ireplace( array( 'http://', 'https://' ), '', home_url() ); // blog domain name
			 */
			$this->ame_domain 				= str_ireplace( array( 'http://', 'https://' ), '', home_url() ); // blog domain name
			$this->ame_software_version 	= $this->version; // The software version
			$this->ame_plugin_or_theme 		= 'theme'; // 'theme' or 'plugin'

			/**
			 * Software Product ID is the product title string
			 * This value must be unique, and it must match the API tab for the product in WooCommerce
			 * Gets the theme name from the stylesheet Theme Name:
			 * For example Theme Name: Testtheme
			 * Testtheme would then need to be the Software Title in the product edit API tab data field
			 */
			$this->ame_software_product_id = __( $this->ame_product_id, 'api-manager-example' );

			// Performs activations and deactivations of API License Keys
			require_once( 'classes/class-wc-key-api.php' );
			$this->api_manager_theme_example_key = new ThinkUp_Update_Theme_Key();

			// Checks for software updatess
			require_once( 'classes/class-wc-plugin-update.php' );

			// Admin menu with the license key and license email form
			require_once( 'admin/class-wc-api-manager-menu.php' );

			$options = get_option( $this->ame_data_key );

			/**
			 * Check for software updates
			 */
			if ( ! empty( $options ) && $options !== false ) {

				$this->update_check(
					$this->upgrade_url,
//					$this->ame_plugin_name,
					$this->theme_folder, // ThinkUpThemes Customization - Allows updates when using child theme
					$this->ame_product_id,
					$this->ame_options[$this->ame_api_key],
					$this->ame_options[$this->ame_activation_email],
					$this->ame_renew_license_url,
					$this->ame_instance_id,
					$this->ame_domain,
					$this->ame_software_version,
					$this->ame_plugin_or_theme,
					$this->text_domain
					);

			}

			// remotely deactivate license upon switching away from this theme
			add_action( 'switch_theme', array( $this, 'uninstall' ) );

		}

	}

	/** Load Shared Classes as on-demand Instances **********************************************/

	/**
	 * Update Check Class.
	 *
	 * @return ThinkUp_Update_Theme_Update_API_Check
	 */
	public function update_check( $upgrade_url, $plugin_name, $product_id, $api_key, $activation_email, $renew_license_url, $instance, $domain, $software_version, $plugin_or_theme, $text_domain, $extra = '' ) {

		return ThinkUp_Update_Theme_Update_API_Check::instance( $upgrade_url, $plugin_name, $product_id, $api_key, $activation_email, $renew_license_url, $instance, $domain, $software_version, $plugin_or_theme, $text_domain, $extra );
	}

	public static function theme_name( $normalize = false ) {
		$my_theme = wp_get_theme();
		$my_theme = wp_get_theme( $my_theme['Template'] ); // ThinkUpThemes Customization - Use parent theme name if child theme is activated

		if ( $normalize == false ) {
			return strtolower( str_replace(' ', '', $my_theme->get( 'Name' ) ) );
		} else {
			return $my_theme->get( 'Name' );
		}
	}

	/**
	 * Gets a properly formed URL, even for child themes
	 * @return string
	 */
	public function theme_url() {
		if ( isset( $this->theme_url ) ) {
			return $this->theme_url;
		}

		return $this->theme_url = get_template_directory_uri() . '/';
	}

	/**
	 * Generate the default data arrays
	 */
	public function activation() {

		if ( get_option( $this->theme_name ) === false || get_option( $this->theme_name . '_instance' ) === false ) {

			global $wpdb;

			$global_options = array(
				$this->ame_api_key 				=> '',
				$this->ame_activation_email 	=> '',
						);

			update_option( $this->ame_data_key, $global_options );

			require_once( 'classes/class-wc-api-manager-passwords.php' );

			$api_manager_theme_example_password_management = new ThinkUp_Update_Theme_Password_Management();

			// Generate a unique installation $instance id
			$instance = $api_manager_theme_example_password_management->generate_password( 12, false );

			$single_options = array(
				$this->ame_product_id_key 			=> $this->ame_software_product_id,
				$this->ame_instance_key 			=> $instance,
				$this->ame_deactivate_checkbox_key 	=> 'on',
				$this->ame_activated_key 			=> 'Deactivated',
				);

			foreach ( $single_options as $key => $value ) {
				update_option( $key, $value );
			}

			$curr_ver = get_option( $this->thinkup_update_theme_version_name );

			// checks if the current plugin version is lower than the version being installed
			if ( version_compare( $this->version, $curr_ver, '>' ) ) {
				// update the version
				update_option( $this->thinkup_update_theme_version_name, $this->version );
			}

		}

	}

	/**
	 * Deletes all data using the Deactivate API License Key checkbox
	 * @return void
	 */
	public function uninstall() {
		global $wpdb, $blog_id;

		$this->license_key_deactivation();

		// Remove options
		if ( is_multisite() ) {

			switch_to_blog( $blog_id );

			foreach ( array(
					$this->ame_data_key,
					$this->ame_product_id_key,
					$this->ame_instance_key,
					$this->ame_deactivate_checkbox_key,
					$this->ame_activated_key,
					) as $option) {

					delete_option( $option );

					}

			restore_current_blog();

		} else {

			foreach ( array(
					$this->ame_data_key,
					$this->ame_product_id_key,
					$this->ame_instance_key,
					$this->ame_deactivate_checkbox_key,
					$this->ame_activated_key
					) as $option) {

					delete_option( $option );

					}

		}

        /**
         * ThinkUpThemes customization
         * delete the transient on theme switch
         *
         */
        delete_option('_site_transient_update_themes');


	}

	/**
	 * Deactivates the license on the API server
	 * @return void
	 */
	public function license_key_deactivation() {

		$activation_status = get_option( $this->ame_activated_key );

		$api_email = $this->ame_options[$this->ame_activation_email];
		$api_key = $this->ame_options[$this->ame_api_key];

		$args = array(
			'email' => $api_email,
			'licence_key' => $api_key,
			);

		if ( $activation_status == 'Activated' && $api_key != '' && $api_email != '' ) {
			$this->api_manager_theme_example_key->deactivate( $args ); // reset license key activation
		}
	}

    /**
     * Displays an inactive notice when the software is inactive.
     */
	public static function thinkup_update_theme_inactive_notice() { ?>
		<?php if ( ! current_user_can( 'manage_options' ) ) return; ?>
		<?php if ( isset( $_GET['page'] ) && self::theme_name() . '_dashboard' == $_GET['page'] ) return; ?>
		<div id="message" class="error">
			<p><?php printf( __( 'The %s API License Key has not been activated, so the theme is inactive! %sClick here%s to activate the license key and the theme.', 'api-manager-example' ), self::theme_name( true ), '<a href="' . esc_url( admin_url( 'options-general.php?page=' . self::theme_name() . '_dashboard' ) ) . '">', '</a>' ); ?></p>
		</div>
		<?php
	}

	/**
	* ThinkUpThemes customization
	* Adding tut_message responses (e.g. renewal, expiry, etc...)
	*/

    /**
     * Displays the tut_message response if set.
     */
	public static function thinkup_update_theme_tut_message_notice() {	

		$tut_message = get_theme_mod( $tut_message_API );

			if ( ! empty( $tut_message ) ) {
			?>
			<div class="error">
				<p><?php _e( $tut_message, 'lan-thinkupthemes'  ); ?></p>
			</div>
			<?php
			}
	}

	/**
	* End of customization
	*/

	/**
	 * Check for external blocking contstant
	 * @return string
	 */
	public function check_external_blocking() {
		// show notice if external requests are blocked through the WP_HTTP_BLOCK_EXTERNAL constant
		if( defined( 'WP_HTTP_BLOCK_EXTERNAL' ) && WP_HTTP_BLOCK_EXTERNAL === true ) {

			// check if our API endpoint is in the allowed hosts
			$host = parse_url( $this->upgrade_url, PHP_URL_HOST );

			if( ! defined( 'WP_ACCESSIBLE_HOSTS' ) || stristr( WP_ACCESSIBLE_HOSTS, $host ) === false ) {
				?>
				<div class="error">
					<p><?php printf( __( '<b>Warning!</b> You\'re blocking external requests which means you won\'t be able to get %s updates. Please add %s to %s.', 'api-manager-example' ), $this->ame_product_id, '<strong>' . $host . '</strong>', '<code>WP_ACCESSIBLE_HOSTS</code>'); ?></p>
				</div>
				<?php
			}

		}
	}

} // End of class

function THINKUP_UPDATE_THEME_API() {
    return ThinkUp_Update_Theme_API_Class::instance();
}

// Initialize the class instance only once
THINKUP_UPDATE_THEME_API();
