<?php

function chaveiro_render_whatsapp_float()
{
    $whatsapp_link = trim((string) get_theme_mod('hero_whatsapp_link', 'https://wa.me/5511999999999'));
    $whatsapp_text = trim((string) get_theme_mod('whatsapp_float_text', 'WhatsApp'));
    $footer_text   = trim((string) get_theme_mod('whatsapp_footer_text', 'Falar no WhatsApp'));

    if (empty($whatsapp_link)) {
        return;
    }

    if ($whatsapp_text === '') {
        $whatsapp_text = 'WhatsApp';
    }

    if ($footer_text === '') {
        $footer_text = 'Falar no WhatsApp';
    }
    ?>
    <a
        href="<?php echo esc_url($whatsapp_link); ?>"
        class="whatsapp-float"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Falar no WhatsApp"
    >
        <span class="whatsapp-float-icon">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
        </span>

        <span class="whatsapp-float-text">
            <?php echo esc_html($whatsapp_text); ?>
        </span>
    </a>

    <div class="whatsapp-footer-bar">
        <a
            href="<?php echo esc_url($whatsapp_link); ?>"
            class="whatsapp-footer-btn"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Falar no WhatsApp"
        >
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            <span><?php echo esc_html($footer_text); ?></span>
        </a>
    </div>
    <?php
}