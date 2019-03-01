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
preg_match("/thumb-([^\s]+)/", $widget[ 'classes_posts' ], $tumb_array);
preg_match("/tamanho-([^\s]+)/", $widget[ 'classes_posts' ], $tamanho_array);
preg_match("/tamanho-([^\s]+)/", $widget[ 'classes_widget' ], $tamanho_widget_array);
// print_r($tamanho_array);

$thumb_size = (isset($tumb_array[1]) ? $tumb_array[1] : 'quadrada');
$post_size = (isset($tamanho_array[1]) ? $tamanho_array[1] : '25');
$widget_size = (isset($tamanho_widget_array[1]) ? $tamanho_widget_array[1] : '100');

// echo $post_size;
// echo $widget_size;
$tamanho_total = $widget_size * $post_size / 100;
if ( ! in_array( 'thumb-icone', $classes_posts ) ) {
	if ($tamanho_total >= 50 ) {
		$thumb_size = $thumb_size.'-g';
	} else{
		$thumb_size = $thumb_size.'-p';
	}
} else {
	$thumb_size = 'thumb-icone';
}

$chamada = get_post_meta( get_the_ID(), 'chamada', true );
if ( ! $chamada ) {
	$chamada = '';
}
?>
<article class="each-post-widget tamanho-total-<?php echo $tamanho_total; ?>  <?php echo esc_attr( $widget[ 'classes_posts' ] );?>">
	<?php if ( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) : ?>
	<figure class=" post-thumbnail">
		<i class="fas fa-share-alt"></i>
		<div class="col-md-12 social-icons-post">
			<?php eol_share_overlay();?>
		</div>
		<?php
		echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
		eol_single_thumbnail($thumb_size, get_the_ID() );
		echo '</a>';
		?>
	</figure>
	<div class="overlay-post-link-widget-text">
		<div class="post-link-widget-text" >

			<h3 class="tax-widget-titulo">
				<a href="<?php the_permalink(); ?>" >
					<?php the_title();?>
				</a>
			</h3>
			<?php
			if ( in_array( 'exibicao-chamada', $classes_posts ) ) :
				$chamada = '<div class="tax-widget-subtitulo">'.apply_filters( 'the_content', $chamada ).'</div>';
				echo $chamada;
			endif;?>
			<?php if ( in_array( 'exibicao-data' , $classes_posts ) ) : ?>
				<div class="tax-widget-data">
					<?php echo get_the_date('d\/m\/Y',get_the_ID().' ');?>
				</div>
			<?php endif;?>
			<?php if ( in_array( 'exibicao-autor' , $classes_posts ) ) : ?>
				<?php if ( $author = get_post_meta( get_the_ID(), 'the_author', true )) { ?>
					<div class="tax-widget-autor">
							<?php
							printf( __( '%s', 'eol' ), apply_filters( 'the_title', $author) );
							?>
					</div>
				<?php } ?>
			<?php endif;?>
		</div>
	</div>

	<?php endif; // foto-fundo?>
	<?php if ( in_array( 'foto-esquerda', $classes_posts ) ) : ?>
		<figure class=" post-thumbnail">
			<i class="fas fa-share-alt"></i>
			<div class="col-md-12 social-icons-post">
				<?php eol_share_overlay();?>
			</div>
			<?php
			echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
			eol_single_thumbnail($thumb_size, get_the_ID() );
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
			<i class="fas fa-share-alt"></i>
			<div class="col-md-12 social-icons-post">
				<?php eol_share_overlay();?>
			</div>
			<?php
			echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
			eol_single_thumbnail($thumb_size, get_the_ID() );
			echo '</a>';
			?>
		</figure>
		<?php endif;?>
		<?php if ( in_array( 'exibicao-chamada', $classes_posts )   && ! ( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<?php $chamada = '<div class="tax-widget-subtitulo">'.apply_filters( 'the_content', $chamada ).'</div>';
			echo $chamada; ?>
		<?php endif;?>
			<?php if ( in_array( 'exibicao-data', $classes_posts )   && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<div class="tax-widget-data">
				<?php echo get_the_date('d\/m\/Y',get_the_ID()).' ';?>
			</div>
		<?php endif;?>
		<?php if ( in_array( 'exibicao-autor', $classes_posts )   && !( in_array( 'foto-fundo', $classes_posts ) || in_array( 'foto-cima', $classes_posts ) ) ) : ?>
			<?php if ( $author = get_post_meta( get_the_ID(), 'the_author', true )) : ?>
				<div class="tax-widget-autor">
					<?php printf( __( '%s', 'eol' ), apply_filters( 'the_title', $author) );?>
				</div>
			<?php endif; ?>
		<?php endif;?>

	</div>
	<?php if ( in_array( 'foto-direita', $classes_posts ) ) : ?>
		<figure class=" post-thumbnail">
			<i class="fas fa-share-alt"></i>
			<div class="col-md-12 social-icons-post">
				<?php eol_share_overlay();?>
			</div>
			<?php
			echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
			eol_single_thumbnail($thumb_size, get_the_ID() );
			echo '</a>';
			?>
		</figure>
	<?php endif;?>
	<?php if ( in_array( 'exibicao-coordenadas', $classes_posts )  ) : ?>
		<div class="eol-post-relacionadas">
			<?php echo do_shortcode( '[eol_coordenadas]' );?>
		</div><!-- .eol-post-relacionadas -->
	<?php endif;?>
</article><!-- #post-## -->
