<?php
/**
  * Name                : Custom Sidebars Generator
  * Description         : This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish. This is a modified version of "Sidebars Generator" plugin by Kyle Getson. http://wordpress.org/extend/plugins/sidebar-generator/
  * Version             : 1.0.3
  * Last edit           : May 08, 2013 18:49
  * Author              : Smartik - http://smartik.ws/
  * Credits             : This plugin was originally created by Kyle Getson - http://www.kylegetson.com/ 
  */

class SidebarGenerator {
	
	/* Initiate the function - Hook the function on to specific actions. */
	public function __construct(){
		add_action('widgets_init', array($this,'init'));
		add_action('admin_menu', array($this,'admin_menu'));
		add_action('admin_print_scripts', array($this,'admin_print_scripts'));
		add_action('wp_ajax_add_sidebar', array($this,'add_sidebar') );
		add_action('wp_ajax_remove_sidebar', array($this,'remove_sidebar') );		
	}
	
	/* Register sidebars - Go through each sidebar and register it. */
	function init(){
		$sidebars = SidebarGenerator::get_sidebars();

		if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = SidebarGenerator::name_to_class($sidebar);
				register_sidebar(array(
					'name'		=> $sidebar,
					'id' => $sidebar,
					'before_widget' => '<aside class="widget '. $sidebar_class .' %2$s">',
					'after_widget' 	=> '</aside>',
					'before_title' 	=> '<h3 class="widget-title">',
					'after_title' 	=> '</h3>',
		    	));
			}
		}
	}
	
	/* Load WP Ajax - Call WP admin AJAX and register js function for add/remove a sidebar. */
	function admin_print_scripts(){
		wp_print_scripts( array( 'sack' ));
		?>
			<script>
				function add_sidebar( sidebar_name )
				{
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "add_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					return true;
				}
				
				function remove_sidebar( sidebar_name,num )
				{
					
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "remove_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.setVar( "row_number", num );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot remove sidebar. Try to remove it after page reload.' )};
				  	mysack.runAJAX();
					return true;
				}
			</script>
		<?php
	}
	
	/**
	 * Add sidebar
	 *
	 * This function creates a new sidebar
	 *
	 * @since 	1.0
	 */
	function add_sidebar(){
		$SidebarGenerator = new SidebarGenerator;
		$sidebars = $SidebarGenerator->get_sidebars();
//		$sidebars = SidebarGenerator::get_sidebars();
		$name = trim( str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']) );
	
		$id = $SidebarGenerator->name_to_class($name);
//		$id = SidebarGenerator::name_to_class($name);
		
		if(isset($sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}
		if($name == 'null'){
			die();
		}
		elseif($name == ''){
			die("alert('Please specify a name for this sidebar.')");
		}
		
		$sidebars[$id] = $name;
		
		$SidebarGenerator->update_sidebars($sidebars);
//		SidebarGenerator::update_sidebars($sidebars);
		
		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);
			
			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);
      		cellLeft.setAttribute('style', 'padding-top: 10px; padding-bottom: 10px; font-weight: 700; color: #FF430A;background:#FFE4E8;');
			
			//second cell
			var cellLeft = row.insertCell(1);
			codeClass = document.createElement('code');
			codeText = document.createTextNode('side-$id');
			codeClass.setAttribute('style', 'padding: 4px 7px; border: 1px solid #bbb;');
			
			codeClass.appendChild(codeText);
      		cellLeft.appendChild(codeClass);
      		cellLeft.setAttribute('style', 'padding-top: 10px; padding-bottom: 10px;background:#FFE4E8;');
			
			//third cell
//			var cellLeft = row.insertCell(2);
//			codeClass = document.createElement('code');
//			codeText = document.createTextNode('[smk_sidebar name=\"$name\"]');
//			codeClass.setAttribute('style', 'padding: 4px 7px; border: 1px solid #bbb;');
//			
//			codeClass.appendChild(codeText);
  //    		cellLeft.appendChild(codeClass);
    //  		cellLeft.setAttribute('style', 'padding-top: 10px; padding-bottom: 10px;background:#FFE4E8;');
			
			//last cell

			var rowc = document.getElementById('sbg_table').rows.length;
			rowc = parseInt(rowc-1);
			
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'return remove_sidebar_link(\'$name\','+rowc+');return false;');
			removeLink.setAttribute('href', 'javascript:void(0)');
			removeLink.setAttribute('style', 'font-weight: 700; color: #D50020');
        
      		removeLink.appendChild(linkText);
      		cellLeft.appendChild(removeLink);
			
      		cellLeft.setAttribute('style', 'padding-top: 10px; padding-bottom: 10px;background:#FFE4E8;');
		";
		
		
		die( "$js");
	}
	
	/**
	 * Remove sidebar
	 *
	 * This function remove a sidebar already created with SidebarGenerator
	 *
	 * @since 	1.0
	 */
	function remove_sidebar(){

		$SidebarGenerator = new SidebarGenerator;
		$sidebars = $SidebarGenerator->get_sidebars();
		
//		$sidebars = SidebarGenerator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);

		$id = $SidebarGenerator->name_to_class($name);
	
//		$id = SidebarGenerator::name_to_class($name);
		if(!isset($sidebars[$id])){
			die("alert('Sidebar does not exist.')");
		}
		$row_number = $_POST['row_number'];
		unset($sidebars[$id]);

		$SidebarGenerator->update_sidebars($sidebars);

//		SidebarGenerator::update_sidebars($sidebars);
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)

		";
		die($js);
	}
	
	/**
	 * Admin menu
	 *
	 * This function creates an admin menu under Appearance tab 
	 *
	 * @since 	1.0
	 */
	function admin_menu(){
		add_theme_page('Sidebars', 'Sidebars', 'administrator',__CLASS__, array($this,'admin_page'));
//		add_theme_page('Sidebars', 'Sidebars', 'SidebarGenerator', __CLASS__, array($this,'admin_page'));
//		add_submenu_page('themes.php', 'Sidebars', 'Sidebars', 'manage_options', __CLASS__, array('SidebarGenerator','admin_page'));
	}
	
	/**
	 * Admin page
	 *
	 * This function creates settings page 
	 *
	 * @since 	1.0
	 */
	function admin_page(){
		?>
		<script>
			function remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = prompt("Sidebar Name:","");
				//alert(sidebar_name);
				add_sidebar(sidebar_name);
			}
		</script>
		<div class="wrap">
			<h2>Custom Sidebars Generator</h2>
			<p>
				The sidebar name is for your use only. It will not be visible to any of your visitors. 
				A CSS class is assigned to each of your sidebar, use this styling to customize the sidebars.<br />
				The sidebar will be added automaticaly to <a href="widgets.php">Widgets</a> page
			</p>
			<br />
			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" class="button-primary" title="Add a sidebar">Add New Sidebar</a>
			</div>
			<br />
			<table class="widefat page" id="sbg_table" style="width:100%;">
				<tr>
					<th>NAME</th>
					<th>CSS CLASS</th>
					<th>REMOVE</th>
				</tr>
				<?php
				$SidebarGenerator = new SidebarGenerator;
				$sidebars = $SidebarGenerator->get_sidebars();
				//$sidebars = array('bob','john','mike','asdf');
				if(is_array($sidebars) && !empty($sidebars)){
					$cnt=0;
					foreach($sidebars as $sidebar){
						$alt = ($cnt%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo $alt?>">
					<td style="padding-top: 10px; padding-bottom: 10px;font-weight: 700;"><?php echo $sidebar; ?></td>
					<td style="padding-top: 10px; padding-bottom: 10px;"><code style="padding: 4px 7px; border: 1px solid #bbb;">side-<?php 
					
//					$SidebarGenerator = new SidebarGenerator;
					echo $SidebarGenerator->name_to_class($sidebar);
					
					?></code></td>
					<td style="padding-top: 10px; padding-bottom: 10px;"><a href="javascript:void(0);" onclick="return remove_sidebar_link('<?php echo $sidebar; ?>',<?php echo $cnt+1; ?>);" style="font-weight: 700; color: #D50020" title="Remove this sidebar">remove</a></td>
				</tr>
				<?php
						$cnt++;
					}
				}
				?>
			</table>
		</div>
		<?php
	}
	
	/**
	 * Update
	 *
	 * This function update the array when a sidebar is added or removed
	 *
	 * @since 	1.0
	 */
	function update_sidebars($sidebar_array){
		$sidebars = update_option('sbg_sidebars',$sidebar_array);
	}	
	
	/**
	 * Get sidebars
	 *
	 * Get all sidebars created with SidebarGenerator
	 *
	 * @since 	1.0
	 */
	function get_sidebars(){
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}
	
	/**
	 * Name to class
	 *
	 * Convert sidebar name to a css class
	 *
	 * @since 	1.0
	 */
	function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
	
	/**
	 * All sidebars
	 *
	 * Get all sidebars, created with SidebarGenerator and already registered
	 *
	 * @since 	1.0
	 */
	function get_all_sidebars(){
		global $wp_registered_sidebars;
		
		$all_sidebars = '';
		
		if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) : 
			
			$sidebars_name = $generated_sidebars = array();
			
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars_name[] 	= $sidebar['name']; 	//get sidebar name
			}

			$SidebarGenerator = new SidebarGenerator;
			$generated_sidebars = $SidebarGenerator->get_sidebars();

