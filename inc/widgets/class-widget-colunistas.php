<?php
/**
 * Widget Colunistas
 *
 */
class EOL_Widget_Colunistas extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'eol_widget_colunistas', 'description' => __('Widget de Colunistas'));
		$control_ops = array('width' => 150, 'height' => 250);
		parent::__construct('eol_widget_colunistas', __('Widget Colunistas'), $widget_ops, $control_ops);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$classes = apply_filters( 'widget_title', empty( $instance['classes'] ) ? 'tamanho-100' : $instance['classes'], $instance);
		$classes_noticias = apply_filters( 'widget_title', empty( $instance['classes-noticias'] ) ? 'tamanho-100' : $instance['classes-noticias'], $instance);
		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$posts = apply_filters( 'widget_colunistas_posts', empty( $instance['posts'] ) ? 3 : $instance['posts'], $instance );
		?>
		<div class="widget-colunistas widget-container no-padding  <?php echo $classes; ?> ">
			<?php
			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			$query = new WP_Query( array(
				'post_type' => 'colunistas',
				'posts_per_page' => $posts
			) );
			if ( $query->have_posts() ) {
				echo '<div class="widget-colunistas">';
				while( $query->have_posts() ) {?>

					<div class="each-colunista  <?php echo $classes_noticias; ?>">
					<?php
					$query->the_post();
					$GLOBALS[ 'classes_noticias' ] = $classes_noticias;
					get_template_part( 'content/each-colunista' );
					 ?>
				 </div> <!--each-colunista-->
					 <?php
				}
				wp_reset_postdata();
				echo '</div>';
			}
			?>
			<a class="colunistas-link" href="<?php echo get_home_url( '','/colunistas')?>">Veja Mais</a>
			<?php
			echo $args['after_widget'];
			?>
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
		$instance['classes'] = sanitize_text_field( $new_instance['classes'] );
		$instance['classes-noticias'] = sanitize_text_field( $new_instance['classes-noticias'] );
		$instance[ 'posts' ] = absint( $new_instance[ 'posts'] );
		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posts' => 3, 'classes' => 'tamanho-100', 'classes-noticias' => 'tamanho-100' ) );
		$title = sanitize_text_field( $instance['title'] );
		$classes = sanitize_text_field( $instance['classes'] );
		$classes_noticias = sanitize_text_field( $instance['classes-noticias'] );
		$number = absint( $instance[ 'posts' ] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Numero de colunistas a ser exibido:', 'eol' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'classes' ); ?>"><?php _e( 'Classes do widget', 'eol' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('classes'); ?>" name="<?php echo $this->get_field_name('classes'); ?>" type="text" value="<?php echo esc_attr($classes); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'classes-noticias' ); ?>"><?php _e( 'Classes das notícias', 'eol' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('classes-noticias'); ?>" name="<?php echo $this->get_field_name('classes-noticias'); ?>" type="text" value="<?php echo esc_attr($classes_noticias); ?>" /></p>

<?php
	}
}

/**
 *
 * Registra o widget
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'EOL_Widget_Colunistas' );
} );
