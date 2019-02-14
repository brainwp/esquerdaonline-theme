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
get_header( 'large' ); ?>
	<main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
		<div class="col-md-12 no-padding">
			<?php dynamic_sidebar( 'home-widgets' );?>

		</div><!-- .col-md-12 -->
		<div class="col-md-12 no-padding">
			<?php dynamic_sidebar( 'home-widgets-baixo' );?>

		</div><!-- .col-md-12 -->

	</main><!-- #main -->
<?php
get_footer();
