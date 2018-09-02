<?php
/**
 * Class for implementing repetable posts widget
 *
 * @since 0.1
 *
 * @see WP_Widget
 */
class EOL_Div_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'eol_div_widget', 'description' => 'Widget separador' );
		$control_ops = array('width' => 400, 'height' => 300);
		parent::__construct('eol_div_widget', __('Abre DIV'), $widget_ops, $control_ops);
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


		$classes =  (isset($instance[ 'classes']) ? $instance[ 'classes']: 'tamanho-100') ;
		echo '<div class="' . $classes . '">';
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
		$instance[ 'classes' ] =  $new_instance[ 'classes'] ;
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
				'classes' => 'tamanho-100'
			)
		);
		?>
		<div class="form-container">
			<?php
			// classes
			$classes = sanitize_text_field( $instance['classes'] );
			?>
			<p>
				<label>Classes</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'classes' ); ?>" value="<?php echo esc_attr($classes); ?>">
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
	register_widget( 'EOL_Div_Widget' );
} );
