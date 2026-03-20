<?php

function chaveiro_create_clientes_table() {

    global $wpdb;

    $table = $wpdb->prefix . 'chaveiro_clientes';

    $sql = "CREATE TABLE $table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100),
        cidade VARCHAR(100),
        whatsapp VARCHAR(20),
        status VARCHAR(20) DEFAULT 'ativo'
    )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'chaveiro_create_clientes_table');


// LISTAGEM
function chaveiro_clientes_page() {

    global $wpdb;
    $clientes = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}chaveiro_clientes");

    echo "<div class='wrap'><h1>Clientes</h1>";

    echo "<form method='post'>
        <input name='nome' placeholder='Nome'>
        <input name='cidade' placeholder='Cidade'>
        <input name='whatsapp' placeholder='WhatsApp'>
        <button class='button button-primary'>Adicionar</button>
    </form>";

    // INSERT
    if(isset($_POST['nome'])) {
        $wpdb->insert($wpdb->prefix . 'chaveiro_clientes', [
            'nome' => $_POST['nome'],
            'cidade' => $_POST['cidade'],
            'whatsapp' => $_POST['whatsapp']
        ]);
        echo "<p>Cliente salvo!</p>";
    }

    echo "<table class='widefat'><tr><th>Nome</th><th>Cidade</th><th>WhatsApp</th></tr>";

    foreach($clientes as $c) {
        echo "<tr>
            <td>$c->nome</td>
            <td>$c->cidade</td>
            <td>$c->whatsapp</td>
        </tr>";
    }

    echo "</table></div>";
}