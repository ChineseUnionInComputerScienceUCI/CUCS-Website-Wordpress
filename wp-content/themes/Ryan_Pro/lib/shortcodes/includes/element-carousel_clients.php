<?php
$title    = NULL;
$items    = NULL;
$show     = NULL;
$scroll   = NULL;
$speed    = NULL;
$effect   = NULL;
$category = NULL;

$title    = $atts['title'];
$items    = $atts['items'];
$show     = $atts['show'];
$scroll   = $atts['scroll'];
$speed    = $atts['speed'];
$effect   = $atts['effect'];
$category = $atts['category'];


// Set default items value
if ( ! is_numeric( $items ) ) {
	$items = 10;
}

$args = array(
	'post_type'   => 'client',
	'numberposts' => $items,
	'post_status' => 'publish',
	'category'    => $category,
	);

$recent_posts = wp_get_recent_posts( $args );

echo '<div class="sc-carousel carousel-client" data-show="' . $show . '" data-scroll="' . $scroll . '" data-speed="' . $speed . '" data-effect="' . $effect . '">';

if ( !empty( $title ) ) {
	echo '<div class="sc-carousel-title"><h3>' . $title . '</h3></div>';
}

echo '<ul id="' . $instanceID . '">';
	$i = 0;
	 foreach( $recent_posts as $recent ){
	$i = $i + 1;
	 $post_id = get_post_thumbnail_id( $recent["ID"] );
	 $post_img = wp_get_attachment_image_src($post_id, 'full', true);
	 $post_img_full = wp_get_attachment_image_src($post_id, 'full', true);

	 // Do not show post if default WordPress image is being used (e.g. no feautured image set)
	 if ( strpos( $post_img[0], 'wp-includes/images/media/default.png' ) !== false ) {
		$post_id = NULL;
	 }

	if ( ! empty( $post_id ) ) {
		echo '<li id="' . $instanceID . '-' . $i . '">',
			 '<div class="entry-header">',
			 '<img src="' . $post_img[0] . '" />',
			 '</div>',
			 '</li>';
		$i++;
	}
}
echo '</ul>',
	 '<div class="caroufredsel_nav">',
	 '<a class="prev" id="' . $instanceID . '_prev" href="#"><i class="fa fa-angle-left"></i></a>',
	 '<a class="next" id="' . $instanceID . '_next" href="#"><i class="fa fa-angle-right"></i></a>',
//	 '<div class="pagination" id="' . $instanceID . '_pag"></div>',
	 '</div>',
	 '<div class="clearboth"></div>',
	 '</div>';

?>