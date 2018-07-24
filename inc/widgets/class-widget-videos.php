<?php
/**
 * Class for implementing repetable posts widget
 *
 * @since 0.1
 *
 * @see WP_Widget
 */
class EOL_Videos_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_eol_linha', 'description' => 'Galeria de Vídeo' );
		$control_ops = array('width' => 400, 'height' => 700);
		parent::__construct('widget_eol_videos', __('Galeria de Vídeo'), $widget_ops, $control_ops);
	}

	/**
	 * Outputs the content for the current Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Text widget instance.
	 */
	public function widget( $args, $instance ) {
		// numero de posts a ser exibido
		$classes =  (isset($instance[ 'classe']) ? $instance[ 'classe'] :"") ;

		?>
		<div class="widget-videos-container <?php echo $classes ?> widget-container">
		<?php
		echo $args['before_widget'];
		$form =  (isset($instance[ 'form']) ? $instance[ 'form'] :"") ;
		$title = apply_filters( 'widget_title', 'Newsletter' );
		echo do_shortcode( '[eol_videos tag="'.$form.'"]' );
		echo $args['after_widget'];
		?>
		</div>
		<?php
	}

	/**
	 * Handles updating settings for the current Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'form' ] =  $new_instance[ 'form'] ;
		$instance[ 'classe' ] =  $new_instance[ 'classe'] ;
		return $instance;
	}

	/**
	 * Outputs the Text widget settings form.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'form' => '',
				'classe' => 'tamanho-50'
			)
		);
		?>
		<div class="form-container">
			<?php
			// numero de posts a ser exibido
			$form = sanitize_text_field( $instance['form'] );
			$classe = sanitize_text_field( $instance['classe'] );
			?>
			<p>
				<label>Tag da galeria de vídeo</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'form' ); ?>" value="<?php echo esc_attr($form); ?>">
			</p>
			<p>
				<label>Classes</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'classe' ); ?>" value="<?php echo esc_attr($classe); ?>">
			</p>

		</div><!-- .form-container -->
		<?php
	}
}

/**
 *
 * Registra o widget
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'EOL_Videos_Widget' );
} );
