<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */
 get_header( 'large' ); ?>
 	<main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
 		<div class="col-md-12 no-padding">
 			<?php
			while ( have_posts() ) : the_post();
        eol_single_thumbnail('full', get_the_ID() );
				dynamic_sidebar( eol_get_widget_object_id() );
			endwhile;
		?>
 		</div><!-- .col-md-12 -->
 	</main><!-- #main -->
 <?php
 get_footer();
