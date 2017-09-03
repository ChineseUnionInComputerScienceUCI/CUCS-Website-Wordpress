<?php
/**
 * ThinkUpThemes.com Upgrade notice - Ryan Pro Theme
 * 
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://<a title="themeforest" href="http://wplift.com/themeforest">themeforest</a>.net/user/unisphere
 */

function thinkup_update_notifier_menu() {
	$xml = thinkup_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)
	$theme_data = wp_get_theme( $theme_data['Template'] ); // Ensures parent theme data is used when child theme is active
	
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		add_dashboard_page( $theme_data['Name'] . 'Theme Updates', $theme_data['Name'] . '<span class="update-plugins count-1" style="float: right;"><span class="update-count">Update</span></span>', 'administrator', str_replace( ' pro', '', strtolower( $theme_data['Name'] ) ) . '-updates', 'thinkup_update_notifier' );

	function thinkup_update_admin_notice() {
	$xml = thinkup_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)
	$theme_data = wp_get_theme( $theme_data['Template'] ); // Ensures parent theme data is used when child theme is active

	$upgrade_url = admin_url( 'index.php?page=' . str_replace( ' pro', '', strtolower( $theme_data['Name'] ) ) . '-updates' );

    $screen = get_current_screen();

	if ( $screen->id !== 'dashboard_page_' . str_replace( ' pro', '', strtolower( $theme_data['Name'] ) ) . '-updates' ) :
    ?>
    <div id="thinkup-theme-update" class="updated">
        <p><?php echo '<strong>There is a new version of the ' . $theme_data['Name'] . ' theme available.</strong> You have version ' . $theme_data['Version'] . ' installed. Update to version ' . $xml->latest . '. <a href="' . $upgrade_url . '">How do I update?</a>'; ?></p>
    </div>
    <?php
endif;
}
add_action( 'admin_notices', 'thinkup_update_admin_notice' );
	}
}  

add_action('admin_menu', 'thinkup_update_notifier_menu');

