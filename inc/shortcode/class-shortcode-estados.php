<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	/**
	 * Cria um shortcode para matérias relacionadas - com integração ao ACF
	 *
	 */
	class EOL_Shortcode_Estados {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize class
		 */
		public function __construct() {
			// add the shortcode
			add_shortcode( 'eol_estados', array( $this, 'shortcode' ) );
		}
		/**
		 * Construi e retorna o HTML do shortcode
		 * @param array $atts
		 * @return string
		 */
		public function shortcode( $atts ) {
			$args = [
			    'taxonomy'     => 'regioes',
			    'parent'        => 0,
			    'number'        => 999,
			    'hide_empty'    => true
			];
			$regioes = array_values(get_terms( $args ));
			$html = '<ul class="nav nav-tabs">';
			foreach ($regioes as $regiao ) {
				$html .=
				'<li class="nav-item">
  			    	<a class="nav-link " href="#">'.$regiao->name.'</a>
  			  	</li>';
			}
			$html .='</ul>';

			return $html;
			$post_id = get_the_ID();
			if ( $atts[ 'id'] && ! empty( $atts[ 'id'] ) ) {
				$post_id = absint( $atts[ 'id' ] );
			}
			$posts = get_post_meta( $post_id, 'related_articles', true );
			if ( ! is_array( $posts ) && empty( $posts ) ) {
				return '';
			}
			$html = '<div class="eol_related_articles">';
			foreach ( $posts as $related_id ) {
				$html .= '<a class="each-related-article" href="' . get_permalink( $related_id ) . '">';
				$html .= get_the_title( $related_id );
				$html .= '</a>';
			}

			return $html . '</div>';
		}
		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

	} // end class EOL_Shortcode_Related_Articles();
new EOL_Shortcode_Estados();
/**
 * Função para instanciar e chamar a classe quando necessário
 * @return object
 */
function EOL_Shortcode_Estados_Func() {
	return EOL_Shortcode_Estados::get_instance();
}
