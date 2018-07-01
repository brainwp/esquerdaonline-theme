<?php
/**
 * Odin Theme Customizer
 *
 */
function eol_customize_init( $wp_customize ) {
	// Init Kirki
	Kirki::add_config( 'eol', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
		'disable_output' => true,
	) );
	// register footer image
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'image',
		'settings'    => 'footer_logo',
		'label'       => 'Logo no rodapé',
		'description' => '',
		'section'     => 'title_tagline',
		'default'     => '',
	) );

	// register general_settings
	$wp_customize->add_section( 'general_settings' ,
		array(
			'priority'    => 1,
			'title'       => esc_html__( 'Configurações gerais', 'eol' ),
			'description' => '',
		)
	);

	Kirki::add_field( 'eol', array(
		'type'        => 'repeater',
		'label'       => esc_attr__( 'Links para redes sociais', 'eol' ),
		'section'     => 'general_settings',
		'priority'    => 1,
		'settings'    => 'social_links',
		'fields' => array(
			'link_icon' => array(
				'type'        => 'select',
				'label'       => esc_attr__( 'Rede Social', 'textdomain' ),
				'description' => '',
				'default'     => 'facebook',
				'choices'     => array(
					'facebook' => 'Facebook',
					'twitter' => 'Twitter',
					'instagram' => 'Instagram',
					'google-plus' => 'Google +',
					'whatsapp' => 'WhatsApp',
					'telegram' => 'Telegram',
				),
			),
			'link_url' => array(
				'type'        => 'text',
				'label'       => 'Link URL',
				'default'     => '#',
				'description' => '',
			),
		)
	));
}
/**
 * Evita carregar funções do Kirki em caso de falta desse
 */
add_action( 'init', function(){
	if ( ! ( class_exists( 'Kirki' ) || ! is_admin() ) ) {
		echo '<div class="notice notice-error">';
		echo '<br>';
		echo 'O Plugin Kirki precisa estar instalado e ativado para o tema Brasa funcionar corretamente.';
	 	echo '<br></div>';
	 	return;
	}
	add_action( 'customize_register', 'eol_customize_init' );
});
