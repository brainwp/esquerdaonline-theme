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
		<?php unset( $ids[0] );?>
		<?php break;?>
	<?php endforeach;?>
	<?php if (!is_singular('brasa_slider_cpt')): ?>
		<div class="overlay-post-link-widget-text">
			<div class="post-link-widget-text" >
				<h3 class="tax-widget-titulo">
					<?php echo $slider->post_title;?>
				</h3>
			</div>
		</div>
	<?php endif; ?>
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
		$img_full = wp_get_attachment_image_src( $img, $full_size, false );
		$img = wp_get_attachment_image_src( $img, $small_size, false );?>
		<div class="slick_slide" data-full="<?php echo $img_full;?>">
			<a href="#" data-src="<?php echo esc_url( $img_full[0] );?>">
		    	<img src="<?php echo esc_url( $img[0] );?>" class="modal-item-open" data-src="<?php echo esc_url( $img_full[0] );?>" data-type="image">
		    </a>
		</div>
	<?php endforeach;?>
</div>
</div><!-- .each-galeria-brasa -->
