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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="col-md-12 entry-header">
		<div class="col-md-10 center-container">
			<div class="editoria text-center">
				<?php
					$term = wp_get_post_terms( get_the_ID(), 'editorias' );
					if ( $term ) {
						printf( '<a href="%s">%s</a>', get_term_link( $term[0] ), apply_filters( 'the_title', $term[0]->name ) );
					}
				?>
			</div><!-- .col-md-12 editoria -->
			<div class="entry-title-container text-center">
				<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
			</div><!-- .col-md-10 entry-title-container -->
			<div class="col-md-12 text-center">
				<div class="col-md-12 center-container text-center sub-title">
					<?php if ( $sub_title = get_post_meta( get_the_ID(), 'sub_title', true ) ) {
						echo apply_filters( 'the_content', $sub_title );
					}?>
				</div><!-- .col-md-9 center-container -->
			</div><!-- .col-md-12 text-center -->
			<div class="col-md-12 text-center">
				<div class="col-md-12 center-container text-center author">
					<?php if ( $author = get_post_meta( get_the_ID(), 'the_author', true ) ) {
							printf( __( 'Por %s', 'eol' ), apply_filters( 'the_title', $author) );
						}
					?>
				</div><!-- .col-md-9 center-container -->
			</div><!-- .col-md-12 text-center -->
			<div class="col-md-12 text-center">
				<div class="col-md-12 center-container text-center entry-meta">
					<?php odin_posted_on(); ?>
				</div><!-- .col-md-9 center-container -->
			</div><!-- .col-md-12 text-center -->
		</div><!-- .col-md-10 center-container -->
	</header><!-- .entry-header -->
	<?php eol_single_thumbnail();?>
	<div class="col-md-12 clear"></div><!-- .col-md-12 clear -->

	<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'odin' ) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
			<span class="cat-links"><?php echo __( 'Posted in:', 'odin' ) . ' ' . get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'odin' ) ); ?></span>
		<?php endif; ?>
		<?php the_tags( '<span class="tag-links">' . __( 'Tagged as:', 'odin' ) . ' ', ', ', '</span>' ); ?>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'odin' ), __( '1 Comment', 'odin' ), __( '% Comments', 'odin' ) ); ?></span>
		<?php endif; ?>
	</footer>
</article><!-- #post-## -->