//			$generated_sidebars = SidebarGenerator::get_sidebars();

			if($sidebars_name || $generated_sidebars){

				if($sidebars_name && $generated_sidebars)
				{
					$all_sidebars 	= array_merge( 
											array_combine($sidebars_name, $sidebars_name), 
											array_combine($generated_sidebars, $generated_sidebars)
									  );
				}
				else if($sidebars_name && ! $generated_sidebars)
				{
					$all_sidebars 	= array_combine($sidebars_name, $sidebars_name);
				}
				else if($generated_sidebars && ! $sidebars_name)
				{
					$all_sidebars 	= array_combine($generated_sidebars, $generated_sidebars);
				}
				else
				{
					$all_sidebars = array('No sidebars');
				}

			} else {
				$all_sidebars = array('No sidebars');
			}
			//$all_sidebars 		= array_combine($sidebars_name, $sidebars_name);
			
		endif;
		
		return $all_sidebars;
	}
	
	
}//End of CLASS. If you remove this, your theme will die :)

/*  Class, do your job! */
$sbg = new SidebarGenerator;//If you remove this the whole class will not work. Period!

/* Give me a function to create a sidebar easy! */
function smk_custom_dynamic_sidebar($name='Default Sidebar'){
	if(function_exists('dynamic_sidebar') && dynamic_sidebar($name)) : 
	endif;
	return true;
}