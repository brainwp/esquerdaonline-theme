<?php
/**
 * Template Name: Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			?>

	</main><!-- #main -->

<?php
get_footer();
