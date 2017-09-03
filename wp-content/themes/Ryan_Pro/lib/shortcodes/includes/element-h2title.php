<?php
$style = NULL;
$size  = NULL;

$style = $atts['style'];
$size  = $atts['size'];

if ( $style == 'single' ) {
	$style = ' style1';
} else if ( $style == 'double' ) {
	$style = ' style2';
} else if ( $style == 'triple' ) {
	$style = ' style3';
} else if ( $style == 'quad' ) {
	$style = ' style4';
} else if ( $style == 'underline' ) {
	$style = ' style5';
}

if ( is_numeric( $size ) ) {
	$size = ' style="font-size: ' . $size . 'px;"';
} else {
	$size = '';
}

?>

	<div class="customtitle<?php echo $style; ?>">

	<?php if( $style == ' style5' ): ?>
		<h2<?php echo $size; ?>><span><?php echo implode(", ", (array)$atts['title']); ?></span></h2>
	<?php else: ?>
		<h2<?php echo $size; ?>><?php echo implode(", ", (array)$atts['title']); ?></h2>		
	<?php endif; ?>
	<?php	if ( $style !== ' style5' ) {
			echo	'<div class="title-div"><div class="title-div-core"></div></div>';
			}
	?>
	</div>