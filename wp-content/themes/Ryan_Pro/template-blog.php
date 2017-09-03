<?php
/**
 * Template Name: Blog
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php  
				$thinkup_blog_pageid = $post->ID; // Store page id to collect meta data in project loop
			?>

			<?php
			$categories  = NULL;
			$posttags = get_the_tags();
			$tag_count = count( get_the_tags() );

			// Find category ID's for tag name and comma separate
			if ($posttags) {
				foreach($posttags as $tag) {
					if ($count !== ( $tag_count - 1 ) ) {
						$categories .= get_cat_ID( $tag->name ) . ',';
					} else {
						$categories .= get_cat_ID( $tag->name );	
					}
					$count++;
				}
			}
			?>

			<?php
			// Ensure pagination works correctly on both front page and inner pages
			if ( is_front_page() ) {
				$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
			} else {
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;			
			}

			// Run query to collect blog posts
			$loop_args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'cat'            => $categories,
				'posts_per_page' => thinkup_input_blogpostcount(),
				'paged'          => $paged,
				'page'           => $paged,
				);
			$loop = new WP_Query( $loop_args ); 
			?>

			<?php global $more; $more = 0; ?>

			<?php if ( $loop->have_posts() ) : ?>

				<div id="container">

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<div class="blog-grid element<?php thinkup_input_stylelayout(); ?>">

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>

						<?php if( has_post_thumbnail() ) { ?>
						<header class="entry-header<?php thinkup_input_stylelayout_class1(); ?>">

							<?php echo thinkup_input_blogimage(); ?>

						</header>
						<?php } ?>

						<div class="entry-content<?php thinkup_input_stylelayout_class2(); ?><?php thinkup_input_blogcommentclass(); ?>">

							<?php thinkup_input_blogmeta(); ?>
							<?php thinkup_input_blogtitle(); ?>
							<?php thinkup_input_blogtext(); ?>

						</div><div class="clearboth"></div>

					</article><!-- #post-<?php get_the_ID(); ?> -->

					</div>

				<?php endwhile; ?>

				</div><div class="clearboth"></div>

				<?php thinkup_input_pagination( $loop->max_num_pages ); ?>

			<?php else: ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>		

			<?php endif; wp_reset_postdata(); ?>

<?php get_footer() ?>