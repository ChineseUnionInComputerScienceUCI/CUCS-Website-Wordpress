<?php
$animate       = NULL;
$delay         = NULL;
$delay_item    = NULL;

$animate       = $atts['animate'];
$delay         = $atts['delay'];
$delay_item    = $atts['delay_item'];

$count         = 0;
?>

<ul class="list iconfont">
<?php foreach((array) $groups['list_item'] as $increment=>$context){ ?>
	<?php
	$count++;

	$indent = NULL;
	$indent = $context['indent'];

	if ( ! empty( $indent ) and $indent !== '0' ) {
		$indent = ' style="margin-left: ' . $indent . 'px;"';	
	} else {
		$indent = NULL;
	}

	// Assign animation variables if set
	if ( ! empty( $animate ) and $animate !== 'none' ) {

		// Assign delay variable
		if ( ! empty( $delay_item ) and $count > 1 ) {
			$delay = $delay + $delay_item;
		}

		$animate_start = '<div class="animated start-' . $animate . '" title="' . $delay . '">';
		$animate_end   = '</div><div class="clearboth"></div>';
	}
	?>
	<li<?php echo $indent; ?>><?php echo $animate_start; ?><i class="fa fa-<?php echo $context['icon']; ?>"></i><?php echo $context['list_item']; ?><?php echo $animate_end; ?></li>
<?php } ?>
</ul>

<?php
// Load animation styles and scripts
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
?>