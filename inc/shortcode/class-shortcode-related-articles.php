<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	/**
	 * Cria um shortcode para matérias relacionadas - com integração ao ACF
	 *
	 */
	class EOL_Shortcode_Related_Articles {
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
			$this->acf_fields();
			// add the shortcode
			add_shortcode( 'eol_relacionadas', array( $this, 'shortcode' ) );
		}
		/**
		 * Registra os campos do ACF
		 */
		private function acf_fields() {
			if(	function_exists( 'register_field_group' ) ) {
				register_field_group(array (
					'id' => 'acf_materias-relacionadas',
					'title' => 'Matérias relacionadas',
					'fields' => array (
						array (
							'key' => 'field_5aea7b0a65c83',
							'label' => 'Selecione as matérias coordenadas',
							'name' => 'related_articles',
							'type' => 'relationship',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'null',
										'operator' => '==',
									),
								),
								'allorany' => 'all',
							),
							'return_format' => 'id',
							'post_type' => array (
								0 => 'post',
								1 => 'page',
								2 => 'colunistas',
							),
							'taxonomy' => array (
								0 => 'all',
							),
							'filters' => array (
								0 => 'search',
								1 => 'post_type',
							),
							'result_elements' => array (
								0 => 'post_type',
								1 => 'post_title',
							),
							'max' => '',
						),
					),
					'location' => array (
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'post',
								'order_no' => 0,
								'group_no' => 0,
							),
						),
					),
					'options' => array (
						'position' => 'normal',
						'layout' => 'default',
						'hide_on_screen' => array (),
					),
					'menu_order' => 0,
				));
			}
		}
		/**
		 * Construi e retorna o HTML do shortcode
		 * @param array $atts
		 * @return string
		 */
		public function shortcode( $atts ) {
			$post_id = get_the_ID();
			if ( isset($atts[ 'id']) && ! empty( $atts[ 'id'] ) ) {
				$post_id = absint( $atts[ 'id' ] );
			}
			$posts = get_post_meta( $post_id, 'related_articles', true );
			if ( ! is_array( $posts ) && empty( $posts ) ) {
				return '';
			}
			$html = '<div class="eol_related_articles">';
			foreach ( $posts as $related_id ) {
				$html .= '<a class="each-related-article" href="' . get_permalink( $related_id ) . '">';
				$html .= '<i class="fas fa-angle-right"></i>'.get_the_title( $related_id );
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
new EOL_Shortcode_Related_Articles();
/**
 * Função para instanciar e chamar a classe quando necessário
 * @return object
 */
function EOL_Shortcode_Related() {
	return EOL_Shortcode_Related_Articles::get_instance();
}
