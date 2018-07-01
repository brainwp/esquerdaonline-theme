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
		parent::__construct('widget_eol_posts', __('Posts'), $widget_ops, $control_ops);
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
		if ( ! empty( $instance[ 'title_front'] ) ) {
			$title = apply_filters( 'the_title', $instance[ 'title_front' ] );
		}
		// pega o termo da posição selecionada;
		$posicao = absint( $instance[ 'posicao' ] );

		// pega as classes do widget (global) e de cada post
		$classes_widget = esc_attr( $instance[ 'classes_widget' ] );
		$classes_posts = esc_attr( $instance[ 'classes_posts' ] );

		// numero de posts a ser exibido
		$number = absint( $instance[ 'number'] );

		$query = new WP_Query(
			array(
				'posts_per_page' => $number,
				'post_type' => array('post', 'especiais'),
				'tax_query' => array(
					array(
						'taxonomy' => '_featured_eo',
						'terms'    => $posicao,
					),
				),
			)
		);
		if ( $query->have_posts() ) {
			printf( '<div class="widget-eol-posts widget-container %s">', esc_attr( $instance[ 'classes_widget' ] ) );
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			// coloca o widget atual numa variavel global para
			$GLOBALS[ 'current_widget' ] = $instance;
			while( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'content/post' );
			}
			echo '</div>';
			wp_reset_postdata();
		}
		?>
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
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['title_front'] = sanitize_text_field( $new_instance['title_front'] );

		$instance['classes_widget'] = esc_attr( sanitize_text_field( $new_instance['classes_widget'] ) );
		$instance['classes_posts'] = esc_attr( sanitize_text_field( $new_instance['classes_posts'] ) );
		$instance[ 'posicao' ] = absint( $new_instance[ 'posicao'] );
		$instance['readmore'] = sanitize_text_field( $new_instance['readmore'] );
		$instance[ 'number' ] = absint( $new_instance[ 'number'] );

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
				'title_front' => '',
				'classes_widget' => 'titulo-pequeno tamanho-50',
				'readmore' => '',
				'posicao' => '',
				'classes_posts' => 'thumb-quadrada exibicao-titulo  tamanho-50 foto-fundo',
				'number' => 0
			)
		);
		?>
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
			<?php
			// campo de titulo "global" no front
			$widget_title_front = sanitize_text_field( $instance['title_front'] );
			?>
			<p>
				<label>Titulo do widget no site</label>
				<input class="widefat post-title" type="text" name="<?php echo $this->get_field_name( 'title_front' ); ?>" value="<?php echo esc_attr($widget_title_front); ?>">
			</p>

			<?php
			// campo de classes "global"
			$classes = sanitize_text_field( $instance['classes_widget'] );
			?>
			<p>
				<label>
					Classes CSS do widget<br>
					<small>Coloque cada classe separado por uma barra de espaço</small>
				</label>
				<input class="widefat classes-css" type="text" name="<?php echo $this->get_field_name( 'classes_widget' ); ?>" value="<?php echo esc_attr($classes); ?>">
			</p>
			<?php
			// seletor de termo da taxonomia "_eo_featured"
			$posicao = absint( $instance['posicao'] );
			$terms = get_terms( array( 'taxonomy' => '_featured_eo', 'hide_empty' => false ) );
			?>
			<p>
				<label>
					Posição (Precisa descrever melhor)<br>
				</label>
				<?php if( ! is_wp_error( $terms ) && ! empty( $terms ) ) : ?>
					<select name="<?php echo $this->get_field_name( 'posicao' ); ?>" required>
						<?php if ( 0 === $posicao ) {
							echo '<option value="" selected>' . __( 'Selecione a taxonomia de posição' ) . '</option>';
						} else {
							echo '<option value="">' . __( 'Selecione a taxonomia de posição' ) . '</option>';
						} ?>
						<?php foreach ( $terms as $term ) : ?>
							<?php $selected = '';?>
							<?php if ( $posicao === $term->term_id ) {
								$selected = 'selected';
							} ?>
							<option value="<?php echo $term->term_id;?>" <?php echo $selected;?>>
								<?php echo $term->name;?>
							</option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</p>

			<?php
			// campo de classes "pra cada post"
			$classes_posts = sanitize_text_field( $instance['classes_posts'] );
			?>
			<p>
				<label>
					Classes CSS do post<br>
					<small>Coloque cada classe separado por uma barra de espaço</small>
				</label>
				<input class="widefat classes-css" type="text" name="<?php echo $this->get_field_name( 'classes_posts' ); ?>" value="<?php echo esc_attr($classes_posts); ?>">
			</p>
			<?php
			// campo de classes "global"
			$readmore = sanitize_text_field( $instance['readmore'] );
			?>
			<p>
				<label>
					Link Leia Mais
				</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo esc_attr($readmore); ?>">
			</p>

			<?php
			// numero de posts a ser exibido
			$number = sanitize_text_field( $instance['number'] );
			?>
			<p>
				<label>Numero de posts</label>
				<input class="widefat" type="number" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr($number); ?>">
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
	register_widget( 'EOL_Posts_Widget' );
} );
