<?php
/*
 *
 * Odin ACF Fields
 *
*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_video',
		'title' => 'video',
		'fields' => array (
			array (
				'key' => 'field_5b3c7cb204f3c',
				'label' => 'link',
				'name' => 'link',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c90189524d15',
				'label' => 'Deseja usar a imagem (thumbnail) do vídeo no YouTube?',
				'name' => 'youtube_img',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'false' => 'Não',
					'true' => 'Sim',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),

			array (
				'key' => 'field_5b3c7d1104f3d',
				'label' => 'chamada',
				'name' => 'chamada',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b3c7d1804f3e',
				'label' => 'data',
				'name' => 'data',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b3c7d2104f3f',
				'label' => 'autor',
				'name' => 'the_author',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_0101r4i0340i3c7d2104f3f',
				'label' => 'link de download',
				'name' => 'download_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),

		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'videos',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_info-noticia',
		'title' => 'Informações da notícia',
		'fields' => array (
			array (
				'key' => 'field_5a9fe7e96b1e8',
				'label' => 'Autor',
				'name' => 'the_author',
				'type' => 'text',
				'instructions' => 'Autor/Autores do texto',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a9fe7ad6b1e7',
				'label' => 'Sub-título',
				'name' => 'sub_title',
				'instructions' => 'Será exibido na página da notícia, abaixo do título.',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 9,
				'formatting' => 'br',
			),
			array (
				'key' => 'field_6a9fe7ad6b1e7',
				'label' => 'Chamada',
				'instructions' => 'Será exibida nos widgets da home',
				'name' => 'chamada',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 9,
				'formatting' => 'br',
			),

			array (
				'key' => 'field_5a9fe80d6b1e9',
				'label' => 'Imagem Alternativa',
				'name' => 'thumbnail_single',
				'type' => 'image',
				'instructions' => 'Essa imagem será utilizada Como padrão para os widgets e como imagem da single se marcado o campo abaixo.',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5b24158bb86b6',
				'label' => 'Exibir na notícia',
				'instructions' => 'Marque para usar a imagem do Widget na página da notícia.',
				'name' => 'exibir_na_single',
				'type' => 'checkbox',
				'choices' => array (
					'true' => 'Sim',
				),
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5a9fe8078y8tfuvuhge9',
				'label' => 'Imagem Tipo Icone ( 80x60px )',
				'name' => 'thumbnail_icone',
				'type' => 'image',
				'instructions' => 'Essa imagem será utilizada em widgets com a classe thumb-icone',
				'save_format' => 'object',
				'preview_size' => 'quadrada-icone',
				'library' => 'all',
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
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'especiais',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => -5,
	));
	register_field_group(array (
		'id' => 'acf_creditos',
		'title' => 'Créditos',
		'fields' => array (
			array (
				'key' => 'field_5a9ff63b047d1',
				'label' => 'Créditos',
				'name' => 'image_author',
				'type' => 'text',
				'instructions' => 'Créditos da Imagem',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_media',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_redes-sociais',
		'title' => 'Redes Sociais',
		'fields' => array (
			array (
				'key' => 'field_5b2979a3c8bd2',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b2979c0c8bd3',
				'label' => 'Twitter',
				'name' => 'twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b297a5c33647',
				'label' => 'Google Plus',
				'name' => 'google_plus',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b2979cec8bd4',
				'label' => 'Instagram',
				'name' => 'instagram',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b2979e8c8bd5',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'colunistas',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/**
 * Set Advanced Custom Fields metabox priority.
 *
 * @param  string  $priority    The metabox priority.
 * @param  array   $field_group The field group data.
 * @return string  $priority    The metabox priority, modified.
 */
function km_set_acf_metabox_priority( $priority, $field_group ) {
	if ( 'Informações da notícia' === $field_group['title'] ) {
		$priority = 'high';
	}
	return $priority;
}
add_filter( 'acf/input/meta_box_priority', 'km_set_acf_metabox_priority', 10, 2 );
