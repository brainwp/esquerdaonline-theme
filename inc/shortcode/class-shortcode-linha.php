<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	/**
	 * Cria um shortcode para matérias relacionadas - com integração ao ACF
	 *
	 */
	class EOL_Shortcode_Linha {
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
			add_shortcode( 'eol_linha', array( $this, 'shortcode' ) );
		}
		/**
		 * Registra os campos do ACF
		 */
		public function shortcode( $atts = '30px') {
			$altura =  ( isset($atts[ 'altura' ]) ? $atts[ 'altura'] :'30px' );
			$html = '<div style="height:'.$altura.'" class="shortcode-linha"><div class="clearfix"></div></div>';
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
new EOL_Shortcode_Linha();
/**
 * Função para instanciar e chamar a classe quando necessário
 * @return object
 */
function EOL_Shortcode_Linha() {
	return EOL_Shortcode_Linha::get_instance();
}
