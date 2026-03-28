<?php
get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        $subtitulo = get_post_meta(get_the_ID(), '_servico_subtitulo', true);
        $resumo    = get_post_meta(get_the_ID(), '_servico_resumo', true);
        $terms     = get_the_terms(get_the_ID(), 'categoria_servico');
        $archive   = get_post_type_archive_link('servicos');
        ?>
        <section class="servicos-archive-page servico-single-page">
            <div class="container">
                <div class="servicos-archive-header text-center">
                    <span class="servicos-archive-kicker">Serviço</span>
                    <h1 class="servicos-archive-title"><?php the_title(); ?></h1>
                </div>

                <div class="servico-single-wrap">
                    <div class="row align-items-start">
                        <div class="col-lg-7 mb-4 mb-lg-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="servico-single-media">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid servico-single-img']); ?>
                                </div>
                            <?php else : ?>
                                <div class="servico-single-media servico-single-placeholder" aria-hidden="true">
                                    <div class="servico-single-placeholder-circle">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-5">
                            <div class="servico-single-card">
                                <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                                    <div class="servico-single-categorias">
                                        <?php foreach ($terms as $term) : ?>
                                            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="servico-single-tag">
                                                <?php echo esc_html($term->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($subtitulo)) : ?>
                                    <p class="servico-single-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($resumo)) : ?>
                                    <div class="servico-single-resumo">
                                        <p><?php echo esc_html($resumo); ?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_the_content()) : ?>
                                    <div class="servico-single-content">
                                        <?php the_content(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($archive)) : ?>
                                    <a href="<?php echo esc_url($archive); ?>" class="btn btn-outline-primary servico-single-back">
                                        Voltar para todos os serviços
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endwhile;
endif;

get_footer();