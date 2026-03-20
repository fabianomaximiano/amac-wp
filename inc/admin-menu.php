<?php

function chaveiro_admin_menu() {

    add_menu_page(
        'SaaS Chaveiro',
        'SaaS Chaveiro',
        'manage_options',
        'chaveiro_saas',
        'chaveiro_dashboard',
        'dashicons-chart-line',
        2
    );

    add_submenu_page(
        'chaveiro_saas',
        'Clientes',
        'Clientes',
        'manage_options',
        'chaveiro_clientes',
        'chaveiro_clientes_page'
    );

    add_submenu_page(
        'chaveiro_saas',
        'Leads',
        'Leads',
        'manage_options',
        'chaveiro_leads',
        'chaveiro_leads_page'
    );

    add_submenu_page(
    'chaveiro_saas',
    'Kanban CRM',
    'Kanban CRM',
    'manage_options',
    'chaveiro_kanban',
    'chaveiro_kanban_page'
);

}
add_action('admin_menu', 'chaveiro_admin_menu');


// DASHBOARD
function chaveiro_dashboard() {

    global $wpdb;

    $total = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}chaveiro_leads");
    $novos = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}chaveiro_leads WHERE status='novo'");
    $contato = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}chaveiro_leads WHERE status='contato'");
    $fechado = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}chaveiro_leads WHERE status='fechado'");

    echo "<div class='wrap'><h1>Dashboard</h1>";

    echo "<div style='display:flex;gap:20px'>";

    echo "<div class='card'><h2>Total</h2><p>$total</p></div>";
    echo "<div class='card'><h2>Novos</h2><p>$novos</p></div>";
    echo "<div class='card'><h2>Contato</h2><p>$contato</p></div>";
    echo "<div class='card'><h2>Fechados</h2><p>$fechado</p></div>";

    echo "</div></div>";
}