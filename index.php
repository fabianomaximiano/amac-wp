<?php get_header(); ?>

<?php
if (function_exists('chaveiro_render_hero')) {
    chaveiro_render_hero();
} else {
    $hero_bg = get_theme_mod('hero_bg_image');
    $hero_titulo = get_theme_mod('hero_titulo', 'Chaveiro 24h na sua região');
    $hero_subtitulo = get_theme_mod('hero_subtitulo', 'Atendimento rápido para emergências residenciais, comerciais e automotivas.');
    $hero_btn_text = get_theme_mod('hero_btn_text', 'Falar no WhatsApp');
    $hero_btn_link = get_theme_mod('hero_whatsapp_link', 'https://wa.me/5511999999999');
?>
<section class="hero-section d-flex align-items-center"
    style="
    min-height: 100vh;
    background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?php echo esc_url($hero_bg); ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    ">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-8 text-white">
                <h1 class="hero-title"><?php echo esc_html($hero_titulo); ?></h1>

                <?php if (!empty($hero_subtitulo)) : ?>
                    <p class="hero-subtitle"><?php echo esc_html($hero_subtitulo); ?></p>
                <?php endif; ?>

                <?php if (!empty($hero_btn_link)) : ?>
                    <div class="hero-actions justify-content-center">
                        <a
                            href="<?php echo esc_url($hero_btn_link); ?>"
                            class="btn btn-success hero-btn whatsapp-btn"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <i class="fa-brands fa-whatsapp"></i>
                            <span><?php echo esc_html($hero_btn_text); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php
if (function_exists('chaveiro_render_servicos')) {
    chaveiro_render_servicos();
} else {
?>
<section id="servicos" class="servicos text-white text-center" style="background:#0A2540;">
    <div class="container">
        <div class="row">
            <?php
            $query = new WP_Query(['post_type' => 'servicos']);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card-servico p-4 h-100">
                        <h5><?php the_title(); ?></h5>
                        <p><?php the_content(); ?></p>
                    </div>
                </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php } ?>

<?php
if (function_exists('chaveiro_render_sobre')) {
    chaveiro_render_sobre();
} else {
    $img = get_theme_mod('sobre_imagem');
?>
<section class="sobre py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center">
                <?php if ($img) : ?>
                    <img src="<?php echo esc_url($img); ?>" class="img-fluid rounded" alt="<?php echo esc_attr(get_theme_mod('sobre_titulo', 'Sobre o Profissional')); ?>">
                <?php endif; ?>
            </div>

            <div class="col-md-7">
                <h2><?php echo esc_html(get_theme_mod('sobre_titulo', 'Sobre o Profissional')); ?></h2>
                <p><?php echo esc_html(get_theme_mod('sobre_descricao', 'Mais de 10 anos de experiência, atendimento rápido e garantia total.')); ?></p>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php
if (function_exists('chaveiro_render_faq')) {
    chaveiro_render_faq();
}
?>

<section class="avaliacoes py-5 text-center">
    <div class="container">
        <h2><?php echo esc_html(get_theme_mod('avaliacoes_titulo', 'O que dizem nossos clientes')); ?></h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card p-3 shadow-sm h-100">
                    ★★★★★
                    <p>Chegou em 15 minutos, salvou meu dia!</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-3 shadow-sm h-100">
                    ★★★★★
                    <p>Profissional e rápido, recomendo muito.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-3 shadow-sm h-100">
                    ★★★★★
                    <p>Preço justo e excelente atendimento.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (get_theme_mod('mapa_iframe')) : ?>
<section class="mapa py-5 text-center">
    <?php echo get_theme_mod('mapa_iframe'); ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>