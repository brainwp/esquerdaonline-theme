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
$destaque = new Odin_Taxonomy(
    'Destaque', // Nome (Singular) da nova Taxonomia.
    '_featured_eo', // Slug do Taxonomia.
    'post' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
);
