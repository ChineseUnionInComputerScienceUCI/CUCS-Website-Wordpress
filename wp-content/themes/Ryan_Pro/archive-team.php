<?php
/**
 * The main Team page template file.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php if ( ! empty( $GLOBALS['thinkup_team_pageid'] ) ) : // Add team page content if any is added ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endif; ?>

			<?php
				$teamtags  = strip_tags( get_the_tag_list( '', ',', '' ) );
				$tag_count = count( get_the_tags() );

				$args = array( 
					'post_type'      => 'team',
					'posts_per_page' => -1,
					'team_tag'        => $teamtags,
				);
				$loop  = new WP_Query( $args );
				$count = 0;

				// Determine which style and layout should be used
				$class_style   = NULL;

				// Determine which layout to output
				$_thinkup_meta_teamstyleswitch = get_post_meta( $post->ID, '_thinkup_meta_teamstyleswitch', true );

				if( empty ( $_thinkup_meta_teamstyleswitch ) or $_thinkup_meta_teamstyleswitch == 'option1' ) {
					if ( $thinkup_team_styleswitch == 'option2' ) {
						$class_style   = ' style2';
					}
				} if( $_thinkup_meta_teamstyleswitch == 'option3' ) {
					$class_style   = ' style2';
				}
			?>

			<div id="container" class="portfolio-wrapper">
			<div id="container-inner">

				<?php if ( $loop ) : 
					while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php if ( has_post_thumbnail() ) :	?>
		
						<div class="element team-grid<?php echo thinkup_input_teamlayout(); ?>">
							<div class="sc-carousel carousel-team sc-postitem<?php echo $class_style; ?>">

								<div class="entry-header">
									<div class="team-thumb">
										<?php thinkup_input_teamoverlay(); ?>
									</div>
								</div>

								<div class="entry-content">
									<?php /* Output team page content */ thinkup_input_teamcontent(); ?>
								</div><div class="clearboth"></div>

							</div>

						</div>
					<?php endif; ?>

					<?php endwhile; else: ?>

				<div class="team-error"><?php _e( 'No clients have been found.', 'ryan' ); ?></div>

				<?php endif; wp_reset_query(); ?>

			<div class="clearboth"></div>
			</div>
			</div>

<?php get_footer(); ?>