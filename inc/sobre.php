<?php

// ==============================
// CUSTOMIZER SOBRE
// ==============================
function chaveiro_sobre_customize($wp_customize)
{
    $wp_customize->add_section('sobre', [
        'title' => 'Seção Sobre'
    ]);

    $wp_customize->add_setting('theme_sobre_heading_conteudo', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_sobre_heading_conteudo',
        [
            'label'       => 'Conteúdo da seção',
            'description' => 'Configure ativação, imagem, formato e textos principais da seção Sobre.',
            'section'     => 'sobre',
            'settings'    => 'theme_sobre_heading_conteudo',
        ]
    ));

    $wp_customize->add_setting('sobre_ativo', [
        'default' => true
    ]);

    $wp_customize->add_control('sobre_ativo', [
        'label'   => 'Ativar Seção Sobre',
        'section' => 'sobre',
        'type'    => 'checkbox'
    ]);

    $wp_customize->add_setting('sobre_imagem');

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'sobre_imagem',
        [
            'label'       => 'Imagem',
            'section'     => 'sobre',
            'description' => 'Use imagem quadrada (proporção 1:1). Exemplos: 300x300, 400x400, 500x500. O WordPress gera automaticamente um corte quadrado para melhor apresentação.'
        ]
    ));

    $wp_customize->add_setting('sobre_img_formato', [
        'default' => 'rounded'
    ]);

    $wp_customize->add_control('sobre_img_formato', [
        'label'   => 'Formato da Imagem',
        'section' => 'sobre',
        'type'    => 'select',
        'choices' => [
            'circle'  => 'Circular',
            'square'  => 'Quadrada',
            'rounded' => 'Bordas Arredondadas'
        ]
    ]);

    $wp_customize->add_setting('sobre_titulo');
    $wp_customize->add_control('sobre_titulo', [
        'label'       => 'Título',
        'section'     => 'sobre',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: Atendimento com experiência e confiança',
        ],
    ]);

    $wp_customize->add_setting('sobre_subtitulo');
    $wp_customize->add_control('sobre_subtitulo', [
        'label'       => 'Subtítulo',
        'section'     => 'sobre',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: Profissional pronto para emergências e serviços agendados',
        ],
    ]);

    $wp_customize->add_setting('sobre_desc');
    $wp_customize->add_control('sobre_desc', [
        'label'       => 'Descrição',
        'section'     => 'sobre',
        'type'        => 'textarea',
        'input_attrs' => [
            'placeholder' => 'Descreva experiência, diferenciais, área de atuação e mensagem institucional da seção Sobre.',
        ],
    ]);
}
add_action('customize_register', 'chaveiro_sobre_customize');


// ==============================
// OBTER IMAGEM SOBRE COM CROP NATIVO
// ==============================
function chaveiro_get_sobre_image_url($image_url)
{
    if (empty($image_url)) {
        return '';
    }

    $attachment_id = attachment_url_to_postid($image_url);

    if ($attachment_id) {
        $cropped = wp_get_attachment_image_url($attachment_id, 'sobre_quadrado');
        if (!empty($cropped)) {
            return $cropped;
        }
    }

    return $image_url;
}


// ==============================
// RENDER SOBRE
// ==============================
function chaveiro_render_sobre()
{
    if (!get_theme_mod('sobre_ativo', true)) {
        return;
    }

    $img_original = get_theme_mod('sobre_imagem');
    $img          = $img_original ? chaveiro_get_sobre_image_url($img_original) : '';

    $formato = get_theme_mod('sobre_img_formato', 'rounded');

    $class_img = 'img-fluid';

    if ($formato === 'circle') {
        $class_img .= ' rounded-circle';
    } elseif ($formato === 'rounded') {
        $class_img .= ' rounded';
    }

    $titulo    = get_theme_mod('sobre_titulo');
    $subtitulo = get_theme_mod('sobre_subtitulo');
    $desc      = get_theme_mod('sobre_desc');
    ?>

    <section class="sobre py-5">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <?php if ($img) : ?>
                        <img
                            src="<?php echo esc_url($img); ?>"
                            class="<?php echo esc_attr($class_img); ?>"
                            style="max-width: 300px; width: 300px; height: 300px; object-fit: cover;"
                            alt="<?php echo esc_attr($titulo ? $titulo : 'Sobre o profissional'); ?>"
                        >
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <?php if ($titulo) : ?>
                        <h2><?php echo esc_html($titulo); ?></h2>
                    <?php endif; ?>

                    <?php if ($subtitulo) : ?>
                        <h5 class="text-muted"><?php echo esc_html($subtitulo); ?></h5>
                    <?php endif; ?>

                    <?php if ($desc) : ?>
                        <p class="mt-3"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <?php
}