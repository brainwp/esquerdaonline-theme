<?php
/**
 * Widget Colunistas
 *
 */
class EOL_Widget_Video_Live extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'eol_widget_video_live', 'description' => __('Widget de vídeo ao-vivo'));
		$control_ops = array('width' => 150, 'height' => 250);
		parent::__construct('eol_widget_video_live', __('Widget de vídeo ao-vivo'), $widget_ops, $control_ops);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = esc_attr( $instance[ 'text' ] );
		$classes = esc_attr( $instance[ 'classes' ] );
		$url = esc_url_raw( $instance[ 'url'] );
		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		 ?>
		 <?php if ($text == ''): ?>
			 <div class="faixa-topo">
			 	<a href="#live">
					<?php echo $text;?>
				</a>
				<a id="fechar-topo" href="#">X</a>
			 </div>
		 <?php endif; ?>
		 <div id="live" class="widget-live-container widget-container <?php echo $classes; ?> ">
			 <?php
			$posts = apply_filters( 'widget_colunistas_posts', empty( $instance['posts'] ) ? 3 : $instance['posts'], $instance );
			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			$embed = wp_oembed_get( $url );
			if ( $embed ) {
				echo $embed;
			}
			?>
			<?php
			echo $args['after_widget'];
			?>
		</div> <!--widget-live-container-->
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
		$instance['text'] = sanitize_text_field( $new_instance['text'] );
		$instance['classes'] = sanitize_text_field( $new_instance['classes'] );
		$instance['url'] = sanitize_text_field( $new_instance['url'] );

		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'classes' => 'tamanho-25', 'url' => '' ) );
		$title = sanitize_text_field( $instance['title'] );
		$text = sanitize_text_field( $instance['text'] );
		$classes = sanitize_text_field( $instance['classes'] );
		$url = sanitize_text_field( $instance['url'] );

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Texto da faixa no topo:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($text); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('classes'); ?>"><?php _e('Classes CSS:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('classes'); ?>" name="<?php echo $this->get_field_name('classes'); ?>" type="text" value="<?php echo esc_attr($classes); ?>" /></p>


		<p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL do Vídeo:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>


<?php
	}
}

/**
 *
 * Registra o widget
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'EOL_Widget_Video_Live' );
} );
