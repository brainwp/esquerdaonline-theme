<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
$widget = $GLOBALS[ 'current_widget' ];
?>
<article class="each-post-widget <?php echo esc_attr( $widget[ 'classes_posts' ] );?>">
	<div class="thumbnail">
		<?php if ( isset( $widget_post[ 'image_id'] ) && absint( $widget_post[ 'image_id' ] ) > 0 ) :
			$image = wp_get_attachment_image_src( $widget_post[ 'image_id'], 'medium', false );
			if ( $image ) {
				printf( '<img src="%s">', $image[0] );
			}
		endif;
		?>
	</div><!-- .thumbnail -->
</article><!-- #post-## -->
