<?php
/**
 * Class for implementing repetable posts widget
 *
 * @since 0.1
 *
 * @see WP_Widget
 */
class EOL_Tags_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_eol_tags', 'description' => 'Widget para exibir links de tags selecionadas' );
		$control_ops = array('width' => 400, 'height' => 700);
		parent::__construct('widget_eol_tags', __('Tags'), $widget_ops, $control_ops);
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

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		?>
		<div class="widget-container widget-tags-container">
		<?php
		echo $args['before_widget'];

		// pega o termo da tag selecionada;
		if (isset($instance[ 'tags_selecionadas' ])) {
			$tags_selecionadas =  (isset($instance[ 'tags_selecionadas']) ? $instance[ 'tags_selecionadas']:"") ;
			echo do_shortcode( '[eol_tags tags="'.$tags_selecionadas.'"]' );
		}
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
		$instance['tags_selecionadas'] = sanitize_text_field( $new_instance['tags_selecionadas'] );
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
				'tags_selecionadas' => '',
			)
		);
		?>
		<div class="form-container">
			<?php
			// campo de titulo "global"
			$tags_selecionadas = sanitize_text_field( $instance['tags_selecionadas'] );
			?>
			<p>
				<label>Tags por nome separadas por vírugula</label>
				<input class="widefat post-title" type="text" name="<?php echo $this->get_field_name( 'tags_selecionadas' ); ?>" value="<?php echo esc_attr($tags_selecionadas); ?>">
				<input type="text" class="force-change" name="<?php echo $this->get_field_name( 'force_change' );?>" style="display:none;"/>
			</p>
		</div>
		<?php
	}
}

/**
 *
 * Registra o widget
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'EOL_Tags_Widget' );
} );
