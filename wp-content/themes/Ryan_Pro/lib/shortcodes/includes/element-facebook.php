<?php
$layout = NULL;
$width  = NULL;
$height = NULL;

$layout = $atts['layout'];


if ( $layout == 'button_count' ) {

	$width  = '100';
	$height = '30';

} else if ( $layout == 'box_count' ) {

	$width  = '60';
	$height = '75';

} else {

	$width  = '450';
	$height = '35';

}

	echo '<iframe src="//www.facebook.com/plugins/like.php?href=' . get_permalink() . '&amp;width=' . $width . '&amp;height=' . $height . '&amp;colorscheme=light&amp;layout=' . $layout . '&amp;action=like&amp;show_faces=true&amp;send=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:' . $width . 'px; height:' . $height . 'px;" allowTransparency="true"></iframe>';


?>