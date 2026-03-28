<?php

if (!defined('ABSPATH')) {
    exit;
}

function chaveiro_produtos_sanitize_checkbox($checked)
{
    return (isset($checked) && true == $checked) ? true : false;
}

function chaveiro_produtos_sanitize_blur($value)
{
    return min(20, max(0, absint($value)));
}

function chaveiro_produtos_get_background_image_url($value)
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

function chaveiro_produtos_section_customize($wp_customize)
{
    $wp_customize->add_section('produtos_section', [
        'title' => 'Seção de Produtos',
    ]);

    $wp_customize->add_setting('theme_produtos_heading_geral', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_produtos_heading_geral',
        [
            'label'       => 'Conteúdo da seção',
            'description' => 'Configure ativação, títulos, subtítulos e fundo da seção. Os itens dos produtos são cadastrados no menu “Produtos” do painel.',
            'section'     => 'produtos_section',
            'settings'    => 'theme_produtos_heading_geral',
        ]
    ));

    $wp_customize->add_setting('produtos_section_ativo', [
        'default'           => true,
        'sanitize_callback' => 'chaveiro_produtos_sanitize_checkbox',
    ]);

    $wp_customize->add_control('produtos_section_ativo', [
        'label'   => 'Ativar seção de produtos',
        'section' => 'produtos_section',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('produtos_section_titulo', [
        'default'           => 'Nossos Principais Produtos',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('produtos_section_titulo', [
        'label'   => 'Título da seção',
        'section' => 'produtos_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('produtos_section_subtitulo', [
        'default'           => 'Conheça alguns dos produtos em destaque.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('produtos_section_subtitulo', [
        'label'   => 'Subtítulo da seção',
        'section' => 'produtos_section',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('produtos_section_bg_type', [
        'default'           => 'color',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('produtos_section_bg_type', [
        'label'   => 'Tipo de fundo',
        'section' => 'produtos_section',
        'type'    => 'select',
        'choices' => [
            'color'    => 'Cor sólida',
            'gradient' => 'Gradiente',
            'image'    => 'Imagem',
        ],
    ]);

    $wp_customize->add_setting('theme_produtos_heading_cores', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_produtos_heading_cores',
        [
            'label'       => 'Cores e fundo',
            'description' => 'Defina cores, imagem de fundo, overlay e blur da seção.',
            'section'     => 'produtos_section',
            'settings'    => 'theme_produtos_heading_cores',
        ]
    ));

    $wp_customize->add_setting('produtos_section_bg_color', [
        'default'           => '#0A2540',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_section_bg_color',
        [
            'label'   => 'Cor principal do fundo',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('produtos_section_bg_color_2', [
        'default'           => '#007BFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_section_bg_color_2',
        [
            'label'   => 'Cor secundária do gradiente',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('produtos_section_bg_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'produtos_section_bg_image',
        [
            'label'       => 'Imagem de fundo',
            'section'     => 'produtos_section',
            'description' => 'Use uma imagem que combine com a seção de produtos.',
        ]
    ));

    $wp_customize->add_setting('produtos_section_overlay', [
        'default'           => 'rgba(0,0,0,0.45)',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('produtos_section_overlay', [
        'label'       => 'Overlay da imagem de fundo',
        'section'     => 'produtos_section',
        'type'        => 'text',
        'description' => 'Exemplo: rgba(0,0,0,0.45)',
    ]);

    $wp_customize->add_setting('produtos_section_bg_blur', [
        'default'           => 0,
        'sanitize_callback' => 'chaveiro_produtos_sanitize_blur',
    ]);

    $wp_customize->add_control('produtos_section_bg_blur', [
        'label'       => 'Blur da imagem de fundo (px)',
        'description' => 'Use entre 0 e 20.',
        'section'     => 'produtos_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 20,
            'step' => 1,
        ],
    ]);

    $wp_customize->add_setting('produtos_section_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_section_text_color',
        [
            'label'   => 'Cor base do texto da seção',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('produtos_section_title_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_section_title_color',
        [
            'label'   => 'Cor do título da seção',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('produtos_section_subtitle_color', [
        'default'           => '#e9ecef',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_section_subtitle_color',
        [
            'label'   => 'Cor do subtítulo da seção',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('produtos_card_bg_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_card_bg_color',
        [
            'label'   => 'Cor de fundo do card',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('produtos_card_text_color', [
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'produtos_card_text_color',
        [
            'label'   => 'Cor do texto do card',
            'section' => 'produtos_section',
        ]
    ));

    $wp_customize->add_setting('theme_produtos_heading_footer', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_produtos_heading_footer',
        [
            'label'       => 'Bloco final abaixo dos cards',
            'description' => 'Ative um título menor, subtítulo menor e botão para levar o usuário para a página completa de produtos.',
            'section'     => 'produtos_section',
            'settings'    => 'theme_produtos_heading_footer',
        ]
    ));

    $wp_customize->add_setting('produtos_footer_cta_enabled', [
        'default'           => false,
        'sanitize_callback' => 'chaveiro_produtos_sanitize_checkbox',
    ]);

    $wp_customize->add_control('produtos_footer_cta_enabled', [
        'label'   => 'Ativar bloco final',
        'section' => 'produtos_section',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('produtos_footer_cta_title', [
        'default'           => 'Veja todos os nossos produtos',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('produtos_footer_cta_title', [
        'label'   => 'Título menor',
        'section' => 'produtos_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('produtos_footer_cta_subtitle', [
        'default'           => 'Conheça a linha completa de produtos organizados por categorias.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('produtos_footer_cta_subtitle', [
        'label'   => 'Subtítulo menor',
        'section' => 'produtos_section',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('produtos_footer_cta_button_text', [
        'default'           => 'Ver todos os produtos',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('produtos_footer_cta_button_text', [
        'label'   => 'Texto do botão',
        'section' => 'produtos_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('produtos_footer_cta_button_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('produtos_footer_cta_button_url', [
        'label'       => 'Link do botão',
        'description' => 'Se deixar vazio, o tema usa automaticamente a página de arquivo do CPT Produtos.',
        'section'     => 'produtos_section',
        'type'        => 'url',
    ]);
}
add_action('customize_register', 'chaveiro_produtos_section_customize');

function chaveiro_register_produtos_cpt()
{
    $labels = [
        'name'                  => 'Produtos',
        'singular_name'         => 'Produto',
        'menu_name'             => 'Produtos',
        'name_admin_bar'        => 'Produto',
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar novo produto',
        'new_item'              => 'Novo produto',
        'edit_item'             => 'Editar produto',
        'view_item'             => 'Ver produto',
        'view_items'            => 'Ver produtos',
        'all_items'             => 'Todos os produtos',
        'search_items'          => 'Buscar produtos',
        'not_found'             => 'Nenhum produto encontrado',
        'not_found_in_trash'    => 'Nenhum produto na lixeira',
        'archives'              => 'Arquivo de produtos',
        'attributes'            => 'Atributos do produto',
        'featured_image'        => 'Imagem destacada',
        'set_featured_image'    => 'Definir imagem destacada',
        'remove_featured_image' => 'Remover imagem destacada',
        'use_featured_image'    => 'Usar como imagem destacada',
    ];

    register_post_type('produtos', [
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-products',
        'supports'            => ['title', 'page-attributes', 'thumbnail'],
        'hierarchical'        => false,
        'show_in_rest'        => true,
        'has_archive'         => true,
        'rewrite'             => [
            'slug'       => 'produtos',
            'with_front' => false,
        ],
        'menu_position'       => 22,
        'exclude_from_search' => false,
    ]);
}
add_action('init', 'chaveiro_register_produtos_cpt');

function chaveiro_register_produtos_taxonomy()
{
    $labels = [
        'name'              => 'Categorias de Produtos',
        'singular_name'     => 'Categoria de Produto',
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

    register_taxonomy('categoria_produto', ['produtos'], [
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => [
            'slug'       => 'categoria-produto',
            'with_front' => false,
        ],
    ]);
}
add_action('init', 'chaveiro_register_produtos_taxonomy');

function chaveiro_add_produtos_meta_box()
{
    add_meta_box(
        'chaveiro_produtos_dados',
        'Configurações do Produto',
        'chaveiro_render_produtos_meta_box',
        'produtos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'chaveiro_add_produtos_meta_box');

function chaveiro_render_produtos_meta_box($post)
{
    wp_nonce_field('chaveiro_save_produto_meta', 'chaveiro_produto_meta_nonce');

    $ativo            = get_post_meta($post->ID, '_produto_ativo', true);
    $tipo_midia       = get_post_meta($post->ID, '_produto_tipo_midia', true);
    $icone            = get_post_meta($post->ID, '_produto_icone', true);
    $subtitulo        = get_post_meta($post->ID, '_produto_subtitulo', true);
    $resumo           = get_post_meta($post->ID, '_produto_resumo', true);
    $valor            = get_post_meta($post->ID, '_produto_valor', true);
    $mostrar_valor    = get_post_meta($post->ID, '_produto_mostrar_valor', true);
    $mostrar_tarja    = get_post_meta($post->ID, '_produto_mostrar_tarja', true);
    $texto_tarja      = get_post_meta($post->ID, '_produto_texto_tarja', true);
    $cor_tarja        = get_post_meta($post->ID, '_produto_cor_tarja', true);
    $cor_texto_tarja  = get_post_meta($post->ID, '_produto_cor_texto_tarja', true);

    if ($ativo === '') {
        $ativo = '1';
    }

    if ($tipo_midia === '') {
        $tipo_midia = 'imagem';
    }

    if ($mostrar_valor === '') {
        $mostrar_valor = '1';
    }

    if ($mostrar_tarja === '') {
        $mostrar_tarja = '0';
    }

    if (empty($cor_tarja)) {
        $cor_tarja = '#ff1e1e';
    }

    if (empty($cor_texto_tarja)) {
        $cor_texto_tarja = '#ffffff';
    }
    ?>
    <p>
        <label>
            <input type="checkbox" name="produto_ativo" value="1" <?php checked($ativo, '1'); ?>>
            Exibir este produto na seção
        </label>
    </p>

    <p>
        <label for="produto_tipo_midia"><strong>Tipo de mídia</strong></label><br>
        <select id="produto_tipo_midia" name="produto_tipo_midia" style="width: 100%; max-width: 320px;">
            <option value="imagem" <?php selected($tipo_midia, 'imagem'); ?>>Imagem destacada</option>
            <option value="icone" <?php selected($tipo_midia, 'icone'); ?>>Ícone</option>
        </select>
    </p>

    <p>
        <label for="produto_icone"><strong>Classe do ícone</strong></label><br>
        <input
            type="text"
            id="produto_icone"
            name="produto_icone"
            value="<?php echo esc_attr($icone); ?>"
            style="width: 100%;"
            placeholder="Ex: fa-solid fa-box"
        >
    </p>

    <p>
        <label for="produto_subtitulo"><strong>Subtítulo</strong></label><br>
        <input
            type="text"
            id="produto_subtitulo"
            name="produto_subtitulo"
            value="<?php echo esc_attr($subtitulo); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="produto_resumo"><strong>Descrição curta</strong></label><br>
        <textarea
            id="produto_resumo"
            name="produto_resumo"
            rows="4"
            style="width: 100%;"
        ><?php echo esc_textarea($resumo); ?></textarea>
    </p>

    <hr>

    <p>
        <label for="produto_valor"><strong>Valor do produto</strong></label><br>
        <input
            type="text"
            id="produto_valor"
            name="produto_valor"
            value="<?php echo esc_attr($valor); ?>"
            style="width: 100%; max-width: 320px;"
            placeholder="Ex.: R$ 199,90"
        >
    </p>

    <p>
        <label>
            <input type="checkbox" name="produto_mostrar_valor" value="1" <?php checked($mostrar_valor, '1'); ?>>
            Mostrar valor no card
        </label>
    </p>

    <hr>

    <p>
        <label>
            <input type="checkbox" name="produto_mostrar_tarja" value="1" <?php checked($mostrar_tarja, '1'); ?>>
            Exibir tarja no card
        </label>
    </p>

    <p>
        <label for="produto_texto_tarja"><strong>Texto da tarja</strong></label><br>
        <input
            type="text"
            id="produto_texto_tarja"
            name="produto_texto_tarja"
            value="<?php echo esc_attr($texto_tarja); ?>"
            style="width: 100%; max-width: 320px;"
            placeholder="Ex.: Promoção"
        >
    </p>

    <p>
        <label for="produto_cor_tarja"><strong>Cor de fundo da tarja</strong></label><br>
        <input
            type="text"
            id="produto_cor_tarja"
            name="produto_cor_tarja"
            value="<?php echo esc_attr($cor_tarja); ?>"
            style="width: 100%; max-width: 320px;"
            placeholder="#ff1e1e"
        >
    </p>

    <p>
        <label for="produto_cor_texto_tarja"><strong>Cor do texto da tarja</strong></label><br>
        <input
            type="text"
            id="produto_cor_texto_tarja"
            name="produto_cor_texto_tarja"
            value="<?php echo esc_attr($cor_texto_tarja); ?>"
            style="width: 100%; max-width: 320px;"
            placeholder="#ffffff"
        >
    </p>
    <?php
}

function chaveiro_save_produtos_meta($post_id)
{
    if (!isset($_POST['chaveiro_produto_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['chaveiro_produto_meta_nonce'])), 'chaveiro_save_produto_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    update_post_meta($post_id, '_produto_ativo', isset($_POST['produto_ativo']) ? '1' : '0');
    update_post_meta($post_id, '_produto_mostrar_valor', isset($_POST['produto_mostrar_valor']) ? '1' : '0');
    update_post_meta($post_id, '_produto_mostrar_tarja', isset($_POST['produto_mostrar_tarja']) ? '1' : '0');

    if (isset($_POST['produto_tipo_midia'])) {
        update_post_meta($post_id, '_produto_tipo_midia', sanitize_text_field(wp_unslash($_POST['produto_tipo_midia'])));
    }

    if (isset($_POST['produto_icone'])) {
        update_post_meta($post_id, '_produto_icone', sanitize_text_field(wp_unslash($_POST['produto_icone'])));
    }

    if (isset($_POST['produto_subtitulo'])) {
        update_post_meta($post_id, '_produto_subtitulo', sanitize_text_field(wp_unslash($_POST['produto_subtitulo'])));
    }

    if (isset($_POST['produto_resumo'])) {
        update_post_meta($post_id, '_produto_resumo', sanitize_textarea_field(wp_unslash($_POST['produto_resumo'])));
    }

    if (isset($_POST['produto_valor'])) {
        update_post_meta($post_id, '_produto_valor', sanitize_text_field(wp_unslash($_POST['produto_valor'])));
    }

    if (isset($_POST['produto_texto_tarja'])) {
        update_post_meta($post_id, '_produto_texto_tarja', sanitize_text_field(wp_unslash($_POST['produto_texto_tarja'])));
    }

    if (isset($_POST['produto_cor_tarja'])) {
        update_post_meta($post_id, '_produto_cor_tarja', sanitize_text_field(wp_unslash($_POST['produto_cor_tarja'])));
    }

    if (isset($_POST['produto_cor_texto_tarja'])) {
        update_post_meta($post_id, '_produto_cor_texto_tarja', sanitize_text_field(wp_unslash($_POST['produto_cor_texto_tarja'])));
    }
}
add_action('save_post_produtos', 'chaveiro_save_produtos_meta');

function chaveiro_get_produtos_archive_url()
{
    $custom_url = trim((string) get_theme_mod('produtos_footer_cta_button_url', ''));

    if (!empty($custom_url)) {
        return esc_url($custom_url);
    }

    $archive_url = get_post_type_archive_link('produtos');

    if (!empty($archive_url)) {
        return esc_url($archive_url);
    }

    return '#';
}

function chaveiro_get_produto_card_data($post_id = 0)
{
    $post_id = $post_id ? $post_id : get_the_ID();

    return [
        'ativo'            => get_post_meta($post_id, '_produto_ativo', true),
        'tipo_midia'       => get_post_meta($post_id, '_produto_tipo_midia', true),
        'icone'            => get_post_meta($post_id, '_produto_icone', true),
        'subtitulo'        => get_post_meta($post_id, '_produto_subtitulo', true),
        'resumo'           => get_post_meta($post_id, '_produto_resumo', true),
        'valor'            => get_post_meta($post_id, '_produto_valor', true),
        'mostrar_valor'    => get_post_meta($post_id, '_produto_mostrar_valor', true),
        'mostrar_tarja'    => get_post_meta($post_id, '_produto_mostrar_tarja', true),
        'texto_tarja'      => get_post_meta($post_id, '_produto_texto_tarja', true),
        'cor_tarja'        => get_post_meta($post_id, '_produto_cor_tarja', true),
        'cor_texto_tarja'  => get_post_meta($post_id, '_produto_cor_texto_tarja', true),
        'imagem'           => get_the_post_thumbnail_url($post_id, 'produto_card'),
    ];
}

function chaveiro_render_produto_tarja($mostrar_tarja, $texto_tarja, $cor_tarja, $cor_texto_tarja)
{
    if ($mostrar_tarja !== '1' || empty($texto_tarja)) {
        return;
    }
    ?>
    <div
        class="produto-card-tarja"
        style="background: <?php echo esc_attr($cor_tarja); ?>; color: <?php echo esc_attr($cor_texto_tarja); ?>;"
    >
        <span><?php echo esc_html($texto_tarja); ?></span>
    </div>
    <?php
}

function chaveiro_render_single_produto_card($post_id = 0, $card_bg_color = '#ffffff', $card_text_color = '#111111')
{
    $post_id = $post_id ? $post_id : get_the_ID();
    $data    = chaveiro_get_produto_card_data($post_id);

    if ($data['ativo'] !== '1' && $data['ativo'] !== '') {
        return;
    }

    $tipo_midia      = !empty($data['tipo_midia']) ? $data['tipo_midia'] : 'imagem';
    $icone           = !empty($data['icone']) ? $data['icone'] : 'fa-solid fa-box';
    $subtitulo       = $data['subtitulo'];
    $resumo          = $data['resumo'];
    $valor           = $data['valor'];
    $mostrar_valor   = $data['mostrar_valor'];
    $mostrar_tarja   = $data['mostrar_tarja'];
    $texto_tarja     = $data['texto_tarja'];
    $cor_tarja       = !empty($data['cor_tarja']) ? $data['cor_tarja'] : '#ff1e1e';
    $cor_texto_tarja = !empty($data['cor_texto_tarja']) ? $data['cor_texto_tarja'] : '#ffffff';
    $imagem          = $data['imagem'];
    ?>
    <article class="produto-card produto-card-<?php echo esc_attr($tipo_midia); ?> h-100 w-100" style="background: <?php echo esc_attr($card_bg_color); ?>; color: <?php echo esc_attr($card_text_color); ?>;">
        <?php if ($tipo_midia === 'imagem' && !empty($imagem)) : ?>
            <div class="produto-card-topo produto-card-topo-imagem">
                <img src="<?php echo esc_url($imagem); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>">

                <div class="produto-card-topo-overlay"></div>

                <?php chaveiro_render_produto_tarja($mostrar_tarja, $texto_tarja, $cor_tarja, $cor_texto_tarja); ?>

                <div class="produto-card-topo-conteudo">
                    <h3 class="produto-titulo"><?php echo esc_html(get_the_title($post_id)); ?></h3>
                    <?php if (!empty($subtitulo)) : ?>
                        <p class="produto-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="produto-card-topo produto-card-topo-icone">
                <?php chaveiro_render_produto_tarja($mostrar_tarja, $texto_tarja, $cor_tarja, $cor_texto_tarja); ?>

                <div class="produto-media produto-media-icon-circle">
                    <span class="produto-media-icon-circle-inner">
                        <i class="<?php echo esc_attr($icone); ?>" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="produto-card-topo-texto produto-card-topo-texto-icone">
                    <h3 class="produto-titulo"><?php echo esc_html(get_the_title($post_id)); ?></h3>
                    <?php if (!empty($subtitulo)) : ?>
                        <p class="produto-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="produto-card-body text-center">
            <?php if ($mostrar_valor === '1' && !empty($valor)) : ?>
                <div class="produto-valor"><?php echo esc_html($valor); ?></div>
            <?php endif; ?>

            <?php if (!empty($resumo)) : ?>
                <div class="produto-resumo">
                    <p><?php echo esc_html($resumo); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </article>
    <?php
}

function chaveiro_render_produtos()
{
    if (!get_theme_mod('produtos_section_ativo', true)) {
        return;
    }

    $titulo               = get_theme_mod('produtos_section_titulo', 'Nossos Principais Produtos');
    $subtitulo            = get_theme_mod('produtos_section_subtitulo', 'Conheça alguns dos produtos em destaque.');
    $bg_type              = get_theme_mod('produtos_section_bg_type', 'color');
    $bg_color_1           = get_theme_mod('produtos_section_bg_color', '#0A2540');
    $bg_color_2           = get_theme_mod('produtos_section_bg_color_2', '#007BFF');
    $bg_image_value       = get_theme_mod('produtos_section_bg_image', '');
    $bg_image             = chaveiro_produtos_get_background_image_url($bg_image_value);
    $overlay              = get_theme_mod('produtos_section_overlay', 'rgba(0,0,0,0.45)');
    $bg_blur              = chaveiro_produtos_sanitize_blur(get_theme_mod('produtos_section_bg_blur', 0));
    $text_color           = get_theme_mod('produtos_section_text_color', '#ffffff');
    $title_color          = get_theme_mod('produtos_section_title_color', '#ffffff');
    $subtitle_color       = get_theme_mod('produtos_section_subtitle_color', '#e9ecef');
    $card_bg_color        = get_theme_mod('produtos_card_bg_color', '#ffffff');
    $card_text_color      = get_theme_mod('produtos_card_text_color', '#111111');
    $footer_cta_enabled   = get_theme_mod('produtos_footer_cta_enabled', false);
    $footer_cta_title     = get_theme_mod('produtos_footer_cta_title', 'Veja todos os nossos produtos');
    $footer_cta_subtitle  = get_theme_mod('produtos_footer_cta_subtitle', 'Conheça a linha completa de produtos organizados por categorias.');
    $footer_cta_btn_text  = get_theme_mod('produtos_footer_cta_button_text', 'Ver todos os produtos');
    $footer_cta_btn_link  = chaveiro_get_produtos_archive_url();

    $section_style = '';
    $use_image_bg  = false;

    if ($bg_type === 'color') {
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
    } elseif ($bg_type === 'gradient') {
        $section_style = 'background: linear-gradient(135deg, ' . esc_attr($bg_color_1) . ', ' . esc_attr($bg_color_2) . ');';
    } elseif ($bg_type === 'image' && !empty($bg_image)) {
        $use_image_bg = true;
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
    } else {
        $section_style = 'background:' . esc_attr($bg_color_1) . ';';
    }

    $query = new WP_Query([
        'post_type'      => 'produtos',
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
    <section id="produtos" class="produtos-section position-relative" style="<?php echo esc_attr($section_style); ?> color: <?php echo esc_attr($text_color); ?>;">
        <?php if ($use_image_bg) : ?>
            <div
                class="produtos-section-bg"
                style="background-image: url('<?php echo esc_url($bg_image); ?>'); filter: blur(<?php echo esc_attr($bg_blur); ?>px);"
                aria-hidden="true"
            ></div>
            <div class="produtos-section-overlay" style="background: <?php echo esc_attr($overlay); ?>;"></div>
        <?php endif; ?>

        <div class="container position-relative">
            <?php if (!empty($titulo) || !empty($subtitulo)) : ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if (!empty($titulo)) : ?>
                            <h2 class="produtos-section-title" style="color: <?php echo esc_attr($title_color); ?>;">
                                <?php echo esc_html($titulo); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($subtitulo)) : ?>
                            <p class="produtos-section-subtitle" style="color: <?php echo esc_attr($subtitle_color); ?>;">
                                <?php echo esc_html($subtitulo); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row produtos-cards-row justify-content-center">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4 d-flex">
                        <?php chaveiro_render_single_produto_card(get_the_ID(), $card_bg_color, $card_text_color); ?>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if ($footer_cta_enabled && (!empty($footer_cta_title) || !empty($footer_cta_subtitle) || !empty($footer_cta_btn_text))) : ?>
                <div class="produtos-footer-cta text-center">
                    <?php if (!empty($footer_cta_title)) : ?>
                        <h3 class="produtos-footer-cta-title"><?php echo esc_html($footer_cta_title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($footer_cta_subtitle)) : ?>
                        <p class="produtos-footer-cta-subtitle"><?php echo esc_html($footer_cta_subtitle); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($footer_cta_btn_text)) : ?>
                        <a class="btn btn-primary produtos-footer-cta-button" href="<?php echo esc_url($footer_cta_btn_link); ?>">
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

function chaveiro_get_produtos_archive_query_args($extra_args = [])
{
    $defaults = [
        'post_type'      => 'produtos',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => [
            'menu_order' => 'ASC',
            'date'       => 'ASC',
        ],
    ];

    return wp_parse_args($extra_args, $defaults);
}

function chaveiro_render_produtos_archive_content($custom_query = null)
{
    $query = $custom_query instanceof WP_Query ? $custom_query : new WP_Query(chaveiro_get_produtos_archive_query_args());

    $card_bg_color   = get_theme_mod('produtos_card_bg_color', '#ffffff');
    $card_text_color = get_theme_mod('produtos_card_text_color', '#111111');
    $archive_url     = get_post_type_archive_link('produtos');
    $terms           = get_terms([
        'taxonomy'   => 'categoria_produto',
        'hide_empty' => true,
    ]);
    ?>
    <section class="produtos-archive-page">
        <div class="container">
            <div class="produtos-archive-header text-center">
                <?php if (is_tax('categoria_produto')) : ?>
                    <span class="produtos-archive-kicker">Categoria de produto</span>
                    <h1 class="produtos-archive-title"><?php single_term_title(); ?></h1>
                    <?php
                    $term_description = term_description();
                    if (!empty($term_description)) :
                        ?>
                        <div class="produtos-archive-description"><?php echo wp_kses_post(wpautop($term_description)); ?></div>
                    <?php endif; ?>
                <?php elseif (is_singular('produtos')) : ?>
                    <span class="produtos-archive-kicker">Produto</span>
                    <h1 class="produtos-archive-title"><?php the_title(); ?></h1>
                <?php else : ?>
                    <span class="produtos-archive-kicker">Conheça nossa linha</span>
                    <h1 class="produtos-archive-title">Todos os produtos</h1>
                    <p class="produtos-archive-description">Explore os produtos organizados por categoria e encontre rapidamente o item ideal.</p>
                <?php endif; ?>
            </div>

            <?php if (!is_singular('produtos') && !empty($terms) && !is_wp_error($terms)) : ?>
                <div class="produtos-categorias-filtro">
                    <a href="<?php echo esc_url($archive_url); ?>" class="produtos-categoria-link <?php echo is_post_type_archive('produtos') ? 'is-active' : ''; ?>">
                        Todos
                    </a>

                    <?php foreach ($terms as $term) : ?>
                        <a
                            href="<?php echo esc_url(get_term_link($term)); ?>"
                            class="produtos-categoria-link <?php echo (is_tax('categoria_produto', $term->slug)) ? 'is-active' : ''; ?>"
                        >
                            <?php echo esc_html($term->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (is_singular('produtos')) : ?>
                <div class="produto-single-wrap">
                    <div class="row align-items-start">
                        <div class="col-lg-7 mb-4 mb-lg-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="produto-single-image">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-5">
                            <div class="produto-single-card">
                                <?php
                                $subtitulo     = get_post_meta(get_the_ID(), '_produto_subtitulo', true);
                                $resumo        = get_post_meta(get_the_ID(), '_produto_resumo', true);
                                $valor         = get_post_meta(get_the_ID(), '_produto_valor', true);
                                $mostrar_valor = get_post_meta(get_the_ID(), '_produto_mostrar_valor', true);
                                $terms         = get_the_terms(get_the_ID(), 'categoria_produto');
                                ?>

                                <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                                    <div class="produto-single-categorias">
                                        <?php foreach ($terms as $term) : ?>
                                            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="produto-single-tag">
                                                <?php echo esc_html($term->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($subtitulo)) : ?>
                                    <p class="produto-single-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                                <?php endif; ?>

                                <?php if ($mostrar_valor === '1' && !empty($valor)) : ?>
                                    <div class="produto-single-valor"><?php echo esc_html($valor); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($resumo)) : ?>
                                    <div class="produto-single-resumo">
                                        <p><?php echo esc_html($resumo); ?></p>
                                    </div>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($archive_url); ?>" class="btn btn-outline-primary produto-single-back">
                                    Voltar para todos os produtos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <?php if ($query->have_posts()) : ?>
                    <div class="row produtos-archive-grid">
                        <?php
                        while ($query->have_posts()) :
                            $query->the_post();
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4 d-flex">
                                <div class="produtos-archive-card-wrap">
                                    <?php chaveiro_render_single_produto_card(get_the_ID(), $card_bg_color, $card_text_color); ?>

                                    <div class="produtos-archive-card-footer text-center">
                                        <a href="<?php the_permalink(); ?>" class="produtos-archive-card-link">
                                            Ver detalhes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="produtos-empty text-center">
                        <h2>Nenhum produto encontrado</h2>
                        <p>No momento ainda não há produtos publicados nesta categoria.</p>
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