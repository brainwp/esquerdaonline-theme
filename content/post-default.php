<?php
/**
 * Template part: Post default;
 * Exibe o bloco padrão de posts
 */
?>






<div class="postholder">
	<article class="post-default <?php if( has_post_thumbnail() ){ echo "has-thumb";}else{ echo "hasnt-thumb";}?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="col-md-4 col-sm-12 post-thumbnail">

				<div class="col-md-12 social-icons-post">
					<div class="icon-itself">
						<a href="#facebook">
							<i class="fab fa-facebook-f"></i>
						</a>
					</div>
					<div class="icon-itself">
						<a href="#twtt">
							<i class="fab fa-twitter"></i>
						</a>
					</div>
					<div class="icon-itself">
						<a href="#gplus">
							<i class="fab fa-google-plus"></i>
						</a>
					</div>

				</div>
				<a href="<?php the_permalink();?>" class="show-social-icons">
					<?php the_post_thumbnail( 'medium' );?>
				</a>





			</figure><!-- .col-md-5 pull-left thumbnail -->
		<?php endif;?>
		<div class="col-md-8 post-content">
			<?php $terms = wp_get_post_terms( get_the_ID(), 'editorias' );?>
			<?php if( $terms ) {
				printf( '<a class="editoria base-editoria" href="%s">%s</a>', get_term_link( $terms[0] ), apply_filters( 'the_title', $terms[0]->name ) );
			} ?>
			<a href="<?php the_permalink();?>" class="the-title base-titulo">
				<h4>
					<?php the_title();?>
				</h4>
			</a>
			<?php if ( $meta = get_post_meta( get_the_ID(), 'sub_title', true ) ) : ?>
				<a href="<?php get_permalink();?>" class="sub-title base-subtitulo">
					<?php echo apply_filters( 'the_content', $meta );?>
				</a>
			<?php endif;?>
				<a href="<?php get_permalink();?>" class="the-date">
					<?php printf( __( '%1$s de %2$s, %3$s', 'eol' ), get_the_date( 'd' ), get_the_date( 'F' ), get_the_date( 'Y' ) );?>
					<?php if ( $meta = get_post_meta( get_the_ID(), 'the_author', true ) ) : ?>
						<?php echo ' • ' . apply_filters( 'the_content', $meta );?>
					<?php endif;?>
				</a>
		</div><!-- .col-md-7 post-content -->
	</article><!-- .post-default -->
</div>
