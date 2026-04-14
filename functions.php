<?php
if (!defined('ABSPATH')) {
    exit;
}

// ==============================
// HELPERS GLOBAIS DO CUSTOMIZER
// ==============================
if (class_exists('WP_Customize_Control') && !class_exists('Theme_Customizer_Section_Title_Control')) {
    class Theme_Customizer_Section_Title_Control extends WP_Customize_Control
    {
        public $type = 'theme_section_title';

        public function render_content()
        {
            $label = isset($this->label) && is_string($this->label) ? $this->label : '';
            $description = isset($this->description) && is_string($this->description) ? $this->description : '';

            if ($label === '' && $description === '') {
                return;
            }

            echo '<div class="theme-customizer-group-title">';

            if ($label !== '') {
                echo '<span class="theme-customizer-group-title-text">' . esc_html($label) . '</span>';
            }

            if ($description !== '') {
                echo '<span class="theme-customizer-group-description">' . esc_html($description) . '</span>';
            }

            echo '</div>';
        }
    }
}

function chaveiro_customizer_panel_styles()
{
    $sections = array(
        'title_tagline',
        'menu_opcoes',
        'tipografia',
        'sobre',
        'hero_section',
        'faq',
        'servicos_section',
        'produtos_section',
        'menu_estilo_secao',
    );
    ?>
    <style>
        .wp-full-overlay-sidebar-content {
            background: #f1f1f1;
        }

        .customize-pane-parent .accordion-section-title,
        .customize-pane-child .accordion-section-title {
            font-weight: 600;
        }

        <?php foreach ($sections as $section_id) : ?>
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> {
            background: #f3f4f6;
            padding: 0 8px 10px;
            box-sizing: border-box;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .accordion-section-content {
            padding: 0 4px;
            box-sizing: border-box;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control {
            width: 100%;
            margin: 0 0 6px 0;
            padding: 6px 7px;
            background: #ffffff;
            border: 1px solid #d9dadd;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.018);
            box-sizing: border-box;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control:last-child {
            margin-bottom: 0;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control label {
            display: block;
            margin-bottom: 1px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-title {
            display: block;
            font-size: 11.3px;
            font-weight: 600;
            color: #1d2327;
            margin-bottom: 2px;
            line-height: 1.2;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .description {
            margin-top: 2px;
            color: #646970;
            font-style: normal;
            font-size: 9.9px;
            line-height: 1.25;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-checkbox {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-checkbox label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin: 0;
            font-size: 11.3px;
            font-weight: 500;
            color: #1d2327;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-checkbox input[type="checkbox"] {
            margin: 0;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="text"],
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="email"],
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="url"],
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="number"],
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> textarea,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> select {
            width: 91%;
            margin: 0 auto;
            display: block;
            min-height: 31px;
            border-radius: 6px;
            border: 1px solid #c3c4c7;
            padding: 5px 8px;
            box-sizing: border-box;
            background: #fff;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
            font-size: 11.3px;
            line-height: 1.24;
            text-align: left;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> textarea {
            min-height: 68px;
            resize: vertical;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="text"]:focus,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="email"]:focus,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="url"]:focus,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> input[type="number"]:focus,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> textarea:focus,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> select:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: 0;
            background: #fff;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-image .actions,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-media .actions,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-site_icon .actions {
            margin-top: 6px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-image .button,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-media .button,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-site_icon .button {
            width: 91%;
            margin: 0 auto;
            display: block;
            justify-content: center;
            min-height: 34px;
            border-radius: 6px;
            font-size: 11.3px;
            line-height: 32px;
            text-align: center;
            box-sizing: border-box;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .attachment-media-view {
            width: 91%;
            margin: 0 auto 5px;
            box-sizing: border-box;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .placeholder,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .thumbnail-image img,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .site-icon-preview img {
            border-radius: 6px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .wp-picker-container {
            display: block;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .wp-picker-container .wp-color-result.button {
            width: 91%;
            height: 31px;
            min-height: 31px;
            border-radius: 6px;
            margin: 0 auto 4px;
            display: block;
            box-sizing: border-box;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .wp-picker-container .wp-color-result-text {
            line-height: 29px;
            font-size: 10.3px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .wp-picker-holder {
            margin-top: 2px;
            margin-left: 4.5%;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-theme_section_title {
            width: 100%;
            margin: 9px 0 3px 0;
            padding: 0;
            background: transparent;
            border: 0;
            box-shadow: none;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control-theme_section_title:first-of-type {
            margin-top: 1px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .customize-control .customize-control-notifications-container {
            margin-bottom: 2px;
        }

        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .site-title,
        #sub-accordion-section-<?php echo esc_attr($section_id); ?> .site-description {
            margin-bottom: 0;
        }
        <?php endforeach; ?>

        .theme-customizer-group-title {
            padding: 0 1px 1px;
        }

        .theme-customizer-group-title-text {
            display: block;
            font-size: 12.2px;
            font-weight: 700;
            color: #1d2327;
            margin-bottom: 1px;
            line-height: 1.14;
        }

        .theme-customizer-group-description {
            display: block;
            color: #646970;
            font-size: 9.7px;
            line-height: 1.23;
        }
    </style>
    <?php
}
add_action('customize_controls_print_styles', 'chaveiro_customizer_panel_styles');

// ==============================
// CARREGAR ARQUIVOS DO TEMA
// ==============================
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/menu.php';
require_once get_template_directory() . '/inc/hero.php';
require_once get_template_directory() . '/inc/admin-hero.php';
require_once get_template_directory() . '/inc/servicos.php';
require_once get_template_directory() . '/inc/produtos.php';
require_once get_template_directory() . '/inc/sobre.php';
require_once get_template_directory() . '/inc/faq.php';
require_once get_template_directory() . '/inc/admin-faq.php';
require_once get_template_directory() . '/inc/footer-config.php';
require_once get_template_directory() . '/inc/whatsapp-float.php';
require_once get_template_directory() . '/inc/admin-menu.php';
require_once get_template_directory() . '/inc/clientes.php';
require_once get_template_directory() . '/inc/leads.php';
require_once get_template_directory() . '/inc/cidades.php';
require_once get_template_directory() . '/inc/menu-estilo.php';

// ==============================
// HERO / SOBRE - TAMANHOS NATIVOS E WEBP
// ==============================
function chaveiro_register_theme_image_sizes()
{
    add_image_size('hero_desktop', 1920, 900, true);
    add_image_size('hero_mobile', 700, 400, true);
    add_image_size('sobre_quadrado', 400, 400, true);
    add_image_size('servico_card', 900, 620, true);
    add_image_size('produto_card', 900, 620, true);
}
add_action('after_setup_theme', 'chaveiro_register_theme_image_sizes');

function chaveiro_convert_uploads_to_webp($formats)
{
    $formats['image/jpeg'] = 'image/webp';
    $formats['image/png']  = 'image/webp';

    return $formats;
}
add_filter('image_editor_output_format', 'chaveiro_convert_uploads_to_webp');

// ==============================
// HELPERS DE ASSETS
// ==============================
function chaveiro_get_theme_script_asset()
{
    $candidates = array(
        '/assets/js/scripts.min.js',
        '/assets/js/script.min.js',
        '/script.min.js',
        '/assets/js/scripts.js',
        '/assets/js/script.js',
        '/script.js',
    );

    foreach ($candidates as $candidate) {
        $absolute_path = get_template_directory() . $candidate;

        if (file_exists($absolute_path)) {
            return array(
                'uri'     => get_template_directory_uri() . $candidate,
                'version' => filemtime($absolute_path),
            );
        }
    }

    return false;
}

function chaveiro_get_named_script_asset($relative_path)
{
    $min_relative = str_replace('.js', '.min.js', $relative_path);

    $min_absolute = get_template_directory() . $min_relative;
    $normal_absolute = get_template_directory() . $relative_path;

    if (file_exists($min_absolute)) {
        return array(
            'uri'     => get_template_directory_uri() . $min_relative,
            'version' => filemtime($min_absolute),
        );
    }

    if (file_exists($normal_absolute)) {
        return array(
            'uri'     => get_template_directory_uri() . $relative_path,
            'version' => filemtime($normal_absolute),
        );
    }

    return false;
}

function chaveiro_get_minified_css_asset($relative_path)
{
    $min_relative_path = str_replace('.css', '.min.css', $relative_path);

    $min_absolute_path = get_template_directory() . $min_relative_path;
    if (file_exists($min_absolute_path)) {
        return array(
            'uri'     => get_template_directory_uri() . $min_relative_path,
            'version' => filemtime($min_absolute_path),
        );
    }

    $absolute_path = get_template_directory() . $relative_path;
    if (file_exists($absolute_path)) {
        return array(
            'uri'     => get_template_directory_uri() . $relative_path,
            'version' => filemtime($absolute_path),
        );
    }

    return false;
}

// ==============================
// GOOGLE FONTS DINÂMICO
// ==============================
function chaveiro_google_fonts_url()
{
    $families = array();

    $font_body        = trim((string) get_theme_mod('font_body', 'Roboto'));
    $font_body_weight = trim((string) get_theme_mod('font_body_weight', '400'));

    $font_h1        = trim((string) get_theme_mod('font_h1', 'Poppins'));
    $font_h1_weight = trim((string) get_theme_mod('font_h1_weight', '700'));

    $font_h2        = trim((string) get_theme_mod('font_h2', 'Poppins'));
    $font_h2_weight = trim((string) get_theme_mod('font_h2_weight', '600'));

    if ($font_body !== '') {
        $families[] = str_replace(' ', '+', $font_body) . ':wght@' . preg_replace('/[^0-9;]/', '', $font_body_weight);
    }

    if ($font_h1 !== '') {
        $families[] = str_replace(' ', '+', $font_h1) . ':wght@' . preg_replace('/[^0-9;]/', '', $font_h1_weight);
    }

    if ($font_h2 !== '') {
        $families[] = str_replace(' ', '+', $font_h2) . ':wght@' . preg_replace('/[^0-9;]/', '', $font_h2_weight);
    }

    $families = array_unique(array_filter($families));

    if (empty($families)) {
        return '';
    }

    return 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $families) . '&display=swap';
}

// ==============================
// ENQUEUE CSS E JS
// ==============================
function chaveiro_enqueue_assets()
{
    $theme_version = wp_get_theme()->get('Version');

    $core_script_asset   = chaveiro_get_theme_script_asset();
    $modal_script_asset  = chaveiro_get_named_script_asset('/assets/js/modal.js');
    $hero_script_asset   = chaveiro_get_named_script_asset('/assets/js/hero.js');
    $kanban_script_asset = chaveiro_get_named_script_asset('/assets/js/kanban.js');

    $bootstrap_util_asset = chaveiro_get_named_script_asset('/vendor/bootstrap/js/dist/util.js');
    $bootstrap_collapse_asset = chaveiro_get_named_script_asset('/vendor/bootstrap/js/dist/collapse.js');
    $bootstrap_carousel_asset = chaveiro_get_named_script_asset('/vendor/bootstrap/js/dist/carousel.js');

    $is_home_context = is_front_page() || is_home();

    $is_servicos_context = $is_home_context
        || is_post_type_archive('servicos')
        || is_singular('servicos')
        || is_tax(array('categoria_servicos', 'servicos_categoria', 'servicos-categoria'));

    $is_produtos_context = $is_home_context
        || is_post_type_archive('produtos')
        || is_singular('produtos')
        || is_tax(array('categoria_produtos', 'produtos_categoria', 'produtos-categoria'));

    $google_fonts_url = chaveiro_google_fonts_url();
    if (!empty($google_fonts_url)) {
        wp_enqueue_style(
            'chaveiro-google-fonts',
            $google_fonts_url,
            array(),
            null
        );
    }

    // ==============================
    // BOOTSTRAP CUSTOM LOCAL
    // ==============================
    $bootstrap_custom = chaveiro_get_minified_css_asset('/assets/css/bootstrap-custom.css');
    if ($bootstrap_custom) {
        wp_enqueue_style(
            'bootstrap-custom',
            $bootstrap_custom['uri'],
            array(),
            $bootstrap_custom['version']
        );
    }

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(),
        '6.5.2'
    );

    wp_enqueue_style(
        'chaveiro-style',
        get_stylesheet_uri(),
        array('bootstrap-custom', 'font-awesome'),
        file_exists(get_stylesheet_directory() . '/style.css')
            ? filemtime(get_stylesheet_directory() . '/style.css')
            : $theme_version
    );

    $base_style_handle = 'chaveiro-style';

    $assets_style = chaveiro_get_minified_css_asset('/assets/css/style.css');
    if ($assets_style) {
        wp_enqueue_style(
            'chaveiro-assets-style',
            $assets_style['uri'],
            array('chaveiro-style'),
            $assets_style['version']
        );

        $base_style_handle = 'chaveiro-assets-style';
    }

    $menu_css = chaveiro_get_minified_css_asset('/assets/css/menu.css');
    if ($menu_css) {
        wp_enqueue_style(
            'chaveiro-menu',
            $menu_css['uri'],
            array($base_style_handle),
            $menu_css['version']
        );
    }

    $menu_estilo_css = chaveiro_get_minified_css_asset('/assets/css/menu-estilo.css');
    if ($menu_estilo_css) {
        wp_enqueue_style(
            'chaveiro-menu-estilo',
            $menu_estilo_css['uri'],
            array('chaveiro-menu'),
            $menu_estilo_css['version']
        );
    }

    $modal_css = chaveiro_get_minified_css_asset('/assets/css/modal.css');
    if ($modal_css) {
        wp_enqueue_style(
            'chaveiro-modal',
            $modal_css['uri'],
            array($base_style_handle),
            $modal_css['version']
        );
    }

    $whatsapp_css = chaveiro_get_minified_css_asset('/assets/css/whatsapp.css');
    if ($whatsapp_css) {
        wp_enqueue_style(
            'chaveiro-whatsapp',
            $whatsapp_css['uri'],
            array($base_style_handle),
            $whatsapp_css['version']
        );
    }

    $hero_css = chaveiro_get_minified_css_asset('/assets/css/hero.css');
    if ($is_home_context && $hero_css) {
        wp_enqueue_style(
            'chaveiro-hero',
            $hero_css['uri'],
            array($base_style_handle),
            $hero_css['version']
        );
    }

    $sobre_css = chaveiro_get_minified_css_asset('/assets/css/sobre.css');
    if ($is_home_context && $sobre_css) {
        wp_enqueue_style(
            'chaveiro-sobre',
            $sobre_css['uri'],
            array($base_style_handle),
            $sobre_css['version']
        );
    }

    $servicos_css = chaveiro_get_minified_css_asset('/assets/css/servicos.css');
    if ($is_servicos_context && $servicos_css) {
        wp_enqueue_style(
            'chaveiro-servicos',
            $servicos_css['uri'],
            array($base_style_handle),
            $servicos_css['version']
        );
    }

    $produtos_css = chaveiro_get_minified_css_asset('/assets/css/produtos.css');
    if ($is_produtos_context && $produtos_css) {
        wp_enqueue_style(
            'chaveiro-produtos',
            $produtos_css['uri'],
            array($base_style_handle),
            $produtos_css['version']
        );
    }

    $faq_css = chaveiro_get_minified_css_asset('/assets/css/faq.css');
    if ($is_home_context && $faq_css) {
        wp_enqueue_style(
            'chaveiro-faq',
            $faq_css['uri'],
            array($base_style_handle),
            $faq_css['version']
        );
    }

    $footer_css = chaveiro_get_minified_css_asset('/assets/css/footer-config.css');
    if ($footer_css) {
        wp_enqueue_style(
            'chaveiro-footer-config',
            $footer_css['uri'],
            array($base_style_handle),
            $footer_css['version']
        );
    }

    $avaliacoes_css = chaveiro_get_minified_css_asset('/assets/css/avaliacoes.css');
    if ($is_home_context && $avaliacoes_css) {
        wp_enqueue_style(
            'chaveiro-avaliacoes',
            $avaliacoes_css['uri'],
            array($base_style_handle),
            $avaliacoes_css['version']
        );
    }

    $kanban_css = chaveiro_get_minified_css_asset('/assets/css/kanban.css');
    if ($kanban_css) {
        wp_enqueue_style(
            'chaveiro-kanban',
            $kanban_css['uri'],
            array($base_style_handle),
            $kanban_css['version']
        );
    }

    wp_enqueue_script('jquery');

    if ($bootstrap_util_asset) {
        wp_enqueue_script(
            'bootstrap-util',
            $bootstrap_util_asset['uri'],
            array('jquery'),
            $bootstrap_util_asset['version'],
            true
        );
    }

    if ($bootstrap_collapse_asset) {
        wp_enqueue_script(
            'bootstrap-collapse',
            $bootstrap_collapse_asset['uri'],
            array('jquery', 'bootstrap-util'),
            $bootstrap_collapse_asset['version'],
            true
        );
    }

    if ($bootstrap_carousel_asset) {
        wp_enqueue_script(
            'bootstrap-carousel',
            $bootstrap_carousel_asset['uri'],
            array('jquery', 'bootstrap-util'),
            $bootstrap_carousel_asset['version'],
            true
        );
    }

    if ($core_script_asset) {
        wp_enqueue_script(
            'chaveiro-scripts',
            $core_script_asset['uri'],
            array('jquery', 'bootstrap-collapse'),
            $core_script_asset['version'],
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

    if ($modal_script_asset) {
        wp_enqueue_script(
            'chaveiro-modal-script',
            $modal_script_asset['uri'],
            array('jquery'),
            $modal_script_asset['version'],
            true
        );

        wp_localize_script(
            'chaveiro-modal-script',
            'ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
            )
        );
    }

    if ($is_home_context && $hero_script_asset) {
        wp_enqueue_script(
            'chaveiro-hero-script',
            $hero_script_asset['uri'],
            array('jquery', 'bootstrap-carousel'),
            $hero_script_asset['version'],
            true
        );
    }

    if ($kanban_script_asset) {
        wp_enqueue_script(
            'chaveiro-kanban-script',
            $kanban_script_asset['uri'],
            array('jquery'),
            $kanban_script_asset['version'],
            true
        );

        wp_localize_script(
            'chaveiro-kanban-script',
            'ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'chaveiro_enqueue_assets');

// ==============================
// CSS DINÂMICO GLOBAL
// ==============================
function chaveiro_custom_css_variables()
{
    $azul_escuro       = get_theme_mod('azul_escuro', '#0A2540');
    $azul_principal    = get_theme_mod('azul_principal', '#007BFF');
    $azul_claro        = get_theme_mod('azul_claro', '#00C6FF');
    $verde_whatsapp    = get_theme_mod('verde_whatsapp', '#25D366');

    $menu_bg_color     = get_theme_mod('menu_bg_color', '#ffffff');
    $menu_bg_scroll    = get_theme_mod('menu_bg_scroll', '#ffffff');
    $menu_text_color   = get_theme_mod('menu_text_color', '#111111');
    $menu_hover_color  = get_theme_mod('menu_hover_color', '#28a745');

    $font_body         = get_theme_mod('font_body', 'Roboto');
    $font_body_weight  = get_theme_mod('font_body_weight', '400');
    $font_body_size    = get_theme_mod('font_body_size', '16');
    $font_body_style   = get_theme_mod('font_body_style', 'normal');

    $font_h1           = get_theme_mod('font_h1', 'Poppins');
    $font_h1_weight    = get_theme_mod('font_h1_weight', '700');
    $font_h1_size      = get_theme_mod('font_h1_size', '42');

    $font_h2           = get_theme_mod('font_h2', 'Poppins');
    $font_h2_weight    = get_theme_mod('font_h2_weight', '600');
    $font_h2_size      = get_theme_mod('font_h2_size', '32');
    ?>
    <style id="chaveiro-custom-vars">
        :root {
            --azul-escuro: <?php echo esc_html($azul_escuro); ?>;
            --azul-principal: <?php echo esc_html($azul_principal); ?>;
            --azul-claro: <?php echo esc_html($azul_claro); ?>;
            --verde-whatsapp: <?php echo esc_html($verde_whatsapp); ?>;

            --menu-bg-color: <?php echo esc_html($menu_bg_color); ?>;
            --menu-bg-scroll: <?php echo esc_html($menu_bg_scroll); ?>;
            --menu-text-color: <?php echo esc_html($menu_text_color); ?>;
            --menu-hover-color: <?php echo esc_html($menu_hover_color); ?>;

            --font-body: '<?php echo esc_html($font_body); ?>', sans-serif;
            --font-body-weight: <?php echo esc_html($font_body_weight); ?>;
            --font-body-size: <?php echo esc_html($font_body_size); ?>px;
            --font-body-style: <?php echo esc_html($font_body_style); ?>;

            --font-h1: '<?php echo esc_html($font_h1); ?>', sans-serif;
            --font-h1-weight: <?php echo esc_html($font_h1_weight); ?>;
            --font-h1-size: <?php echo esc_html($font_h1_size); ?>px;

            --font-h2: '<?php echo esc_html($font_h2); ?>', sans-serif;
            --font-h2-weight: <?php echo esc_html($font_h2_weight); ?>;
            --font-h2-size: <?php echo esc_html($font_h2_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'chaveiro_custom_css_variables', 5);

// ==============================
// PRESETS DE CORES
// ==============================
function chaveiro_get_color_presets()
{
    return array(
        'padrao' => array(
            'azul_escuro'    => '#0A2540',
            'azul_principal' => '#007BFF',
            'azul_claro'     => '#00C6FF',
            'verde_whatsapp' => '#25D366',
        ),
        'vermelho' => array(
            'azul_escuro'    => '#3A0A0A',
            'azul_principal' => '#FF3B3B',
            'azul_claro'     => '#FF7B7B',
            'verde_whatsapp' => '#25D366',
        ),
        'verde' => array(
            'azul_escuro'    => '#0A3A2A',
            'azul_principal' => '#28A745',
            'azul_claro'     => '#5CD68D',
            'verde_whatsapp' => '#25D366',
        ),
    );
}

function chaveiro_apply_preset()
{
    if (!current_user_can('edit_theme_options')) {
        wp_send_json_error('Sem permissão.');
    }

    $preset  = isset($_POST['preset']) ? sanitize_text_field(wp_unslash($_POST['preset'])) : '';
    $presets = chaveiro_get_color_presets();

    if (!isset($presets[$preset])) {
        wp_send_json_error('Preset inválido.');
    }

    foreach ($presets[$preset] as $key => $value) {
        set_theme_mod($key, $value);
    }

    wp_send_json_success('Preset aplicado.');
}
add_action('wp_ajax_apply_preset', 'chaveiro_apply_preset');

add_action('wp_ajax_apply_preset', 'chaveiro_apply_preset');


// ==============================
// DESABILITAR EMOJIS DO WORDPRESS
// ==============================

function chaveiro_disable_wp_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

add_action('init', 'chaveiro_disable_wp_emojis');


// ==============================
// BASE MULTI-CLIENTE
// ==============================
function chaveiro_cliente_atual()
{
    if (isset($_GET['cliente'])) {
        return sanitize_text_field(wp_unslash($_GET['cliente']));
    }

    return 'default';
}

// ==============================
// SHORTCODE DA LANDING
// ==============================
function chaveiro_lp_shortcode()
{
    ob_start();
    include get_template_directory() . '/index.php';
    return ob_get_clean();
}
add_shortcode('lp_chaveiro', 'lp_chaveiro');