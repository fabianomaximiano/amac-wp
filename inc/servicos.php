<?php

if (!defined('ABSPATH')) {
    exit;
}

function chaveiro_servicos_sanitize_checkbox($checked)
{
    return (isset($checked) && true == $checked) ? true : false;
}

function chaveiro_servicos_sanitize_blur($value)
{
    return min(20, max(0, absint($value)));
}

function chaveiro_servicos_get_background_image_url($value)
{
    if (empty($value)) {
        return '';
    }

    if (is_numeric($value)) {
        $image_url = wp_get_attachment_image_url((int) $value, 'full');
        return $image_url ? $image_url : '';
    }

    return esc_url_raw($value);
}

function chaveiro_servicos_section_customize($wp_customize)
{
    $wp_customize->add_section('servicos_section', [
        'title' => 'Seção de Serviços',
    ]);

    $wp_customize->add_setting('theme_servicos_heading_geral', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_servicos_heading_geral',
        [
            'label'       => 'Conteúdo da seção',
            'description' => 'Configure ativação, títulos, subtítulos e fundo da seção. Os itens dos serviços são cadastrados no menu “Serviços” do painel.',
            'section'     => 'servicos_section',
            'settings'    => 'theme_servicos_heading_geral',
        ]
    ));

    $wp_customize->add_setting('servicos_section_ativo', [
        'default'           => true,
        'sanitize_callback' => 'chaveiro_servicos_sanitize_checkbox',
    ]);

    $wp_customize->add_control('servicos_section_ativo', [
        'label'   => 'Ativar seção de serviços',
        'section' => 'servicos_section',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('servicos_section_titulo', [
        'default'           => 'Nossos Principais Serviços',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('servicos_section_titulo', [
        'label'       => 'Título da seção',
        'section'     => 'servicos_section',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'Ex.: Nossos Principais Serviços',
        ],
    ]);

    $wp_customize->add_setting('servicos_section_subtitulo', [
        'default'           => 'Atendimento profissional, rápido e seguro.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('servicos_section_subtitulo', [
        'label'       => 'Subtítulo da seção',
        'section'     => 'servicos_section',
        'type'        => 'textarea',
        'input_attrs' => [
            'placeholder' => 'Descreva de forma curta os diferenciais da seção de serviços.',
        ],
    ]);

    $wp_customize->add_setting('servicos_section_bg_type', [
        'default'           => 'color',
        'sanitize_callback' => 'sanitize_text_field',
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

    $wp_customize->add_setting('theme_servicos_heading_cores', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_servicos_heading_cores',
        [
            'label'       => 'Cores e fundo',
            'description' => 'Defina cores, imagem de fundo, overlay e blur. O blur ajuda a imagem não competir com o texto.',
            'section'     => 'servicos_section',
            'settings'    => 'theme_servicos_heading_cores',
        ]
    ));

    $wp_customize->add_setting('servicos_section_bg_color', [
        'default'           => '#0A2540',
        'sanitize_callback' => 'sanitize_hex_color',
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
        'default'           => '#007BFF',
        'sanitize_callback' => 'sanitize_hex_color',
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
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'servicos_section_bg_image',
        [
            'label'       => 'Imagem de fundo',
            'section'     => 'servicos_section',
            'description' => 'Use uma imagem que combine com a seção de serviços.',
        ]
    ));

    $wp_customize->add_setting('servicos_section_overlay', [
        'default'           => 'rgba(0,0,0,0.45)',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('servicos_section_overlay', [
        'label'       => 'Overlay da imagem de fundo',
        'description' => 'Exemplo: rgba(0,0,0,0.45)',
        'section'     => 'servicos_section',
        'type'        => 'text',
        'input_attrs' => [
            'placeholder' => 'rgba(0,0,0,0.45)',
        ],
    ]);

    $wp_customize->add_setting('servicos_section_bg_blur', [
        'default'           => 0,
        'sanitize_callback' => 'chaveiro_servicos_sanitize_blur',
    ]);

    $wp_customize->add_control('servicos_section_bg_blur', [
        'label'       => 'Blur da imagem de fundo (px)',
        'description' => 'Use entre 0 e 20. Sugestão: 2 a 6.',
        'section'     => 'servicos_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 20,
            'step' => 1,
        ],
    ]);

    $wp_customize->add_setting('servicos_section_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
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
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
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
        'default'           => '#e9ecef',
        'sanitize_callback' => 'sanitize_hex_color',
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
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
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
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'servicos_card_text_color',
        [
            'label'   => 'Cor do texto do card',
            'section' => 'servicos_section',
        ]
    ));

    $wp_customize->add_setting('theme_servicos_heading_footer', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_servicos_heading_footer',
        [
            'label'       => 'Bloco final abaixo dos cards',
            'description' => 'Ative um título menor, subtítulo menor e botão para levar o usuário para a página completa de serviços.',
            'section'     => 'servicos_section',
            'settings'    => 'theme_servicos_heading_footer',
        ]
    ));

    $wp_customize->add_setting('servicos_footer_cta_enabled', [
        'default'           => false,
        'sanitize_callback' => 'chaveiro_servicos_sanitize_checkbox',
    ]);

    $wp_customize->add_control('servicos_footer_cta_enabled', [
        'label'   => 'Ativar bloco final',
        'section' => 'servicos_section',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('servicos_footer_cta_title', [
        'default'           => 'Veja todos os nossos serviços',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('servicos_footer_cta_title', [
        'label'   => 'Título menor',
        'section' => 'servicos_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('servicos_footer_cta_subtitle', [
        'default'           => 'Conheça a lista completa de soluções organizadas por categorias.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('servicos_footer_cta_subtitle', [
        'label'   => 'Subtítulo menor',
        'section' => 'servicos_section',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('servicos_footer_cta_button_text', [
        'default'           => 'Ver todos os serviços',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('servicos_footer_cta_button_text', [
        'label'   => 'Texto do botão',
        'section' => 'servicos_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('servicos_footer_cta_button_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('servicos_footer_cta_button_url', [
        'label'       => 'Link do botão',
        'description' => 'Se deixar vazio, o tema usa automaticamente a página de arquivo do CPT Serviços.',
        'section'     => 'servicos_section',
        'type'        => 'url',
    ]);
}
add_action('customize_register', 'chaveiro_servicos_section_customize');

function chaveiro_register_servicos_cpt()
{
    $labels = [
        'name'                  => 'Serviços',
        'singular_name'         => 'Serviço',
        'menu_name'             => 'Serviços',
        'name_admin_bar'        => 'Serviço',
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar novo serviço',
        'new_item'              => 'Novo serviço',
        'edit_item'             => 'Editar serviço',
        'view_item'             => 'Ver serviço',
        'view_items'            => 'Ver serviços',
        'all_items'             => 'Todos os serviços',
        'search_items'          => 'Buscar serviços',
        'not_found'             => 'Nenhum serviço encontrado',
        'not_found_in_trash'    => 'Nenhum serviço na lixeira',
        'archives'              => 'Arquivo de serviços',
        'attributes'            => 'Atributos do serviço',
        'featured_image'        => 'Imagem destacada',
        'set_featured_image'    => 'Definir imagem destacada',
        'remove_featured_image' => 'Remover imagem destacada',
        'use_featured_image'    => 'Usar como imagem destacada',
    ];

    register_post_type('servicos', [
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-admin-tools',
        'supports'            => ['title', 'page-attributes', 'thumbnail'],
        'hierarchical'        => false,
        'show_in_rest'        => true,
        'has_archive'         => true,
        'rewrite'             => [
            'slug'       => 'servicos',
            'with_front' => false,
        ],
        'menu_position'       => 21,
        'exclude_from_search' => false,
    ]);
}
add_action('init', 'chaveiro_register_servicos_cpt');

function chaveiro_register_servicos_taxonomy()
{
    $labels = [
        'name'              => 'Categorias de Serviços',
        'singular_name'     => 'Categoria de Serviço',
        'search_items'      => 'Buscar categorias',
        'all_items'         => 'Todas as categorias',
        'parent_item'       => 'Categoria pai',
        'parent_item_colon' => 'Categoria pai:',
        'edit_item'         => 'Editar categoria',
        'update_item'       => 'Atualizar categoria',
        'add_new_item'      => 'Adicionar nova categoria',
        'new_item_name'     => 'Novo nome da categoria',
        'menu_name'         => 'Categorias',
    ];

    register_taxonomy('categoria_servico', ['servicos'], [
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => [
            'slug'       => 'categoria-servico',
            'with_front' => false,
        ],
    ]);
}
add_action('init', 'chaveiro_register_servicos_taxonomy');

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

    $ativo      = get_post_meta($post->ID, '_servico_ativo', true);
    $tipo_midia = get_post_meta($post->ID, '_servico_tipo_midia', true);
    $icone      = get_post_meta($post->ID, '_servico_icone', true);
    $subtitulo  = get_post_meta($post->ID, '_servico_subtitulo', true);
    $resumo     = get_post_meta($post->ID, '_servico_resumo', true);

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

function chaveiro_get_servicos_archive_url()
{
    $custom_url = trim((string) get_theme_mod('servicos_footer_cta_button_url', ''));

    if (!empty($custom_url)) {
        return esc_url($custom_url);
    }

    $archive_url = get_post_type_archive_link('servicos');

    if (!empty($archive_url)) {
        return esc_url($archive_url);
    }

    return '#';
}

function chaveiro_get_servico_card_data($post_id = 0)
{
    $post_id = $post_id ? $post_id : get_the_ID();

    return [
        'ativo'      => get_post_meta($post_id, '_servico_ativo', true),
        'tipo_midia' => get_post_meta($post_id, '_servico_tipo_midia', true),
        'icone'      => get_post_meta($post_id, '_servico_icone', true),
        'subtitulo'  => get_post_meta($post_id, '_servico_subtitulo', true),
        'resumo'     => get_post_meta($post_id, '_servico_resumo', true),
        'imagem'     => get_the_post_thumbnail_url($post_id, 'servico_card'),
    ];
}

function chaveiro_render_single_servico_card($post_id = 0, $card_bg_color = '#ffffff', $card_text_color = '#111111', $link_url = '')
{
    $post_id = $post_id ? $post_id : get_the_ID();
    $data    = chaveiro_get_servico_card_data($post_id);

    if ($data['ativo'] !== '1' && $data['ativo'] !== '') {
        return;
    }

    $tipo_midia = !empty($data['tipo_midia']) ? $data['tipo_midia'] : 'icone';
    $icone      = !empty($data['icone']) ? $data['icone'] : 'fa-solid fa-key';
    $subtitulo  = $data['subtitulo'];
    $resumo     = $data['resumo'];
    $imagem     = $data['imagem'];

    $open_link  = !empty($link_url);
    ?>
    <?php if ($open_link) : ?>
        <a href="<?php echo esc_url($link_url); ?>" class="servico-card-link-wrapper" aria-label="<?php echo esc_attr(get_the_title($post_id)); ?>">
    <?php endif; ?>

    <article class="servico-card servico-card-<?php echo esc_attr($tipo_midia); ?> h-100 w-100" style="background: <?php echo esc_attr($card_bg_color); ?>; color: <?php echo esc_attr($card_text_color); ?>;">
        <?php if ($tipo_midia === 'imagem' && !empty($imagem)) : ?>
            <div class="servico-card-topo servico-card-topo-imagem">
                <img src="<?php echo esc_url($imagem); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>">
                <div class="servico-card-topo-overlay"></div>
                <div class="servico-card-topo-conteudo">
                    <h3 class="servico-titulo"><?php echo esc_html(get_the_title($post_id)); ?></h3>
                    <?php if (!empty($subtitulo)) : ?>
                        <p class="servico-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="servico-card-topo servico-card-topo-icone">
                <div class="servico-media servico-media-icon-circle">
                    <span class="servico-media-icon-circle-inner">
                        <i class="<?php echo esc_attr($icone); ?>" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="servico-card-topo-conteudo servico-card-topo-conteudo-icone">
                    <h3 class="servico-titulo"><?php echo esc_html(get_the_title($post_id)); ?></h3>
                    <?php if (!empty($subtitulo)) : ?>
                        <p class="servico-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="servico-card-body text-center">
            <?php if (!empty($resumo)) : ?>
                <div class="servico-resumo">
                    <p><?php echo esc_html($resumo); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </article>

    <?php if ($open_link) : ?>
        </a>
    <?php endif; ?>
    <?php
}

function chaveiro_render_servicos()
{
    if (!get_theme_mod('servicos_section_ativo', true)) {
        return;
    }

    $titulo               = get_theme_mod('servicos_section_titulo', 'Nossos Principais Serviços');
    $subtitulo            = get_theme_mod('servicos_section_subtitulo', 'Atendimento profissional, rápido e seguro.');
    $bg_type              = get_theme_mod('servicos_section_bg_type', 'color');
    $bg_color_1           = get_theme_mod('servicos_section_bg_color', '#0A2540');
    $bg_color_2           = get_theme_mod('servicos_section_bg_color_2', '#007BFF');
    $bg_image_value       = get_theme_mod('servicos_section_bg_image', '');
    $bg_image             = chaveiro_servicos_get_background_image_url($bg_image_value);
    $overlay              = get_theme_mod('servicos_section_overlay', 'rgba(0,0,0,0.45)');
    $bg_blur              = chaveiro_servicos_sanitize_blur(get_theme_mod('servicos_section_bg_blur', 0));
    $text_color           = get_theme_mod('servicos_section_text_color', '#ffffff');
    $title_color          = get_theme_mod('servicos_section_title_color', '#ffffff');
    $subtitle_color       = get_theme_mod('servicos_section_subtitle_color', '#e9ecef');
    $card_bg_color        = get_theme_mod('servicos_card_bg_color', '#ffffff');
    $card_text_color      = get_theme_mod('servicos_card_text_color', '#111111');
    $footer_cta_enabled   = get_theme_mod('servicos_footer_cta_enabled', false);
    $footer_cta_title     = get_theme_mod('servicos_footer_cta_title', 'Veja todos os nossos serviços');
    $footer_cta_subtitle  = get_theme_mod('servicos_footer_cta_subtitle', 'Conheça a lista completa de soluções organizadas por categorias.');
    $footer_cta_btn_text  = get_theme_mod('servicos_footer_cta_button_text', 'Ver todos os serviços');
    $footer_cta_btn_link  = chaveiro_get_servicos_archive_url();

    $section_style = '';
    $use_image_bg  = false;

    if ($bg_type === 'color') {
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
    } elseif ($bg_type === 'gradient') {
        $section_style = 'background: linear-gradient(135deg, ' . esc_attr($bg_color_1) . ', ' . esc_attr($bg_color_2) . ');';
    } elseif ($bg_type === 'image' && !empty($bg_image)) {
        $use_image_bg = true;
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
    } elseif ($bg_type === 'image' && empty($bg_image)) {
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
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
        <?php if ($use_image_bg) : ?>
            <div
                class="servicos-section-bg"
                style="background-image: url('<?php echo esc_url($bg_image); ?>'); filter: blur(<?php echo esc_attr($bg_blur); ?>px);"
                aria-hidden="true"
            ></div>
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
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4 d-flex">
                        <?php chaveiro_render_single_servico_card(get_the_ID(), $card_bg_color, $card_text_color, get_permalink()); ?>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if ($footer_cta_enabled && (!empty($footer_cta_title) || !empty($footer_cta_subtitle) || !empty($footer_cta_btn_text))) : ?>
                <div class="servicos-footer-cta text-center">
                    <?php if (!empty($footer_cta_title)) : ?>
                        <h3 class="servicos-footer-cta-title"><?php echo esc_html($footer_cta_title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($footer_cta_subtitle)) : ?>
                        <p class="servicos-footer-cta-subtitle"><?php echo esc_html($footer_cta_subtitle); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($footer_cta_btn_text)) : ?>
                        <a class="btn btn-primary servicos-footer-cta-button" href="<?php echo esc_url($footer_cta_btn_link); ?>">
                            <?php echo esc_html($footer_cta_btn_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}

function chaveiro_get_servicos_archive_query_args($extra_args = [])
{
    $defaults = [
        'post_type'      => 'servicos',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => [
            'menu_order' => 'ASC',
            'date'       => 'ASC',
        ],
    ];

    return wp_parse_args($extra_args, $defaults);
}

function chaveiro_render_servicos_archive_content($custom_query = null)
{
    $query = $custom_query instanceof WP_Query ? $custom_query : new WP_Query(chaveiro_get_servicos_archive_query_args());

    $card_bg_color   = get_theme_mod('servicos_card_bg_color', '#ffffff');
    $card_text_color = get_theme_mod('servicos_card_text_color', '#111111');
    $archive_url     = get_post_type_archive_link('servicos');
    $terms           = get_terms([
        'taxonomy'   => 'categoria_servico',
        'hide_empty' => true,
    ]);

    ?>
    <section class="servicos-archive-page">
        <div class="container">
            <div class="servicos-archive-header text-center">
                <?php if (is_tax('categoria_servico')) : ?>
                    <span class="servicos-archive-kicker">Categoria de serviço</span>
                    <h1 class="servicos-archive-title"><?php single_term_title(); ?></h1>
                    <?php
                    $term_description = term_description();
                    if (!empty($term_description)) :
                        ?>
                        <div class="servicos-archive-description"><?php echo wp_kses_post(wpautop($term_description)); ?></div>
                    <?php endif; ?>
                <?php elseif (is_singular('servicos')) : ?>
                    <span class="servicos-archive-kicker">Serviço</span>
                    <h1 class="servicos-archive-title"><?php the_title(); ?></h1>
                <?php else : ?>
                    <span class="servicos-archive-kicker">Conheça nossas soluções</span>
                    <h1 class="servicos-archive-title">Todos os serviços</h1>
                    <p class="servicos-archive-description">Explore os serviços organizados por categoria e encontre rapidamente o atendimento ideal.</p>
                <?php endif; ?>
            </div>

            <?php if (!is_singular('servicos') && !empty($terms) && !is_wp_error($terms)) : ?>
                <div class="servicos-categorias-filtro">
                    <a href="<?php echo esc_url($archive_url); ?>" class="servicos-categoria-link <?php echo is_post_type_archive('servicos') ? 'is-active' : ''; ?>">
                        Todos
                    </a>

                    <?php foreach ($terms as $term) : ?>
                        <a
                            href="<?php echo esc_url(get_term_link($term)); ?>"
                            class="servicos-categoria-link <?php echo (is_tax('categoria_servico', $term->slug)) ? 'is-active' : ''; ?>"
                        >
                            <?php echo esc_html($term->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (is_singular('servicos')) : ?>
                <div class="servico-single-wrap">
                    <div class="row align-items-start">
                        <div class="col-lg-7 mb-4 mb-lg-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="servico-single-image">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-5">
                            <div class="servico-single-card">
                                <?php
                                $subtitulo = get_post_meta(get_the_ID(), '_servico_subtitulo', true);
                                $resumo    = get_post_meta(get_the_ID(), '_servico_resumo', true);
                                $terms     = get_the_terms(get_the_ID(), 'categoria_servico');
                                ?>

                                <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                                    <div class="servico-single-categorias">
                                        <?php foreach ($terms as $term) : ?>
                                            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="servico-single-tag">
                                                <?php echo esc_html($term->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($subtitulo)) : ?>
                                    <p class="servico-single-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($resumo)) : ?>
                                    <div class="servico-single-resumo">
                                        <p><?php echo esc_html($resumo); ?></p>
                                    </div>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($archive_url); ?>" class="btn btn-outline-primary servico-single-back">
                                    Voltar para todos os serviços
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <?php if ($query->have_posts()) : ?>
                    <div class="row servicos-archive-grid">
                        <?php
                        while ($query->have_posts()) :
                            $query->the_post();
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4 d-flex">
                                <div class="servicos-archive-card-wrap">
                                    <?php chaveiro_render_single_servico_card(get_the_ID(), $card_bg_color, $card_text_color, get_permalink()); ?>

                                    <div class="servicos-archive-card-footer text-center">
                                        <a href="<?php the_permalink(); ?>" class="servicos-archive-card-link">
                                            Ver detalhes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="servicos-empty text-center">
                        <h2>Nenhum serviço encontrado</h2>
                        <p>No momento ainda não há serviços publicados nesta categoria.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php

    if (!$custom_query instanceof WP_Query) {
        wp_reset_postdata();
    }
}