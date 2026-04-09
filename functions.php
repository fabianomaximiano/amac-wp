<?php
if (!defined('ABSPATH')) {
    exit;
}

// ==============================
// ENQUEUE DE ESTILOS E SCRIPTS
// ==============================

function chaveiro_enqueue_assets()
{
    $theme_version = wp_get_theme()->get('Version');
    $script_asset  = chaveiro_get_theme_script_asset();

    /*
    ==============================
    FONTES
    ==============================
    */

    $google_fonts_url = chaveiro_google_fonts_url();
    if (!empty($google_fonts_url)) {
        wp_enqueue_style(
            'chaveiro-google-fonts',
            $google_fonts_url,
            array(),
            null
        );
    }

    /*
    ==============================
    LIBS
    ==============================
    */

    wp_enqueue_style(
        'bootstrap-4',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css',
        array(),
        '4.6.2'
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(),
        '6.5.2'
    );

    /*
    ==============================
    STYLE PRINCIPAL
    ==============================
    */

    wp_enqueue_style(
        'chaveiro-style',
        get_stylesheet_uri(),
        array('bootstrap-4', 'font-awesome'),
        file_exists(get_stylesheet_directory() . '/style.css')
            ? filemtime(get_stylesheet_directory() . '/style.css')
            : $theme_version
    );

    /*
    ==============================
    MENU
    ==============================
    */

    $menu_css_path = get_template_directory() . '/assets/css/menu.css';

    if (file_exists($menu_css_path)) {
        wp_enqueue_style(
            'chaveiro-menu',
            get_template_directory_uri() . '/assets/css/menu.css',
            array('chaveiro-style'),
            filemtime($menu_css_path)
        );
    }

    /*
    ==============================
    HERO
    ==============================
    */

    $hero_css_path = get_template_directory() . '/assets/css/hero.css';

    if (file_exists($hero_css_path)) {
        wp_enqueue_style(
            'chaveiro-hero',
            get_template_directory_uri() . '/assets/css/hero.css',
            array('chaveiro-style'),
            filemtime($hero_css_path)
        );
    }

    /*
    ==============================
    MODAL  (GLOBAL — usado no menu)
    ==============================
    */

    $modal_css_path = get_template_directory() . '/assets/css/modal.css';

    if (file_exists($modal_css_path)) {
        wp_enqueue_style(
            'chaveiro-modal',
            get_template_directory_uri() . '/assets/css/modal.css',
            array('chaveiro-style'),
            filemtime($modal_css_path)
        );
    }

    /*
    ==============================
    WHATSAPP (GLOBAL)
    ==============================
    */

    $whatsapp_css_path = get_template_directory() . '/assets/css/whatsapp.css';

    if (file_exists($whatsapp_css_path)) {
        wp_enqueue_style(
            'chaveiro-whatsapp',
            get_template_directory_uri() . '/assets/css/whatsapp.css',
            array('chaveiro-style'),
            filemtime($whatsapp_css_path)
        );
    }

    /*
    ==============================
    KANBAN
    ==============================
    */

    $kanban_css_path = get_template_directory() . '/assets/css/kanban.css';

    if (file_exists($kanban_css_path)) {
        wp_enqueue_style(
            'chaveiro-kanban',
            get_template_directory_uri() . '/assets/css/kanban.css',
            array('chaveiro-style'),
            filemtime($kanban_css_path)
        );
    }

    /*
    ==============================
    SEÇÕES DO SITE
    ==============================
    */

    $sobre_css_path = get_template_directory() . '/assets/css/sobre.css';

    if (file_exists($sobre_css_path)) {
        wp_enqueue_style(
            'chaveiro-sobre',
            get_template_directory_uri() . '/assets/css/sobre.css',
            array('chaveiro-style'),
            filemtime($sobre_css_path)
        );
    }

    $servicos_css_path = get_template_directory() . '/assets/css/servicos.css';

    if (file_exists($servicos_css_path)) {
        wp_enqueue_style(
            'chaveiro-servicos',
            get_template_directory_uri() . '/assets/css/servicos.css',
            array('chaveiro-style'),
            filemtime($servicos_css_path)
        );
    }

    $produtos_css_path = get_template_directory() . '/assets/css/produtos.css';

    if (file_exists($produtos_css_path)) {
        wp_enqueue_style(
            'chaveiro-produtos',
            get_template_directory_uri() . '/assets/css/produtos.css',
            array('chaveiro-style'),
            filemtime($produtos_css_path)
        );
    }

    $faq_css_path = get_template_directory() . '/assets/css/faq.css';

    if (file_exists($faq_css_path)) {
        wp_enqueue_style(
            'chaveiro-faq',
            get_template_directory_uri() . '/assets/css/faq.css',
            array('chaveiro-style'),
            filemtime($faq_css_path)
        );
    }

    $footer_css_path = get_template_directory() . '/assets/css/footer-config.css';

    if (file_exists($footer_css_path)) {
        wp_enqueue_style(
            'chaveiro-footer-config',
            get_template_directory_uri() . '/assets/css/footer-config.css',
            array('chaveiro-style'),
            filemtime($footer_css_path)
        );
    }

    $avaliacoes_css_path = get_template_directory() . '/assets/css/avaliacoes.css';

    if (file_exists($avaliacoes_css_path)) {
        wp_enqueue_style(
            'chaveiro-avaliacoes',
            get_template_directory_uri() . '/assets/css/avaliacoes.css',
            array('chaveiro-style'),
            filemtime($avaliacoes_css_path)
        );
    }

    /*
    ==============================
    SCRIPTS
    ==============================
    */

    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'bootstrap-4-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '4.6.2',
        true
    );

    if ($script_asset) {

        wp_enqueue_script(
            'chaveiro-scripts',
            $script_asset['uri'],
            array('jquery', 'bootstrap-4-bundle'),
            $script_asset['version'],
            true
        );

        wp_localize_script(
            'chaveiro-scripts',
            'ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
            )
        );
    }
}

add_action('wp_enqueue_scripts', 'chaveiro_enqueue_assets');