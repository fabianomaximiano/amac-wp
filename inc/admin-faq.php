<?php

function chaveiro_faq_customize($wp_customize)
{
    $wp_customize->add_section('faq', [
        'title' => 'FAQ',
    ]);

    $wp_customize->add_setting('faq_titulo', [
        'default' => 'Perguntas Frequentes',
    ]);

    $wp_customize->add_control('faq_titulo', [
        'label'   => 'Título da seção FAQ',
        'section' => 'faq',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('faq_exibir_icone_titulo', [
        'default' => true,
    ]);

    $wp_customize->add_control('faq_exibir_icone_titulo', [
        'label'   => 'Exibir ícone no título da FAQ',
        'section' => 'faq',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('faq_icone_titulo_classe', [
        'default' => 'fa-solid fa-circle-question',
    ]);

    $wp_customize->add_control('faq_icone_titulo_classe', [
        'label'       => 'Classe do ícone do título',
        'description' => 'Exemplo: fa-solid fa-circle-question',
        'section'     => 'faq',
        'type'        => 'text',
    ]);

    $wp_customize->add_setting('faq_exibir_icones', [
        'default' => true,
    ]);

    $wp_customize->add_control('faq_exibir_icones', [
        'label'   => 'Exibir ícones nas perguntas',
        'section' => 'faq',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('faq_icone_classe', [
        'default' => 'fa-solid fa-key',
    ]);

    $wp_customize->add_control('faq_icone_classe', [
        'label'       => 'Classe do ícone das perguntas',
        'description' => 'Exemplo: fa-solid fa-key',
        'section'     => 'faq',
        'type'        => 'text',
    ]);

    $wp_customize->add_setting('faq_bg_section', [
        'default' => '#f8f9fa',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_bg_section',
        [
            'label'   => 'Cor de fundo da seção FAQ',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_titulo_cor', [
        'default' => '#111111',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_titulo_cor',
        [
            'label'   => 'Cor do título da FAQ',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_icone_titulo_cor', [
        'default' => '#25D366',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_icone_titulo_cor',
        [
            'label'   => 'Cor do ícone do título',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_pergunta_bg', [
        'default' => '#ffffff',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_pergunta_bg',
        [
            'label'   => 'Cor de fundo da pergunta',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_pergunta_cor', [
        'default' => '#222222',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_pergunta_cor',
        [
            'label'   => 'Cor do texto da pergunta',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_resposta_bg', [
        'default' => '#ffffff',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_resposta_bg',
        [
            'label'   => 'Cor de fundo da resposta',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_resposta_cor', [
        'default' => '#444444',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_resposta_cor',
        [
            'label'   => 'Cor do texto da resposta',
            'section' => 'faq',
        ]
    ));

    $wp_customize->add_setting('faq_icone_cor', [
        'default' => '#25D366',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'faq_icone_cor',
        [
            'label'   => 'Cor do ícone das perguntas',
            'section' => 'faq',
        ]
    ));

    for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting("faq_pergunta_$i");
        $wp_customize->add_control("faq_pergunta_$i", [
            'label'   => "Pergunta $i",
            'section' => 'faq',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("faq_resposta_$i");
        $wp_customize->add_control("faq_resposta_$i", [
            'label'   => "Resposta $i",
            'section' => 'faq',
            'type'    => 'textarea',
        ]);
    }
}
add_action('customize_register', 'chaveiro_faq_customize');


function chaveiro_faq_custom_css()
{
    $faq_bg_section      = get_theme_mod('faq_bg_section', '#f8f9fa');
    $faq_titulo_cor      = get_theme_mod('faq_titulo_cor', '#111111');
    $faq_icone_titulo_cor = get_theme_mod('faq_icone_titulo_cor', '#25D366');
    $faq_pergunta_bg     = get_theme_mod('faq_pergunta_bg', '#ffffff');
    $faq_pergunta_cor    = get_theme_mod('faq_pergunta_cor', '#222222');
    $faq_resposta_bg     = get_theme_mod('faq_resposta_bg', '#ffffff');
    $faq_resposta_cor    = get_theme_mod('faq_resposta_cor', '#444444');
    $faq_icone_cor       = get_theme_mod('faq_icone_cor', '#25D366');
    ?>
    <style id="chaveiro-faq-custom-css">
        .faq-section {
            background-color: <?php echo esc_html($faq_bg_section); ?>;
        }

        .faq-section-title {
            color: <?php echo esc_html($faq_titulo_cor); ?>;
        }

        .faq-title-icon {
            color: <?php echo esc_html($faq_icone_titulo_cor); ?>;
        }

        .faq-card .card-header {
            background-color: <?php echo esc_html($faq_pergunta_bg); ?>;
        }

        .faq-question-btn {
            color: <?php echo esc_html($faq_pergunta_cor); ?>;
        }

        .faq-card .card-body {
            background-color: <?php echo esc_html($faq_resposta_bg); ?>;
            color: <?php echo esc_html($faq_resposta_cor); ?>;
        }

        .faq-question-icon {
            color: <?php echo esc_html($faq_icone_cor); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'chaveiro_faq_custom_css', 30);