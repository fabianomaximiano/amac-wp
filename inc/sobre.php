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
            'description' => 'Use imagem quadrada (1:1). Ex: 400x400 ou 600x600.'
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
        'label'   => 'Título',
        'section' => 'sobre',
        'type'    => 'text'
    ]);

    $wp_customize->add_setting('sobre_subtitulo');
    $wp_customize->add_control('sobre_subtitulo', [
        'label'   => 'Subtítulo',
        'section' => 'sobre',
        'type'    => 'text'
    ]);

    $wp_customize->add_setting('sobre_desc');
    $wp_customize->add_control('sobre_desc', [
        'label'   => 'Descrição',
        'section' => 'sobre',
        'type'    => 'textarea'
    ]);
}
add_action('customize_register', 'chaveiro_sobre_customize');


// ==============================
// RENDER SOBRE
// ==============================
function chaveiro_render_sobre()
{
    if (!get_theme_mod('sobre_ativo', true)) {
        return;
    }

    $img_original = get_theme_mod('sobre_imagem');
    $img = $img_original;

    $formato = get_theme_mod('sobre_img_formato', 'rounded');

    $class_img = 'img-fluid sobre-img';

    if ($formato === 'circle') {
        $class_img .= ' rounded-circle';
    } elseif ($formato === 'rounded') {
        $class_img .= ' rounded';
    }

    $titulo    = get_theme_mod('sobre_titulo');
    $subtitulo = get_theme_mod('sobre_subtitulo');
    $desc      = get_theme_mod('sobre_desc');
?>

<section class="sobre-section py-5">

    <div class="container">

        <div class="row align-items-center sobre-row">

            <div class="col-lg-5 text-center mb-4 mb-lg-0">

                <?php if ($img) : ?>

                    <div class="sobre-img-wrapper">

                        <img
                            src="<?php echo esc_url($img); ?>"
                            class="<?php echo esc_attr($class_img); ?>"
                            alt="<?php echo esc_attr($titulo ? $titulo : 'Sobre'); ?>"
                        >

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-lg-7 sobre-content">

                <?php if ($titulo) : ?>
                    <h2 class="sobre-title">
                        <?php echo esc_html($titulo); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($subtitulo) : ?>
                    <h5 class="sobre-subtitle">
                        <?php echo esc_html($subtitulo); ?>
                    </h5>
                <?php endif; ?>

                <?php if ($desc) : ?>
                    <p class="sobre-text">
                        <?php echo esc_html($desc); ?>
                    </p>
                <?php endif; ?>

            </div>

        </div>

    </div>

</section>

<?php
}