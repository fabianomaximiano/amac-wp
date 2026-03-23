<?php

function chaveiro_menu_customize($wp_customize) {

    // ======================
    // MENU E IDENTIDADE
    // ======================
    $wp_customize->add_section('menu_opcoes', [
        'title' => 'Menu e Identidade'
    ]);

    $wp_customize->add_setting('theme_menu_heading_estrutura', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_menu_heading_estrutura',
        [
            'label'       => 'Estrutura do menu',
            'description' => 'Configure altura e comportamento do menu principal.',
            'section'     => 'menu_opcoes',
            'settings'    => 'theme_menu_heading_estrutura',
        ]
    ));

    $wp_customize->add_setting('menu_altura', ['default' => 80]);
    $wp_customize->add_control('menu_altura', [
        'label'       => 'Altura do Menu (px)',
        'section'     => 'menu_opcoes',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '80',
            'min'         => 40,
            'max'         => 180,
            'step'        => 1,
        ],
    ]);

    $wp_customize->add_setting('menu_transparente', ['default' => true]);
    $wp_customize->add_control('menu_transparente', [
        'label'   => 'Menu transparente no topo',
        'section' => 'menu_opcoes',
        'type'    => 'checkbox'
    ]);

    $wp_customize->add_setting('theme_menu_heading_cores', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_menu_heading_cores',
        [
            'label'       => 'Cores do menu',
            'description' => 'Defina as cores principais do fundo, texto e hover do menu.',
            'section'     => 'menu_opcoes',
            'settings'    => 'theme_menu_heading_cores',
        ]
    ));

    $wp_customize->add_setting('menu_bg_color', ['default' => '#ffffff']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_bg_color',
        [
            'label'   => 'Cor de fundo',
            'section' => 'menu_opcoes'
        ]
    ));

    $wp_customize->add_setting('menu_bg_scroll', ['default' => '#ffffff']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_bg_scroll',
        [
            'label'   => 'Cor do menu ao rolar',
            'section' => 'menu_opcoes'
        ]
    ));

    $wp_customize->add_setting('menu_text_color', ['default' => '#000000']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_text_color',
        [
            'label'   => 'Cor do texto',
            'section' => 'menu_opcoes'
        ]
    ));

    $wp_customize->add_setting('menu_hover_color', ['default' => '#28a745']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'menu_hover_color',
        [
            'label'   => 'Cor hover',
            'section' => 'menu_opcoes'
        ]
    ));

    $wp_customize->add_setting('theme_menu_heading_whatsapp', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_menu_heading_whatsapp',
        [
            'label'       => 'WhatsApp',
            'description' => 'Defina o número principal e se o canal deve ficar ativo no tema.',
            'section'     => 'menu_opcoes',
            'settings'    => 'theme_menu_heading_whatsapp',
        ]
    ));

    $wp_customize->add_setting('whatsapp_numero');
    $wp_customize->add_control('whatsapp_numero', [
        'label'       => 'WhatsApp',
        'section'     => 'menu_opcoes',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: 5511999999999',
        ],
    ]);

    $wp_customize->add_setting('whatsapp_ativo', ['default' => true]);
    $wp_customize->add_control('whatsapp_ativo', [
        'label'   => 'Ativar WhatsApp',
        'section' => 'menu_opcoes',
        'type'    => 'checkbox'
    ]);

    // ======================
    // TIPOGRAFIA
    // ======================
    $wp_customize->add_section('tipografia', [
        'title' => 'Tipografia'
    ]);

    $wp_customize->add_setting('theme_tipografia_heading_body', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_tipografia_heading_body',
        [
            'label'       => 'Texto base',
            'description' => 'Configurações gerais de fonte, peso, tamanho e estilo do conteúdo principal.',
            'section'     => 'tipografia',
            'settings'    => 'theme_tipografia_heading_body',
        ]
    ));

    $wp_customize->add_setting('font_body', ['default' => 'Roboto']);
    $wp_customize->add_control('font_body', [
        'label'       => 'Fonte do texto',
        'section'     => 'tipografia',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: Roboto',
        ],
    ]);

    $wp_customize->add_setting('font_body_weight', ['default' => '400']);
    $wp_customize->add_control('font_body_weight', [
        'label'       => 'Peso (300,400,700)',
        'section'     => 'tipografia',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '400',
        ],
    ]);

    $wp_customize->add_setting('font_body_size', ['default' => '16']);
    $wp_customize->add_control('font_body_size', [
        'label'       => 'Tamanho (px)',
        'section'     => 'tipografia',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '16',
        ],
    ]);

    $wp_customize->add_setting('font_body_style', ['default' => 'normal']);
    $wp_customize->add_control('font_body_style', [
        'label'   => 'Estilo',
        'section' => 'tipografia',
        'type'    => 'select',
        'choices' => [
            'normal' => 'Normal',
            'italic' => 'Itálico'
        ]
    ]);

    $wp_customize->add_setting('theme_tipografia_heading_h1', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_tipografia_heading_h1',
        [
            'label'       => 'Títulos H1',
            'description' => 'Defina fonte, peso e tamanho dos títulos principais H1.',
            'section'     => 'tipografia',
            'settings'    => 'theme_tipografia_heading_h1',
        ]
    ));

    $wp_customize->add_setting('font_h1', ['default' => 'Poppins']);
    $wp_customize->add_control('font_h1', [
        'label'       => 'Fonte H1',
        'section'     => 'tipografia',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: Poppins',
        ],
    ]);

    $wp_customize->add_setting('font_h1_weight', ['default' => '700']);
    $wp_customize->add_control('font_h1_weight', [
        'label'       => 'Peso H1',
        'section'     => 'tipografia',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '700',
        ],
    ]);

    $wp_customize->add_setting('font_h1_size', ['default' => '42']);
    $wp_customize->add_control('font_h1_size', [
        'label'       => 'Tamanho H1 (px)',
        'section'     => 'tipografia',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '42',
        ],
    ]);

    $wp_customize->add_setting('theme_tipografia_heading_h2', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_tipografia_heading_h2',
        [
            'label'       => 'Títulos H2',
            'description' => 'Defina fonte, peso e tamanho dos subtítulos e títulos secundários H2.',
            'section'     => 'tipografia',
            'settings'    => 'theme_tipografia_heading_h2',
        ]
    ));

    $wp_customize->add_setting('font_h2', ['default' => 'Poppins']);
    $wp_customize->add_control('font_h2', [
        'label'       => 'Fonte H2',
        'section'     => 'tipografia',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: Poppins',
        ],
    ]);

    $wp_customize->add_setting('font_h2_weight', ['default' => '600']);
    $wp_customize->add_control('font_h2_weight', [
        'label'       => 'Peso H2',
        'section'     => 'tipografia',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '600',
        ],
    ]);

    $wp_customize->add_setting('font_h2_size', ['default' => '32']);
    $wp_customize->add_control('font_h2_size', [
        'label'       => 'Tamanho H2 (px)',
        'section'     => 'tipografia',
        'type'        => 'number',
        'input_attrs' => [
            'placeholder' => '32',
        ],
    ]);

}
add_action('customize_register', 'chaveiro_menu_customize');