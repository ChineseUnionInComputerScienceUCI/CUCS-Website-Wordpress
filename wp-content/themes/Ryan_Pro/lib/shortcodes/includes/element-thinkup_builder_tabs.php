<?php
$style     = NULL;
$icon      = NULL;
$active    = NULL;
$increment = NULL;
$position  = NULL;
$count     = NULL;

$style     = $atts['style'];
$position  = $atts['position'];


if ( empty( $style ) ) {
	$style = 'style1';
}
if( ! empty( $position ) ) {
	$class_position = ' tab-buttons-' . $position;
}

	// Determine width of list items if tabs are set to be full-width
	if( $position == 'full' ) {
		?><?php foreach((array) $groups['title'] as $increment=>$context){ ?><?php
	
		$count = $count + 1;
	
		?><?php } ?><?php

		$count_buttons = ' style="width:' . ( 100 / $count ) . '%"';
	} else if( $position == 'center' ) {
		?><script>
		jQuery( document ).ready( function() {
		var tab_width = jQuery( '#<?php echo $instanceID; ?> ul' ).width();
			jQuery( '#<?php echo $instanceID; ?> ul' ).width( tab_width );
			jQuery( '#<?php echo $instanceID; ?> ul' ).css( { 'display': 'block' } );
		});
		</script><?php
	}
?>

	<div class="tabs <?php echo $style; ?>">

		<div id="<?php echo $instanceID; ?>" class="tab-buttons<?php echo $class_position; ?>">
		<ul class="nav nav-tabs">
		
		<?php foreach((array) $groups['title'] as $increment=>$context){ ?>
		
		<?php
		$icon = $context['icon'];
		if ( ! empty( $icon ) and $icon !== 'none' ) { 
			$icon = '<i class="fa fa-' . $icon . '"></i>';
		} else {
			$icon = '';
		}

		if ( empty( $increment ) or $increment == '0' ) { 
			$active = ' class="active"';
		} else {
			$active = '';
		}
		?>

		<li<?php echo $active; ?><?php echo $count_buttons; ?>><a href="#<?php echo $instanceID; ?>-<?php echo $increment; ?>" data-toggle="tab"><?php echo $icon; ?><?php echo $context['title']; ?></a></li>

		<?php $increment = $increment + 1; ?>

		<?php } ?>
		
		</ul><div class="clearboth"></div>
		</div>
	
		<?php $increment = NULL; ?>
	
		<div class="tab-content">
		
		<?php foreach((array) $groups['title'] as $increment=>$context){ ?>
			
		<?php
		if ( empty( $increment ) or $increment == '0' ) { 
			$active = '  active in';
		} else {
			$active = '';
		}
		?>

		<div class="tab-pane fade<?php echo $active; ?>" id="<?php echo $instanceID; ?>-<?php echo $increment; ?>"><?php echo $context['tab']; ?></div>

		<?php $increment = $increment + 1; ?>

		<?php } ?>

		<?php $increment = NULL; ?>

		</div>

	</div>