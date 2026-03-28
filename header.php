<?php
$altura = (int) get_theme_mod('menu_altura', 88);
$whatsapp = get_theme_mod('whatsapp_numero');
$whatsapp_ativo = get_theme_mod('whatsapp_ativo', true);
$whatsapp_link = !empty($whatsapp)
    ? 'https://wa.me/' . preg_replace('/\D+/', '', $whatsapp)
    : 'https://wa.me/5511999999999';

$cta_texto = get_theme_mod('menu_cta_texto', 'Solicitar atendimento');
$cta_link  = trim((string) get_theme_mod('menu_cta_link', ''));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header">
    <nav class="navbar navbar-expand-lg fixed-top <?php echo get_theme_mod('menu_transparente', true) ? 'navbar-transparent' : 'navbar-solid'; ?>"
         style="min-height: <?php echo esc_attr($altura); ?>px;">
        <div class="container navbar-main-container">

            <div class="site-branding-wrap">
                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        bloginfo('name');
                    }
                    ?>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="<?php esc_attr_e('Abrir menu', 'chaveiro'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <div class="navbar-collapse-inner">

                    <div class="header-menu-wrap">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'menu-principal',
                            'container'      => false,
                            'menu_class'     => 'navbar-nav header-menu align-items-lg-center',
                            'fallback_cb'    => false,
                        ]);
                        ?>
                    </div>

                    <div class="header-cta-group d-flex align-items-lg-center">
                        <?php if (!empty($cta_link)) : ?>
                            <a href="<?php echo esc_url($cta_link); ?>" class="btn btn-warning header-atendimento-btn">
                                <?php echo esc_html($cta_texto); ?>
                            </a>
                        <?php else : ?>
                            <button type="button"
                                    id="abrirModal"
                                    class="btn btn-warning header-atendimento-btn">
                                <?php echo esc_html($cta_texto); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</header>

<div id="modalAtendimento" class="hero-modal" aria-hidden="true">
    <div class="hero-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modalAtendimentoTitulo">
        <button type="button" class="fechar" aria-label="Fechar modal">&times;</button>

        <div class="hero-modal-header">
            <h3 id="modalAtendimentoTitulo" class="hero-form-title">Solicite atendimento</h3>
            <p class="hero-form-tip">Preencha os dados abaixo para agilizar o atendimento. O CEP ajuda a completar cidade e bairro automaticamente.</p>
        </div>

        <form id="leadForm" class="hero-lead-form">
            <input type="hidden" name="origem" value="header_modal">
            <input type="hidden" name="url_origem" id="url_origem" value="">

            <div class="form-group">
                <label for="lead_nome">Nome</label>
                <input
                    id="lead_nome"
                    name="nome"
                    class="form-control"
                    placeholder="Seu nome"
                    required
                >
                <small class="form-text text-muted">Informe o nome de quem vai receber o atendimento.</small>
            </div>

            <div class="form-group">
                <label for="lead_telefone">Telefone</label>
                <input
                    id="lead_telefone"
                    name="telefone"
                    class="form-control telefone"
                    placeholder="(11) 99999-9999"
                    required
                >
                <small class="form-text text-muted">Use um número com WhatsApp para agilizar o retorno.</small>
            </div>

            <div class="form-group">
                <label for="lead_tipo_servico">Tipo de serviço</label>
                <select id="lead_tipo_servico" name="tipo_servico" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="Abertura de residência">Abertura de residência</option>
                    <option value="Abertura de veículo">Abertura de veículo</option>
                    <option value="Chave automotiva">Chave automotiva</option>
                    <option value="Fechadura digital">Fechadura digital</option>
                    <option value="Troca de fechadura">Troca de fechadura</option>
                    <option value="Cópia de chave">Cópia de chave</option>
                    <option value="Outros">Outros</option>
                </select>
                <small class="form-text text-muted">Escolha o serviço principal para priorizar o atendimento.</small>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="lead_cep">CEP</label>
                    <input
                        id="lead_cep"
                        name="cep"
                        class="form-control cep"
                        placeholder="00000-000"
                        required
                    >
                    <small class="form-text text-muted">Ao sair do campo, tentamos completar os dados.</small>
                </div>

                <div class="form-group col-md-4">
                    <label for="lead_cidade">Cidade</label>
                    <input
                        id="lead_cidade"
                        name="cidade"
                        class="form-control"
                        placeholder="Cidade"
                        required
                    >
                </div>

                <div class="form-group col-md-4">
                    <label for="lead_bairro">Bairro</label>
                    <input
                        id="lead_bairro"
                        name="bairro"
                        class="form-control"
                        placeholder="Bairro"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="lead_urgencia">Urgência</label>
                <select id="lead_urgencia" name="urgencia" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="Urgente agora">Urgente agora</option>
                    <option value="Ainda hoje">Ainda hoje</option>
                    <option value="Posso agendar">Posso agendar</option>
                </select>
                <small class="form-text text-muted">Isso ajuda a organizar a prioridade do atendimento.</small>
            </div>

            <div class="form-group">
                <label for="lead_mensagem">Mensagem</label>
                <textarea
                    id="lead_mensagem"
                    name="mensagem"
                    class="form-control"
                    rows="3"
                    placeholder="Ex.: trancado para fora, chave quebrou, fechadura travou..."
                ></textarea>
                <small class="form-text text-muted">Descreva rapidamente o problema.</small>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Atendimento imediato</button>
        </form>

        <div id="msg" class="mt-3"></div>
    </div>
</div>

<?php if ($whatsapp_ativo) : ?>
    <a href="<?php echo esc_url($whatsapp_link); ?>"
       class="whatsapp-float whatsapp-btn"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Falar pelo WhatsApp">
        <span class="whatsapp-float-icon">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
        </span>
        <span class="whatsapp-float-text">WhatsApp</span>
    </a>

    <div class="whatsapp-footer-bar">
        <a href="<?php echo esc_url($whatsapp_link); ?>"
           class="whatsapp-footer-btn whatsapp-btn"
           target="_blank"
           rel="noopener noreferrer">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            <span>Falar pelo WhatsApp</span>
        </a>
    </div>
<?php endif; ?>