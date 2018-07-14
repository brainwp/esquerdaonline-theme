<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header('large'); ?>

	<div id="primary" class="<?php echo odin_classes_page_sidebar(); ?>">
		<main id="main-content" class="site-main" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
				if (wp_get_post_terms( get_the_ID(), 'especiais' )) {
					echo get_the_ID();
					$term = wp_get_post_terms( get_the_ID(), 'especiais' );
					$especial = get_page_by_title( $term[0]->name, $output = OBJECT, $post_type = 'especiais' );
					$sub_title =	( get_post_meta( $especial->ID, 'sub_title', true)  ?  get_post_meta( $especial->ID, 'sub_title', true ) :   '' );
					$header_especial = '<div id="header-especiais" class="">
									<figure class=" post-thumbnail">
								 '.eol_single_thumbnail('full', $especial->ID).'
									</figure>
									<div class="col-md-3 pull-right social-icons-post">
									</div>
									<div class="col-md-9" id="especial-text" class="">
										<a href="'.get_the_permalink( $especial->ID ).'">
											<h1 class="entry-title main-title">'.get_the_title($especial->ID).'</h1>
											<div class="sub-title">
												'.apply_filters( 'the_content', $sub_title ).'
											</div><!-- sub-title -->
										</a>
									</div>
								</div><!--  id="header-especiais" -->';
				}
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( '/content/content', 'single' );

					// Social area (share button, comments, etc )
					get_template_part( '/parts/social-area' );
				endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
