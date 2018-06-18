<?php
/**
 * Widget Colunistas
 *
 */
class EOL_Widget_Estados extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'eol_widget_estado', 'description' => __('Menu por região e estado'));
		$control_ops = array('width' => 150, 'height' => 250);
		parent::__construct('eol_widget_estado', __('Menu regioões'), $widget_ops, $control_ops);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		?>
		<div class="widget-container widget-estados-container">
			<?php
		echo $args['before_widget'];
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Matérias por localidade' : $instance['title'], $instance, $this->id_base );
		echo $args['before_title'] . $title . $args['after_title'];

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$args_query = [
			'taxonomy'     => 'regioes',
			'number'        => 999,
			'hide_empty'    => true
		];
		$regioes = array_values(get_terms( $args_query ));
		$html = '<div class="widget-estados">';
		$html_tabs = '<div class="div-select"><select class="regioes"><option value="0">Regiões</option>';
		$html_content = '<div class="div-select"><select class="estados"><option value="0">Estados</option>';
		$html_array_tabs = array();
		foreach ($regioes as $regiao ) {
			if (!$regiao->parent) {
				$html_tabs .=
				'<option value="'.$regiao->term_id.'">'.$regiao->name.'</option>';
			}
			else{
				$html_content .='<option value="'.get_term_link($regiao).'" class="estado '.$regiao->parent.'">'.$regiao->name.'</option>';
			}
		}
		// foreach ($html_array_tabs as $key => $value) {
		// 	$html_content .=  '<select class="'.$key.' estados" class="tab-pane fade in "><option value="0">Estados</option>'.$value.'</select>';
		// }
		$html_tabs .='</select></div>';
		$html_content .= '</select></div>';
		$html .=$html_tabs.$html_content.'</div><!-- tabbed -->';
		echo $html;
		echo $args['after_widget'];?>
	</div>
	<?php

	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance[ 'posts' ] = absint( $new_instance[ 'posts'] );
		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posts' => 3 ) );
		$title = sanitize_text_field( $instance['title'] );
		$number = absint( $instance[ 'posts' ] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
	}
}

/**
 *
 * Registra o widget
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'EOL_Widget_Estados' );
} );
