<?php
/**
 * Class for implementing repetable posts widget
 *
 * @since 0.1
 *
 * @see WP_Widget
 */
class EOL_Galeria_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_eol_galeria', 'description' => 'Galeria de fotos' );
		$control_ops = array('width' => 400, 'height' => 700);
		parent::__construct('widget_eol_galeria', __('Galeria de Imagens'), $widget_ops, $control_ops);
		$this->remove_widget_padrao();
	}

	public function remove_widget_padrao() {
		unregister_widget('WP_Widget_Media_Gallery');
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
		$title =  (isset($instance[ 'title']) ? $instance[ 'title'] :"") ;

		?>
		<div class="widget-galeria-container <?php echo $classes ?> widget-container">
		<?php
		echo $args['before_widget'];
		$shortcode =  (isset($instance[ 'shortcode']) ? $instance[ 'shortcode'] :"");
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		if ( ! $title ) {
			$title = 'asss';
		}
		echo do_shortcode( $shortcode );
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
		$instance[ 'title' ] =  sanitize_text_field( $new_instance[ 'title'] );
		$instance[ 'shortcode' ] =  sanitize_text_field( $new_instance[ 'shortcode'] );

		$instance[ 'classe' ] =  sanitize_text_field( $new_instance[ 'classe'] ) ;
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
				'shortcode' => '',
				'classe' => 'tamanho-50',
				'title' => ''
			)
		);
		?>
		<div class="form-container">
			<?php
			// numero de posts a ser exibido
			$shortcode = sanitize_text_field( $instance['shortcode'] );
			$classe = sanitize_text_field( $instance['classe'] );
			$title = sanitize_text_field( $instance['title'] );

			?>
			<p>
				<label>Título</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($title); ?>">
			</p>

			<p>
				<label>Shortcode da galeria</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" value="<?php echo esc_attr($shortcode); ?>">
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
	register_widget( 'EOL_Galeria_Widget' );
} );
