<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ==================================================
 * MENU - ESTILO VISUAL
 * ==================================================
 * Responsabilidades deste arquivo:
 * - registrar campos no Customizer
 * - sanitizar os valores
 * - carregar o CSS específico do menu-estilo
 * - enviar as variáveis CSS dinâmicas para o arquivo
 */

/**
 * ==================================================
 * HELPERS
 * ==================================================
 */
if (!function_exists('chaveiro_sanitize_select')) {
    function chaveiro_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $control = $setting->manager->get_control($setting->id);

        if (!$control || empty($control->choices)) {
            return $setting->default;
        }

        return array_key_exists($input, $control->choices) ? $input : $setting->default;
    }
}

if (!function_exists('chaveiro_sanitize_text_or_empty')) {
    function chaveiro_sanitize_text_or_empty($value)
    {
        $value = is_string($value) ? trim($value) : '';
        return $value === '' ? '' : sanitize_text_field($value);
    }
}

if (!function_exists('chaveiro_sanitize_url_or_empty')) {
    function chaveiro_sanitize_url_or_empty($value)
    {
        $value = is_string($value) ? trim($value) : '';
        return $value === '' ? '' : esc_url_raw($value);
    }
}

if (!function_exists('chaveiro_sanitize_absint_range')) {
    function chaveiro_sanitize_absint_range($value, $min = 0, $max = 999)
    {
        $value = absint($value);

        if ($value < $min) {
            $value = $min;
        }

        if ($value > $max) {
            $value = $max;
        }

        return $value;
    }
}

/**
 * ==================================================
 * CUSTOMIZER
 * ==================================================
 */
add_action('customize_register', 'chaveiro_registrar_menu_estilo_customizer');

