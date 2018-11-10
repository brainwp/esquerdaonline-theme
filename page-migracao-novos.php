<?php
/* Template Name: Migração -> Novos */
get_header();
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
$request_url = 'https://esquerdaonline.com.br/wp-json/wp/v2/posts';
if ( isset( $_GET[ 'page_num' ] ) ) {
	$request_url .= '?page=' . $_GET[ 'page_num' ];
} else {
	$_GET[ 'page_num' ] = 1;
}
$response = wp_remote_get( $request_url );
if ( is_array( $response ) ) {
	$header = $response['headers']; // array of http header lines
	$body = $response['body']; // use the content>
	$posts = json_decode( $body );
	if ( $posts && is_array( $posts ) ) {
		foreach ( $posts as $post ) {
			echo '<br>';
			var_dump( $post->title->rendered );
			$max_date = new DateTime( '2018-07-13');
			$post_date = new DateTime( $post->date );
			if( ! ( $post_date->format('Y-m-d') > $max_date->format( 'Y-m-d' ) ) ) {
				echo 'Cadastrado todos!';
				die();
			}
			$search_post = get_page_by_title( $post->title, OBJECT, 'post' );
			$have_post = false;
			if ( $search_post && ! is_wp_error( $search_post ) ) {
				$have_post = true;
				break;
			}
			$tags = array();
			if ( isset( $post->pure_taxonomies->tags ) && ! empty( $post->pure_taxonomies->tags ) ) {
				foreach ( $post->pure_taxonomies->tags as $tag ) {
					$tags[] = $tag->name;
				}
			}
			$categories = array();
			if ( isset( $post->pure_taxonomies->categories ) && ! empty( $post->pure_taxonomies->categories ) ) {
				foreach ( $post->pure_taxonomies->categories as $cat ) {
					$categories[] = $cat->name;
				}
			}

			$colunista = false;
			if ( isset( $post->pure_taxonomies->categories ) && ! empty( $post->pure_taxonomies->categories ) ) {
				foreach ( $post->pure_taxonomies->categories as $cat ) {
					if ( 10 === intval( $cat->parent ) ) {
						$colunista = get_page_by_title( $cat->name, OBJECT, 'colunistas' );
						break;
					}
				}
			}

			$new_post = array(
				'post_title'	=> $post->title->rendered,
				'post_content'	=> $post->content->rendered,
				'post_status' 	=> 'publish',
				'post_date'		=> $post->date
			);
			if ( ! empty( $tags ) ) {
				$new_post[ 'tags_input' ] = $tags;
			}
			$add_new_post = wp_insert_post( $new_post, true );
			if ( is_wp_error( $add_new_post ) ) {
				var_dump( $add_new_post );
				continue;
			}
			wp_set_post_tags( $add_new_post, $tags, false );
			wp_set_object_terms( $add_new_post, $categories, 'category', false );
			if ( $colunista && is_object( $colunista ) && ! is_wp_error( $colunista ) ) {
				$colunista_term = get_term_by( 'slug', $colunista->post_name, 'colunistas_tax' );
				echo '<br> termo do colunista<br>';
				var_dump( $colunista_term );
				if ( $colunista_term && ! is_wp_error( $colunista_term ) ) {
					$return = wp_set_post_terms( $add_new_post, array( $colunista_term->term_id ), 'colunistas_tax', false );
						echo '<br>colunista cadastrado!<br>';
						var_dump( $return );
				}
			}
			echo '<br>';
			var_dump( $colunista );
			echo '<br>categorias cadastradas: <br>';
			var_dump( wp_get_post_terms( $add_new_post, 'category' ) );
			echo '<br>';
			$thumbnail_url = $post->better_featured_image->source_url;
			echo 'OLD THUMB URL <br>';
			var_dump( $thumbnail_url );
			$thumbnail_id = media_sideload_image( $thumbnail_url, $add_new_post, null, 'id' );
			echo 'THUMB ID <br>';
			var_dump( $thumbnail_id );
			set_post_thumbnail( $add_new_post, $thumbnail_id );
			if ( $post->better_featured_image->image_author ) {
				update_post_meta( $thumbnail_id, 'image_author', $post->better_featured_image->image_author );
			}
			echo '<br>Cadastrando ACF';
			foreach ( $post->acf as $key => $value) {
				update_post_meta( $add_new_post, $key, $value );
			}
			echo '<br>---------------<br>';
		}
	}
	$_GET[ 'page_num' ]++;
	if ( ! $have_post ) {
		echo '<script>window.location.href = "https://esquerdaonline.org/pagina-migracao-novos-posts/?page_num='. $_GET[ 'page_num'] . '";</script>';
	} else {
		echo '<br><b style="color:red">POST COM O MESMO NOME ENCONTRADO!</b>';
	}
}
