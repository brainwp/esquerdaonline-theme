<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( ! get_option( 'site_icon' ) ) : ?>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2&appId=334035897045245&autoLogAppEvents=1"></script>
	<div id="modal" class="modal">
		<div id="modal-content"></div>
		<div class="modal-share" style="display:none;opacity:0;">
			<span><?php _e( 'Compartilhe!', 'eol' );?></span>
			<?php eol_share_overlay();?>
		</div><!-- .modal-share -->
		<div class="modal-download" style="display:none;opacity:0;">
			<a href="#">
				<span><?php _e( 'Baixe e espalhe!', 'eol' );?></span>
				<i class="fa fa-download" aria-hidden="true"></i>
			</a>
		</div><!-- .modal-share -->

	</div>
	<a id="skippy" class="sr-only sr-only-focusable" href="#content">
		<div class="container">
			<span class="skiplink-text"><?php _e( 'Skip to content', 'odin' ); ?></span>
		</div>
	</a>

	<header id="header" role="banner" class="small-header">
		<div class="container">
			<div class="site-logo hidden-xs hidden-sm">
				<a href="#menu-open" class="menu-open-icon">
					<span class="bars"></i>
				</a>

				<div class="social-icons">
					<?php $links = get_theme_mod( 'social_links', false );?>
					<?php if ( $links ) : ?>
						<?php foreach( $links as $link ) : ?>
							<?php $class = sprintf( 'fa-%s-%s', $link[ 'link_icon' ], $link[ 'link_icon' ][0] );?>
							<?php if ( 'twitter' === $link[ 'link_icon'] ) {
								$class = 'fa-twitter';
							}
							if ( 'instagram' === $link[ 'link_icon'] ) {
								$class = 'fa-instagram';
							}
							?>
							<a href="<?php echo esc_url( $link[ 'link_url'] );?>">
								<i class="fab <?php echo $class;?>"></i>
							</a>
						<?php endforeach;?>
					<?php endif;?>
				</div><!-- .social-icons -->
			</div><!-- .col-md-4 site-logo -->


			<?php odin_the_custom_logo(); ?>
			<a href="#" class="search-icon-mobile hidden-md hidden-lg" data-open="false">
			</a>
			<div class="search-container-mobile col-md-10 text-right" style="display:none;">
				<?php get_search_form( true );?>
			</div><!-- .search-container -->
			<div class="search-container col-md-7 text-right">
				<?php get_search_form( true );?>
			</div><!-- .search-container -->

			<nav class="pull-right menu-editorias text-right hidden-xs hidden-sm">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'depth'          => 2,
							'container'      => false,
							'menu_class'     => 'nav navbar-nav',
							'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
							'walker'         => new Odin_Bootstrap_Nav_Walker()
						)
					);
				?>
				<a href="#" class="search-icon" data-open="false">
				</a>
				<a href="#" class="close-search-icon">
					<i class="fas fa-times-circle"></i>
				</a>
			</nav><!-- .col-md-5 pull-right menu-editorias -->
		</div>
	</header><!-- #header -->

	<?php if( is_singular( 'colunistas' ) ) {
		?>
	<div class="archive-colunista">
    	<div class="barra-colunistas">
    		<div  class="container">
    			<h5 class="col-md-12 no-padding">Colunas</h5>
    		</div>
    	</div><?php
    	get_template_part( '/content/header', 'colunista' );
		?>
	</div>
	<?php
} else if( has_term( '', 'colunistas', $post->ID )) {
		?>
	<div class="barra-colunistas">
		<div  class="container">
			<h5 class="col-md-12">Colunas</h5>
		</div>
	</div>
<?php  }?>
	<div id="wrapper" class="container">

		<div class="row">
