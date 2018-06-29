<?php
/**
 * Custom template tags for Odin.
 *
 * @package Odin
 * @since 2.2.0
 */

if ( ! function_exists( 'odin_classes_page_full' ) ) {

	/**
	 * Classes page full.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_full() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar' ) ) {

	/**
	 * Classes page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar() {
		//return 'col-md-9';
		return 'col-md-8';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar_aside' ) ) {

	/**
	 * Classes aside of page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar_aside() {
		return 'col-md-4  hidden-print widget-area';
	}
}

if ( ! function_exists( 'odin_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', 'odin' ) . ' </span>';
		}

		// Set up and print post meta information.
			printf( '<span class="entry-date">Publicado em: <time class="entry-date" datetime="%s">%s</time></span> <span class="byline">%s <span class="modify-date">  %s</span></span>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'd/m/Y h\hi' ) ),
			__( 'Modificado em: ', 'odin' ),
			get_the_modified_date( 'd/m/Y h\hi' )
		);
	}
}

if ( ! function_exists( 'odin_paging_nav' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_paging_nav() {
		$mid  = 2;     // Total of items that will show along with the current page.
		$end  = 1;     // Total of items displayed for the last few pages.
		$show = false; // Show all items.

		echo odin_pagination( $mid, $end, false );
	}
}

if ( ! function_exists( 'odin_the_custom_logo' ) ) {

	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Odin 2.2.10
	 */
	function odin_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}
/**
 * Output the single thumbnail if it's exists
 * If not, return the default get_post_thumbnail()
 */
function eol_single_thumbnail($size='full', $post_id = null, $meta = null) {
	$single_thumbnail = '';
	echo '<div class="single-thumbnail">';
	$post_id = ( $post_id ? $post_id : get_the_ID());
	preg_match("/widget([^\s]+)/", $size, $size_thumb);
	// se single
	if (is_single( $post_id )) {
		// se vai mostrar a alternativa
		if (get_field('exibir_na_single',$post_id) && $single_thumbnail = get_post_meta( $post_id , 'thumbnail_single', true )) {
			$single_thumbnail = get_post_meta( $post_id , 'thumbnail_single', true );
			$single_thumbnail_img = wp_get_attachment_image_src( $single_thumbnail, 'full', false );
			printf( '<img src="%s" alt="%s">', $single_thumbnail_img[0], esc_attr(get_the_title() ) );
		}
		// se vai mostrar a padrão
		elseif($single_thumbnail_img = get_the_post_thumbnail( $post_id , 'full' )){
			echo $single_thumbnail_img;
			$single_thumbnail = get_post_thumbnail_id( $post_id );
		}
		else{
			// fazer imagem padrão ser utilizada no facebook.
		}
	}
	// se é widget e é thumb-widget com imagem alternativa
	elseif( isset($size_thumb[1] ) &&  $single_thumbnail = get_post_meta( $post_id , 'thumbnail_single', true )){
		$single_thumbnail_img = wp_get_attachment_image_src( $single_thumbnail, 'full', false );
		printf( '<img src="%s" alt="%s">', $single_thumbnail_img[0], esc_attr(get_the_title() ) );
	}
	// se é widget e é thumb-widget com imagem destacada
	elseif (isset($size_thumb[1] )&& $single_thumbnail_img = get_the_post_thumbnail( $post_id , 'full' )) {
		echo $single_thumbnail_img;
		$single_thumbnail = get_post_thumbnail_id( $post_id );
	}
	// se é widget e é thumb-tamanho com imagem destacada
	elseif($single_thumbnail_img = get_the_post_thumbnail( $post_id , $size )) {
		echo $single_thumbnail_img;
		$single_thumbnail = get_post_thumbnail_id( $post_id );
	}
	else{
		if ($size != "") {
			$size = "-".$size;
		}
		?>
			<img class="attachment-post-default-thumbnail size-post-default-thumbnail wp-post-image" src="<?php echo get_template_directory_uri() ?>/assets/images/img-default<?php echo $size; ?>.jpg" alt="">
		<?php
	}
	echo '</div>';
	if ($meta) {
		if ( is_single($post_id) && $author = get_post_meta( $single_thumbnail, 'image_author', true ) ) {
			printf( __('<span class="image-author"><i class="fas fa-camera hidden-sm hidden-xs"></i><span>%s</span></span>', 'eol' ), apply_filters( 'the_title', $author ) );
		}
		if ( is_single($post_id) && $caption = wp_get_attachment_caption( $single_thumbnail) ) {
			printf( __('<p class="image-caption">%s</p>', 'eol' ), apply_filters( 'the_title', $caption ) );
		}
	}


	// print_r($size);
	// die;


}
function eol_single_thumbnail_meta($post_id, $single_thumbnail){
	$post_id = ( $post_id ? $post_id : get_the_ID());

}
function eol_widget_thumbnail($size,$id) {

}
function eol_share_overlay() {
	echo '
	<div class="icon-itself">
		<a href="#">
			<i class="fab fa-facebook-f"></i>
		</a>
	</div>
	<div class="icon-itself">
		<a href="#">
			<i class="fab fa-twitter"></i>
		</a>
	</div>
	<div class="icon-itself hidden-md hidden-lg">
		<a href="#">
			<i class="fab fa-whatsapp"></i>
		</a>
	</div>
	<div class="icon-itself">
		<a href="#">
			<i class="fab fa-telegram"></i>
		</a>
	</div>
	';
}
