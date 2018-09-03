<?php
/**
 * Cria CPTs
 */
require_once get_template_directory() . '/core/classes/class-post-type.php';

// CPT Colunistas
$colunistas = new Odin_Post_Type(
    'Colunista', // Nome (Singular) do Post Type.
    'colunistas' // Slug do Post Type.
);
$colunistas->set_arguments(
    array(
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon' => 'dashicons-groups',
        'rewrite' 	=> array(
        	'pages'		=> true
        ),
    )
);

// CPT Especiais
$especiais = new Odin_Post_Type(
    'Especiais', // Nome (Singular) do Post Type.
    'especiais' // Slug do Post Type.
);
$especiais->set_arguments(
    array(
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon' => 'dashicons-star-filled'
    )
);
$especiais->set_labels(
    array(
        'menu_name' => 'Especiais',
        'name'		=> 'Especiais',
        'all_items'	=> 'Ver todos especiais'
    )
);

// CPT Vídeos
$videos = new Odin_Post_Type(
    'Vídeo', // Nome (Singular) do Post Type.
    'videos' // Slug do Post Type.
);
$videos->set_arguments(
    array(
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon' => 'dashicons-video-alt'
    )
);
$videos->set_labels(
    array(
        'menu_name' => 'Vídeos',
        'name'		=> 'Vídeos',
        'all_items'	=> 'Ver todos vídeos'
    )
);
