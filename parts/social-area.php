<?php
/**
 *
 * Area de comentários, compartilhamentos, etc;
 *
*/
?>
<section class="social-area col-md-12">

	<div class="continue-reading col-md-12">
		<?php if ( $terms = wp_get_post_terms( get_the_ID(), 'post_tag' ) ) : ?>
			<?php $query = new WP_Query(
					array(
						'tag_id' 			=> $terms[0]->term_id,
						'posts_per_page' 	=> 3
					)
				);
				if ( $query->have_posts() ) : ?>
					<h3 class="area-title"><?php _e( 'Continue <span>Lendo</span> &#62;', 'eol' );?></h3><!-- .area-title -->
					<section class="main-post-social">
						<?php while( $query->have_posts() ) : $query->the_post(); ?>
							<?php get_template_part( '/content/post-default' );?>
						<?php endwhile; wp_reset_postdata();?>
					</section>
				<?php endif;?>
		<?php endif;?>
	</div><!-- .continue-reading col-md-12 -->


	<div class="col-md-12 fb-comments-area">
		<h3 class="col-md-4 pull-left comments-title">
			<span class="fb-comments-count" data-href="<?php the_permalink();?>"></span>
			<?php _e( ' Comentários', 'eol' );?>
			<span class="red-line"></span>
		</h3>
		<div class="col-md-5 pull-right share-buttons">
			<?php if ( function_exists( 'sharing_display' ) ) {
				echo sharing_display();
			} ?>
		</div>
		<?php if ( comments_open() || get_comments_number() ) {
			comments_template();
		} ?>
	</div> <!-- .col-md-12 fb-comments -->

</section><!-- .social-area col-md-12 -->




