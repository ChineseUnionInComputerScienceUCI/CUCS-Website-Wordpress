<?php
/**
 * Template Name: Testimonials
 *
 * @package ThinkUpThemes
 */

?>

	<?php $thinkup_testimonial_pageid = $post->ID; // Store page id to collect meta data in team loop; ?>

	<?php get_template_part( 'archive', 'testimonial' ); ?>