<?php
$id      = NULL;
$thumb   = NULL;
$title   = NULL;
$details = NULL;

$title_input   = NULL;
$details_input = NULL;
$youtubeimage  = NULL;

$id      = $atts['id'];
$thumb   = $atts['thumb'];
$title   = $atts['title'];
$details = $atts['details'];


if (!empty($title)) {
	$title_input = ' alt="' . $title . '"';
}
if (!empty($details)) {
	$details_input = ' title="' . $details . '"';
}
$youtubeimage = '//img.youtube.com/vi/' . $id . '/0.jpg';


if (empty($thumb)) {
echo	'<div class="sc-lightbox image">',
		'<span><img class="lightbox" src="' . $youtubeimage . '"' . $title_input . '></span>',
		'<div class="image-overlay style2">',
		'<div class="image-overlay-inner">',
		'<div class="hover-icons"><a class="hover-zoom prettyPhoto" href="//www.youtube.com/watch?v=' . $id . '"' . $details_input . '"></a></div>',
		'</div>',
		'</div>',
		'</div>';
} else {
echo	'<div class="sc-lightbox image">',
		'<span><img class="lightbox" src="' . $thumb . '"' . $title_input . '></span>',
		'<div class="image-overlay style2">',
		'<div class="image-overlay-inner">',
		'<div class="hover-icons"><a class="hover-zoom prettyPhoto" href="//www.youtube.com/watch?v=' . $id . '"' . $details_input . '"></a></div>',
		'</div>',
		'</div>',
		'</div>';
}

?>