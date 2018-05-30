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
			    'number'        => 999,
			    'hide_empty'    => true
			];
			$regioes = array_values(get_terms( $args ));
			$html = '<div class="tabbed">';
			$html_tabs = '<ul class="tabs">';
			$html_content = '';
			$html_array_tabs = array();
			foreach ($regioes as $regiao ) {
				if (!$regiao->parent) {
					$html_tabs .=
					'<li class="tab-'.$regiao->term_id.'">
	  			    	<a class="tab-'.$regiao->term_id.' tab" href="#">'.$regiao->name.'</a>
	  			  	</li>';

				}
				else{
					if (isset($html_array_tabs["tab-" . $regiao->parent] ) ) {
						$html_array_tabs["tab-" . $regiao->parent] .= '<a>'.$regiao->name.'</a>';
					}
					else{
						$html_array_tabs["tab-" . $regiao->parent] = '<a>'.$regiao->name.'</a>';
					}
				}
			}
			foreach ($html_array_tabs as $key => $value) {
				$html_content .=  '<div class="'.$key.'" class="tab-pane fade in ">'.$value.'</div>';
			}
			$html_tabs .='</ul>';
			$html .=$html_tabs.$html_content.'</div><!-- tabbed -->';
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
new EOL_Shortcode_Estados();
/**
 * Função para instanciar e chamar a classe quando necessário
 * @return object
 */
function EOL_Shortcode_Estados_Func() {
	return EOL_Shortcode_Estados::get_instance();
}
