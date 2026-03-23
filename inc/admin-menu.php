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

function chaveiro_admin_menu_styles() {
    ?>
    <style>
        .chaveiro-admin-wrap {
            margin: 20px 20px 0 0;
        }

        .chaveiro-admin-header {
            margin-bottom: 18px;
        }

        .chaveiro-admin-title {
            margin: 0 0 6px;
            font-size: 26px;
            line-height: 1.2;
            font-weight: 700;
            color: #1d2327;
        }

        .chaveiro-admin-subtitle {
            margin: 0;
            color: #646970;
            font-size: 13px;
            line-height: 1.5;
        }

        .chaveiro-admin-surface {
            background: #f6f7f7;
            border: 1px solid #dcdcde;
            border-radius: 10px;
            padding: 14px;
        }

        .chaveiro-admin-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 14px;
        }

        .chaveiro-admin-card,
        .chaveiro-admin-section {
            background: #ffffff;
            border: 1px solid #dcdcde;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }

        .chaveiro-admin-card {
            padding: 16px;
        }

        .chaveiro-admin-card-label {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            line-height: 1.25;
            font-weight: 600;
            color: #1d2327;
        }

        .chaveiro-admin-card-value {
            display: block;
            font-size: 28px;
            line-height: 1.1;
            font-weight: 700;
            color: #2271b1;
        }

        .chaveiro-admin-card-desc {
            display: block;
            margin-top: 6px;
            color: #646970;
            font-size: 11px;
            line-height: 1.35;
        }

        .chaveiro-admin-sections {
            display: grid;
            gap: 14px;
        }

        .chaveiro-admin-section {
            padding: 14px;
        }

        .chaveiro-admin-section-title {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1d2327;
            margin-bottom: 2px;
            line-height: 1.2;
        }

        .chaveiro-admin-section-description {
            display: block;
            color: #646970;
            font-size: 10.5px;
            line-height: 1.35;
            margin-bottom: 12px;
        }

        .chaveiro-admin-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .chaveiro-admin-actions .button {
            min-height: 34px;
            line-height: 32px;
            border-radius: 6px;
        }

        .chaveiro-admin-highlight {
            border-left: 4px solid #2271b1;
            padding-left: 10px;
            color: #1d2327;
            font-size: 12px;
            line-height: 1.5;
        }

        .chaveiro-admin-list {
            margin: 0;
            padding-left: 18px;
        }

        .chaveiro-admin-list li {
            margin-bottom: 6px;
            color: #1d2327;
            font-size: 12px;
            line-height: 1.4;
        }

        @media (max-width: 1100px) {
            .chaveiro-admin-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .chaveiro-admin-wrap {
                margin-right: 10px;
            }

            .chaveiro-admin-grid {
                grid-template-columns: 1fr;
            }

            .chaveiro-admin-title {
                font-size: 22px;
            }

            .chaveiro-admin-card-value {
                font-size: 24px;
            }
        }
    </style>
    <?php
}
add_action('admin_head', 'chaveiro_admin_menu_styles');

