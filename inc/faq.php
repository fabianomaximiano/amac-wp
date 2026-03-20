<?php

function chaveiro_render_faq()
{
    $faq_titulo              = get_theme_mod('faq_titulo', 'Perguntas Frequentes');
    $exibir_icone_titulo     = get_theme_mod('faq_exibir_icone_titulo', true);
    $faq_icone_titulo_classe = trim((string) get_theme_mod('faq_icone_titulo_classe', 'fa-solid fa-circle-question'));
    $exibir_icones           = get_theme_mod('faq_exibir_icones', true);
    $faq_icone_classe        = trim((string) get_theme_mod('faq_icone_classe', 'fa-solid fa-key'));

    if ($faq_icone_titulo_classe === '') {
        $faq_icone_titulo_classe = 'fa-solid fa-circle-question';
    }

    if ($faq_icone_classe === '') {
        $faq_icone_classe = 'fa-solid fa-key';
    }
    ?>

    <section class="faq-section">
        <div class="container">
            <h2 class="faq-section-title text-center mb-4">
                <?php if ($exibir_icone_titulo) : ?>
                    <i class="faq-title-icon <?php echo esc_attr($faq_icone_titulo_classe); ?>" aria-hidden="true"></i>
                <?php endif; ?>

                <span class="faq-section-title-text">
                    <?php echo esc_html($faq_titulo); ?>
                </span>
            </h2>

            <div class="accordion faq-accordion" id="faqAccordion">
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <?php
                    $pergunta = trim((string) get_theme_mod("faq_pergunta_$i", ''));
                    $resposta = trim((string) get_theme_mod("faq_resposta_$i", ''));

                    if ($pergunta === '') {
                        continue;
                    }
                    ?>
                    <div class="card faq-card">
                        <div class="card-header" id="faqHeading<?php echo esc_attr($i); ?>">
                            <button
                                class="btn faq-question-btn collapsed"
                                type="button"
                                data-toggle="collapse"
                                data-target="#faq<?php echo esc_attr($i); ?>"
                                aria-expanded="false"
                                aria-controls="faq<?php echo esc_attr($i); ?>"
                            >
                                <span class="faq-question-content">
                                    <?php if ($exibir_icones) : ?>
                                        <i class="faq-question-icon <?php echo esc_attr($faq_icone_classe); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>

                                    <span class="faq-question-text">
                                        <?php echo esc_html($pergunta); ?>
                                    </span>
                                </span>

                                <span class="faq-toggle-icon" aria-hidden="true"></span>
                            </button>
                        </div>

                        <div
                            id="faq<?php echo esc_attr($i); ?>"
                            class="collapse"
                            aria-labelledby="faqHeading<?php echo esc_attr($i); ?>"
                            data-parent="#faqAccordion"
                        >
                            <div class="card-body">
                                <?php echo nl2br(esc_html($resposta)); ?>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <?php
}