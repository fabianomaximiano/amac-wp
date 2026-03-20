<?php

// ==============================
// CPT CIDADES
// ==============================
function chaveiro_register_cidades_cpt()
{
    $labels = [
        'name'                  => 'Cidades',
        'singular_name'         => 'Cidade',
        'menu_name'             => 'Cidades',
        'name_admin_bar'        => 'Cidade',
        'add_new'               => 'Adicionar nova',
        'add_new_item'          => 'Adicionar nova cidade',
        'new_item'              => 'Nova cidade',
        'edit_item'             => 'Editar cidade',
        'view_item'             => 'Ver cidade',
        'all_items'             => 'Todas as cidades',
        'search_items'          => 'Buscar cidades',
        'not_found'             => 'Nenhuma cidade encontrada.',
        'not_found_in_trash'    => 'Nenhuma cidade encontrada na lixeira.',
        'item_published'        => 'Cidade publicada.',
        'item_updated'          => 'Cidade atualizada.',
        'item_scheduled'        => 'Cidade agendada.',
        'item_reverted_to_draft'=> 'Cidade movida para rascunho.',
    ];

    register_post_type('cidades', [
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'chaveiro-em'],
        'menu_icon'           => 'dashicons-location',
        'show_in_rest'        => false,
        'supports'            => ['title'],
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
    ]);
}
add_action('init', 'chaveiro_register_cidades_cpt');


// ==============================
// PLACEHOLDER DO TÍTULO
// ==============================
function chaveiro_cidades_title_placeholder($title, $post)
{
    if ($post->post_type === 'cidades') {
        return 'Digite o nome da cidade';
    }

    return $title;
}
add_filter('enter_title_here', 'chaveiro_cidades_title_placeholder', 10, 2);


// ==============================
// METABOX DADOS DA CIDADE
// ==============================
function chaveiro_add_cidades_meta_box()
{
    add_meta_box(
        'chaveiro_cidade_dados',
        'Dados da Cidade',
        'chaveiro_render_cidades_meta_box',
        'cidades',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'chaveiro_add_cidades_meta_box');

function chaveiro_render_cidades_meta_box($post)
{
    wp_nonce_field('chaveiro_save_cidade_meta', 'chaveiro_cidade_meta_nonce');

    $bairro = get_post_meta($post->ID, '_cidade_bairro', true);
    $mapa   = get_post_meta($post->ID, '_cidade_mapa', true);
    ?>
    <div class="chaveiro-admin-field">
        <label for="cidade_bairro"><strong>Bairro / Região</strong></label>
        <p class="description">Ex.: Centro, Zona Sul, Vila Mariana, Região Metropolitana.</p>
        <input
            type="text"
            id="cidade_bairro"
            name="cidade_bairro"
            value="<?php echo esc_attr($bairro); ?>"
            class="widefat"
            placeholder="Digite o principal bairro ou região atendida"
        >
    </div>

    <div class="chaveiro-admin-field" style="margin-top:20px;">
        <label for="cidade_mapa"><strong>Mapa (iframe)</strong></label>
        <p class="description">Cole aqui o iframe do Google Maps para essa cidade.</p>
        <textarea
            id="cidade_mapa"
            name="cidade_mapa"
            rows="6"
            class="widefat"
            placeholder="<iframe ...></iframe>"
        ><?php echo esc_textarea($mapa); ?></textarea>
    </div>
    <?php
}

function chaveiro_save_cidades_meta($post_id)
{
    if (!isset($_POST['chaveiro_cidade_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['chaveiro_cidade_meta_nonce'])), 'chaveiro_save_cidade_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['cidade_bairro'])) {
        update_post_meta($post_id, '_cidade_bairro', sanitize_text_field(wp_unslash($_POST['cidade_bairro'])));
    }

    if (isset($_POST['cidade_mapa'])) {
        update_post_meta($post_id, '_cidade_mapa', wp_kses_post(wp_unslash($_POST['cidade_mapa'])));
    }
}
add_action('save_post_cidades', 'chaveiro_save_cidades_meta');


// ==============================
// LIMPAR TELA DO ADMIN
// ==============================
function chaveiro_cidades_remove_metaboxes()
{
    remove_meta_box('slugdiv', 'cidades', 'normal');
    remove_meta_box('postcustom', 'cidades', 'normal');
    remove_meta_box('commentstatusdiv', 'cidades', 'normal');
    remove_meta_box('commentsdiv', 'cidades', 'normal');
    remove_meta_box('authordiv', 'cidades', 'normal');
    remove_meta_box('revisionsdiv', 'cidades', 'normal');
}
add_action('add_meta_boxes_cidades', 'chaveiro_cidades_remove_metaboxes', 99);


// ==============================
// AJUSTES VISUAIS NO ADMIN DE CIDADES
// ==============================
function chaveiro_cidades_admin_css()
{
    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'cidades') {
        return;
    }
    ?>
    <style>
        .post-type-cidades #postdivrich,
        .post-type-cidades #wp-content-wrap,
        .post-type-cidades #postexcerpt,
        .post-type-cidades #trackbacksdiv,
        .post-type-cidades #commentstatusdiv,
        .post-type-cidades #commentsdiv,
        .post-type-cidades #authordiv,
        .post-type-cidades #revisionsdiv,
        .post-type-cidades #slugdiv,
        .post-type-cidades #postcustom {
            display: none !important;
        }

        .post-type-cidades .wrap h1.wp-heading-inline::after {
            content: " — cadastro de SEO local";
            font-size: 13px;
            color: #666;
            font-weight: 400;
            margin-left: 8px;
        }

        .post-type-cidades .misc-pub-post-status,
        .post-type-cidades .misc-pub-visibility {
            display: none;
        }
    </style>
    <?php
}
add_action('admin_head-post.php', 'chaveiro_cidades_admin_css');
add_action('admin_head-post-new.php', 'chaveiro_cidades_admin_css');


// ==============================
// AVISO DE USO NO ADMIN
// ==============================
function chaveiro_cidades_admin_help_box()
{
    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'cidades') {
        return;
    }

    echo '<div class="notice notice-info inline" style="margin-top:15px;">
        <p><strong>Como preencher:</strong> no título, informe o nome da cidade. Em "Bairro / Região", informe a principal área atendida. No campo "Mapa", cole o iframe do Google Maps.</p>
    </div>';
}
add_action('edit_form_after_title', 'chaveiro_cidades_admin_help_box');


// ==============================
// SCHEMA LOCAL BUSINESS
// ==============================
function chaveiro_schema_local()
{
    if (!is_singular('cidades')) {
        return;
    }

    $cidade   = get_the_title();
    $telefone = get_theme_mod('whatsapp_numero', '');
    $telefone = preg_replace('/\D+/', '', $telefone);

    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Locksmith",
        "name": <?php echo wp_json_encode(get_bloginfo('name') . ' em ' . $cidade); ?>,
        "areaServed": <?php echo wp_json_encode($cidade); ?>,
        "telephone": <?php echo wp_json_encode($telefone); ?>
    }
    </script>
    <?php
}
add_action('wp_head', 'chaveiro_schema_local', 30);