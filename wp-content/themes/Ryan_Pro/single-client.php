<?php
/**
 * The Client item page template file.
 *
 * @package ThinkUpThemes
 */

ob_start(); get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'client' ); ?>

				<div class="clearboth"></div>

			<?php endwhile; wp_reset_query(); ?>

<?php get_footer(); ob_end_flush(); ?>