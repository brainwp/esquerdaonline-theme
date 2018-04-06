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

<article id="post-<?php the_ID(); ?>" <?php $classes = array('col-md-12' , 'no-padding' ); post_class($classes);?>>
	<header class="col-md-12 no-padding">
		<div class="col-md-2 no-padding lefthright">
			<section class="post-thumb">
				<div class="thumbnail-colunista">
					<?php the_post_thumbnail( 'thumbnail' );?>
				</div>
			</section>
		</div><!-- .col-md-4 center-container -->

		<div class="col-md-10 center-container no-padding">
			<div class="entry-title-container col-md-12 text-left">
				<?php the_title( '<h4 class="colunista-name">', '</h1>' );?>
			</div><!-- .col-md-12 entry-title-container -->
			<div class="entry-title-container col-md-12 text-left">
				<section class="content-it-self">
					<?php
						the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'odin' ) );
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );
					?>
				</section>
			</div><!-- .col-md-12 entry-title-container -->
			<div class="col-md-12 text-left social-icons-colunist">
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-facebook-f"></i>
					</a>
				</div>
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-twitter"></i>
					</a>
				</div>
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-google-plus"></i>
					</a>
				</div>
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-instagram"></i>
					</a>
				</div>
				<div class="icon-itself">
					<a href="#">
						<i class="fas fa-print"></i>
					</a>
				</div>

			</div><!-- .col-md-6 social-icons-post -->
		</div><!-- .col-md-8 center-container -->
	</header><!-- .entry-header -->

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
				<article class="col-md-12">
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

<!-- col-md-8 post-colunista -->