function chaveiro_registrar_menu_estilo_customizer($wp_customize)
{
    $wp_customize->add_section('menu_estilo_secao', array(
        'title'       => __('Menu - Estilo Visual', 'amac-wp'),
        'priority'    => 32,
        'description' => __('Controle o fundo da faixa do menu, as cores dos links e o botão de atendimento.', 'amac-wp'),
    ));

    if (class_exists('Theme_Customizer_Section_Title_Control')) {
        $wp_customize->add_setting('menu_estilo_titulo_fundo', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
            $wp_customize,
            'menu_estilo_titulo_fundo',
            array(
                'section'     => 'menu_estilo_secao',
                'label'       => __('Fundo da faixa', 'amac-wp'),
                'description' => __('Defina se o fundo será sólido ou em degradê.', 'amac-wp'),
            )
        ));
    }

    $wp_customize->add_setting('header_faixa_bg_tipo', array(
        'default'           => 'solido',
        'sanitize_callback' => 'chaveiro_sanitize_select',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_faixa_bg_tipo', array(
        'label'   => __('Tipo de fundo', 'amac-wp'),
        'section' => 'menu_estilo_secao',
        'type'    => 'select',
        'choices' => array(
            'solido'  => __('Cor sólida', 'amac-wp'),
            'degrade' => __('Degradê', 'amac-wp'),
        ),
    ));

    $wp_customize->add_setting('header_faixa_bg_cor_1', array(
        'default'           => '#eef1f5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_faixa_bg_cor_1',
        array(
            'label'   => __('Cor principal do fundo', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_faixa_bg_cor_2', array(
        'default'           => '#dfe5ec',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_faixa_bg_cor_2',
        array(
            'label'       => __('Cor secundária do degradê', 'amac-wp'),
            'description' => __('Usada apenas quando o tipo de fundo for degradê.', 'amac-wp'),
            'section'     => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_faixa_bg_direcao', array(
        'default'           => '90deg',
        'sanitize_callback' => 'chaveiro_sanitize_select',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_faixa_bg_direcao', array(
        'label'   => __('Direção do degradê', 'amac-wp'),
        'section' => 'menu_estilo_secao',
        'type'    => 'select',
        'choices' => array(
            '90deg'  => __('Esquerda para direita', 'amac-wp'),
            '180deg' => __('Cima para baixo', 'amac-wp'),
            '135deg' => __('Diagonal', 'amac-wp'),
        ),
    ));

    if (class_exists('Theme_Customizer_Section_Title_Control')) {
        $wp_customize->add_setting('menu_estilo_titulo_links', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
            $wp_customize,
            'menu_estilo_titulo_links',
            array(
                'section'     => 'menu_estilo_secao',
                'label'       => __('Links e efeitos do menu', 'amac-wp'),
                'description' => __('Cores do texto, hover, item ativo e efeito visual dos links.', 'amac-wp'),
            )
        ));
    }

    $wp_customize->add_setting('header_logo_texto_cor', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_logo_texto_cor',
        array(
            'label'       => __('Cor do logo em texto', 'amac-wp'),
            'description' => __('Afeta o nome do site quando não houver logo em imagem.', 'amac-wp'),
            'section'     => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_menu_link_cor', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_menu_link_cor',
        array(
            'label'   => __('Cor do texto do menu', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_menu_link_hover_cor', array(
        'default'           => '#0ea5e9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_menu_link_hover_cor',
        array(
            'label'   => __('Cor do hover do menu', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_menu_link_ativo_cor', array(
        'default'           => '#0284c7',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_menu_link_ativo_cor',
        array(
            'label'   => __('Cor do item ativo', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_menu_hover_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_menu_hover_bg',
        array(
            'label'       => __('Cor de fundo no hover', 'amac-wp'),
            'description' => __('Aplicada de forma suave no hover e no menu mobile.', 'amac-wp'),
            'section'     => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_menu_indicador_cor', array(
        'default'           => '#0ea5e9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_menu_indicador_cor',
        array(
            'label'       => __('Cor do indicador dos links', 'amac-wp'),
            'description' => __('Usada no sublinhado/efeito visual do item.', 'amac-wp'),
            'section'     => 'menu_estilo_secao',
        )
    ));

    if (class_exists('Theme_Customizer_Section_Title_Control')) {
        $wp_customize->add_setting('menu_estilo_titulo_botao', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
            $wp_customize,
            'menu_estilo_titulo_botao',
            array(
                'section'     => 'menu_estilo_secao',
                'label'       => __('Botão de atendimento', 'amac-wp'),
                'description' => __('Controle o texto, link e aparência do botão principal do header.', 'amac-wp'),
            )
        ));
    }

    $wp_customize->add_setting('menu_cta_texto', array(
        'default'           => __('Solicitar atendimento', 'amac-wp'),
        'sanitize_callback' => 'chaveiro_sanitize_text_or_empty',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('menu_cta_texto', array(
        'label'   => __('Texto do botão', 'amac-wp'),
        'section' => 'menu_estilo_secao',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('menu_cta_link', array(
        'default'           => '',
        'sanitize_callback' => 'chaveiro_sanitize_url_or_empty',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('menu_cta_link', array(
        'label'       => __('Link do botão', 'amac-wp'),
        'description' => __('Se ficar vazio, o botão continua abrindo o modal.', 'amac-wp'),
        'section'     => 'menu_estilo_secao',
        'type'        => 'url',
    ));

    $wp_customize->add_setting('header_cta_bg', array(
        'default'           => '#facc15',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_cta_bg',
        array(
            'label'   => __('Cor de fundo do botão', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_cta_texto_cor', array(
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_cta_texto_cor',
        array(
            'label'   => __('Cor do texto do botão', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_cta_borda_cor', array(
        'default'           => '#facc15',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_cta_borda_cor',
        array(
            'label'   => __('Cor da borda do botão', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_cta_bg_hover', array(
        'default'           => '#eab308',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_cta_bg_hover',
        array(
            'label'   => __('Cor de fundo do botão no hover', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_cta_texto_hover', array(
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_cta_texto_hover',
        array(
            'label'   => __('Cor do texto do botão no hover', 'amac-wp'),
            'section' => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_cta_shadow_cor', array(
        'default'           => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_cta_shadow_cor',
        array(
            'label'       => __('Cor da sombra do botão', 'amac-wp'),
            'description' => __('Usada com transparência para compor a sombra.', 'amac-wp'),
            'section'     => 'menu_estilo_secao',
        )
    ));

    $wp_customize->add_setting('header_cta_radius', array(
        'default'           => 14,
        'sanitize_callback' => function ($value) {
            return chaveiro_sanitize_absint_range($value, 0, 60);
        },
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_cta_radius', array(
        'label'       => __('Arredondamento do botão', 'amac-wp'),
        'description' => __('Valor em pixels.', 'amac-wp'),
        'section'     => 'menu_estilo_secao',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 60,
            'step' => 1,
        ),
    ));
}

/**
 * ==================================================
 * ENQUEUE DO CSS DO MÓDULO
 * ==================================================
 */
add_action('wp_enqueue_scripts', 'chaveiro_menu_estilo_enqueue', 30);

function chaveiro_menu_estilo_enqueue()
{
    $css_path = get_template_directory() . '/assets/css/menu-estilo.css';

    if (!file_exists($css_path)) {
        return;
    }

    wp_enqueue_style(
        'chaveiro-menu-estilo',
        get_template_directory_uri() . '/assets/css/menu-estilo.css',
        array('chaveiro-menu'),
        filemtime($css_path)
    );

    $bg_tipo         = get_theme_mod('header_faixa_bg_tipo', 'solido');
    $bg_cor_1        = get_theme_mod('header_faixa_bg_cor_1', '#eef1f5');
    $bg_cor_2        = get_theme_mod('header_faixa_bg_cor_2', '#dfe5ec');
    $bg_direcao      = get_theme_mod('header_faixa_bg_direcao', '90deg');

    $logo_cor        = get_theme_mod('header_logo_texto_cor', '#0f172a');
    $link_cor        = get_theme_mod('header_menu_link_cor', '#0f172a');
    $link_hover_cor  = get_theme_mod('header_menu_link_hover_cor', '#0ea5e9');
    $link_ativo_cor  = get_theme_mod('header_menu_link_ativo_cor', '#0284c7');
    $hover_bg        = get_theme_mod('header_menu_hover_bg', '#ffffff');
    $indicador_cor   = get_theme_mod('header_menu_indicador_cor', '#0ea5e9');

    $cta_bg          = get_theme_mod('header_cta_bg', '#facc15');
    $cta_texto       = get_theme_mod('header_cta_texto_cor', '#111111');
    $cta_borda       = get_theme_mod('header_cta_borda_cor', '#facc15');
    $cta_bg_hover    = get_theme_mod('header_cta_bg_hover', '#eab308');
    $cta_texto_hover = get_theme_mod('header_cta_texto_hover', '#111111');
    $cta_shadow      = get_theme_mod('header_cta_shadow_cor', '#f59e0b');
    $cta_radius      = absint(get_theme_mod('header_cta_radius', 14));

    $faixa_bg = ($bg_tipo === 'degrade')
        ? 'linear-gradient(' . $bg_direcao . ', ' . $bg_cor_1 . ' 0%, ' . $bg_cor_2 . ' 100%)'
        : $bg_cor_1;

    $shadow_rgba      = chaveiro_menu_estilo_hex_to_rgba($cta_shadow, 0.24);
    $shadow_rgba_hover = chaveiro_menu_estilo_hex_to_rgba($cta_shadow, 0.32);

    $css = '
:root{
    --header-faixa-bg: ' . esc_html($faixa_bg) . ';
    --header-logo-texto-cor: ' . esc_html($logo_cor) . ';
    --header-menu-link-cor: ' . esc_html($link_cor) . ';
    --header-menu-link-hover-cor: ' . esc_html($link_hover_cor) . ';
    --header-menu-link-ativo-cor: ' . esc_html($link_ativo_cor) . ';
    --header-menu-hover-bg: ' . esc_html($hover_bg) . ';
    --header-menu-indicador-cor: ' . esc_html($indicador_cor) . ';

    --header-cta-bg: ' . esc_html($cta_bg) . ';
    --header-cta-texto-cor: ' . esc_html($cta_texto) . ';
    --header-cta-borda-cor: ' . esc_html($cta_borda) . ';
    --header-cta-bg-hover: ' . esc_html($cta_bg_hover) . ';
    --header-cta-texto-hover: ' . esc_html($cta_texto_hover) . ';
    --header-cta-shadow: ' . esc_html($shadow_rgba) . ';
    --header-cta-shadow-hover: ' . esc_html($shadow_rgba_hover) . ';
    --header-cta-radius: ' . esc_html($cta_radius) . 'px;
}
';

    wp_add_inline_style('chaveiro-menu-estilo', $css);
}

if (!function_exists('chaveiro_menu_estilo_hex_to_rgba')) {
    function chaveiro_menu_estilo_hex_to_rgba($hex, $alpha = 1)
    {
        $hex = sanitize_hex_color($hex);

        if (!$hex) {
            return 'rgba(245, 158, 11, ' . floatval($alpha) . ')';
        }

        $hex = str_replace('#', '', $hex);

        if (strlen($hex) === 3) {
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return 'rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . floatval($alpha) . ')';
    }
}