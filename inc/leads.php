<?php

if (!defined('ABSPATH')) {
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// ==============================
// HELPERS
// ==============================
if (!function_exists('chaveiro_leads_log')) {
    function chaveiro_leads_log($message)
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[Chaveiro Leads] ' . $message);
        }
    }
}

if (!function_exists('chaveiro_get_env_value')) {
    function chaveiro_get_env_value($key, $default = '')
    {
        if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
            return $_ENV[$key];
        }

        $value = getenv($key);
        if ($value !== false && $value !== '') {
            return $value;
        }

        return $default;
    }
}

// ==============================
// CARREGAR AUTOLOAD E .ENV
// ==============================
if (!function_exists('chaveiro_inicializar_dependencias')) {
    function chaveiro_inicializar_dependencias()
    {
        $autoload_path = get_template_directory() . '/vendor/autoload.php';

        if (!file_exists($autoload_path)) {
            chaveiro_leads_log('Autoload não encontrado em: ' . $autoload_path);
            return;
        }

        require_once $autoload_path;

        if (!class_exists('\Dotenv\Dotenv')) {
            chaveiro_leads_log('Classe Dotenv não encontrada após autoload.');
            return;
        }

        $paths = array(
            ABSPATH,
            get_template_directory(),
        );

        foreach ($paths as $path) {
            $env_file = trailingslashit($path) . '.env';

            if (!file_exists($env_file)) {
                continue;
            }

            try {
                $dotenv = Dotenv::createImmutable($path);
                $dotenv->safeLoad();
                chaveiro_leads_log('.env carregado em: ' . $env_file);
                break;
            } catch (\Throwable $e) {
                chaveiro_leads_log('Erro ao carregar .env: ' . $e->getMessage());
            }
        }
    }
}
add_action('after_setup_theme', 'chaveiro_inicializar_dependencias');

// ==============================
// TABELA DE LEADS
// ==============================
if (!function_exists('chaveiro_create_leads_table')) {
    function chaveiro_create_leads_table()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'chaveiro_leads';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table} (
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
        ) {$charset_collate};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}
add_action('after_switch_theme', 'chaveiro_create_leads_table');
add_action('init', 'chaveiro_create_leads_table');

// ==============================
// SALVAR LEAD
// ==============================
if (!function_exists('salvar_lead')) {
    function salvar_lead()
    {
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

        if (empty($nome) || empty($telefone) || empty($cidade)) {
            wp_send_json_error(array(
                'msg' => 'Preencha os campos obrigatórios: nome, telefone e cidade.'
            ));
        }

        $inserted = $wpdb->insert(
            $wpdb->prefix . 'chaveiro_leads',
            array(
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
                'status'       => 'novo',
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );

        if (!$inserted) {
            chaveiro_leads_log('Erro ao inserir lead: ' . $wpdb->last_error);

            wp_send_json_error(array(
                'msg' => 'Não foi possível salvar sua solicitação agora. Tente novamente.'
            ));
        }

        $email_enviado = false;
        $erro_email = '';

        if (!class_exists('\PHPMailer\PHPMailer\PHPMailer')) {
            chaveiro_leads_log('PHPMailer não disponível.');
        } else {
            try {
                $mail = new PHPMailer(true);

                // Mesmo padrão do teste validado
                $mail->isSMTP();
                $mail->Host       = chaveiro_get_env_value('SMTP_HOST', 'smtp.titan.email');
                $mail->SMTPAuth   = true;
                $mail->Username   = chaveiro_get_env_value('SMTP_USERNAME', 'contato@fabianomaximiano.com.br');
                $mail->Password   = chaveiro_get_env_value('SMTP_PASSWORD', '');
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
                $mail->CharSet    = 'UTF-8';

                // Ative só para testar e depois volte para 0/comentado
                // $mail->SMTPDebug = 2;

                $from_email = chaveiro_get_env_value('SMTP_FROM_EMAIL', 'contato@fabianomaximiano.com.br');
                $from_name  = chaveiro_get_env_value('SMTP_FROM_NAME', 'Amac-Chaveiro e Acessórios');
                $to_email   = chaveiro_get_env_value('LEAD_RECEIVER_EMAIL', 'biano@live.com');

                if (empty($mail->Username) || empty($mail->Password) || empty($to_email)) {
                    throw new Exception('Credenciais SMTP incompletas.');
                }

                $mail->setFrom($from_email, $from_name);
                $mail->addAddress($to_email, 'Destinatário');

                $mail->isHTML(true);
                $mail->Subject = 'Novo Lead: ' . $nome . ' - ' . $tipo_servico;

                $body  = '<h2>Solicitação de Atendimento</h2>';
                $body .= '<p><strong>Nome:</strong> ' . esc_html($nome) . '</p>';
                $body .= '<p><strong>Telefone:</strong> ' . esc_html($telefone) . '</p>';
                $body .= '<p><strong>Serviço:</strong> ' . esc_html($tipo_servico) . '</p>';
                $body .= '<p><strong>CEP:</strong> ' . esc_html($cep) . '</p>';
                $body .= '<p><strong>Cidade:</strong> ' . esc_html($cidade) . '</p>';
                $body .= '<p><strong>Bairro:</strong> ' . esc_html($bairro) . '</p>';
                $body .= '<p><strong>Urgência:</strong> ' . esc_html($urgencia) . '</p>';
                $body .= '<p><strong>Mensagem:</strong><br>' . nl2br(esc_html($mensagem)) . '</p>';
                $body .= '<hr>';
                $body .= '<p><strong>Origem:</strong> ' . esc_html($origem) . '</p>';
                $body .= '<p><strong>URL:</strong> ' . esc_html($url_origem) . '</p>';

                $mail->Body    = $body;
                $mail->AltBody =
                    "Solicitação de Atendimento\n" .
                    "Nome: {$nome}\n" .
                    "Telefone: {$telefone}\n" .
                    "Serviço: {$tipo_servico}\n" .
                    "CEP: {$cep}\n" .
                    "Cidade: {$cidade}\n" .
                    "Bairro: {$bairro}\n" .
                    "Urgência: {$urgencia}\n" .
                    "Mensagem: {$mensagem}\n" .
                    "Origem: {$origem}\n" .
                    "URL: {$url_origem}";

                $mail->send();
                $email_enviado = true;
            } catch (\Throwable $e) {
                $erro_email = $e->getMessage();
                chaveiro_leads_log('Erro no envio do e-mail: ' . $erro_email);
            }
        }

        $mensagem_retorno = $email_enviado
            ? 'Solicitação enviada com sucesso. Nossa equipe recebeu sua solicitação.'
            : 'Solicitação registrada com sucesso. No momento o e-mail automático falhou, mas seu pedido foi salvo.';

        wp_send_json_success(array(
            'msg'           => $mensagem_retorno,
            'email_enviado' => $email_enviado,
            'debug'         => (defined('WP_DEBUG') && WP_DEBUG) ? $erro_email : ''
        ));
    }
}
add_action('wp_ajax_salvar_lead', 'salvar_lead');
add_action('wp_ajax_nopriv_salvar_lead', 'salvar_lead');