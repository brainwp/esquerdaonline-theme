
<?php
/* Template Name: Migração -> Colunistas */
$categories = get_categories( array( 'parent' => 10 ) );
if ( $categories && ! is_wp_error( $categories ) ) {
	foreach ( $categories as $cat ) {
		$colunista = get_page_by_title( $cat->name, OBJECT, 'colunistas' );
		if ( $colunista && ! is_wp_error( $colunista ) && is_object( $colunista ) ) {
			$query = get_posts( array( 'cat' => $cat->term_id, 'posts_per_page' => 700 ) );
			// cria um termo em colunista
			$new_term = wp_insert_term( $colunista->post_title, 'colunistas', array( 'slug' => $colunista->post_name ) );
			if ( is_wp_error( $new_term ) ) {
				echo 'colunista ' . $cat->name ' com erro: <br><br>';
				var_dump( $new_term );
				echo '<br><br>';
			}
			if ( ! $query || empty( $query ) ) {
				continue;
			}
			foreach ( $query as $post ) {
				$set = wp_set_post_terms( $colunista->ID, array( $new_term[ 'term_id' ] ), 'colunistas' );
			}
		}
	}
}