// DASHBOARD
function chaveiro_dashboard() {

    global $wpdb;

    $table_name = $wpdb->prefix . 'chaveiro_leads';

    $table_exists = $wpdb->get_var(
        $wpdb->prepare(
            'SHOW TABLES LIKE %s',
            $table_name
        )
    );

    $total = 0;
    $novos = 0;
    $contato = 0;
    $fechado = 0;

    if ($table_exists === $table_name) {
        $total = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table_name}");
        $novos = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status='novo'");
        $contato = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status='contato'");
        $fechado = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status='fechado'");
    }

    echo "<div class='wrap chaveiro-admin-wrap'>";

    echo "<div class='chaveiro-admin-header'>";
    echo "<h1 class='chaveiro-admin-title'>Dashboard</h1>";
    echo "<p class='chaveiro-admin-subtitle'>Painel administrativo com padrão visual organizado e consistente com o restante do projeto.</p>";
    echo "</div>";

    echo "<div class='chaveiro-admin-surface'>";

    echo "<div class='chaveiro-admin-grid'>";

    echo "<div class='chaveiro-admin-card'>";
    echo "<span class='chaveiro-admin-card-label'>Total de Leads</span>";
    echo "<span class='chaveiro-admin-card-value'>" . esc_html(number_format_i18n($total)) . "</span>";
    echo "<span class='chaveiro-admin-card-desc'>Total geral de registros captados.</span>";
    echo "</div>";

    echo "<div class='chaveiro-admin-card'>";
    echo "<span class='chaveiro-admin-card-label'>Novos</span>";
    echo "<span class='chaveiro-admin-card-value'>" . esc_html(number_format_i18n($novos)) . "</span>";
    echo "<span class='chaveiro-admin-card-desc'>Leads aguardando primeiro contato.</span>";
    echo "</div>";

    echo "<div class='chaveiro-admin-card'>";
    echo "<span class='chaveiro-admin-card-label'>Em Contato</span>";
    echo "<span class='chaveiro-admin-card-value'>" . esc_html(number_format_i18n($contato)) . "</span>";
    echo "<span class='chaveiro-admin-card-desc'>Leads em negociação ou atendimento.</span>";
    echo "</div>";

    echo "<div class='chaveiro-admin-card'>";
    echo "<span class='chaveiro-admin-card-label'>Fechados</span>";
    echo "<span class='chaveiro-admin-card-value'>" . esc_html(number_format_i18n($fechado)) . "</span>";
    echo "<span class='chaveiro-admin-card-desc'>Leads convertidos em serviço.</span>";
    echo "</div>";

    echo "</div>";

    echo "<div class='chaveiro-admin-sections'>";

    echo "<div class='chaveiro-admin-section'>";
    echo "<span class='chaveiro-admin-section-title'>Acessos rápidos</span>";
    echo "<span class='chaveiro-admin-section-description'>Links úteis para navegar nas áreas principais do sistema.</span>";
    echo "<div class='chaveiro-admin-actions'>";
    echo "<a href='" . esc_url(admin_url('admin.php?page=chaveiro_clientes')) . "' class='button button-secondary'>Clientes</a>";
    echo "<a href='" . esc_url(admin_url('admin.php?page=chaveiro_leads')) . "' class='button button-primary'>Leads</a>";
    echo "<a href='" . esc_url(admin_url('admin.php?page=chaveiro_kanban')) . "' class='button button-secondary'>Kanban CRM</a>";
    echo "<a href='" . esc_url(admin_url('customize.php')) . "' class='button button-secondary'>Customizer</a>";
    echo "</div>";
    echo "</div>";

    echo "<div class='chaveiro-admin-section'>";
    echo "<span class='chaveiro-admin-section-title'>Resumo do painel</span>";
    echo "<span class='chaveiro-admin-section-description'>Base visual mais limpa para acompanhar os números principais do projeto.</span>";
    echo "<div class='chaveiro-admin-highlight'>Esse padrão facilita manutenção e deixa o painel administrativo alinhado com o restante das seções já padronizadas no projeto.</div>";
    echo "</div>";

    echo "<div class='chaveiro-admin-section'>";
    echo "<span class='chaveiro-admin-section-title'>Próximos ajustes recomendados</span>";
    echo "<span class='chaveiro-admin-section-description'>Sugestões para manter consistência visual em todo o admin.</span>";
    echo "<ul class='chaveiro-admin-list'>";
    echo "<li>Aplicar esse mesmo padrão nas páginas de Clientes, Leads e Kanban.</li>";
    echo "<li>Remover estilos inline antigos das demais telas administrativas.</li>";
    echo "<li>Criar componentes reutilizáveis para cards, tabelas e cabeçalhos.</li>";
    echo "<li>Adicionar métricas extras, como taxa de conversão e tempo médio de resposta.</li>";
    echo "</ul>";
    echo "</div>";

    echo "</div>";
    echo "</div>";
    echo "</div>";
}