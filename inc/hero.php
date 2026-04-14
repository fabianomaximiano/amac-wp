<?php

function chaveiro_get_image_size_from_url($image_url, $size = 'full')
{
    if (empty($image_url)) {
        return '';
    }

    $attachment_id = attachment_url_to_postid($image_url);

    if ($attachment_id) {
        $sized_image = wp_get_attachment_image_url($attachment_id, $size);
        if (!empty($sized_image)) {
            return $sized_image;
        }
    }

    return $image_url;
}

function chaveiro_get_hero_button_colors($color_key = 'yellow')
{
    $map = [
        'yellow' => [
            'bg'    => '#FFC107',
            'text'  => '#111111',
            'hover' => '#E0A800',
        ],
        'blue' => [
            'bg'    => '#007BFF',
            'text'  => '#FFFFFF',
            'hover' => '#0069D9',
        ],
        'red' => [
            'bg'    => '#DC3545',
            'text'  => '#FFFFFF',
            'hover' => '#C82333',
        ],
    ];

    return isset($map[$color_key]) ? $map[$color_key] : $map['yellow'];
}

function chaveiro_render_hero()
{
    if (!get_theme_mod('hero_ativo', true)) {
        return;
    }

    $slides = [];

    for ($i = 1; $i <= 4; $i++) {
        $desktop_original = trim((string) get_theme_mod("hero_img_desktop_{$i}", ''));
        $mobile_original  = trim((string) get_theme_mod("hero_img_mobile_{$i}", ''));
        $title            = trim((string) get_theme_mod("hero_title_{$i}", ''));
        $sub              = trim((string) get_theme_mod("hero_sub_{$i}", ''));
        $btn_text         = trim((string) get_theme_mod("hero_btn_text_{$i}", 'Solicitar atendimento'));
        $btn_link         = trim((string) get_theme_mod("hero_btn_link_{$i}", ''));
        $btn_color        = trim((string) get_theme_mod("hero_btn_color_{$i}", 'yellow'));

        if ($desktop_original === '' && $mobile_original === '' && $title === '' && $sub === '' && $btn_text === '' && $btn_link === '') {
            continue;
        }

        if ($desktop_original === '') {
            continue;
        }

        $desktop_image = chaveiro_get_image_size_from_url($desktop_original, 'hero_desktop');
        $mobile_image  = '';

        if ($mobile_original !== '') {
            $mobile_image = chaveiro_get_image_size_from_url($mobile_original, 'hero_mobile');
        } else {
            $mobile_image = chaveiro_get_image_size_from_url($desktop_original, 'hero_mobile');
        }

        $slides[] = [
            'index'     => $i,
            'desktop'   => $desktop_image ?: $desktop_original,
            'mobile'    => $mobile_image ?: ($desktop_image ?: $desktop_original),
            'title'     => $title,
            'sub'       => $sub,
            'btn_text'  => $btn_text,
            'btn_link'  => $btn_link,
            'btn_color' => $btn_color,
        ];
    }

    if (empty($slides)) {
        return;
    }

    if (!empty($slides[0]['desktop'])) {
        echo '<link rel="preload" as="image" href="' . esc_url($slides[0]['desktop']) . '" fetchpriority="high">';
    }

    if (!empty($slides[0]['mobile'])) {
        echo '<link rel="preload" as="image" href="' . esc_url($slides[0]['mobile']) . '" media="(max-width: 767.98px)" fetchpriority="high">';
    }
    ?>
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-ride="carousel">
            <?php if (count($slides) > 1) : ?>
                <ol class="carousel-indicators">
                    <?php foreach ($slides as $index => $slide) : ?>
                        <li
                            data-target="#heroCarousel"
                            data-slide-to="<?php echo esc_attr($index); ?>"
                            class="<?php echo $index === 0 ? 'active' : ''; ?>"
                        ></li>
                    <?php endforeach; ?>
                </ol>
            <?php endif; ?>

            <div class="carousel-inner">
                <?php foreach ($slides as $index => $slide) : ?>
                    <?php $button_colors = chaveiro_get_hero_button_colors($slide['btn_color']); ?>

                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div
                            class="hero-slide"
                            style="background-image: url('<?php echo esc_url($slide['desktop']); ?>');"
                            data-desktop-bg="<?php echo esc_url($slide['desktop']); ?>"
                            data-mobile-bg="<?php echo esc_url($slide['mobile']); ?>"
                        >
                            <div class="hero-overlay"></div>

                            <div class="hero-content-wrap">
                                <div class="container h-100">
                                    <div class="row h-100 align-items-center justify-content-center hero-row">
                                        <div class="col-lg-8 hero-text-column text-center">
                                            <?php if ($slide['title'] !== '') : ?>
                                                <h1 class="hero-title">
                                                    <?php echo esc_html($slide['title']); ?>
                                                </h1>
                                            <?php endif; ?>

                                            <?php if ($slide['sub'] !== '') : ?>
                                                <p class="hero-subtitle">
                                                    <?php echo esc_html($slide['sub']); ?>
                                                </p>
                                            <?php endif; ?>

                                            <?php if ($slide['btn_link'] !== '' && $slide['btn_text'] !== '') : ?>
                                                <div class="hero-actions">
                                                    <a
                                                        href="<?php echo esc_url($slide['btn_link']); ?>"
                                                        class="btn hero-btn"
                                                        style="
                                                            background-color: <?php echo esc_attr($button_colors['bg']); ?>;
                                                            border-color: <?php echo esc_attr($button_colors['bg']); ?>;
                                                            color: <?php echo esc_attr($button_colors['text']); ?>;
                                                        "
                                                        onmouseover="
                                                            this.style.backgroundColor='<?php echo esc_js($button_colors['hover']); ?>';
                                                            this.style.borderColor='<?php echo esc_js($button_colors['hover']); ?>';
                                                            this.style.color='<?php echo esc_js($button_colors['text']); ?>';
                                                        "
                                                        onmouseout="
                                                            this.style.backgroundColor='<?php echo esc_js($button_colors['bg']); ?>';
                                                            this.style.borderColor='<?php echo esc_js($button_colors['bg']); ?>';
                                                            this.style.color='<?php echo esc_js($button_colors['text']); ?>';
                                                        "
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                    >
                                                        <span><?php echo esc_html($slide['btn_text']); ?></span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <?php if (count($slides) > 1) : ?>
                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev" aria-label="Slide anterior">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next" aria-label="Próximo slide">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            <?php endif; ?>
        </div>
    </section>
    <?php
}