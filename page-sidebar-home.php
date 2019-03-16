<?php
/**
 * Template Name: Com widget
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
			<?php dynamic_sidebar( eol_get_widget_object_id() );?>
		</div><!-- .col-md-12 -->
	</main><!-- #main -->
	<?php if ( is_front_page() ) : ?>
		<div class="col-md-12 no-padding">
			<?php dynamic_sidebar( 'home-widgets-baixo' );?>
		</div><!-- .col-md-12 -->
	<?php endif;?>
<?php
get_footer();
