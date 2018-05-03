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
class EOL_Taxonomy_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'eol_widget_taxonomy_posts',
			'description'                 => '',
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'eol_widget_taxonomy_posts', __( 'Posts em destaque de uma determinada editoria' ), $widget_ops );
		$this->alt_option_name = 'eol_widget_taxonomy_posts';
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		/**
		 * Pega a editoria se selecionada alguma
		*/
		$term = isset( $instance['term'] ) ? absint( $instance['term'] ) : 'false';

		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		if ( ! $instance[ 'term'] || 'false' === $instance[ 'term'] ) {
			$query_args = array();
		} else {
			$query_args = array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'editorias',
						'field'    => 'term_id',
						'terms'    => array( $instance[ 'term'] ),
					),
					array(
						'taxonomy' => '_featured_eo',
						'field'    => 'slug',
						'terms'    => array( 'sim' ),
					),
				),
			);
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
		<ul class="widget-eol-taxonomy-posts">
			<?php $i = 0;?>
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				setup_postdata( $recent_post );
				$post_title = get_the_title( $recent_post->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				?>

				<li class="post-widget-li index-num-<?php echo $i;?>">
					<?php if ( 0 === $i ) {
						the_post_thumbnail( 'medium' );
					} else {
						echo '<a class="post-thumbnail-link" href="' . get_permalink() . '">';
						the_post_thumbnail( 'thumbnail' );
						echo '</a>';
					}
					?>
					<a class="post-link-widget-li" href="<?php the_permalink( $recent_post->ID ); ?>"><?php echo $title; ?>
					</a>
				</li>
			<?php endforeach; ?>
			<?php wp_reset_postdata();?>
		</ul>
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
		$instance[ 'term' ] = 'false';

		if ( 'false' != $new_instance[ 'editoria'] ) {
			$instance[ 'term' ] = absint( $new_instance[ 'term'] );
			if ( ! term_exists( $instance[ 'term' ], 'editorias' ) ) {
				$instance[ 'term' ] = 'false';
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
		$term  = isset( $instance['term'] ) ? absint( $instance['term'] ) : 'false';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php /*
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		*/
		?>
		<select name="<?php echo $this->get_field_name( 'term' ); ?>"  id="<?php echo $this->get_field_id( 'term' ); ?>" required>
			<?php
			var_dump( $term );
			echo '<option value="">Selecionar</option>';
			$editorias = get_terms( array( 'taxonomy' => 'editorias' ) );
			if ( $editorias && ! is_wp_error( $editorias ) && ! empty( $editorias) ) {
				foreach ( $editorias as $editoria ) {
					if ( $term === $editoria->term_id ) {
						printf( '<option value="%s" selected>%s</option>', $editoria->term_id, $editoria->name );
					} else {
						printf( '<option value="%s">%s</option>', $editoria->term_id, $editoria->name );
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
	register_widget( 'EOL_Taxonomy_Posts' );
} );