<?php
/**
 *  Name - Installer Panel
 *  Dependency - Core Admin Class
 *  Version - 1.0
 *  Code Name - Nobody
 */

class IOAEasyFrontInstaller extends PLUGIN_IOA_PANEL_CORE {
	
	
	// init menu
	function __construct () { 

		add_action('admin_menu',array(&$this,'manager_admin_menu'));
        add_action('admin_init',array(&$this,'manager_admin_init'));
        
	 }
	
	// setup things before page loads , script loading etc ...
	function manager_admin_init(){	 }	
	
	function manager_admin_menu(){
		
		add_theme_page('Demo Content', 'Demo Content', 'edit_theme_options', 'easint' ,array($this,'manager_admin_wrap'));
		  
				  
	  }

	
	/**
	 * Main Body for the Panel
	 */

	function panelmarkup(){	
	   global $easy_metadata;

		if( (isset($_GET['page']) && $_GET['page'] == 'easint') && isset($_GET['demo_install'])  ) :
			easy_import_start();
			EASYFInstallerHelper::beginInstall();

		endif; 
		
		?>
		
		<?php if(isset($_GET['demo_install'])): easy_success_notification(); endif; ?>

		<div class="demo-installer clearfix">
			<h2><?php echo $easy_metadata['data']->panel_title ?></h2>
			
			<p><?php echo $easy_metadata['data']->panel_text ?></p>	
			
			<a href="<?php echo admin_url() ?>themes.php?page=easint&amp;demo_install=true" class="button-install"><?php _e( 'Install Demo Content', 'ryan' ) ?></a>

		</div>			



		<?php
	

	    
	 }
	 

}

new IOAEasyFrontInstaller();