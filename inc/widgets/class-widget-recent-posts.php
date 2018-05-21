<?php
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class EOL_Recent_Posts_Taxonomy extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'eol_widget_recent_posts_taxonomy',
			'description'                 => '',
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'eol_widget_recent_posts_taxonomy', __( 'Ultimos posts da categoria do post atual' ), $widget_ops );
		$this->alt_option_name = 'eol_widget_recent_posts_taxonomy';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		/**
		 * Pega a editoria se selecionada alguma
		*/
		$term = isset( $instance['editoria'] ) ? absint( $instance['editoria'] ) : 'false';

		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$query_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);

		if ( is_singular( 'post' ) || is_int( $term ) ) {
			$veja_mais = "Veja Mais";
			// se nao tem termo selecionado no widget
			if ( 0 === $term ) {
				$post = get_queried_object();
				$query_args['post__not_in'] = array($post->ID);
				if ( has_term( '', 'colunistas', $post->ID )) {
					$term = wp_get_post_terms( $post->ID, 'colunistas', array( 'fields' => 'all' ) );
					$tax = 'colunistas';
					$title =$term[0]->name;
					$veja_mais = "Todas da coluna";

				} else {
					$term = wp_get_post_terms( $post->ID, 'editorias', array( 'fields' => 'all' ) );
					$tax = 'editorias';
					$title = "Mais desta editoria";
					// $title = apply_filters( 'widget_title', $term[0]->name, $instance, $this->id_base );

				}
			} else {
				$term = array( get_term( absint( $term ) ) );
				$tax = 'editorias';
				$title = $title = apply_filters( 'widget_title', $term[0]->name, $instance, $this->id_base );

			}
			if ( $term && ! is_wp_error( $term ) ) {
				$query_args[ $tax ] = $term[0]->slug;
			}
			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $title;
			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		}
		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$r = new WP_Query(
			apply_filters(
				'widget_posts_args', $query_args, $instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>
		<?php echo $args['before_widget']; ?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul class="posts-widget-list-tx">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title = get_the_title( $recent_post->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				?>
				<li class="post-widget-li">
					<a class="post-link-widget-li" href="<?php the_permalink( $recent_post->ID ); ?>"><?php echo $title; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php $term_link = get_term_link( $query_args[ $tax ], $tax );?>
		<?php if ( ! is_wp_error( $term_link ) ) : ?>
			<a class="editoria-link" href="<?php echo $term_link?>"><?php echo $veja_mais ?></a>
		<?php endif;?>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance[ 'editoria' ] = 'false';

		if ( 'false' != $new_instance[ 'editoria'] ) {
			$instance[ 'editoria' ] = absint( $new_instance[ 'editoria'] );
			if ( ! term_exists( $instance[ 'editoria' ], 'editorias' ) ) {
				$instance[ 'editoria' ] = 'false';
			}
		}
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$editoria  = isset( $instance['editoria'] ) ? absint( $instance['editoria'] ) : 'false';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'editoria' ); ?>"><?php _e( 'Escolha a editoria:' ); ?></label>
		<select name="<?php echo $this->get_field_name( 'editoria' ); ?>"  id="<?php echo $this->get_field_id( 'editoria' ); ?>">
			<?php
			if ( 'false' === $editoria ) {
				echo '<option value="false" selected>Automatico</option>';
			} else {
				echo '<option value="false">Automatico</option>';
			}
			$editorias = get_terms( array( 'taxonomy' => 'editorias' ) );
			if ( $editorias && ! is_wp_error( $editorias ) && ! empty( $editorias) ) {
				foreach ( $editorias as $term ) {
					if ( $editoria === $term->term_id ) {
						printf( '<option value="%s" selected>%s</option>', $term->term_id, $term->name );
					} else {
						printf( '<option value="%s">%s</option>', $term->term_id, $term->name );
					}
				}
			}
			?>
		</select>
<?php
	}
}

/**
 *
 * Registra o widget
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'EOL_Recent_Posts_Taxonomy' );
} );
