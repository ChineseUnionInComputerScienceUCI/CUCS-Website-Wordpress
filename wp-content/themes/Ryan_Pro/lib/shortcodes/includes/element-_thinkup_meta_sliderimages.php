<?php
$image  = NULL;
$height = NULL;

$height = $atts['height'];

	if ( empty( $height ) or $height == '0' ) {
		$height = '200';
	}
?>

<div class="rslides-sc" data-height="<?php echo $height; ?>">
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