<?php
/**
 * Cria CPTs
 */
require_once get_template_directory() . '/core/classes/class-post-type.php';

// CPTs Colunistas
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
