<?php
/**
 * Template Name: Portfolio
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php $thinkup_portfolio_pageid = $post->ID; // Store page id to collect meta data in project loop ?>

			<?php if ( ! empty( $GLOBALS['thinkup_portfolio_pageid'] ) ) : // Add portfolio page content if any is added ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endif; ?>

			<?php
				$posttags = strip_tags( get_the_tag_list( '', ',', '' ) );
				$tag_count = count( get_the_tags() );
				
				$loop = new WP_Query(array(
						'post_type' => 'portfolio',
						'posts_per_page' => -1,
						'paged' => $paged,
						'tagportfolio' => $posttags,
					));
				$count =0;
			?>

			<?php if ( $tag_count > 1 ) : ?>
			<?php /* Portfolio Filter */ echo thinkup_input_portfoliofilter(); ?>
			<?php endif; ?>
			
			<?php /* Portfolio Slider */ thinkup_input_portfolioslider(); ?>

			<div id="container" class="portfolio-wrapper">
			<div id="container-inner">

				<?php if ( $loop ) : 
					while ( $loop->have_posts() ) : $loop->the_post();
					$terms = get_the_terms( $post->ID, 'tagportfolio' );

						if ( $terms && ! is_wp_error( $terms ) ) : 
							$links = array();
							foreach ( $terms as $term ) {
								if ( strpos( $posttags, $term->name ) !== false or strpos( $posttags, strtolower( $term->name ) ) !== false ) :
									$links[] = $term->name;
								endif;
							}
							$tax = join( ",", $links );		
						else :	
							$tax = '';	
						endif; ?>

						<?php if ( has_post_thumbnail() ) : ?>

						<div class="element image_grid <?php thinkup_input_portfoliolayout(); ?>" data-tags="<?php if ( !empty($tax)) { echo $tax; } else { echo 'thinkup_remove_tag'; }?>">
							<div class="sc-carousel carousel-portfolio sc-postitem<?php thinkup_input_portfoliostyleclass(); ?>">

								<div class="entry-header">
									<div class="port-thumb">
										<?php thinkup_input_portfoliosize();
										/* Hover Content */ thinkup_input_portfoliohover(); ?>
									</div><div class="clearboth"></div>
								</div><?php

								/* Title & Tags */ thinkup_input_portfoliocontent1(); ?>

							</div>

						</div>

						<?php endif; ?>

					<?php endwhile; else: ?>

				<div class="portfolio-error"><?php _e( 'No portfolio items have been found.', 'ryan' ); ?></div>

				<?php endif; wp_reset_query(); ?>

			<div class="clearboth"></div>
			</div>
			</div>

			<?php /* Featured Content */ thinkup_input_portfoliofeatured(); ?>

<?php get_footer(); ?>