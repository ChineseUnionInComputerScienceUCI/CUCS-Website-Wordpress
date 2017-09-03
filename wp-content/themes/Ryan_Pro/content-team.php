<?php
/**
 * The Portfolio item content template file.
 *
 * @package ThinkUpThemes
 */
?>


		<article class="team-content">

			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ryan' ), 'after' => '</div>' ) ); ?>

		</article>