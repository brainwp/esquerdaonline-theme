<?php
/*
 *
 * Odin ACF Fields
 *
*/
if(function_exists("register_field_group"))
{
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
			'position' => 'side',
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
