<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	/**
	 * Cria um shortcode para matérias relacionadas - com integração ao ACF
	 *
	 */
	class EOL_Shortcode_Videos {
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
			add_shortcode( 'eol_videos', array( $this, 'shortcode' ) );
		}
		/**
		 * Registra os campos do ACF
		 */
		public function shortcode( $atts ) {
			$html ="";
			if (isset($atts['tag'])) {
				$tag = $atts['tag'];
				$number = (isset($atts['numero'])?$atts['numero']:5);
				$query = new WP_Query(
					array(
						'posts_per_page' => $number,
						'post_type' => array('videos'),
						'tax_query' => array(
				        array (
				            'taxonomy' => 'tag',
				            'field' => 'slug',
				            'terms' => $tag,
				        )
				    ),
					)
				);
				if ( $query->have_posts() ) {
					// echo "<h1>".$tag."</h1>";
					$html = '
						<div class="videos">
							<div id="modal" class="modal">
								<div id="modal-content"></div>
							</div> ';
					$count = 1;
					while( $query->have_posts() && $count <= $number) {
						$query->the_post();
						$titulo = get_the_title( );
						$chamada = get_post_meta( get_the_ID(), 'chamada', true );
						$link = get_post_meta( get_the_ID(), 'link', true );
						$autor = get_post_meta( get_the_ID(), 'the_author', true );
						$data = get_post_meta( get_the_ID(), 'data', true );
						$html .='

							<div class="video-item  col-md-12">
								<a href="#" data-title="'.$titulo.'" data-subtitle="'.$chamada.'" data-author="'.$autor.'" data-date="'.$data.'" class="modal-item-open video-open col-md-4" data-src="'.$link.'" data-type="video">
									<i class="fas fa-play"></i>
								<div class="col-md-8 video-text">
									<div class="titulo-video-destaque">
										'.$titulo.'
									</div>
									<div class="chamada-video-destaque">
										'.$chamada.'
									</div>
									<div class="data-video-destaque">
										'.$data.'
									</div>
									<div class="autor-video-destaque">
										'.$autor.'
									</div>
								</div><!--video-text-->
								</a>

							</div><!--video-item-->';
						$count++;
					}
					wp_reset_postdata();
					$html .= '
						</div><!--col-md-6 video-menores-->
					</div><!--class="videos"-->';
				}
				?>
				<?php
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
new EOL_Shortcode_Videos();
/**
 * Função para instanciar e chamar a classe quando necessário
 * @return object
 */
function EOL_Shortcode_Videos() {
	return EOL_Shortcode_Videos::get_instance();
}
