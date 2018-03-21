<div class="each-colunista">
	<a href="<?php the_permalink();?>" class="coluna-link">
		<div class="col-md-2 thumbnail-colunista">
			<?php the_post_thumbnail( 'thumbnail' );?>
		</div><!-- .col-md-2 thumbnail-colunista -->
		<h4 class="col-md-10 colunista-name">
			<?php the_title();?>
		</h4><!-- .col-md-10-colunista-name -->
	</a>
	<?php
	// pega o ultimo post do colunista e o exibe;
	global $post;
	$last_post = new WP_Query( array(
		'posts_per_page' => 1,
		'colunistas' => $post->post_name
	));
	?>
	<?php if ( $last_post->have_posts() ) : ?>
		<?php while( $last_post->have_posts() ) : $last_post->the_post(); ?>
			<article>
				<a href="<?php the_permalink();?>" class="post-title">
					<?php the_title();?>
				</a>
				<?php if ( $meta = get_post_meta( get_the_ID(), 'sub_title', true ) ) :?>
					<a href="<?php the_permalink();?>" class="post-sub-title">
						<?php echo apply_filters( 'the_content', $meta );?>
					</a>
				<?php endif;?>
			</article>
		<?php endwhile; wp_reset_postdata();?>
	<?php endif;?>
</div><!-- .each-colunista -->