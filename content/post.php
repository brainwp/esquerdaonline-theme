<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
$widget = $GLOBALS[ 'current_widget' ];
$classes_posts = explode( ' ', $widget[ 'classes_posts' ] );
$chamada = get_post_meta( get_the_ID(), 'chamada', true );
if ( ! $chamada ) {
	$chamada = '';
}
?>
<article class="each-post-widget <?php echo esc_attr( $widget[ 'classes_posts' ] );?>">
	<?php if ( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) : ?>
	<figure class=" post-thumbnail">
		<div class="col-md-12 social-icons-post">
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
					<i class="fab fa-instagram"></i>
				</a>
			</div>
		</div>
		<?php
		echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
		eol_single_thumbnail('retangular-m', get_the_ID() );
		echo '</a>';
		$chamada = '<div class="tax-widget-subtitulo">'.apply_filters( 'the_content', $chamada ).'</div>';
		?>
	</figure>
	<div class="post-link-widget-text" >
		<h3 class="tax-widget-titulo">
			<a href="<?php the_permalink(); ?>" >
				<?php the_title();?>
			</a>
		</h3>
		<?php echo $chamada; ?>
		<?php if ( in_array( 'exibicao-data' , $classes_posts ) ) : ?>
			<div class="tax-widget-data">
				<?php echo get_the_date('d\/m\/Y',get_the_ID());?>
			</div>
		<?php endif;?>
		<?php if ( in_array( 'exibicao-autor' , $classes_posts ) ) : ?>
			<?php if ( $author = get_post_meta( get_the_ID(), 'the_author', true )) { ?>
				<div class="tax-widget-autor">
						<?php
						printf( __( ' · %s', 'eol' ), apply_filters( 'the_title', $author) );
						?>
				</div>
			<?php } ?>
		<?php endif;?>
	</div>
	<?php endif; // foto-fundo?>
	<?php if ( in_array( 'foto-esquerda', $classes_posts ) ) : ?>
		<figure class=" post-thumbnail">
			<div class="col-md-12 social-icons-post">
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
						<i class="fab fa-instagram"></i>
					</a>
				</div>
			</div>
			<?php
			echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
			eol_single_thumbnail('retangular-m', get_the_ID() );
			echo '</a>';
			?>
		</figure>
	<?php endif;?>
	<div class="post-link-widget-text">
		<?php if ( in_array( 'exibicao-titulo', $classes_posts )  && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<h3 class="tax-widget-titulo">
				<a href="<?php the_permalink( get_the_ID() ); ?>" >
					<?php the_title();?>
				</a>
			</h3>
		<?php endif;?>
		<?php if ( in_array( 'foto-meio', $classes_posts ) ) : ?>
		<figure class=" post-thumbnail">
			<div class="col-md-12 social-icons-post">
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
						<i class="fab fa-instagram"></i>
					</a>
				</div>
			</div>
			<?php
			echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
			eol_single_thumbnail('retangular-m', get_the_ID() );
			echo '</a>';
			?>
		</figure>
		<?php endif;?>
		<?php if ( in_array( 'exibicao-chamada', $classes_posts )   && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<?php echo $chamada; ?>
		<?php endif;?>
			<?php if ( in_array( 'exibicao-data', $classes_posts )   && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<div class="tax-widget-data">
				<?php echo get_the_date('d\/m\/Y',get_the_ID());?>
			</div>
		<?php endif;?>
		<?php if ( in_array( 'exibicao-autor', $classes_posts )   && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<?php if ( $author = get_post_meta( get_the_ID(), 'the_author', true )) : ?>
				<div class="tax-widget-autor">
					<?php printf( __( ' · %s', 'eol' ), apply_filters( 'the_title', $author) );?>
				</div>
			<?php endif; ?>
		<?php endif;?>
		<?php if ( in_array( 'exibicao-relacionadas', $classes_posts )   && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<div class="eol-post-relacionadas">
				<?php echo do_shortcode( '[eol_relacionadas]' );?>
			</div><!-- .eol-post-relacionadas -->
		<?php endif;?>
	</div>
	<?php if ( in_array( 'foto-direita', $classes_posts ) ) : ?>
		<figure class=" post-thumbnail">
			<div class="col-md-12 social-icons-post">
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
						<i class="fab fa-instagram"></i>
					</a>
				</div>
			</div>
			<?php
			echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
			eol_single_thumbnail('retangular-m', get_the_ID() );
			echo '</a>';
			?>
		</figure>
	<?php endif;?>
</article><!-- #post-## -->
