
<?php
/* Template Name: Migração -> Colunistas */
get_header();
$categories = get_categories( array( 'parent' => 10 ) );
if ( $categories && ! is_wp_error( $categories ) ) {
	foreach ( $categories as $cat ) {
		$colunista = get_page_by_title( $cat->name, OBJECT, 'colunistas' );
		if ( $colunista && ! is_wp_error( $colunista ) && is_object( $colunista ) ) {
			$query = get_posts( array( 'cat' => $cat->term_id, 'posts_per_page' => 700 ) );
			// busca o termo do colunista
			$new_term = get_term_by( 'name', $colunista->post_title, 'colunistas_tax', OBJECT );
			if ( is_wp_error( $new_term ) || ! $new_term ) {
				echo 'colunista ' . $cat->name . ' com erro: <br><br>';
				var_dump( $new_term );
				echo '<br><br>';
				continue;
			}
			if ( ! $query || empty( $query ) ) {
				continue;
			}
			foreach ( $query as $post ) {
				$set = wp_set_post_terms( $post->ID, array( $new_term->term_id ), 'colunistas_tax' );
				var_dump( $post->ID );
				echo '<br>';
				var_dump( $set );
				echo '<br><br>';
			}
			clean_term_cache( array( $new_term->term_id ), 'colunistas_tax', true );
		}
	}
}
