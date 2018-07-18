<?php
if ( ! defined( 'ABSPATH' ) )
exit; // Exit if accessed directly.

// require_once 'autoloader.php';

/**
* Classe para configuração do comportamento da taxonomia especiais
*
* @author   Matheus Gimenez <contato@matheusgimenez.com.br>
*/
class EOL_Duplicador {
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
		add_action( 'admin_menu', array( $this, 'my_admin_menu' ) );

	}
	public function my_admin_menu() {
		add_menu_page( 'Duplicar modelo de home', 'Duplicador', 'manage_options', 'myplugin/duplicador-admin-page.php', array( $this, 'duplicador_admin_page'), 'dashicons-tickets', 6  );
	}
	public function duplicador_admin_page(){
		// Check whether the button has been pressed AND also check the nonce



		?>
		<div class="wrap">
			<h2>Duplicador Revolucionario de Modelos</h2>
		</div>
		<div>
			<form class="" action="" method="post">
				<label for="page_id">Página a ser copiada</label>
				<br>
				<?php
				$args = "";
				wp_dropdown_pages( $args );
				?>
				<br>
				<label for="page_title">Título da página nova</label>
				<br>
				<input type="text" name="page_title" value="">
				<?php
				wp_nonce_field('duplicador_nonce');
				submit_button('Duplicar');

				?>


			</form>

		</div>

		<?php

		if (isset($_POST['page_title']) && $_POST['page_title'] == "") {
				echo 'Falta o título.';
				return;
		}
		if (isset($_POST['page_id']) && check_admin_referer('duplicador_nonce')) {
			// the button has been pressed AND we've passed the security check

			$this->duplicar_pagina($_POST['page_id']);
		}
	}


	function duplicar_pagina($id){
		// $array = array('teste','teste2');
		// array_push($array,'teste2');
		// print_r($array);
		// array_push($array,'teste2');
		// echo "<br>";
		// print_r($array);
		// die;
		$url = get_permalink( $id );
		$widget_object_id = eol_get_widget_object_id( $url );
		$widgets_table = get_option( 'sidebars_widgets', false );
		if ( $widgets_table && isset( $widgets_table[ $widget_object_id ] ) ) {
			// print_r($widgets_table);
			// die;
			// pega widgets da pagina a ser copiada
			$widgets = $widgets_table[ $widget_object_id ];
			// cria pagina, pega id, url e depois nome da área de widgets da página nova
			$new_page_id = $this->cria_pagina($_POST['page_title']);
			$new_page_url = get_permalink( $new_page_id );
			$new_widget_object_id = eol_get_widget_object_id( $new_page_url );
			$widgets_table[ $new_widget_object_id ] = array();

			// paga cada widget na pagina a ser copiada
			foreach ($widgets as $widget) {
				// extrai o index do widget a ser copiado
				$widget_slpit = explode('-',$widget);
				$widget_title = $widget_slpit[0];
				$widget_index = $widget_slpit[1];

				// pega as configurações widget a ser copiado
				$widgets_options = get_option( "widget_".$widget_title, false );
				// adiciona um novo widget com as configurações
				array_push($widgets_options, $widgets_options[$widget_index]);

				// atualiza a tabela com o novo widget
				update_option( "widget_".$widget_title, $widgets_options );

				// pega index do novo widget
				end($widgets_options);
				$new_index = key($widgets_options);

				// empurra pra area de widget da página nova o novo widget
				array_push($widgets_table[ $new_widget_object_id ], $widget_title.'-'.$new_index ) ;

				// atualiza a tabela com o novo widget na area da página nova
				update_option( 'sidebars_widgets', $widgets_table );
		
				print_r($widgets_options) ;

			}
		}
	}
	function cria_pagina($title){
		$new_page_template = 'page-sidebar-home.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
		//don't change the code below, unless you know what you're doing
		if (null !== $page_check = get_page_by_title($title)) {
			echo 'Página "'.$title.'" já existe';
			return;
		}
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $title,
			'post_status' => 'publish',
			'post_author' => 1,
		);
		if (is_wp_error( $new_page_id = wp_insert_post($new_page) )) {
			echo "Não criou";
			return;
		}
		if (null == update_post_meta($new_page_id, '_wp_page_template', $new_page_template)) {
			echo "Não conseguiu adionar o template \"Com Widget\" na página.";
			return;
		}
		return $new_page_id;


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

} // end class ();
new EOL_Duplicador();
