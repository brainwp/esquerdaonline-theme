<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header('small'); ?>
	<div id="primary" class="site-main col-md-12">
		<main id="main-content" class="site-main" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( '/content/content', 'single-noticia-colunista' );

					// Social area (share button, comments, etc )
				endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
