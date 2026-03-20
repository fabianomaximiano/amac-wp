<?php

// ==============================
// CRIAR / ATUALIZAR TABELA DE LEADS
// ==============================
function chaveiro_create_leads_table() {
    global $wpdb;

    $table = $wpdb->prefix . 'chaveiro_leads';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(150) NOT NULL,
        telefone VARCHAR(30) NOT NULL,
        tipo_servico VARCHAR(120) DEFAULT '',
        cep VARCHAR(12) DEFAULT '',
        cidade VARCHAR(120) DEFAULT '',
        bairro VARCHAR(120) DEFAULT '',
        urgencia VARCHAR(50) DEFAULT '',
        mensagem TEXT,
        origem VARCHAR(50) DEFAULT 'formulario',
        url_origem TEXT,
        status VARCHAR(20) DEFAULT 'novo',
        cliente_id BIGINT UNSIGNED DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_switch_theme', 'chaveiro_create_leads_table');
add_action('init', 'chaveiro_create_leads_table');


// ==============================
// SALVAR LEAD (AJAX)
// ==============================
function salvar_lead() {
    global $wpdb;

    $nome         = isset($_POST['nome']) ? sanitize_text_field(wp_unslash($_POST['nome'])) : '';
    $telefone     = isset($_POST['telefone']) ? sanitize_text_field(wp_unslash($_POST['telefone'])) : '';
    $tipo_servico = isset($_POST['tipo_servico']) ? sanitize_text_field(wp_unslash($_POST['tipo_servico'])) : '';
    $cep          = isset($_POST['cep']) ? sanitize_text_field(wp_unslash($_POST['cep'])) : '';
    $cidade       = isset($_POST['cidade']) ? sanitize_text_field(wp_unslash($_POST['cidade'])) : '';
    $bairro       = isset($_POST['bairro']) ? sanitize_text_field(wp_unslash($_POST['bairro'])) : '';
    $urgencia     = isset($_POST['urgencia']) ? sanitize_text_field(wp_unslash($_POST['urgencia'])) : '';
    $mensagem     = isset($_POST['mensagem']) ? sanitize_textarea_field(wp_unslash($_POST['mensagem'])) : '';
    $origem       = isset($_POST['origem']) ? sanitize_text_field(wp_unslash($_POST['origem'])) : 'formulario';
    $url_origem   = isset($_POST['url_origem']) ? esc_url_raw(wp_unslash($_POST['url_origem'])) : '';

    if (empty($nome) || empty($telefone) || empty($tipo_servico) || empty($cep) || empty($cidade) || empty($bairro) || empty($urgencia)) {
        wp_send_json_error([
            'msg' => 'Preencha os campos obrigatórios antes de enviar.'
        ]);
    }

    $wpdb->insert(
        $wpdb->prefix . 'chaveiro_leads',
        [
            'nome'         => $nome,
            'telefone'     => $telefone,
            'tipo_servico' => $tipo_servico,
            'cep'          => $cep,
            'cidade'       => $cidade,
            'bairro'       => $bairro,
            'urgencia'     => $urgencia,
            'mensagem'     => $mensagem,
            'origem'       => $origem,
            'url_origem'   => $url_origem,
            'status'       => 'novo'
        ],
        [
            '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'
        ]
    );

    $numero = get_theme_mod('whatsapp_numero', '');
    $numero = preg_replace('/\D+/', '', $numero);

    $texto_whatsapp = "Olá, meu nome é {$nome}. "
        . "Preciso de {$tipo_servico}. "
        . "CEP: {$cep}. "
        . "Cidade: {$cidade}. "
        . "Bairro: {$bairro}. "
        . "Urgência: {$urgencia}. ";

    if (!empty($mensagem)) {
        $texto_whatsapp .= "Detalhes: {$mensagem}";
    }

    $whatsapp_link = '';
    if (!empty($numero)) {
        $whatsapp_link = 'https://wa.me/' . $numero . '?text=' . rawurlencode($texto_whatsapp);
    }

    wp_send_json_success([
        'msg'      => 'Lead enviado com sucesso.',
        'whatsapp' => $whatsapp_link
    ]);
}
add_action('wp_ajax_salvar_lead', 'salvar_lead');
add_action('wp_ajax_nopriv_salvar_lead', 'salvar_lead');


// ==============================
// ATUALIZAR STATUS (AJAX)
// ==============================
function atualizar_status_lead() {
    global $wpdb;

    $id     = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? sanitize_text_field(wp_unslash($_POST['status'])) : '';

    if (!$id || empty($status)) {
        wp_send_json_error('Dados inválidos.');
    }

    $wpdb->update(
        $wpdb->prefix . 'chaveiro_leads',
        ['status' => $status],
        ['id' => $id],
        ['%s'],
        ['%d']
    );

    wp_send_json_success('Status atualizado');
}
add_action('wp_ajax_update_lead_status', 'atualizar_status_lead');


// ==============================
// LISTAGEM (CRM)
// ==============================
function chaveiro_leads_page() {
    global $wpdb;

    $status = isset($_GET['status']) ? sanitize_text_field(wp_unslash($_GET['status'])) : '';
    $busca  = isset($_GET['s']) ? sanitize_text_field(wp_unslash($_GET['s'])) : '';

    $query = "SELECT * FROM {$wpdb->prefix}chaveiro_leads WHERE 1=1";

    if ($status) {
        $query .= $wpdb->prepare(" AND status = %s", $status);
    }

    if ($busca) {
        $like = '%' . $wpdb->esc_like($busca) . '%';
        $query .= $wpdb->prepare(
            " AND (nome LIKE %s OR telefone LIKE %s OR cidade LIKE %s OR bairro LIKE %s OR tipo_servico LIKE %s)",
            $like,
            $like,
            $like,
            $like,
            $like
        );
    }

    $leads = $wpdb->get_results($query . " ORDER BY created_at DESC");

    echo "<div class='wrap'><h1>CRM - Leads</h1>";

    echo "
    <form method='get' style='margin:20px 0; display:flex; gap:10px; align-items:center; flex-wrap:wrap;'>
        <input type='hidden' name='page' value='chaveiro_leads'>
        <select name='status'>
            <option value=''>Todos os status</option>
            <option value='novo' " . selected($status, 'novo', false) . ">Novo</option>
            <option value='contato' " . selected($status, 'contato', false) . ">Contato</option>
            <option value='fechado' " . selected($status, 'fechado', false) . ">Fechado</option>
        </select>
        <input type='text' name='s' placeholder='Buscar por nome, telefone, cidade...' value='" . esc_attr($busca) . "'>
        <button class='button'>Filtrar</button>
    </form>";

    echo "<table class='widefat striped'>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Serviço</th>
                <th>CEP</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Urgência</th>
                <th>Origem</th>
                <th>Status</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>";

    if ($leads) {
        foreach ($leads as $lead) {
            echo "<tr>
                <td>" . esc_html($lead->nome) . "</td>
                <td>" . esc_html($lead->telefone) . "</td>
                <td>" . esc_html($lead->tipo_servico) . "</td>
                <td>" . esc_html($lead->cep) . "</td>
                <td>" . esc_html($lead->cidade) . "</td>
                <td>" . esc_html($lead->bairro) . "</td>
                <td>" . esc_html($lead->urgencia) . "</td>
                <td>" . esc_html($lead->origem) . "</td>
                <td>
                    <select class='status-change' data-id='" . esc_attr($lead->id) . "'>
                        <option value='novo' " . selected($lead->status, 'novo', false) . ">novo</option>
                        <option value='contato' " . selected($lead->status, 'contato', false) . ">contato</option>
                        <option value='fechado' " . selected($lead->status, 'fechado', false) . ">fechado</option>
                    </select>
                </td>
                <td>" . esc_html($lead->created_at) . "</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>Nenhum lead encontrado.</td></tr>";
    }

    echo "</tbody></table></div>";
}


// ==============================
// KANBAN CRM
// ==============================
function chaveiro_kanban_page() {
    global $wpdb;

    $leads = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}chaveiro_leads ORDER BY created_at DESC");

    $columns = [
        'novo'    => [],
        'contato' => [],
        'fechado' => []
    ];

    foreach ($leads as $lead) {
        $status = in_array($lead->status, ['novo', 'contato', 'fechado'], true) ? $lead->status : 'novo';
        $columns[$status][] = $lead;
    }

    echo "<div class='wrap'><h1>Kanban CRM</h1>";
    echo "<div class='kanban-board'>";

    foreach ($columns as $status => $items) {
        echo "<div class='kanban-column' data-status='" . esc_attr($status) . "'>";
        echo "<h2>" . esc_html(ucfirst($status)) . "</h2>";

        foreach ($items as $lead) {
            echo "<div class='kanban-card' draggable='true' data-id='" . esc_attr($lead->id) . "'>
                    <strong>" . esc_html($lead->nome) . "</strong><br>
                    " . esc_html($lead->telefone) . "<br>
                    <small>" . esc_html($lead->tipo_servico) . "</small><br>
                    <small>" . esc_html($lead->cidade . ' / ' . $lead->bairro) . "</small><br>
                    <small>Urgência: " . esc_html($lead->urgencia) . "</small>
                  </div>";
        }

        echo "</div>";
    }

    echo "</div></div>";
}