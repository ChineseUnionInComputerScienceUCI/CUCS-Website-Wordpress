<?php
$image  = NULL;
$height = NULL;
$width  = NULL;

$height = $atts['height'];
$width  = $atts['width'];

// Set height
if ( empty( $height ) or $height == '0' ) {
	$height = '200';
}

// Set full width of specified
if ( $width == 'on' ) {
	$full_width  = ' data-wide="on"';
	$class_width = ' full-width';	
} else {
	$full_width  = NULL;
	$class_width = NULL;
}

?>

<div class="rslides-sc<?php echo $class_width; ?>" data-height="<?php echo $height; ?>"<?php echo $full_width; ?>>
<div class="rslides-container">
<div class="rslides-inner">
	<ul class="slides">
	<?php foreach((array) $groups['image'] as $increment=>$context){ ?>
	<?php $image  = $context['image']; ?>
		<li>
	<img src="<?php echo get_template_directory_uri() . '/images/transparent.png'; ?>" style="background: url(<?php echo $image; ?>) no-repeat center; background-size: cover;" alt="Demo Image" />
	</li>
	<?php } ?>
	</ul>
</div>
</div>
</div>