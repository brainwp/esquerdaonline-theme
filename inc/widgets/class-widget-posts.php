<?php
/**
 * Class for implementing repetable posts widget
 *
 * @since 0.1
 *
 * @see WP_Widget
 */
class EOL_Posts_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_eol_posts', 'description' => 'Widget de posts com repetidor' );
		$control_ops = array('width' => 400, 'height' => 700);
		parent::__construct('widget_eol_posts', __('Widget de Posts'), $widget_ops, $control_ops);
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
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 * @since 4.4.0 Added the `$this` parameter.
		 *
		 * @param string         $widget_text The widget content.
		 * @param array          $instance    Array of settings for the current widget.
		 * @param WP_Widget_Text $this        Current Text widget instance.
		 */
		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $args['after_widget'];
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
		var_dump( $new_instance ) . '<br>';
		var_dump( $old_instance );
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_kses_post( stripslashes( $new_instance['text'] ) );
		$instance['filter'] = ! empty( $new_instance['filter'] );
		$instance[ 'posts' ] = array();
		$index = 0;
		foreach ( $new_instance[ 'post_title'] as $key => $value ) {
			if ( ! isset( $new_instance[ 'post_id'][ $index ] ) ) {
				continue;
			}
			$instance[ 'posts' ][ $index ][ 'post_title' ] = esc_attr( $value );
			$instance[ 'posts' ][ $index ][ 'post_id' ] = absint( $new_instance[ 'post_id'][ $index ] );
			$index++;
		}
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
				'title' => '',
				'posts' => array(),
			)
		);
		/**
		 * Template HTML para o repetidor de campos
		 * Quando clicado em adicionar post, o conteúdo dessa tag é copiado para dentro da div.posts
		 */
		?>
		<script type="text/template" id="eol-posts-widget-<?php echo $this->get_field_id('title'); ?>">
			<li class="each-repeater" style="border:1px solid #e3e3e3;">
				<p>
					<label>Titulo do post</label>
					<input class="widefat post-title" type="text" name="<?php echo $this->get_field_name( 'post_title[]' ); ?>">
				</p>
					<p>
						<label>Buscar post / ID do post</label>
						<input class="widefat post-search" type="text" name="<?php echo $this->get_field_name( 'post_id[]' ); ?>">
						<span class="posts-search-list">

						</span>
					</p>
				<p>
					<a href="#" class="remove-row">
						Remover post
					</a>
				</p>
			</li><!-- .each-repeater -->
		</script>
		<div class="form-container">
			<?php
			// campo de titulo "global"
			$widget_title = sanitize_text_field( $instance['title'] );
			?>
			<p>
				<label>Titulo do widget</label>
				<input class="widefat post-title" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($widget_title); ?>">
				<input type="text" class="force-change" name="<?php echo $this->get_field_name( 'force_change' );?>" style="display:none;"/>
			</p>

			<ul class="posts">
				<?php
				/**
				 * Adiciona a lista de campos já criado anteriormente e que já contem registro no banco do WP
				 */
				if ( ! empty( $instance[ 'posts'] ) ) : ?>
					<?php foreach ( $instance[ 'posts' ] as $post ) : ?>
						<li class="each-repeater" style="border:1px solid #e3e3e3;">
							<p>
								<label>Titulo do post</label>
								<input class="widefat post-title" type="text" name="<?php echo $this->get_field_name( 'post_title[]' ); ?>" value="<?php echo esc_attr( $post[ 'post_title'] );?>">
							</p>
							<p>
								<label>Buscar post / ID do post</label>
								<input class="widefat post-search" type="text" name="<?php echo $this->get_field_name( 'post_id[]' ); ?>" value="<?php echo esc_attr( $post[ 'post_id' ] );?>">
								<span class="posts-search-list"></span>
							</p>
							<p>
								<a href="#" class="remove-row">
									Remover post
								</a>
							</p>
						</li><!-- .each-repeater -->
					<?php endforeach;?>
				<?php endif;?>
			</ul><!-- .posts -->
			<a href="#eol-posts-widget-<?php echo $this->get_field_id('title'); ?>" class="add-new-row">
				(+) Adicionar post
			</a>
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
	register_widget( 'EOL_Posts_Widget' );
} );