function thinkup_update_notifier() { 
	$xml = thinkup_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)
	$theme_data = wp_get_theme( $theme_data['Template'] ); // Ensures parent theme data is used when child theme is active ?>
	
	<style>
		.update-nag {display: none;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>
        
        <div id="screenshot" style="float: left; padding: 0 20px 20px 0;width: 50%;-webkit-box-sizing: border-box;   -moz-box-sizing: border-box;   -ms-box-sizing: border-box;   -o-box-sizing: border-box;   box-sizing: border-box;" >
			<img style="border: 1px solid #ddd;max-width: 100%;" src="<?php echo get_bloginfo( 'template_url' ) . '/screenshot.png'; ?>" />
        </div>
        
		<div id="instructions" style="float: left;width: 50%;">
            <h3 style="margin-top: 5px;">Update Instructions</h3>
            <p>To update your theme please ensure you have activated <?php echo $theme_data['Name']; ?> with your unique API license key. Haven't activated the theme? No problem, you can find your license key here:</p>
			<p><a href="http://www.thinkupthemes.com/my-account/api-keys" target="_blank">www.thinkupthemes.com/my-account/api-keys</a></p>
			<p>Once the API Key for your theme has been activated you can now update quickly and easily without leaving your website. To update please follow the steps below:</p>
            <ul style="list-style: disc;padding-left: 20px;">
				<li>Go to Dashboard -&gt; Updates and press the Check Again button.</li>
				<li>Scroll down to Themes and place a tick in the checkbox next to <?php echo $theme_data['Name']; ?>.</li>
				<li>Press Update Themes.</li>
				<li>Your theme will begin to update and should only take a few seconds to complete.</li>
			</ul>
			<p>Instructions on how to update using your API Key can be found here:</p>
			<p><a href="http://www.thinkupthemes.com/docs/updating-via-wordpress-automatic" target="_blank">Support Center - Update via WordPress (Automatic)</a></p>
            <p style="background: #FFDBDB;  border: 1px solid rgba(0, 0, 0, 0.2);  text-shadow: 1px 1px 0 #FFF;  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5), inset 0 0 40px 0px rgba(0, 0, 0, 0.05);  -moz-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5), inset 0 0 40px 0px rgba(0, 0, 0, 0.05);  -ms-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5), inset 0 0 40px 0px rgba(0, 0, 0, 0.05);  -o-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5), inset 0 0 40px 0px rgba(0, 0, 0, 0.05);  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5), inset 0 0 40px 0px rgba(0, 0, 0, 0.05);padding: 10px;">Note: You must be an active member of either the single theme or club membership. As a member you are entitled to 1 year of free updates and support. If your membership has expired you'll need to either <a href="http://www.thinkupthemes.com/themes/<?php echo str_replace( ' pro', '', strtolower( $theme_data['Name'] ) ); ?>/" target="_blank">purchase <?php echo $theme_data['Name']; ?></a> to update or <a href="http://www.thinkupthemes.com/pricing/" target="_blank">join the Theme Club</a>.</p>
        </div>

		<div class="clear"></div>
	    
	    <h3 class="title">Changelog</h3>
	    <?php echo $xml->changelog; ?>

	</div>
    
<?php } 

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function thinkup_latest_theme_version($interval) {

	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)
	$theme_data = wp_get_theme( $theme_data['Template'] ); // Ensures parent theme data is used when child theme is active
	
	// remote xml file location
	$ryan_notifier_file_url = 'https://dl.dropboxusercontent.com/u/248874002/Updates/Themes/update_' . str_replace( ' pro', '', strtolower( $theme_data['Name'] ) ) . '.xml';

	// Check if Dropbox link is broken
	if( function_exists('curl_init') ) { // if cURL is available, use it...
		$dropbox_ch = curl_init($ryan_notifier_file_url);
		curl_setopt($dropbox_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($dropbox_ch, CURLOPT_HEADER, 0);
		curl_setopt($dropbox_ch, CURLOPT_TIMEOUT, 10);
		$dropbox_check = curl_exec($dropbox_ch);
		curl_close($dropbox_ch);
	} else {
		$dropbox_check = @file_get_contents($ryan_notifier_file_url); // ...if not, use the common file_get_contents()
	}

	// If dropbox is empty then check thinkupcloud.com
	if( empty( $dropbox_check ) ) {

		$thinkup_cloud_prefix = NULL;
		if (empty($_SERVER['HTTPS'])) {
			$thinkup_cloud_prefix = 'http';
		} else {
			$thinkup_cloud_prefix = 'https';	
		}
		$ryan_notifier_file_url = $thinkup_cloud_prefix . '://thinkupcloud.com/cloudfiles/thinkupthemes/updates/themes/update_' . str_replace( ' pro', '', strtolower( $theme_data['Name'] ) ) . '.xml';
	}

	$ryan_db_cache_field = 'ryan_contempo-notifier-cache';
	$ryan_db_cache_field_last_updated = 'ryan_contempo-notifier-last-updated';
	$ryan_last = get_option( $ryan_db_cache_field_last_updated );
	$ryan_now = time();
	// check the cache
	if ( !$ryan_last || (( $ryan_now - $ryan_last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ryan_ch = curl_init($ryan_notifier_file_url);
			curl_setopt($ryan_ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ryan_ch, CURLOPT_HEADER, 0);
			curl_setopt($ryan_ch, CURLOPT_TIMEOUT, 10);
			$ryan_cache = curl_exec($ryan_ch);
			curl_close($ryan_ch);
		} else {
			$ryan_cache = @file_get_contents($ryan_notifier_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($ryan_cache) {			
			// we got good results
			update_option( $ryan_db_cache_field, $ryan_cache );
			update_option( $ryan_db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$ryan_notifier_data = get_option( $ryan_db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$ryan_notifier_data = get_option( $ryan_db_cache_field );
	}
	
	if ( strpos( $ryan_notifier_data,'looking for. Check out our' ) !== false) {
	} else {
		@$ryan_xml = simplexml_load_string($ryan_notifier_data); 
	}
	return $ryan_xml;
}

?>