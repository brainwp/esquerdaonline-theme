<?php
/*
 *
 * Odin ACF Fields
 *
*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_campos-adicionais',
		'title' => 'Campos adicionais',
		'fields' => array (
			array (
				'key' => 'field_5a9fe7ad6b1e7',
				'label' => 'Sub-título',
				'name' => 'sub_title',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 9,
				'formatting' => 'br',
			),
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
				'key' => 'field_5a9fe80d6b1e9',
				'label' => 'Imagem Retangular',
				'name' => 'thumbnail_single',
				'type' => 'image',
				'instructions' => 'Essa imagem será utilizada para todos os widgets que utilizem imagens retangulares e para a imagem de destque na página da notícia.',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
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
}
