<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- .row -->
	</div><!-- #wrapper -->


	<footer id="footer" role="contentinfo" class="col-md-12">
		<div class="container">
			<div class="col-md-2 logo-social">
				<?php $image = get_theme_mod( 'footer_logo', false ); ?>
				<?php if ( $image ) :?>
					<a href="<?php home_url();?>" class="site-logo">
						<img src="<?php echo esc_url( $image );?>" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				<?php endif;?>
				<div class="pull-right social-icons">
					<?php $links = get_theme_mod( 'social_links', false );?>

					<?php if ( $links ) : ?>
						<?php foreach( $links as $link ) : ?>
							<?php $class = sprintf( 'fa-%s-f', $link[ 'link_icon' ] );?>
							<?php if ( 'twitter' === $link[ 'link_icon'] ) {
								$class = 'fa-twitter';
							}
							if ( 'instagram' === $link[ 'link_icon'] ) {
								$class = 'fa-instagram';
							}
							if ( 'whatsapp' === $link[ 'link_icon'] ) {
								$class = 'fa-whatsapp';
							}
							if ( 'telegram' === $link[ 'link_icon'] ) {
								$class = 'fa-telegram-plane';
							}

							?>
							<a href="<?php echo esc_url( $link[ 'link_url'] );?>">
								<i class="fab <?php echo $class;?>"></i>
							</a>
						<?php endforeach;?>
					<?php endif;?>
 				</div><!-- .pull-right social-icons -->
			</div><!-- .col-md-3 logo-social -->
			<div class="col-md-7 nav-footer">
				<?php for ( $i = 1; $i < 5; $i++ ) : ?>
					<?php $theme_location = sprintf( 'menu-footer-%s', $i );?>
					<nav class="nav-footer-each col-md-3">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => $theme_location,
									'depth'          => 1,
									'container'      => false,
								)
							);
						?>
					</nav><!-- .nav-footer-each col-md-3 -->
				<?php endfor;?>
			</div><!-- .col-md-7 nav-footer -->
			<div class="col-md-3 madeby">
				<a href="https://resistenciapsol50.com.br">
					<img src="<?php echo get_template_directory_uri();?>/assets/images/resistencia.png" alt="<?php _e( 'Mantido pela Resistencia - Corrente interna do PSOL', 'eol');?>" title="<?php _e( 'Mantido pela Resistencia - Corrente interna do PSOL', 'eol');?>">
				</a>
				<a href="https://brasa.art.br">
					<img src="<?php echo get_template_directory_uri();?>/assets/images/brasa.png" alt="<?php _e( 'Desenvolvido em WordPress pela Brasa.art.br', 'eol' );?>" title="<?php _e( 'Desenvolvido em WordPress pela Brasa.art.br', 'eol' );?>">
				</a>

			</div><!-- .col-md-3 madeby -->
		</div><!-- .container -->
	</footer><!-- #footer -->

	<?php wp_footer(); ?>
</body>
</html>
