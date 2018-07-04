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
			if (isset($atts['tags'])) {
				$tags = $atts['tags'];
				$number = (isset($atts['numero'])?$atts['numero']:5);
				$query = new WP_Query(
					array(
						'posts_per_page' => $number,
						'post_type' => array('videos'),
						'tax_query' => array(
							array(
								'taxonomy' => 'tags',
								'terms'    => $tags,
							),
						),
					)
				);
				if ( $query->have_posts() ) {
					$html = '<div class="videos">';
					$count = 1;
					while( $query->have_posts() && $count <= $number) {
						$query->the_post();
						$titulo = get_the_title( );
						$chamada = get_post_meta( get_the_ID(), 'chamada', true );
						$link = get_post_meta( get_the_ID(), 'link', true );
						$autor = get_post_meta( get_the_ID(), 'autor', true );
						$data = get_post_meta( get_the_ID(), 'data', true );
						if ($count == 1) {
							$html .='
							<div class="col-md-6 video-destaque">
								<a href="#" class="video-open" data-src="'.$link.'" data-type="video">
									<i class="fas fa-play"></i>
									'.eol_single_thumbnail($thumb_size, get_the_ID() ).'
								</a>
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

							</div><!--col-md-6 video-destaque-->
							<div class="col-md-6 video-menores">';
							$count++;
						}
						else{
							$html .='
							<div class="video-item col-md-12">
								<a href="#" class="video-open col-md-4" data-src="'.$link.'" data-type="video">
									<i class="fas fa-play"></i>
									'.eol_single_thumbnail($thumb_size, get_the_ID() ).'
								</a>
								<div class="col-md-8 video-sm-text">
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
								</div><!--video-sm-text-->
							</div><!--video-item-->';
							$count++;
						}
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
