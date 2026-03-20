<?php
if (!defined('ABSPATH')) {
    exit;
}

// ==============================
// CARREGAR ARQUIVOS DO TEMA
// ==============================
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/menu.php';
require_once get_template_directory() . '/inc/hero.php';
require_once get_template_directory() . '/inc/admin-hero.php';
require_once get_template_directory() . '/inc/servicos.php';
require_once get_template_directory() . '/inc/sobre.php';
require_once get_template_directory() . '/inc/faq.php';
require_once get_template_directory() . '/inc/admin-faq.php';
require_once get_template_directory() . '/inc/footer-config.php';
require_once get_template_directory() . '/inc/whatsapp-float.php';
require_once get_template_directory() . '/inc/admin-menu.php';
require_once get_template_directory() . '/inc/clientes.php';
require_once get_template_directory() . '/inc/leads.php';
require_once get_template_directory() . '/inc/cidades.php';

// ==============================
// HERO / SOBRE - TAMANHOS NATIVOS E WEBP
// ==============================
function chaveiro_register_theme_image_sizes()
{
    add_image_size('hero_desktop', 1920, 900, true);
    add_image_size('hero_mobile', 768, 1100, true);
    add_image_size('sobre_quadrado', 400, 400, true);
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
// RETORNAR ARQUIVO JS DO TEMA
// ==============================
function chaveiro_get_theme_script_asset()
{
    $candidates = array(
        '/assets/js/scripts.js',
        '/assets/js/script.js',
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
    $script_asset  = chaveiro_get_theme_script_asset();

    $google_fonts_url = chaveiro_google_fonts_url();
    if (!empty($google_fonts_url)) {
        wp_enqueue_style(
            'chaveiro-google-fonts',
            $google_fonts_url,
            array(),
            null
        );
    }

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

    wp_enqueue_style(
        'chaveiro-style',
        get_stylesheet_uri(),
        array('bootstrap-4', 'font-awesome'),
        file_exists(get_stylesheet_directory() . '/style.css')
            ? filemtime(get_stylesheet_directory() . '/style.css')
            : $theme_version
    );

    $assets_css_path = get_template_directory() . '/assets/css/style.css';
    if (file_exists($assets_css_path)) {
        wp_enqueue_style(
            'chaveiro-assets-style',
            get_template_directory_uri() . '/assets/css/style.css',
            array('chaveiro-style'),
            filemtime($assets_css_path)
        );
    }

    $hero_css_path = get_template_directory() . '/assets/css/hero.css';
    if (file_exists($hero_css_path)) {
        wp_enqueue_style(
            'chaveiro-hero',
            get_template_directory_uri() . '/assets/css/hero.css',
            array('chaveiro-style'),
            filemtime($hero_css_path)
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

        wp_localize_script('chaveiro-scripts', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
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
add_action('wp_head', 'chaveiro_custom_css_variables', 20);

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
add_shortcode('lp_chaveiro', 'chaveiro_lp_shortcode');