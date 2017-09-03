<?php
/**
 * Template Name Portfolio: Parallax
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>  

				<?php get_template_part( 'content', 'portfolio' ); ?>

				<div class="clearboth"></div>

				<?php thinkup_input_projectnavigation(); ?>

				<?php thinkup_input_projectrelated(); ?>

				<?php /* Add comments */  thinkup_input_allowcomments(); ?>

			<?php endwhile; wp_reset_query(); ?>

<?php get_footer(); ?>