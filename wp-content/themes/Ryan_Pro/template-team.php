<?php
/**
 * Template Name: Team
 *
 * @package ThinkUpThemes
 */

?>

	<?php $thinkup_team_pageid = $post->ID; // Store page id to collect meta data in team loop; ?>

	<?php get_template_part( 'archive', 'team' ); ?>