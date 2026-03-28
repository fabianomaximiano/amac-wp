<?php
get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        $subtitulo     = get_post_meta(get_the_ID(), '_produto_subtitulo', true);
        $resumo        = get_post_meta(get_the_ID(), '_produto_resumo', true);
        $valor         = get_post_meta(get_the_ID(), '_produto_valor', true);
        $mostrar_valor = get_post_meta(get_the_ID(), '_produto_mostrar_valor', true);
        $terms         = get_the_terms(get_the_ID(), 'categoria_produto');
        $archive       = get_post_type_archive_link('produtos');
        ?>
        <section class="produtos-archive-page produto-single-page">
            <div class="container">
                <div class="produtos-archive-header text-center">
                    <span class="produtos-archive-kicker">Produto</span>
                    <h1 class="produtos-archive-title"><?php the_title(); ?></h1>
                </div>

                <div class="produto-single-wrap">
                    <div class="row align-items-start">
                        <div class="col-lg-7 mb-4 mb-lg-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="produto-single-media">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid produto-single-img']); ?>
                                </div>
                            <?php else : ?>
                                <div class="produto-single-media produto-single-placeholder" aria-hidden="true">
                                    <div class="produto-single-placeholder-circle">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-5">
                            <div class="produto-single-card">
                                <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                                    <div class="produto-single-categorias">
                                        <?php foreach ($terms as $term) : ?>
                                            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="produto-single-tag">
                                                <?php echo esc_html($term->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($subtitulo)) : ?>
                                    <p class="produto-single-subtitulo"><?php echo esc_html($subtitulo); ?></p>
                                <?php endif; ?>

                                <?php if ($mostrar_valor === '1' && !empty($valor)) : ?>
                                    <div class="produto-single-valor"><?php echo esc_html($valor); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($resumo)) : ?>
                                    <div class="produto-single-resumo">
                                        <p><?php echo esc_html($resumo); ?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_the_content()) : ?>
                                    <div class="produto-single-content">
                                        <?php the_content(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($archive)) : ?>
                                    <a href="<?php echo esc_url($archive); ?>" class="btn btn-outline-primary produto-single-back">
                                        Voltar para todos os produtos
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