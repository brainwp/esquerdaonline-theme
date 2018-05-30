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
        'menu_icon' => 'dashicons-groups'
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
