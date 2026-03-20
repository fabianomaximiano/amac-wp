<?php get_header(); ?>

<?php
$post_id = get_the_ID();

$cidade  = get_the_title();
$bairro  = get_post_meta($post_id, '_cidade_bairro', true);
$mapa    = get_post_meta($post_id, '_cidade_mapa', true);

$numero = get_theme_mod('whatsapp_numero', '');
$numero = preg_replace('/\D+/', '', $numero);

$mensagem = rawurlencode(
    'Olá, preciso de um chaveiro em ' . $cidade .
    (!empty($bairro) ? ' - ' . $bairro : '') .
    '. Pode me atender agora?'
);

$whatsapp_link = !empty($numero) ? 'https://wa.me/' . $numero . '?text=' . $mensagem : '';

$hero_bg = get_the_post_thumbnail_url($post_id, 'full');
if (empty($hero_bg)) {
    $hero_bg = get_theme_mod('hero_bg_image', '');
}
?>

<section class="cidade-hero py-5 text-white" <?php if (!empty($hero_bg)) : ?>style="background-image: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)), url('<?php echo esc_url($hero_bg); ?>'); background-size: cover; background-position: center center; background-repeat: no-repeat;"<?php endif; ?>>
    <div class="container py-5">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <h1 class="mb-3">Chaveiro 24h em <?php echo esc_html($cidade); ?></h1>

                <p class="lead mb-4">
                    Atendimento rápido e profissional em <?php echo esc_html($cidade); ?>
                    <?php if (!empty($bairro)) : ?>
                        , com cobertura na região de <?php echo esc_html($bairro); ?>
                    <?php endif; ?>.
                    Chegamos com agilidade para abertura de portas, chaves automotivas e fechaduras.
                </p>

                <?php if (!empty($whatsapp_link)) : ?>
                    <a href="<?php echo esc_url($whatsapp_link); ?>"
                       class="btn btn-success btn-lg whatsapp-btn"
                       target="_blank"
                       rel="noopener noreferrer">
                        Chamar no WhatsApp
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="cidade-intro py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-3">Atendimento de chaveiro em <?php echo esc_html($cidade); ?></h2>

                <p>
                    Prestamos serviço de chaveiro 24 horas em <?php echo esc_html($cidade); ?>
                    <?php if (!empty($bairro)) : ?>
                        e em áreas próximas de <?php echo esc_html($bairro); ?>
                    <?php endif; ?>,
                    com foco em rapidez, segurança e atendimento profissional.
                </p>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php if (trim(get_the_content())) : ?>
                        <div class="cidade-conteudo mt-4">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="cidade-servicos py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Serviços em <?php echo esc_html($cidade); ?></h2>
            <p class="mb-0">Soluções rápidas para residência, comércio e automóveis.</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h3 class="h4">Abertura de portas</h3>
                        <p class="mb-0">Atendimento para portas residenciais e comerciais com segurança e agilidade.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h3 class="h4">Chave automotiva</h3>
                        <p class="mb-0">Suporte para perda de chave, travamento e necessidades automotivas urgentes.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h3 class="h4">Fechaduras e troca</h3>
                        <p class="mb-0">Instalação, troca e manutenção de fechaduras comuns e digitais.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($mapa)) : ?>
<section class="cidade-mapa py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Atendimento na região</h2>
            <?php if (!empty($bairro)) : ?>
                <p class="mb-0">Veja a área de referência em <?php echo esc_html($bairro); ?>, <?php echo esc_html($cidade); ?>.</p>
            <?php endif; ?>
        </div>

        <div class="cidade-mapa-embed">
            <?php echo $mapa; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="cidade-avaliacoes py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>O que dizem nossos clientes</h2>
            <p class="mb-0">Prova social para reforçar confiança no atendimento local.</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-0">
                    <p class="mb-2">★★★★★</p>
                    <p class="mb-0">Atendimento rápido, educado e resolveu meu problema no mesmo dia.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-0">
                    <p class="mb-2">★★★★★</p>
                    <p class="mb-0">Profissional de confiança, chegou rápido e fez um serviço excelente.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-0">
                    <p class="mb-2">★★★★★</p>
                    <p class="mb-0">Preço justo e atendimento muito eficiente. Recomendo para emergências.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($whatsapp_link)) : ?>
<section class="cidade-cta py-5 text-center">
    <div class="container">
        <h2 class="mb-3">Precisa de atendimento em <?php echo esc_html($cidade); ?>?</h2>
        <p class="mb-4">
            <?php if (!empty($bairro)) : ?>
                Solicite agora atendimento em <?php echo esc_html($bairro); ?> e região.
            <?php else : ?>
                Solicite agora atendimento rápido e profissional.
            <?php endif; ?>
        </p>

        <a href="<?php echo esc_url($whatsapp_link); ?>"
           class="btn btn-success btn-lg whatsapp-btn"
           target="_blank"
           rel="noopener noreferrer">
            Falar com um chaveiro agora
        </a>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>