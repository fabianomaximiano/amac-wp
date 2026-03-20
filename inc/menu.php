<?php

function chaveiro_menu_customize($wp_customize) {

    // ======================
    // MENU E IDENTIDADE
    // ======================
    $wp_customize->add_section('menu_opcoes', [
        'title' => 'Menu e Identidade'
    ]);

    // ALTURA
    $wp_customize->add_setting('menu_altura', ['default' => 80]);
    $wp_customize->add_control('menu_altura', [
        'label' => 'Altura do Menu (px)',
        'section' => 'menu_opcoes',
        'type' => 'number'
    ]);

    // TRANSPARENTE
    $wp_customize->add_setting('menu_transparente', ['default' => true]);
    $wp_customize->add_control('menu_transparente', [
        'label' => 'Menu transparente no topo',
        'section' => 'menu_opcoes',
        'type' => 'checkbox'
    ]);

    // COR FUNDO
    $wp_customize->add_setting('menu_bg_color', ['default' => '#ffffff']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_bg_color',
        [
            'label' => 'Cor de fundo',
            'section' => 'menu_opcoes'
        ]
    ));

    // COR SCROLL
    $wp_customize->add_setting('menu_bg_scroll', ['default' => '#ffffff']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_bg_scroll',
        [
            'label' => 'Cor do menu ao rolar',
            'section' => 'menu_opcoes'
        ]
    ));

    // TEXTO
    $wp_customize->add_setting('menu_text_color', ['default' => '#000000']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_text_color',
        [
            'label' => 'Cor do texto',
            'section' => 'menu_opcoes'
        ]
    ));

    // HOVER
    $wp_customize->add_setting('menu_hover_color', ['default' => '#28a745']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_hover_color',
        [
            'label' => 'Cor hover',
            'section' => 'menu_opcoes'
        ]
    ));

    // WHATSAPP
    $wp_customize->add_setting('whatsapp_numero');
    $wp_customize->add_control('whatsapp_numero', [
        'label' => 'WhatsApp',
        'section' => 'menu_opcoes'
    ]);

    $wp_customize->add_setting('whatsapp_ativo', ['default' => true]);
    $wp_customize->add_control('whatsapp_ativo', [
        'label' => 'Ativar WhatsApp',
        'section' => 'menu_opcoes',
        'type' => 'checkbox'
    ]);

    // ======================
    // TIPOGRAFIA (EVOLUÍDA)
    // ======================
    $wp_customize->add_section('tipografia', [
        'title' => 'Tipografia'
    ]);

    // ===== BODY =====
    $wp_customize->add_setting('font_body', ['default' => 'Roboto']);
    $wp_customize->add_control('font_body', [
        'label' => 'Fonte do texto',
        'section' => 'tipografia'
    ]);

    $wp_customize->add_setting('font_body_weight', ['default' => '400']);
    $wp_customize->add_control('font_body_weight', [
        'label' => 'Peso (300,400,700)',
        'section' => 'tipografia',
        'type' => 'number'
    ]);

    $wp_customize->add_setting('font_body_size', ['default' => '16']);
    $wp_customize->add_control('font_body_size', [
        'label' => 'Tamanho (px)',
        'section' => 'tipografia',
        'type' => 'number'
    ]);

    $wp_customize->add_setting('font_body_style', ['default' => 'normal']);
    $wp_customize->add_control('font_body_style', [
        'label' => 'Estilo',
        'section' => 'tipografia',
        'type' => 'select',
        'choices' => [
            'normal' => 'Normal',
            'italic' => 'Itálico'
        ]
    ]);

    // ===== H1 =====
    $wp_customize->add_setting('font_h1', ['default' => 'Poppins']);
    $wp_customize->add_control('font_h1', [
        'label' => 'Fonte H1',
        'section' => 'tipografia'
    ]);

    $wp_customize->add_setting('font_h1_weight', ['default' => '700']);
    $wp_customize->add_control('font_h1_weight', [
        'label' => 'Peso H1',
        'section' => 'tipografia',
        'type' => 'number'
    ]);

    $wp_customize->add_setting('font_h1_size', ['default' => '42']);
    $wp_customize->add_control('font_h1_size', [
        'label' => 'Tamanho H1 (px)',
        'section' => 'tipografia',
        'type' => 'number'
    ]);

    // ===== H2 =====
    $wp_customize->add_setting('font_h2', ['default' => 'Poppins']);
    $wp_customize->add_control('font_h2', [
        'label' => 'Fonte H2',
        'section' => 'tipografia'
    ]);

    $wp_customize->add_setting('font_h2_weight', ['default' => '600']);
    $wp_customize->add_control('font_h2_weight', [
        'label' => 'Peso H2',
        'section' => 'tipografia',
        'type' => 'number'
    ]);

    $wp_customize->add_setting('font_h2_size', ['default' => '32']);
    $wp_customize->add_control('font_h2_size', [
        'label' => 'Tamanho H2 (px)',
        'section' => 'tipografia',
        'type' => 'number'
    ]);

}
add_action('customize_register', 'chaveiro_menu_customize');