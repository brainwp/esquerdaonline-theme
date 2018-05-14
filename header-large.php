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

	<header id="header" role="banner" class="large-header">
		<a href="#menu-open" id="menu-open" class="menu-open-icon hidden-lg hidden-md">
			<span class="bars"></i>
		</a>
		<div class="container">
			<div class="col-md-12 menu-line-1 ">
				<div class="fechar-menu">
					<i class="fas fa-times"></i>
				</div>
				<div class="social-icons pull-right">
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

				<nav class="col-md-12 " id="menu-institucional" >
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

				</nav><!-- #menu-institucional.col-md-12 -->
			</div>
			<!-- .line-1 -->
			<div class="col-md-12 menu-line-2">
				<?php odin_the_custom_logo(); ?>

			</div>
			<!-- .line-2 -->
			<div class="col-sm-12 menu-line-3 ">

				<nav class=" menu-editorias text-center ">

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
					<div class="search-container col-md-7 text-right">
						<?php get_search_form( true );?>
					</div><!-- .search-container -->
					<a href="#" class="search-icon" data-open="false">
					</a>
				</nav><!-- .col-md-5 pull-right menu-editorias -->
			</div>
			<!-- .line-3 -->
		</div>
	</header><!-- #header -->
	<?php if( !is_tax() && is_singular( 'colunistas' ) ) {
		?>
	<div class="archive-colunista">
    	<div class="barra-colunistas">
    		<div  class="container">
    			<h5 class="col-md-12 no-padding">Colunistas</h5>
    		</div>
    	</div><?php
    	get_template_part( '/content/header', 'colunista' );
		?>
	</div>
	<?php
} else if( !is_tax() && has_term( '', 'colunistas', $post->ID )) {
		?>
	<div class="barra-colunistas">
		<div  class="container">
			<h5 class="col-md-12">Colunistas</h5>
		</div>
	</div>
<?php  }
else if( is_singular('post') ) {
		?>
	<div class="barra-editorias">
		<div  class="container">
			<?php
			$term = wp_get_post_terms( get_the_ID(), 'editorias' );
			?>
			<h5 class="col-md-12"><?php echo $term[0]->name;  ?></h5>
		</div>
	</div>
<?php  }?>
	<div id="wrapper" class="container">
		<div class="row">
