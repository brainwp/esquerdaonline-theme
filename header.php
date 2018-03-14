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
	<a id="skippy" class="sr-only sr-only-focusable" href="#content">
		<div class="container">
			<span class="skiplink-text"><?php _e( 'Skip to content', 'odin' ); ?></span>
		</div>
	</a>
	<nav class="col-md-12 hidden-xs hidden-sm" id="menu-institucional" >
		<div class="container">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-institucional',
						'depth'          => 1,
						'container'      => false,
						'menu_class'     => 'nav navbar-nav',
						'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
						'walker'         => new Odin_Bootstrap_Nav_Walker()
					)
				);
			?>
		</div><!-- .container -->
	</nav><!-- #menu-institucional.col-md-12 -->
	<header id="header" role="banner">
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

			<nav class="pull-right menu-editorias text-right hidden-xs hidden-sm">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'depth'          => 1,
							'container'      => false,
							'menu_class'     => 'nav navbar-nav',
							'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
							'walker'         => new Odin_Bootstrap_Nav_Walker()
						)
					);
				?>
				<a href="#" class="search-icon">

				</a>
			</nav><!-- .col-md-5 pull-right menu-editorias -->
		</div>
	</header><!-- #header -->

	<div id="wrapper" class="container">
		<div class="row">
