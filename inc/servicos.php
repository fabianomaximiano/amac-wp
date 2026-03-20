<?php

function chaveiro_servicos_section_customize($wp_customize)
{
    $wp_customize->add_section('servicos_section', [
        'title' => 'Seção de Serviços',
    ]);

    $wp_customize->add_setting('servicos_section_ativo', [
        'default' => true,
    ]);

    $wp_customize->add_control('servicos_section_ativo', [
        'label'   => 'Ativar seção de serviços',
        'section' => 'servicos_section',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('servicos_section_titulo', [
        'default' => 'Nossos Principais Serviços',
    ]);

    $wp_customize->add_control('servicos_section_titulo', [
        'label'   => 'Título da seção',
        'section' => 'servicos_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('servicos_section_subtitulo', [
        'default' => 'Atendimento profissional, rápido e seguro.',
    ]);

    $wp_customize->add_control('servicos_section_subtitulo', [
        'label'   => 'Subtítulo da seção',
        'section' => 'servicos_section',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('servicos_section_bg_type', [
        'default' => 'color',
    ]);

    $wp_customize->add_control('servicos_section_bg_type', [
        'label'   => 'Tipo de fundo',
        'section' => 'servicos_section',
        'type'    => 'select',
        'choices' => [
            'color'    => 'Cor sólida',
            'gradient' => 'Gradiente',
            'image'    => 'Imagem',
        ],
    ]);

    $wp_customize->add_setting('servicos_section_bg_color', [
        'default' => '#0A2540',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_section_bg_color',
        [
            'label'   => 'Cor principal do fundo',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_section_bg_color_2', [
        'default' => '#007BFF',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_section_bg_color_2',
        [
            'label'   => 'Cor secundária do gradiente',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_section_bg_image', [
        'default' => '',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'servicos_section_bg_image',
        [
            'label'   => 'Imagem de fundo',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_section_overlay', [
        'default' => 'rgba(0,0,0,0.45)',
    ]);

    $wp_customize->add_control('servicos_section_overlay', [
        'label'       => 'Overlay da imagem de fundo',
        'description' => 'Exemplo: rgba(0,0,0,0.45)',
        'section'     => 'servicos_section',
        'type'        => 'text',
    ]);

    $wp_customize->add_setting('servicos_section_text_color', [
        'default' => '#ffffff',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_section_text_color',
        [
            'label'   => 'Cor base do texto da seção',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_section_title_color', [
        'default' => '#ffffff',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_section_title_color',
        [
            'label'   => 'Cor do título da seção',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_section_subtitle_color', [
        'default' => '#e9ecef',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_section_subtitle_color',
        [
            'label'   => 'Cor do subtítulo da seção',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_card_bg_color', [
        'default' => '#ffffff',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_card_bg_color',
        [
            'label'   => 'Cor de fundo do card',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('servicos_card_text_color', [
        'default' => '#111111',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_card_text_color',
        [
            'label'   => 'Cor do texto do card',
            'section' => 'servicos_section',
        ]
    ));
}
add_action('customize_register', 'chaveiro_servicos_section_customize');

function chaveiro_register_servicos_cpt()
{
    $labels = [
        'name'               => 'Serviços',
        'singular_name'      => 'Serviço',
        'menu_name'          => 'Serviços',
        'name_admin_bar'     => 'Serviço',
        'add_new'            => 'Adicionar novo',
        'add_new_item'       => 'Adicionar novo serviço',
        'new_item'           => 'Novo serviço',
        'edit_item'          => 'Editar serviço',
        'view_item'          => 'Ver serviço',
        'all_items'          => 'Todos os serviços',
        'search_items'       => 'Buscar serviços',
        'not_found'          => 'Nenhum serviço encontrado',
        'not_found_in_trash' => 'Nenhum serviço na lixeira',
    ];

    register_post_type('servicos', [
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => ['title', 'editor', 'page-attributes', 'thumbnail'],
        'hierarchical'       => false,
        'show_in_rest'       => true,
    ]);
}
add_action('init', 'chaveiro_register_servicos_cpt');

function chaveiro_add_servicos_meta_box()
{
    add_meta_box(
        'chaveiro_servicos_dados',
        'Configurações do Serviço',
        'chaveiro_render_servicos_meta_box',
        'servicos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'chaveiro_add_servicos_meta_box');

function chaveiro_render_servicos_meta_box($post)
{
    wp_nonce_field('chaveiro_save_servico_meta', 'chaveiro_servico_meta_nonce');

    $ativo       = get_post_meta($post->ID, '_servico_ativo', true);
    $tipo_midia  = get_post_meta($post->ID, '_servico_tipo_midia', true);
    $icone       = get_post_meta($post->ID, '_servico_icone', true);
    $subtitulo   = get_post_meta($post->ID, '_servico_subtitulo', true);
    $resumo      = get_post_meta($post->ID, '_servico_resumo', true);

    if ($ativo === '') {
        $ativo = '1';
    }

    if ($tipo_midia === '') {
        $tipo_midia = 'icone';
    }
    ?>
    <p>
        <label>
            <input type="checkbox" name="servico_ativo" value="1" <?php checked($ativo, '1'); ?>>
            Exibir este serviço na seção
        </label>
    </p>

    <p>
        <label for="servico_tipo_midia"><strong>Tipo de mídia</strong></label><br>
        <select id="servico_tipo_midia" name="servico_tipo_midia" style="width: 100%; max-width: 320px;">
            <option value="icone" <?php selected($tipo_midia, 'icone'); ?>>Ícone</option>
            <option value="imagem" <?php selected($tipo_midia, 'imagem'); ?>>Imagem destacada</option>
        </select>
    </p>

    <p>
        <label for="servico_icone"><strong>Classe do ícone</strong></label><br>
        <input
            type="text"
            id="servico_icone"
            name="servico_icone"
            value="<?php echo esc_attr($icone); ?>"
            style="width: 100%;"
            placeholder="Ex: fa-solid fa-key"
        >
    </p>

    <p>
        <label for="servico_subtitulo"><strong>Subtítulo</strong></label><br>
        <input
            type="text"
            id="servico_subtitulo"
            name="servico_subtitulo"
            value="<?php echo esc_attr($subtitulo); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="servico_resumo"><strong>Descrição curta</strong></label><br>
        <textarea
            id="servico_resumo"
            name="servico_resumo"
            rows="4"
            style="width: 100%;"
        ><?php echo esc_textarea($resumo); ?></textarea>
    </p>
    <?php
}

function chaveiro_save_servicos_meta($post_id)
{
    if (!isset($_POST['chaveiro_servico_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['chaveiro_servico_meta_nonce'])), 'chaveiro_save_servico_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    update_post_meta($post_id, '_servico_ativo', isset($_POST['servico_ativo']) ? '1' : '0');

    if (isset($_POST['servico_tipo_midia'])) {
        update_post_meta($post_id, '_servico_tipo_midia', sanitize_text_field(wp_unslash($_POST['servico_tipo_midia'])));
    }

    if (isset($_POST['servico_icone'])) {
        update_post_meta($post_id, '_servico_icone', sanitize_text_field(wp_unslash($_POST['servico_icone'])));
    }

    if (isset($_POST['servico_subtitulo'])) {
        update_post_meta($post_id, '_servico_subtitulo', sanitize_text_field(wp_unslash($_POST['servico_subtitulo'])));
    }

    if (isset($_POST['servico_resumo'])) {
        update_post_meta($post_id, '_servico_resumo', sanitize_textarea_field(wp_unslash($_POST['servico_resumo'])));
    }
}
add_action('save_post_servicos', 'chaveiro_save_servicos_meta');

function chaveiro_render_servicos()
{
    if (!get_theme_mod('servicos_section_ativo', true)) {
        return;
    }

    $titulo          = get_theme_mod('servicos_section_titulo', 'Nossos Principais Serviços');
    $subtitulo       = get_theme_mod('servicos_section_subtitulo', 'Atendimento profissional, rápido e seguro.');
    $bg_type         = get_theme_mod('servicos_section_bg_type', 'color');
    $bg_color_1      = get_theme_mod('servicos_section_bg_color', '#0A2540');
    $bg_color_2      = get_theme_mod('servicos_section_bg_color_2', '#007BFF');
    $bg_image        = get_theme_mod('servicos_section_bg_image', '');
    $overlay         = get_theme_mod('servicos_section_overlay', 'rgba(0,0,0,0.45)');
    $text_color      = get_theme_mod('servicos_section_text_color', '#ffffff');
    $title_color     = get_theme_mod('servicos_section_title_color', '#ffffff');
    $subtitle_color  = get_theme_mod('servicos_section_subtitle_color', '#e9ecef');
    $card_bg_color   = get_theme_mod('servicos_card_bg_color', '#ffffff');
    $card_text_color = get_theme_mod('servicos_card_text_color', '#111111');

    $section_style = '';
    $has_overlay   = false;

    if ($bg_type === 'color') {
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
    } elseif ($bg_type === 'gradient') {
        $section_style = 'background: linear-gradient(135deg, ' . esc_attr($bg_color_1) . ', ' . esc_attr($bg_color_2) . ');';
    } elseif ($bg_type === 'image' && !empty($bg_image)) {
        $section_style = 'background-image: url(' . esc_url($bg_image) . '); background-size: cover; background-position: center center; background-repeat: no-repeat;';
        $has_overlay = true;
    }

    $query = new WP_Query([
        'post_type'      => 'servicos',
        'posts_per_page' => -1,
        'orderby'        => [
            'menu_order' => 'ASC',
            'date'       => 'ASC',
        ],
        'post_status'    => 'publish',
    ]);

    if (!$query->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <section id="servicos" class="servicos-section position-relative" style="<?php echo esc_attr($section_style); ?> color: <?php echo esc_attr($text_color); ?>;">
        <?php if ($has_overlay) : ?>
            <div class="servicos-section-overlay" style="background: <?php echo esc_attr($overlay); ?>;"></div>
        <?php endif; ?>

        <div class="container position-relative">
            <?php if (!empty($titulo) || !empty($subtitulo)) : ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if (!empty($titulo)) : ?>
                            <h2 class="servicos-section-title" style="color: <?php echo esc_attr($title_color); ?>;">
                                <?php echo esc_html($titulo); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($subtitulo)) : ?>
                            <p class="servicos-section-subtitle" style="color: <?php echo esc_attr($subtitle_color); ?>;">
                                <?php echo esc_html($subtitulo); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row servicos-cards-row justify-content-center">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();

                    $post_id     = get_the_ID();
                    $ativo       = get_post_meta($post_id, '_servico_ativo', true);
                    $tipo_midia  = get_post_meta($post_id, '_servico_tipo_midia', true);
                    $icone       = get_post_meta($post_id, '_servico_icone', true);
                    $sub         = get_post_meta($post_id, '_servico_subtitulo', true);
                    $resumo      = get_post_meta($post_id, '_servico_resumo', true);
                    $imagem      = get_the_post_thumbnail_url($post_id, 'large');

                    if ($ativo !== '1' && $ativo !== '') {
                        continue;
                    }

                    if ($tipo_midia === '') {
                        $tipo_midia = 'icone';
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4 d-flex">
                        <article class="servico-card servico-card-<?php echo esc_attr($tipo_midia); ?> h-100 w-100" style="background: <?php echo esc_attr($card_bg_color); ?>; color: <?php echo esc_attr($card_text_color); ?>;">
                            <?php if ($tipo_midia === 'imagem' && !empty($imagem)) : ?>
                                <div class="servico-card-topo servico-card-topo-imagem">
                                    <img src="<?php echo esc_url($imagem); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                    <div class="servico-card-topo-overlay"></div>
                                    <div class="servico-card-topo-conteudo">
                                        <h3 class="servico-titulo"><?php the_title(); ?></h3>
                                        <?php if (!empty($sub)) : ?>
                                            <p class="servico-subtitulo"><?php echo esc_html($sub); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="servico-card-topo servico-card-topo-icone">
                                    <div class="servico-media servico-media-icon-circle">
                                        <span class="servico-media-icon-circle-inner">
                                            <i class="<?php echo esc_attr(!empty($icone) ? $icone : 'fa-solid fa-key'); ?>" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <div class="servico-card-topo-conteudo servico-card-topo-conteudo-icone">
                                        <h3 class="servico-titulo"><?php the_title(); ?></h3>
                                        <?php if (!empty($sub)) : ?>
                                            <p class="servico-subtitulo"><?php echo esc_html($sub); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="servico-card-body text-center">
                                <?php if (!empty($resumo)) : ?>
                                    <div class="servico-resumo">
                                        <p><?php echo esc_html($resumo); ?></p>
                                    </div>
                                <?php else : ?>
                                    <div class="servico-resumo">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}