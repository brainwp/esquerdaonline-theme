<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $slider, $atts;
$cfg = (!empty($atts['json'])) ? $atts['json'] : get_post_meta($slider->ID,'brasa-slider-cfg',true);
$ids = esc_textarea( get_post_meta( $slider->ID, 'brasa_slider_ids', true ) );
$ids = explode(',', $ids);
$size = (!empty($atts['size'])) ? $atts['size'] : esc_textarea( get_post_meta( $slider->ID, 'brasa_slider_size', true ) );
$brasa_slider_id = $slider->ID;
?>
<div class="col-md-12 first-slider galeria-eol">
	<?php foreach ( $ids as $id ) :
		$brasa_slider_item_id = $id;
		if(get_post_type($id) == 'attachment'){
			$img = $id;
		} else {
			$img = get_post_thumbnail_id($id);
		}
		$size = apply_filters('brasa_slider_img_size', $size);
		$img = wp_get_attachment_image_src( $img, $size, false );?>
		<a <?php echo get_post_meta($slider->ID, 'brasa_slider_link_window_' . $id, true ) ?  "target='_blank'" : ''; ?> href="<?php echo esc_url( get_post_meta($slider->ID, 'brasa_slider_id' . $id, true ) );?>">
		    	<img src="<?php echo esc_url( $img[0] );?>" class="img_slider">
		</a>
		<?php unset( $ids[0] );?>
		<?php break;?>
	<?php endforeach;?>
</div><!-- .col-md-12 first-slider galeria-eol -->
<div class="col-md-12 is_slider" id="slider-<?php echo esc_attr( $slider->post_name );?>" data-json="<?php echo esc_attr( $cfg ); ?>">
	<?php
	foreach ( $ids as $id ) :
		$brasa_slider_item_id = $id;
		if(get_post_type($id) == 'attachment'){
			$img = $id;
		} else {
			$img = get_post_thumbnail_id($id);
		}
		$size = apply_filters('brasa_slider_img_size', $size);
		$img = wp_get_attachment_image_src( $img, $size, false );
		$img_full = wp_get_attachment_image_src( $img, 'full', false );
		?>
		<div class="slick_slide" data-full="<?php echo $img_full;?>">
			<a <?php echo get_post_meta($slider->ID, 'brasa_slider_link_window_' . $id, true ) ?  "target='_blank'" : ''; ?> href="<?php echo esc_url( get_post_meta($slider->ID, 'brasa_slider_id' . $id, true ) );?>">
		    	<img src="<?php echo esc_url( $img[0] );?>" class="img_slider">
		    </a>
		</div>
	<?php endforeach;?>
</div>
