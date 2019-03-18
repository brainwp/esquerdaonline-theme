<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	// require_once 'autoloader.php';

	/**
	 * Classe para download de thumbnail de vídeo do youtube
	 * no post type videos
	 *
	 * @author   Matheus Gimenez <contato@matheusgimenez.com.br>
	 */
	class EOL_YT_Image_Thumbnail {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize the class
		 */
		public function __construct() {
			// Cria o termo relacionado ao colunista
			add_action( 'acf/save_post', array( $this, 'save_post_videos' ), 10, 3 );
		}
		/**
		 * Pega o URL da imagem de acordo com o url do vídeo
		 * @param string $video_url
		 * @return string|bool
		 */
		private function get_youtube_image( $video_url ) {
			$search = strpos( $video_url, 'youtube' );
			if ( $search === false ) {
				return false;
			}
			parse_str( parse_url( $video_url, PHP_URL_QUERY ), $yt_vars );
			$id = $yt_vars['v'];
			$image_url = sprintf( 'https://img.youtube.com/vi/%s/maxresdefault.jpg', $id );
			return $image_url;
		}
		/**
		* Faz o download da imagem thumbnail do vídeo selecionado no YouTube
		*
		* @param int $post_id The post ID.
		* @param post $post The post object.
		* @param bool $update Whether this is an existing post being updated or not.
		*/
		public function save_post_videos( $post_id ) {
			if ( 'videos' != $_REQUEST[ 'post_type'] ) {
				return;
			}
			$link = get_field( 'link' );
			if ( ! $link || empty( $link ) ) {
				return;
			}
			$value = get_field( 'youtube_img' );
			if ( $value && 'true' === $value ) {
				$image_url = $this->get_youtube_image( $link );
				if ( ! $image_url ) {
					return;
				}
				if ( $image_url === get_post_meta( $post_id, 'thumbnail_yt_url', true ) ) {
					return;
				}
				$image_id = media_sideload_image( $image_url, $post_id, null, 'id' );
				set_post_thumbnail( $post_id, $image_id );
				update_post_meta( $post_id, 'thumbnail_yt_url', $image_url );
			}
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

	} // end class EOL_YT_Image_Thumbnail();
	new EOL_YT_Image_Thumbnail();
