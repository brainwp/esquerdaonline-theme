<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $slider, $atts;
$cfg = (!empty($atts['json'])) ? $atts['json'] : get_post_meta($slider->ID,'brasa-slider-cfg',true);
$ids = esc_textarea( get_post_meta( $slider->ID, 'brasa_slider_ids', true ) );
$ids = explode(',', $ids);
$size = (!empty($atts['size'])) ? $atts['size'] : esc_textarea( get_post_meta( $slider->ID, 'brasa_slider_size', true ) );
global $_wp_additional_image_sizes;
// echo $size;
if (!array_key_exists($size, $_wp_additional_image_sizes)) {
	$full_size = $size.'-g';
	$small_size = $size.'-p';
}
elseif(strpos($size,'retangular' ) !== false ){
	$full_size = 'retangular-g';
	$small_size = 'retangular-p';

}
elseif(strpos($size,'quadrada') !== false ){
	$full_size = 'quadrada-g';
	$small_size = 'quadrada-p';
}
else{
	$full_size = $size;
	$small_size = $size;
}
$brasa_slider_id = $slider->ID;
?>
<?php if (!is_singular('brasa_slider_cpt')): ?>
	<h3 class="galeria-title">
		<?php echo apply_filters( 'the_title', $slider->post_title );?>
	</h3><!-- .galeria-title -->
<?php endif;?>
<div class="social-icons-post" data-share="<?php echo get_permalink( $slider->ID );?>">
	<?php eol_share_overlay( get_permalink( $slider->ID ) );?>
</div><!-- .col-md-12 social-icons-post -->
<div class="each-galeria-brasa">
<div id="main-slide" class=" first-slider galeria-eol">
	<div class="loader"></div>
	<?php foreach ( $ids as $id ) :
		$brasa_slider_item_id = $id;
		if(get_post_type($id) == 'attachment'){
			$img = $id;
		} else {
			$img = get_post_thumbnail_id($id);
		}
		$img_full = wp_get_attachment_image_src( $img, $full_size, false );
		$img = wp_get_attachment_image_src( $img, $small_size, false );?>
		<a href="#">
		    	<img src="<?php echo esc_url( $img_full[0] );?>" class="img_slider modal-item-open" data-src="<?php echo esc_url( $img_full[0] );?>" data-type="image" data-url="<?php echo get_permalink( $brasa_slider_id );?>">
		</a>
		<?php break;?>
	<?php endforeach;?>
	<div class="overlay-post-link-widget-text">
		<div class="post-link-widget-text" >
			<h3 class="tax-widget-titulo each-image-title">
				<?php echo wp_get_attachment_caption( $ids[0] );?>
			</h3>
			<h5 class="tax-widget-titulo each-image-title-author">
				<?php if ( $field = get_post_meta( $ids[0], 'image_author', true ) ) : ?>
					<i class="fas fa-camera hidden-sm hidden-xs"></i> <?php echo $field;?>
				<?php endif;?>
			</h5>

		</div>
	</div>
</div><!-- .col-md-12 first-slider galeria-eol -->

<div class="navegacao-slider is_slider" id="slider-<?php echo esc_attr( $slider->post_name );?>" data-json="<?php echo esc_attr( $cfg ); ?>">
	<?php
	foreach ( $ids as $id ) :
		$brasa_slider_item_id = $id;
		if(get_post_type($id) == 'attachment'){
			$img = $id;
		} else {
			$img = get_post_thumbnail_id($id);
		}
		$img_top = wp_get_attachment_image_src( $img, 'full', false );
		$img_full = wp_get_attachment_image_src( $img, $full_size, false );
		$img = wp_get_attachment_image_src( $img, $small_size, false );
		$author = get_post_meta( $ids[0], 'image_author', true );
		if ( ! $author ) {
			$author = '';
		} ?>
		<div class="slick_slide galeria-id-<?php echo $id;?>" data-full="<?php echo $img_full[0];?>" >
			<a href="#" data-src="<?php echo esc_url( $img_top[0] );?>">
		    	<img src="<?php echo esc_url( $img[0] );?>" class="modal-item-open" data-src="<?php echo esc_url( $img_top[0] );?>" data-type="image" data-caption="<?php echo esc_attr( wp_get_attachment_caption( $id ) );?>" data-author="<?php echo $author;?>">
		    </a>
		</div>
	<?php endforeach;?>
</div>
</div><!-- .each-galeria-brasa -->
