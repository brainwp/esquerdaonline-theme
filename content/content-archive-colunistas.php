<div class="each-colunista col-md-12">
		<div class="col-sm-2 thumbnail-colunista">
			<a href="<?php echo $link_colunista = get_the_permalink();?>" class="coluna-link">
				<?php the_post_thumbnail( 'thumbnail' );?>
			</a>
		</div><!-- .col-md-4 thumbnail-colunista -->
		<div class="col-sm-10 conteudo-colunista">
			<div class="colunista-nome no-padding text-left col-md-6">
				<h4 class="colunista-name">
					<a href="<?php the_permalink();?>" class="">
						<?php the_title();?>
					</a>
				</h4><!-- .colunista-name -->
			</div>
			<!--  .col-md-8-->
			<div class="colunista-social no-padding text-right col-md-6">
				<?php if ( $value = get_post_meta( get_the_ID(), 'facebook', true ) ) : ?>
				<div class="icon-itself">
					<a href="<?php echo esc_url( $value );?>">
						<i class="fab fa-facebook-f"></i>
					</a>
				</div>
				<?php endif;?>
				<?php if ( $value = get_post_meta( get_the_ID(), 'twitter', true ) ) : ?>
				<div class="icon-itself">
					<a href="<?php echo esc_url( $value );?>">
						<i class="fab fa-twitter"></i>
					</a>
				</div>
				<?php endif;?>
				<?php if ( $value = get_post_meta( get_the_ID(), 'google_plus', true ) ) : ?>
				<div class="icon-itself">
					<a href="<?php echo esc_url( $value );?>">
						<i class="fab fa-google-plus"></i>
					</a>
				</div>
				<?php endif;?>
				<?php if ( $value = get_post_meta( get_the_ID(), 'instagram', true ) ) : ?>
				<div class="icon-itself">
					<a href="<?php echo esc_url( $value );?>">
						<i class="fab fa-instagram"></i>
					</a>
				</div>
				<?php endif;?>
				<?php if ( $value = get_post_meta( get_the_ID(), 'email', true ) ) : ?>
				<div class="icon-itself">
					<a href="mailto:<?php echo esc_url( $value );?>">
						<i class="fas fa-envelope"></i>
					</a>
				</div>
				<?php endif;?>

			</div>
			<!-- col-md-4 colunista-social -->
			<div class="col-md-12 post-colunista">
				<?php 	// pega o ultimo post do colunista e o exibe;
				global $post;
				$last_post = new WP_Query( array(
					'posts_per_page' => 1,
					'colunistas' => $post->post_name
				));
				?>
				<?php if ( $last_post->have_posts() ) : ?>
					<?php while( $last_post->have_posts() ) : $last_post->the_post(); ?>
						<article class="col-sm-12">
							<a href="<?php the_permalink();?>" class="post-title">
								<?php the_title('<h2>','</h2>');?>
							</a>
						</article>
						<div class="col-sm-6 the-date-time">
							<?php echo get_the_date('j \d\e F \d\e Y'); ?>
						</div>
						<div class="col-sm-6 coluna-link">
							<a href="<?php echo $link_colunista;?>" class="coluna-link">
								<?php _e( 'Mais textos da coluna', 'eol' );?>
							</a>
						</div>
					<?php endwhile; wp_reset_postdata();?>
				<?php endif; ?>
			</div>
		</div>
		<!-- col-md-8 conteudo-colunista -->
		<div class="clearfix">

		</div>
</div><!-- .each-colunista -->
