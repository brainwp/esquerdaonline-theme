<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	/**
	 * Cria um shortcode para matérias relacionadas - com integração ao ACF
	 *
	 */
	class EOL_Shortcode_Tags {
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
			// add acf fields
			// add the shortcode
			add_shortcode( 'eol_tags', array( $this, 'shortcode' ) );
		}
		/**
		 * Registra os campos do ACF
		 */
		public function shortcode( $atts ) {
			$html ="";
			if (isset($atts['tags'])) {
				$tags_selecionadas = $atts['tags'];
				$array_tags = explode(",", $tags_selecionadas);
				$html .= '<span class="tag-links">';
				$count = count($array_tags);
				foreach ($array_tags as $tag) {
					$tag_obj = get_term_by( 'name', $tag, 'post_tag', $output = OBJECT, $filter = 'raw' );
					$tag_link = get_term_link( $tag_obj );
			    // If there was an error, continue to the next term.
			    if ( is_wp_error( $tag_link ) ) {
			        continue;
			    }
					$html .= '<a href="' . esc_url( $tag_link ) . '">' . $tag_obj->name . '</a>';
					if ($tag != end($array_tags)){
						$html .= " / ";
					}
			    // We successfully got a link. Print it out.

				}
				$html .= '</span>';
			}

			return $html;
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
new EOL_Shortcode_Tags();
/**
 * Função para instanciar e chamar a classe quando necessário
 * @return object
 */
function EOL_Shortcode_Tags() {
	return EOL_Shortcode_Tags::get_instance();
}
