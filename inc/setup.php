<?php

// ==============================
// SETUP DO TEMA
// ==============================
function chaveiro_theme_setup() {

    // TITLE TAG AUTOMÁTICA
    add_theme_support('title-tag');

    // THUMBNAILS
    add_theme_support('post-thumbnails');

    // HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    // LOGO PERSONALIZADO
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // MENUS
    register_nav_menus([
        'menu-principal' => 'Menu Principal'
    ]);
}
add_action('after_setup_theme', 'chaveiro_theme_setup');