<?php
/**
 * Criar taxonomias personalizadas
 */
require_once get_template_directory() . '/core/classes/class-taxonomy.php';

// Taxonomia Editoria
$editoria = new Odin_Taxonomy(
    'Editoria', // Nome (Singular) da nova Taxonomia.
    'editorias', // Slug do Taxonomia.
    'post' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);

// Taxonomia Colunistas
$colunistas = new Odin_Taxonomy(
    'Colunista', // Nome (Singular) da nova Taxonomia.
    'colunistas', // Slug do Taxonomia.
    'post' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);
/**
 * Classe para configuração do comportamento da taxonomia colunistas
 */
require_once get_template_directory() . '/inc/class-colunistas.php';

// Taxonomia Destaque
$posicao = new Odin_Taxonomy(
    'Posição', // Nome (Singular) da nova Taxonomia.
    '_featured_eo', // Slug do Taxonomia.
    array('post','especiais','videos') // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);
$posicao = new Odin_Taxonomy(
    'Regiões e UF', // Nome (Singular) da nova Taxonomia.
    'regioes', // Slug do Taxonomia.
    'post' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);

// para especiais ( dossies ou Coberturas)
$posicao = new Odin_Taxonomy(
    'Tipo', // Nome (Singular) da nova Taxonomia.
    'tipo', // Slug do Taxonomia.
    'especiais' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);

// Taxonomia Especiais
$especiais = new Odin_Taxonomy(
    'Especiais', // Nome (Singular) da nova Taxonomia.
    'especiais', // Slug do Taxonomia.
    'post' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);

// Taxonomia Especiais
// $videos = new Odin_Taxonomy(
//     'Posição', // Nome (Singular) da nova Taxonomia.
//     'posicao', // Slug do Taxonomia.
//     'videos' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
// );
/**
 * Classe para configuração do comportamento da taxonomia colunistas
 */
// require_once get_template_directory() . '/inc/class-especiais.php';
