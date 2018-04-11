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
	<header class="col-md-12 entry-header">
		<div class="col-md-12 center-container no-padding">
			<div class="entry-title-container text-center">
				<?php the_title( '<h1 class="entry-title main-title">', '</h1>' );?>
			</div><!-- .col-md-10 entry-title-container -->
			<div class="col-md-12 sub-title-main">
				<div class="col-md-11 text-center sub-title">
					<?php if ( $sub_title = get_post_meta( get_the_ID(), 'sub_title', true ) ) {
						echo apply_filters( 'the_content', $sub_title );
					}?>
				</div><!-- .col-md-9 center-container -->
			</div><!-- .col-md-12 text-center -->
			<div class=" text-center">
				<div class=" social-icons-post">
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
				<div class=" center-container text-center entry-meta">
					<?php odin_posted_on(); ?>
				</div><!-- .col-md-9 center-container -->
			</div><!-- .col-md-6 text-center -->

		</div><!-- .col-md-10 center-container -->
	</header><!-- .entry-header -->

	<section class="post-thumb">
		<?php eol_single_thumbnail();?>
	</section>

	<div class="col-md-12 clear"></div><!-- .col-md-12 clear -->

	<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
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


			<footer class="entry-meta">
				<?php //if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
					<span class="cat-links"><?php //echo __( 'Posted in:', 'odin' ) . ' ' . get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'odin' ) ); ?></span>
				<?php //endif; ?>
				<?php the_tags( '<span class="tag-links">' . __( 'Tagged as:<br>', 'odin' ) . ' ', ' / ', '</span>' ); ?>
				<?php //if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="comments-link"><?php //comments_popup_link( __( 'Leave a comment', 'odin' ), __( '1 Comment', 'odin' ), __( '% Comments', 'odin' ) ); ?></span>
				<?php //endif; ?>
				<div class="col-md-12   entry-meta">
					<?php odin_posted_on(); ?>
				</div><!-- .col-md-9 center-container -->
			</footer>



		</div><!-- .entry-content -->
	<?php endif; ?>


</article><!-- #post-## -->
<?php get_sidebar();?>
