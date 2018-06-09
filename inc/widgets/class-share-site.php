<?php
/**
 * Widget Share Site
 *
 */
class EOL_Widget_Share_Site extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'eol_widget_share_site', 'description' => __('Widget de Colunistas'));
		$control_ops = array('width' => 150, 'height' => 250);
		parent::__construct('eol_widget_share_site', __('Widget Compartilhar Site'), $widget_ops, $control_ops);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="widget-share-site">
			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url();?>">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo home_url();?>">
					<i class="fab fa-twitter"></i>
			</a>
			<a target="_blank" href="https://plus.google.com/share?url=https://esquerdaonline.com.br">
				<i class="fab fa-google-plus"></i>
			</a>
		</div><!-- .widget-share-site -->
		<?php
		echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posts' => 3 ) );
		$title = sanitize_text_field( $instance['title'] );
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
	register_widget( 'EOL_Widget_Share_Site' );
} );
