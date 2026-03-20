<?php

function chaveiro_hero_customize($wp_customize)
{
    $wp_customize->add_section('hero_section', [
        'title' => 'Hero (Topo do Site)',
    ]);

    $wp_customize->add_setting('hero_ativo', [
        'default' => true,
    ]);

    $wp_customize->add_control('hero_ativo', [
        'label'   => 'Ativar seção Hero',
        'section' => 'hero_section',
        'type'    => 'checkbox',
    ]);

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("hero_img_desktop_{$i}");
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "hero_img_desktop_{$i}",
            [
                'label'       => "Imagem principal {$i}",
                'section'     => 'hero_section',
                'description' => 'Imagem principal do slide. O WordPress gera automaticamente cortes para desktop e mobile.',
            ]
        ));

        $wp_customize->add_setting("hero_img_mobile_{$i}");
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "hero_img_mobile_{$i}",
            [
                'label'       => "Imagem mobile {$i} (opcional)",
                'section'     => 'hero_section',
                'description' => 'Preencha apenas se quiser uma imagem específica para celular. Se deixar em branco, será usada a imagem principal.',
            ]
        ));

        $wp_customize->add_setting("hero_title_{$i}");
        $wp_customize->add_control("hero_title_{$i}", [
            'label'   => "Título {$i}",
            'section' => 'hero_section',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("hero_sub_{$i}");
        $wp_customize->add_control("hero_sub_{$i}", [
            'label'   => "Subtítulo {$i}",
            'section' => 'hero_section',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("hero_btn_text_{$i}", [
            'default' => 'Solicitar atendimento',
        ]);
        $wp_customize->add_control("hero_btn_text_{$i}", [
            'label'       => "Texto do botão {$i}",
            'section'     => 'hero_section',
            'type'        => 'text',
            'description' => 'Texto do botão deste slide.',
        ]);

        $wp_customize->add_setting("hero_btn_link_{$i}", [
            'default' => '',
        ]);
        $wp_customize->add_control("hero_btn_link_{$i}", [
            'label'       => "Link do botão {$i}",
            'section'     => 'hero_section',
            'type'        => 'url',
            'description' => 'Link do botão deste slide. Pode ser WhatsApp, telefone, formulário ou outra URL.',
        ]);

        $wp_customize->add_setting("hero_btn_color_{$i}", [
            'default' => 'yellow',
        ]);
        $wp_customize->add_control("hero_btn_color_{$i}", [
            'label'   => "Cor do botão {$i}",
            'section' => 'hero_section',
            'type'    => 'select',
            'choices' => [
                'yellow' => 'Amarelo',
                'blue'   => 'Azul',
                'red'    => 'Vermelho',
            ],
        ]);
    }
}

add_action('customize_register', 'chaveiro_hero_customize');