<?php
/**
 *
 * Area de comentários, compartilhamentos, etc;
 *
*/
?>
<section class="social-area col-md-12">
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
		</div><!-- .col-md-5 pull-right share-buttons -->
		<?php if ( comments_open() || get_comments_number() ) {
			comments_template();
		} ?>
	</div><!-- .col-md-12 fb-comments -->
</section><!-- .social-area col-md-12 -->
