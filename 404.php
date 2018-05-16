<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Odin
 * @since 2.2.0
 */

 get_header('large'); ?>

	<main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">

			<header class="page-header">
				<p>Desculpe, esta página não foi encontrada</p>
				<h1 class="page-title"><?php _e( '404', 'odin' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php _e( 'Nada foi encontrado nesse endereço. Talvez a busca no menu auxilie você a encontrar o que deseja.', 'odin' ); ?></p>
			</div><!-- .page-content -->

	</main><!-- #main -->

<?php
get_footer();
