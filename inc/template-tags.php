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
		return 'col-md-9';
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
		return 'col-md-3 hidden-xs hidden-print widget-area';
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
		printf( '<span class="entry-date"><time class="entry-date" datetime="%s">%s</time></span> - <span class="byline">%s <span class="modify-date">%s</span></span>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'd/m/Y h:i' ) ),
			__( 'Modificado em ', 'odin' ),
			get_the_modified_date( 'd/m/Y h:i' )
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

function eol_single_thumbnail() {
	echo '<div class="single-thumbnail">';
	if ( $single_thumbnail = get_post_meta( get_the_ID(), 'thumbnail_single', true ) ) {
		$single_thumbnail_img = wp_get_attachment_image_src( $single_thumbnail, 'large', false );
		printf( '<img src="%s" alt="%s">', $single_thumbnail_img[0], esc_attr(get_the_title() ) );
	} else {
		the_post_thumbnail( 'large' );
		$single_thumbnail = get_post_thumbnail_id();
	}
	echo '</div>';
	if ( $author = get_post_meta( $single_thumbnail, 'image_author', true ) ) {
		printf( __('<span class="image-author"><i class="fas fa-camera"></i><span>Foto: %s</span></span>', 'eol' ), apply_filters( 'the_title', $author ) );
	}
}
