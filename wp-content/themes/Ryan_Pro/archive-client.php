<?php
/**
 * The main Portfolio page template file.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>
  
			<?php
				if ( !empty( $thinkup_client_category ) ) $thinkup_client_category = explode(",",$thinkup_client_category);
				$loop = new WP_Query( array('orderby ' => 'date', 'post_type' => 'client', 'posts_per_page' => -1, 'paged' => $paged, 'category__in' => $thinkup_client_category ) );
				$count =0;
			?>

			<div id="container" class="portfolio-wrapper">
			<div id="container-inner">

				<?php if ( $loop ) : 
					while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="element column-4 client_grid">
							<ul class="client-thumb">
								<li>
									<?php the_post_thumbnail(); ?>
								</li>
							</ul>
						</div>
					<?php endif; ?>

					<?php endwhile; else: ?>

				<div class="portfolio-error"><?php _e( 'No clients have been found.', 'ryan' ); ?></div>

				<?php endif; wp_reset_query(); ?>

			<div class="clearboth"></div>
			</div>
			</div>

<?php get_footer(); ?>