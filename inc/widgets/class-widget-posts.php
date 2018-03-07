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
			//echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( $instance[ 'posts' ] && is_array( $instance[ 'posts'] ) && ! empty( $instance[ 'posts'] ) ) {
			printf( '<div class="col-md-12 widget-eol-posts %s">', esc_attr( $instance[ 'classes_widget' ] ) );
			foreach ( $instance[ 'posts'] as $key => $value ) {
				$GLOBALS[ 'widget_current_post' ] = $value;
				setup_postdata( $value[ 'post_id' ] );
				get_template_part( 'content/post' );
			}
			echo '</div>';
			wp_reset_postdata();
		}
		?>
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
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance[ 'posts' ] = array();
		$instance['classes_widget'] = esc_attr( sanitize_text_field( $new_instance['classes_widget'] ) );
		$instance['readmore'] = sanitize_text_field( $new_instance['readmore'] );
		$index = 0;
		foreach ( $new_instance[ 'post_title'] as $key => $value ) {
			$instance[ 'posts' ][ $index ][ 'post_title' ] = esc_attr( $value );
			$instance[ 'posts' ][ $index ][ 'post_id' ] = absint( $new_instance[ 'post_id'][ $index ] );
			if ( 0 === $instance[ 'posts' ][ $index ][ 'post_id' ] ) {
				$instance[ 'posts' ][ $index ][ 'post_id' ] = '';
			}
			// Verifica se o campo de imagem foi preenchido e valida se o ID é de fato uma imagem
			if ( isset( $new_instance[ 'image_id'][ $index ] ) && ! empty( $new_instance[ 'image_id'][ $index ] ) ) {
				$image_id = absint( $new_instance[ 'image_id'][ $index ] );
				if ( wp_attachment_is_image( $image_id ) ) {
					$instance[ 'posts' ][ $index ][ 'image_id' ] = $image_id;
				}
			}
			// Verifica se o campo de texto "classes css" está preenchido, se sim, seta o valor no novo array, se não, seta um valor vazio
			if ( isset( $new_instance[ 'classes_css' ][ $index ] ) ) {
				$instance[ 'posts' ][ $index ][ 'classes_css' ] = esc_attr( sanitize_text_field( $new_instance[ 'classes_css'][ $index ] ) );
			} else {
				$instance[ 'posts' ][ $index ][ 'classes_css' ] = '';
			}
			// Verifica se o campo de texto "author" está preenchido, se sim, seta o valor no novo array, se não, seta um valor vazio
			if ( isset( $new_instance[ 'author' ][ $index ] ) ) {
				$instance[ 'posts' ][ $index ][ 'author' ] = esc_attr( sanitize_text_field( $new_instance[ 'author'][ $index ] ) );
			} else {
				$instance[ 'posts' ][ $index ][ 'author' ] = '';
			}
			// Verifica se o campo de texto "sub titulo" está preenchido, se sim, seta o valor no novo array, se não, seta um valor vazio
			if ( isset( $new_instance[ 'sub_title' ][ $index ] ) ) {
				$instance[ 'posts' ][ $index ][ 'sub_title' ] = esc_attr( sanitize_text_field( $new_instance[ 'sub_title'][ $index ] ) );
			} else {
				$instance[ 'posts' ][ $index ][ 'sub_title' ] = '';
			}
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
				'classes_widget' => '',
				'readmore' => '',
				'posts' => array(),
			)
		);
		/**
		 * Template HTML para o repetidor de campos
		 * Quando clicado em adicionar post, o conteúdo dessa tag é copiado para dentro da div.posts
		 */
		?>
		<script type="text/template" id="eol-posts-widget-<?php echo $this->get_field_id('title'); ?>">
			<li class="each-repeater open" style="border:1px solid #e3e3e3;">
				<p>
					<label>Título do post</label>
					<input class="widefat post-title" type="text" name="<?php echo $this->get_field_name( 'post_title[]' ); ?>">
				</p>
				<p>
					<label>Sub-título</label>
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'sub_title[]' ); ?>">
				</p>
				<p>
					<label>Buscar post / ID do post</label>
					<input class="widefat post-search" type="text" name="<?php echo $this->get_field_name( 'post_id[]' ); ?>">
					<span class="posts-search-list">

					</span>
				</p>
				<p>
					<label>Classes CSS do post</label>
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'classes_css[]' ); ?>">
				</p>
				<p>
					<label>Autor</label>
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'author[]' ); ?>">
				</p>
				<p class="image-selector">
					<a href="#" class="image-selector-link">
						Selecione uma imagem para ser exibida.
						<small> ( Caso nenhuma seja selecionada a imagem destacada do post será utilizada )
						</small>
					</a>
					<input type="hidden" name="<?php echo $this->get_field_name( 'image_id[]' ); ?>" class="input-image">
					<span class="image-selected" style="display: none;">
						<a href="#" class="btn-delete-image">
							Remover imagem
						</a>
					</span>
				</p>

				<p>
					<a href="#" class="remove-row">
						Remover post
					</a>
					|
					<a href="#" class="close-row">
						Fechar
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
			// campo de classes "global"
			$readmore = sanitize_text_field( $instance['readmore'] );
			?>
			<p>
				<label>
					Link Leia Mais
				</label>
				<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo esc_attr($readmore); ?>">
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
								<label>Sub-título</label>
								<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'sub_title[]' ); ?>" value="<?php echo esc_attr( $post[ 'sub_title'] );?>">
							</p>

							<p>
								<label>Buscar post / ID do post</label>
								<input class="widefat post-search" type="text" name="<?php echo $this->get_field_name( 'post_id[]' ); ?>" value="<?php echo esc_attr( $post[ 'post_id' ] );?>">
								<span class="posts-search-list"></span>
							</p>
							<p>
								<label>Classes CSS do post</label>
								<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'classes_css[]' ); ?>" value="<?php echo esc_attr( $post[ 'classes_css' ] );?>">
							</p>
							<p>
								<label>Autor</label>
								<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'author[]' ); ?>" value="<?php echo esc_attr( $post[ 'author' ] );?>">
							</p>
							<?php $image_id = '';?>
							<?php if ( isset( $post[ 'image_id' ] ) && wp_attachment_is_image( $post[ 'image_id' ] ) ) {
								$image_id = $post[ 'image_id' ];
							}?>
							<p class="image-selector">
								<?php // Esconde o link de seleção de imagem caso uma imagem já tenha sido selecionada ?>
								<?php $image_selector_link_style = '';?>
								<?php if ( '' != $image_id ) {
									$image_selector_link_style = 'display:none;';
								}?>
								<a href="#" class="image-selector-link" style="<?php echo $image_selector_link_style;?>">
									Selecione uma imagem para ser exibida.
									<small> ( Caso nenhuma seja selecionada a imagem destacada do post será utilizada )
									</small>
								</a>
								<input type="hidden" name="<?php echo $this->get_field_name( 'image_id[]' ); ?>" class="input-image" value="<?php echo $image_id;?>">
								<?php // Exibe o botão de remover imagem quando uma imagem estiver sido selecionada ?>
								<?php $image_selected_style = 'display:none;';?>
								<?php if ( '' != $image_id ) {
									$image_selected_style = '';
								}?>
								<span class="image-selected" style="<?php echo $image_selected_style;?>">
									<?php if ( '' != $image_id ) {
										$image = wp_get_attachment_image_src( $image_id, 'thumbnail', false );
										printf( '<img src="%s" width="64" height="64">', $image[0] );
									}?>
									<a href="#" class="btn-delete-image">
										Remover imagem
									</a>
								</span>
							</p>
							<p>
								<a href="#" class="remove-row">
									Remover post
								</a>
								|
								<a href="#" class="close-row">
									Fechar
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
