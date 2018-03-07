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
