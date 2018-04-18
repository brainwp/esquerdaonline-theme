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
						<?php echo get_the_date('j \d\e F \d\e Y'); ?>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata();?>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->

<?php
	$args = array(
	  'post_type'   => 'colunistas',
	  'orderby'=> 'title',
	  'order' => 'ASC'
	);
	$colunistas = get_posts( $args );
	 ?>
<aside id="sidebar-colunistas" class="<?php echo odin_classes_page_sidebar_aside(); ?>" role="complementary">
	<h3 class="widgettitle widget-title" ><?php _e( 'acesso <span>rápido</span>', 'eol' );?></h3>
	<ul class="posts-widget-list-tx">
		<?php foreach ($colunistas as $colunista ) :
			$link = get_post_permalink( $colunista->ID);
			$nome = $colunista->post_title;
			?>
			<li class="post-widget-li">
				<a class="post-link-widget-li" href="<?php echo $link?>"><?php echo $nome; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</aside><!-- #sidebar -->
<?php get_sidebar('colunistas');?>

<!-- col-md-8 post-colunista -->
