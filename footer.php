<?php
if (!defined('ABSPATH')) {
    exit;
}

$cep         = trim((string) get_theme_mod('footer_cep', ''));
$rua         = trim((string) get_theme_mod('footer_rua', ''));
$numero      = trim((string) get_theme_mod('footer_numero', ''));
$complemento = trim((string) get_theme_mod('footer_complemento', ''));
$bairro      = trim((string) get_theme_mod('footer_bairro', ''));
$cidade      = trim((string) get_theme_mod('footer_cidade', ''));
$estado      = trim((string) get_theme_mod('footer_estado', ''));
$horario     = trim((string) get_theme_mod('footer_horario', ''));
$telefone_1  = trim((string) get_theme_mod('footer_telefone_1', ''));
$telefone_2  = trim((string) get_theme_mod('footer_telefone_2', ''));
$email       = trim((string) get_theme_mod('footer_email', ''));

$social_icon_style = get_theme_mod('footer_social_icon_style', 'none');

$socials = array(
    'facebook'  => trim((string) get_theme_mod('footer_social_facebook', '')),
    'instagram' => trim((string) get_theme_mod('footer_social_instagram', '')),
    'linkedin'  => trim((string) get_theme_mod('footer_social_linkedin', '')),
    'x'         => trim((string) get_theme_mod('footer_social_x', '')),
);

$social_icons = array(
    'facebook'  => 'fa-brands fa-facebook-f',
    'instagram' => 'fa-brands fa-instagram',
    'linkedin'  => 'fa-brands fa-linkedin-in',
    'x'         => 'fa-brands fa-x-twitter',
);

$social_labels = array(
    'facebook'  => 'Facebook',
    'instagram' => 'Instagram',
    'linkedin'  => 'LinkedIn',
    'x'         => 'X',
);

$line_1_parts = array_filter(array($rua, $numero));
$line_2_parts = array_filter(array($complemento, $bairro));
$line_3_parts = array_filter(array($cidade, $estado));

$full_address_lines = array_filter(array(
    !empty($line_1_parts) ? implode(', ', $line_1_parts) : '',
    !empty($line_2_parts) ? implode(' - ', $line_2_parts) : '',
    !empty($line_3_parts) ? implode(' - ', $line_3_parts) : '',
    $cep,
));

$social_links = array();

foreach ($socials as $network => $username) {
    if (empty($username) || empty($social_icons[$network])) {
        continue;
    }

    $url = function_exists('theme_get_social_url') ? theme_get_social_url($network, $username) : '';

    if (empty($url)) {
        continue;
    }

    $social_links[$network] = array(
        'url'   => $url,
        'icon'  => $social_icons[$network],
        'label' => isset($social_labels[$network]) ? $social_labels[$network] : ucfirst($network),
    );
}

$has_contact = !empty($telefone_1) || !empty($telefone_2) || !empty($email);
?>

<footer class="site-footer">
    <div class="container">
        <div class="row footer-top">
            <div class="col-md-4 mb-4">
                <h5><?php esc_html_e('Endereço', 'amac-wp'); ?></h5>

                <?php if (!empty($full_address_lines)) : ?>
                    <address class="footer-address">
                        <?php foreach ($full_address_lines as $line) : ?>
                            <div><?php echo esc_html($line); ?></div>
                        <?php endforeach; ?>
                    </address>
                <?php endif; ?>
            </div>

            <div class="col-md-4 mb-4">
                <h5><?php esc_html_e('Atendimento', 'amac-wp'); ?></h5>

                <?php if (!empty($horario)) : ?>
                    <div class="footer-horario">
                        <?php echo nl2br(esc_html($horario)); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-4 mb-4">
                <h5><?php esc_html_e('Contato', 'amac-wp'); ?></h5>

                <?php if ($has_contact) : ?>
                    <div class="footer-contact">
                        <?php if (!empty($telefone_1)) : ?>
                            <div class="footer-contact-item">
                                <a href="tel:<?php echo esc_attr(preg_replace('/\D+/', '', $telefone_1)); ?>">
                                    <?php echo esc_html($telefone_1); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($telefone_2)) : ?>
                            <div class="footer-contact-item">
                                <a href="tel:<?php echo esc_attr(preg_replace('/\D+/', '', $telefone_2)); ?>">
                                    <?php echo esc_html($telefone_2); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($email)) : ?>
                            <div class="footer-contact-item">
                                <a href="mailto:<?php echo antispambot(esc_attr($email)); ?>">
                                    <?php echo antispambot(esc_html($email)); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($social_links)) : ?>
                    <div class="footer-social footer-social-<?php echo esc_attr($social_icon_style); ?>">
                        <?php foreach ($social_links as $network => $social) : ?>
                            <a
                                class="social-link social-<?php echo esc_attr($network); ?>"
                                href="<?php echo esc_url($social['url']); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="<?php echo esc_attr($social['label']); ?>"
                                title="<?php echo esc_attr($social['label']); ?>"
                            >
                                <i class="<?php echo esc_attr($social['icon']); ?>" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <hr>

        <div class="row footer-bottom">
            <div class="col-12 footer-copy text-center">
                <p class="mb-0">
                    &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>.
                    <?php esc_html_e('Todos os direitos reservados.', 'amac-wp'); ?>
                </p>
            </div>

            <?php if (has_nav_menu('footer')) : ?>
                <div class="col-12 footer-menu-wrap text-center">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>