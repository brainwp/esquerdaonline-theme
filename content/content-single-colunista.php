<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php $classes = array('col-md-8' , 'no-padding' ); post_class($classes);?>>
	<div class="col-md-12 post-colunista no-padding">
		<?php 	// pega o ultimo post do colunista e o exibe;
		global $post;
		$last_post = new WP_Query( array(
			'posts_per_page' => 10,
			'colunistas' => $post->post_name
		));
		?>
		<?php if ( $last_post->have_posts() ) : ?>
			<?php while( $last_post->have_posts() ) : $last_post->the_post(); ?>
				<article class="each-colunista col-md-12">
					<a href="<?php the_permalink();?>" class="post-title">
						<?php the_title('<h2>','</h2>');?>
					</a>

						<?php if ( $sub_title = get_post_meta( get_the_ID(), 'sub_title', true ) ) {?>
							<div class="col-md-12 text-left sub-title no-padding">
							<?php echo apply_filters( 'the_content', $sub_title );
							?>
							</div><!-- .col-md-9 center-container -->
							<?php
						}?>
					<div class="col-sm-6 the-date-time">
						<?php echo get_the_date(); ?>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata();?>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
<?php get_sidebar('colunistas');?>

<!-- col-md-8 post-colunista -->
