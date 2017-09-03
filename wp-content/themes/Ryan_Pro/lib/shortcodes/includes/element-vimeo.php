<?php
$id      = NULL;
$thumb   = NULL;
$title   = NULL;
$details = NULL;

$title_input   = NULL;
$details_input = NULL; 
$vimeoimage    = NULL;

$id      = $atts['id'];
$thumb   = $atts['thumb'];
$title   = $atts['title'];
$details = $atts[''];


if (!empty($title)) {
	$title_input = ' alt="' . $title . '"';
}
if (!empty($details)) {
	$details_input = ' title="' . $details . '"';
}
$vimeoimage = unserialize(@file_get_contents('//vimeo.com/api/v2/video/' . $id . '.php'));

if ( $vimeoimage === false ) {
	echo '<div class="notification error">',
	     '<div class="icon"><span> No Vimeo thumbnail exists. Please specify a thumbnail to use.</span></div>',
	     '</div>';
} else if (empty($thumb)) {
echo	'<div class="sc-lightbox image">',
		'<span><img class="lightbox" src="' . $vimeoimage[0]["thumbnail_large"] . '"' . $title_input . '></span>',
		'<div class="image-overlay style2">',
		'<div class="image-overlay-inner">',
		'<div class="hover-icons"><a class="hover-zoom prettyPhoto" href="//vimeo.com/' . $id . '"' . $details_input . '></a></div>',
		'</div>',
		'</div>',
		'</div>';
} else {
echo	'<div class="sc-lightbox image">',
		'<span><img class="lightbox" src="' . $thumb . '"' . $title_input . '></span>',
		'<div class="image-overlay style2">',
		'<div class="image-overlay-inner">',
		'<div class="hover-icons"><a class="hover-zoom prettyPhoto" href="//vimeo.com/' . $id . '"' . $details_input . '></a></div>',
		'</div>',
		'</div>',
		'</div>';
}


?>