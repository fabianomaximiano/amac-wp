<?php
if (!defined('ABSPATH')) {
    exit;
}

if (class_exists('WP_Customize_Control') && !class_exists('Theme_Customizer_Section_Title_Control')) {
    class Theme_Customizer_Section_Title_Control extends WP_Customize_Control
    {
        public $type = 'theme_section_title';

        public function render_content()
        {
            $label = isset($this->label) && is_string($this->label) ? $this->label : '';
            $description = isset($this->description) && is_string($this->description) ? $this->description : '';

            if ($label === '' && $description === '') {
                return;
            }

            echo '<div class="theme-customizer-group-title">';

            if ($label !== '') {
                echo '<span class="theme-customizer-group-title-text">' . esc_html($label) . '</span>';
            }

            if ($description !== '') {
                echo '<span class="theme-customizer-group-description">' . esc_html($description) . '</span>';
            }

            echo '</div>';
        }
    }
}

/**
 * Registra configurações do rodapé no Customizer
 */
function theme_customize_footer($wp_customize)
{
    $wp_customize->add_section('theme_footer_section', array(
        'title'       => __('Rodapé', 'amac-wp'),
        'priority'    => 160,
        'description' => __('Configure as informações, cores e redes sociais do rodapé.', 'amac-wp'),
    ));

    /*
    |--------------------------------------------------------------------------
    | Cores do rodapé
    |--------------------------------------------------------------------------
    */
    $wp_customize->add_setting('theme_footer_heading_colors', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_footer_heading_colors',
        array(
            'label'       => __('Cores do Rodapé', 'amac-wp'),
            'description' => __('Defina as cores principais do fundo, textos, links e ícones do rodapé.', 'amac-wp'),
            'section'     => 'theme_footer_section',
            'settings'    => 'theme_footer_heading_colors',
        )
    ));

    $footer_color_controls = array(
        'footer_bg_color' => array(
            'label'   => __('Cor de fundo do rodapé', 'amac-wp'),
            'default' => '#f5f5f5',
        ),
        'footer_text_color' => array(
            'label'   => __('Cor do texto', 'amac-wp'),
            'default' => '#111111',
        ),
        'footer_heading_color' => array(
            'label'   => __('Cor dos títulos', 'amac-wp'),
            'default' => '#111111',
        ),
        'footer_link_color' => array(
            'label'   => __('Cor dos links', 'amac-wp'),
            'default' => '#0d6efd',
        ),
        'footer_hr_color' => array(
            'label'   => __('Cor da linha divisória', 'amac-wp'),
            'default' => '#d9d9d9',
        ),
    );

    foreach ($footer_color_controls as $setting_id => $config) {
        $wp_customize->add_setting($setting_id, array(
            'default'           => $config['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $setting_id,
            array(
                'label'   => $config['label'],
                'section' => 'theme_footer_section',
            )
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Cores dos ícones sociais
    |--------------------------------------------------------------------------
    */
    $wp_customize->add_setting('theme_footer_heading_icon_colors', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_footer_heading_icon_colors',
        array(
            'label'       => __('Cores dos Ícones Sociais', 'amac-wp'),
            'description' => __('Controle a cor do ícone, fundo, borda e efeito ao passar o mouse.', 'amac-wp'),
            'section'     => 'theme_footer_section',
            'settings'    => 'theme_footer_heading_icon_colors',
        )
    ));

    $icon_color_controls = array(
        'footer_icon_color' => array(
            'label'   => __('Cor dos ícones', 'amac-wp'),
            'default' => '#111111',
        ),
        'footer_icon_bg_color' => array(
            'label'   => __('Cor de fundo dos ícones', 'amac-wp'),
            'default' => '#ffffff',
        ),
        'footer_icon_border_color' => array(
            'label'   => __('Cor da borda dos ícones', 'amac-wp'),
            'default' => '#d9d9d9',
        ),
        'footer_icon_hover_color' => array(
            'label'   => __('Cor dos ícones no hover', 'amac-wp'),
            'default' => '#ffffff',
        ),
        'footer_icon_hover_bg_color' => array(
            'label'   => __('Cor de fundo dos ícones no hover', 'amac-wp'),
            'default' => '#0d6efd',
        ),
    );

    foreach ($icon_color_controls as $setting_id => $config) {
        $wp_customize->add_setting($setting_id, array(
            'default'           => $config['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $setting_id,
            array(
                'label'   => $config['label'],
                'section' => 'theme_footer_section',
            )
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Endereço
    |--------------------------------------------------------------------------
    */
    $wp_customize->add_setting('theme_footer_heading_endereco', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_footer_heading_endereco',
        array(
            'label'       => __('Endereço', 'amac-wp'),
            'description' => __('Preencha os dados do endereço comercial. O CEP ajuda a completar automaticamente os campos principais.', 'amac-wp'),
            'section'     => 'theme_footer_section',
            'settings'    => 'theme_footer_heading_endereco',
        )
    ));

    $wp_customize->add_setting('footer_cep', array(
        'default'           => '',
        'sanitize_callback' => 'theme_sanitize_cep',
    ));

    $wp_customize->add_control('footer_cep', array(
        'label'       => __('CEP', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '00000-000',
            'maxlength'   => 9,
            'class'       => 'theme-field theme-cep-field',
        ),
        'description' => __('Digite o CEP e aguarde o preenchimento automático de rua, bairro, cidade e estado.', 'amac-wp'),
    ));

    $wp_customize->add_setting('footer_rua', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_rua', array(
        'label'       => __('Rua / Logradouro', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ex.: Rua Sara Newton',
            'class'       => 'theme-field',
        ),
    ));

    $wp_customize->add_setting('footer_numero', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_numero', array(
        'label'       => __('Número', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ex.: 103',
            'class'       => 'theme-field',
        ),
    ));

    $wp_customize->add_setting('footer_complemento', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_complemento', array(
        'label'       => __('Complemento', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ex.: casa 1, sala 2, loja A',
            'class'       => 'theme-field',
        ),
        'description' => __('Campo opcional.', 'amac-wp'),
    ));

    $wp_customize->add_setting('footer_bairro', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_bairro', array(
        'label'       => __('Bairro', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ex.: Jardim Boa Vista',
            'class'       => 'theme-field',
        ),
    ));

    $wp_customize->add_setting('footer_cidade', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_cidade', array(
        'label'       => __('Cidade', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ex.: São Paulo',
            'class'       => 'theme-field',
        ),
    ));

    $wp_customize->add_setting('footer_estado', array(
        'default'           => '',
        'sanitize_callback' => 'theme_sanitize_uf',
    ));

    $wp_customize->add_control('footer_estado', array(
        'label'       => __('Estado', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ex.: SP',
            'maxlength'   => 2,
            'class'       => 'theme-field',
        ),
    ));

    /*
    |--------------------------------------------------------------------------
    | Atendimento
    |--------------------------------------------------------------------------
    */
    $wp_customize->add_setting('theme_footer_heading_atendimento', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_footer_heading_atendimento',
        array(
            'label'       => __('Atendimento', 'amac-wp'),
            'description' => __('Informe horários de funcionamento ou disponibilidade de plantão.', 'amac-wp'),
            'section'     => 'theme_footer_section',
            'settings'    => 'theme_footer_heading_atendimento',
        )
    ));

    $wp_customize->add_setting('footer_horario', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_horario', array(
        'label'       => __('Horário de atendimento', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'placeholder' => "Ex.:\nSegunda à Sexta: 08h às 18h\nSábado: 08h às 13h\nEmergências: 24 horas",
            'class'       => 'theme-field',
        ),
    ));

    /*
    |--------------------------------------------------------------------------
    | Contato
    |--------------------------------------------------------------------------
    */
    $wp_customize->add_setting('theme_footer_heading_contato', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_footer_heading_contato',
        array(
            'label'       => __('Contato', 'amac-wp'),
            'description' => __('Preencha os principais canais de contato exibidos no rodapé.', 'amac-wp'),
            'section'     => 'theme_footer_section',
            'settings'    => 'theme_footer_heading_contato',
        )
    ));

    $wp_customize->add_setting('footer_telefone_1', array(
        'default'           => '',
        'sanitize_callback' => 'theme_sanitize_phone',
    ));

    $wp_customize->add_control('footer_telefone_1', array(
        'label'       => __('Telefone 1', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '(11) 99999-9999',
            'class'       => 'theme-field theme-phone-field',
        ),
    ));

    $wp_customize->add_setting('footer_telefone_2', array(
        'default'           => '',
        'sanitize_callback' => 'theme_sanitize_phone',
    ));

    $wp_customize->add_control('footer_telefone_2', array(
        'label'       => __('Telefone 2', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '(11) 3333-3333',
            'class'       => 'theme-field theme-phone-field',
        ),
    ));

    $wp_customize->add_setting('footer_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('footer_email', array(
        'label'       => __('E-mail', 'amac-wp'),
        'section'     => 'theme_footer_section',
        'type'        => 'email',
        'input_attrs' => array(
            'placeholder' => 'contato@dominio.com.br',
            'class'       => 'theme-field',
        ),
    ));

    /*
    |--------------------------------------------------------------------------
    | Redes sociais
    |--------------------------------------------------------------------------
    */
    $wp_customize->add_setting('theme_footer_heading_social', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Theme_Customizer_Section_Title_Control(
        $wp_customize,
        'theme_footer_heading_social',
        array(
            'label'       => __('Redes sociais', 'amac-wp'),
            'description' => __('Informe somente o usuário ou identificador da rede social.', 'amac-wp'),
            'section'     => 'theme_footer_section',
            'settings'    => 'theme_footer_heading_social',
        )
    ));

    $social_fields = array(
        'footer_social_facebook' => array(
            'label'       => __('Facebook (usuário)', 'amac-wp'),
            'placeholder' => 'Ex.: suaempresa',
            'sanitize'    => 'theme_sanitize_social_facebook',
        ),
        'footer_social_instagram' => array(
            'label'       => __('Instagram (usuário)', 'amac-wp'),
            'placeholder' => 'Ex.: suaempresa',
            'sanitize'    => 'theme_sanitize_social_instagram',
        ),
        'footer_social_linkedin' => array(
            'label'       => __('LinkedIn (usuário)', 'amac-wp'),
            'placeholder' => 'Ex.: in/seuperfil ou company/suaempresa',
            'sanitize'    => 'theme_sanitize_social_linkedin',
        ),
        'footer_social_x' => array(
            'label'       => __('X (usuário)', 'amac-wp'),
            'placeholder' => 'Ex.: suaempresa',
            'sanitize'    => 'theme_sanitize_social_x',
        ),
    );

    foreach ($social_fields as $field_id => $field) {
        $wp_customize->add_setting($field_id, array(
            'default'           => '',
            'sanitize_callback' => $field['sanitize'],
        ));

        $wp_customize->add_control($field_id, array(
            'label'       => $field['label'],
            'section'     => 'theme_footer_section',
            'type'        => 'text',
            'input_attrs' => array(
                'placeholder' => $field['placeholder'],
                'class'       => 'theme-field',
            ),
        ));
    }

    $wp_customize->add_setting('footer_social_icon_style', array(
        'default'           => 'none',
        'sanitize_callback' => 'theme_sanitize_social_icon_style',
    ));

    $wp_customize->add_control('footer_social_icon_style', array(
        'label'   => __('Estilo dos ícones sociais', 'amac-wp'),
        'section' => 'theme_footer_section',
        'type'    => 'select',
        'choices' => array(
            'none'           => __('Somente ícone', 'amac-wp'),
            'circle'         => __('Círculo', 'amac-wp'),
            'square'         => __('Quadrado', 'amac-wp'),
            'rounded-square' => __('Quadrado com cantos arredondados', 'amac-wp'),
        ),
    ));
}
add_action('customize_register', 'theme_customize_footer');

function theme_sanitize_cep($value)
{
    $value = preg_replace('/[^0-9]/', '', (string) $value);

    if (strlen($value) > 8) {
        $value = substr($value, 0, 8);
    }

    if (strlen($value) === 8) {
        $value = substr($value, 0, 5) . '-' . substr($value, 5);
    }

    return $value;
}

function theme_sanitize_uf($value)
{
    $value = strtoupper(sanitize_text_field($value));
    $value = preg_replace('/[^A-Z]/', '', $value);
    return substr($value, 0, 2);
}

function theme_sanitize_phone($value)
{
    $value = sanitize_text_field($value);
    return preg_replace('/[^0-9\(\)\-\+\s]/', '', $value);
}

function theme_sanitize_social_facebook($value)
{
    return theme_sanitize_social_username($value, 'facebook');
}

function theme_sanitize_social_instagram($value)
{
    return theme_sanitize_social_username($value, 'instagram');
}

function theme_sanitize_social_linkedin($value)
{
    return theme_sanitize_social_username($value, 'linkedin');
}

function theme_sanitize_social_x($value)
{
    return theme_sanitize_social_username($value, 'x');
}

function theme_sanitize_social_username($value, $network = '')
{
    $value = sanitize_text_field($value);
    $value = trim($value);

    if ($value === '') {
        return '';
    }

    $value = html_entity_decode($value, ENT_QUOTES, 'UTF-8');

    if (filter_var($value, FILTER_VALIDATE_URL)) {
        $parts = wp_parse_url($value);
        if (!empty($parts['path']) && is_string($parts['path'])) {
            $value = trim($parts['path'], '/');
        } else {
            $value = '';
        }
    }

    $value = preg_replace('#^https?://#i', '', $value);
    $value = preg_replace('#^www\.#i', '', $value);
    $value = trim($value);
    $value = ltrim($value, '@/');
    $value = preg_replace('#\?.*$#', '', $value);
    $value = preg_replace('#\#.*$#', '', $value);

    if ($network === 'facebook') {
        $value = preg_replace('#^facebook\.com/#i', '', $value);
    }

    if ($network === 'instagram') {
        $value = preg_replace('#^instagram\.com/#i', '', $value);
    }

    if ($network === 'x') {
        $value = preg_replace('#^(x\.com|twitter\.com)/#i', '', $value);
    }

    if ($network === 'linkedin') {
        $value = preg_replace('#^linkedin\.com/#i', '', $value);

        if (preg_match('#^(in|company|school|showcase)/#i', $value)) {
            $segments = explode('/', trim($value, '/'));
            $segments = array_values(array_filter($segments));
            return implode('/', array_slice($segments, 0, 2));
        }

        return trim($value, '/');
    }

    $segments = explode('/', trim($value, '/'));
    $segments = array_values(array_filter($segments));

    return isset($segments[0]) ? $segments[0] : '';
}

function theme_sanitize_social_icon_style($value)
{
    $allowed = array('none', 'circle', 'square', 'rounded-square');
    return in_array($value, $allowed, true) ? $value : 'none';
}

function theme_footer_customizer_styles()
{
    ?>
    <style>
        #sub-accordion-section-theme_footer_section {
            background: #f3f4f6;
            padding: 0 6px 8px;
            box-sizing: border-box;
        }

        #sub-accordion-section-theme_footer_section .customize-control {
            margin-bottom: 5px;
            padding: 7px 8px;
            background: #ffffff;
            border: 1px solid #d9dadd;
            border-radius: 7px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.018);
            box-sizing: border-box;
        }

        #sub-accordion-section-theme_footer_section .customize-control:last-child {
            margin-bottom: 0;
        }

        #sub-accordion-section-theme_footer_section .customize-control label {
            display: block;
            margin-bottom: 1px;
        }

        #sub-accordion-section-theme_footer_section .customize-control-title {
            font-size: 11.5px;
            font-weight: 600;
            color: #1d2327;
            margin-bottom: 2px;
            line-height: 1.22;
        }

        #sub-accordion-section-theme_footer_section .description {
            margin-top: 2px;
            color: #646970;
            font-style: normal;
            font-size: 10px;
            line-height: 1.28;
        }

        #sub-accordion-section-theme_footer_section .customize-control-checkbox {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        #sub-accordion-section-theme_footer_section .customize-control-checkbox label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin: 0;
            font-size: 11.5px;
            font-weight: 500;
            color: #1d2327;
        }

        #sub-accordion-section-theme_footer_section .customize-control-checkbox input[type="checkbox"] {
            margin: 0;
        }

        #sub-accordion-section-theme_footer_section input[type="text"],
        #sub-accordion-section-theme_footer_section input[type="email"],
        #sub-accordion-section-theme_footer_section input[type="url"],
        #sub-accordion-section-theme_footer_section input[type="number"],
        #sub-accordion-section-theme_footer_section textarea,
        #sub-accordion-section-theme_footer_section select {
            width: 92%;
            margin: 0 auto;
            display: block;
            min-height: 32px;
            border-radius: 6px;
            border: 1px solid #c3c4c7;
            padding: 5px 8px;
            box-sizing: border-box;
            background: #fff;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
            font-size: 11.5px;
            line-height: 1.28;
        }

        #sub-accordion-section-theme_footer_section textarea {
            min-height: 72px;
            resize: vertical;
        }

        #sub-accordion-section-theme_footer_section input[type="text"]:focus,
        #sub-accordion-section-theme_footer_section input[type="email"]:focus,
        #sub-accordion-section-theme_footer_section input[type="url"]:focus,
        #sub-accordion-section-theme_footer_section input[type="number"]:focus,
        #sub-accordion-section-theme_footer_section textarea:focus,
        #sub-accordion-section-theme_footer_section select:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: 0;
            background: #fff;
        }

        #sub-accordion-section-theme_footer_section .customize-control-theme_section_title {
            padding: 0;
            margin: 10px 0 4px;
            background: transparent;
            border: 0;
            box-shadow: none;
        }

        #sub-accordion-section-theme_footer_section .customize-control-theme_section_title:first-of-type {
            margin-top: 1px;
        }

        #sub-accordion-section-theme_footer_section .wp-picker-container {
            display: block;
        }

        #sub-accordion-section-theme_footer_section .wp-picker-container .wp-color-result.button {
            width: 92%;
            height: 32px;
            min-height: 32px;
            border-radius: 6px;
            margin: 0 auto 5px;
            display: block;
            box-sizing: border-box;
        }

        #sub-accordion-section-theme_footer_section .wp-picker-container .wp-color-result-text {
            line-height: 30px;
            font-size: 10.5px;
        }

        #sub-accordion-section-theme_footer_section .wp-picker-holder {
            margin-top: 3px;
            margin-left: 4%;
        }

        #sub-accordion-section-theme_footer_section .customize-control .customize-control-notifications-container {
            margin-bottom: 3px;
        }

        .theme-customizer-group-title {
            padding: 0 1px 1px;
        }

        .theme-customizer-group-title-text {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: #1d2327;
            margin-bottom: 1px;
            line-height: 1.16;
        }

        .theme-customizer-group-description {
            display: block;
            color: #646970;
            font-size: 9.8px;
            line-height: 1.26;
        }

        .theme-cep-status {
            width: 92%;
            margin: 4px auto 0;
            font-size: 9.8px;
            line-height: 1.26;
        }
    </style>
    <?php
}
add_action('customize_controls_print_styles', 'theme_footer_customizer_styles');

function theme_footer_customizer_scripts()
{
    ?>
    <script>
        (function () {
            function onlyDigits(value) {
                return (value || '').replace(/\D/g, '');
            }

            function formatCep(value) {
                value = onlyDigits(value).substring(0, 8);

                if (value.length > 5) {
                    return value.replace(/^(\d{5})(\d{1,3})$/, '$1-$2');
                }

                return value;
            }

            function formatPhone(value) {
                value = onlyDigits(value).substring(0, 11);

                if (value.length <= 10) {
                    return value.replace(/^(\d{0,2})(\d{0,4})(\d{0,4}).*/, function (_, a, b, c) {
                        let out = '';
                        if (a) out += '(' + a;
                        if (a.length === 2) out += ') ';
                        if (b) out += b;
                        if (c) out += '-' + c;
                        return out;
                    });
                }

                return value.replace(/^(\d{0,2})(\d{0,5})(\d{0,4}).*/, function (_, a, b, c) {
                    let out = '';
                    if (a) out += '(' + a;
                    if (a.length === 2) out += ') ';
                    if (b) out += b;
                    if (c) out += '-' + c;
                    return out;
                });
            }

            function getControl(settingId) {
                return document.querySelector('#customize-control-' + settingId);
            }

            function getControlInput(settingId) {
                const control = getControl(settingId);
                if (!control) return null;
                return control.querySelector('input, textarea, select');
            }

            function setSettingValue(settingId, value) {
                const input = getControlInput(settingId);

                if (!input) {
                    return;
                }

                input.value = value;
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }

            function showCepStatus(message, type) {
                const control = getControl('footer_cep');
                if (!control) return;

                let status = control.querySelector('.theme-cep-status');

                if (!status) {
                    status = document.createElement('div');
                    status.className = 'theme-cep-status';
                    control.appendChild(status);
                }

                status.textContent = message;
                status.style.color = type === 'error' ? '#b32d2e' : '#2271b1';
            }

            function sanitizeSocialValue(value, network) {
                value = (value || '').trim();
                value = value.replace(/^https?:\/\//i, '');
                value = value.replace(/^www\./i, '');
                value = value.replace(/^@+/, '');
                value = value.replace(/^\/+/, '');
                value = value.replace(/\?.*$/, '');
                value = value.replace(/\#.*$/, '');

                if (network === 'facebook') {
                    value = value.replace(/^facebook\.com\//i, '');
                }

                if (network === 'instagram') {
                    value = value.replace(/^instagram\.com\//i, '');
                }

                if (network === 'x') {
                    value = value.replace(/^(x\.com|twitter\.com)\//i, '');
                }

                if (network === 'linkedin') {
                    value = value.replace(/^linkedin\.com\//i, '');

                    if (/^(in|company|school|showcase)\//i.test(value)) {
                        const segments = value.split('/').filter(Boolean);
                        return segments.slice(0, 2).join('/');
                    }

                    return value.replace(/^\/+|\/+$/g, '');
                }

                const segments = value.split('/').filter(Boolean);
                return segments.length ? segments[0] : '';
            }

            async function lookupCep(rawValue) {
                const cep = onlyDigits(rawValue);

                if (cep.length !== 8) {
                    showCepStatus('CEP incompleto. Use o formato 00000-000.', 'error');
                    return;
                }

                showCepStatus('Buscando endereço...', 'info');

                try {
                    const response = await fetch('https://viacep.com.br/ws/' + cep + '/json/');
                    const data = await response.json();

                    if (!data || data.erro) {
                        showCepStatus('CEP não encontrado. Confira o número digitado.', 'error');
                        return;
                    }

                    setSettingValue('footer_rua', data.logradouro || '');
                    setSettingValue('footer_bairro', data.bairro || '');
                    setSettingValue('footer_cidade', data.localidade || '');
                    setSettingValue('footer_estado', data.uf || '');

                    showCepStatus('Endereço preenchido com sucesso. Revise número e complemento.', 'info');
                } catch (error) {
                    console.error('Erro ao consultar CEP:', error);
                    showCepStatus('Não foi possível consultar o CEP agora. Tente novamente.', 'error');
                }
            }

            document.addEventListener('input', function (event) {
                const target = event.target;

                if (!(target instanceof HTMLInputElement)) {
                    return;
                }

                if (target.matches('#customize-control-footer_cep input')) {
                    target.value = formatCep(target.value);
                }

                if (
                    target.matches('#customize-control-footer_telefone_1 input') ||
                    target.matches('#customize-control-footer_telefone_2 input')
                ) {
                    target.value = formatPhone(target.value);
                }
            }, true);

            document.addEventListener('focusout', function (event) {
                const target = event.target;

                if (!(target instanceof HTMLInputElement)) {
                    return;
                }

                if (target.matches('#customize-control-footer_cep input')) {
                    lookupCep(target.value);
                }

                const socialMap = {
                    '#customize-control-footer_social_facebook input': 'facebook',
                    '#customize-control-footer_social_instagram input': 'instagram',
                    '#customize-control-footer_social_linkedin input': 'linkedin',
                    '#customize-control-footer_social_x input': 'x'
                };

                Object.keys(socialMap).forEach(function (selector) {
                    if (target.matches(selector)) {
                        target.value = sanitizeSocialValue(target.value, socialMap[selector]);
                        target.dispatchEvent(new Event('input', { bubbles: true }));
                        target.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            }, true);
        })();
    </script>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'theme_footer_customizer_scripts');

function theme_footer_dynamic_css()
{
    $footer_bg_color            = get_theme_mod('footer_bg_color', '#f5f5f5');
    $footer_text_color          = get_theme_mod('footer_text_color', '#111111');
    $footer_heading_color       = get_theme_mod('footer_heading_color', '#111111');
    $footer_link_color          = get_theme_mod('footer_link_color', '#0d6efd');
    $footer_hr_color            = get_theme_mod('footer_hr_color', '#d9d9d9');
    $footer_icon_color          = get_theme_mod('footer_icon_color', '#111111');
    $footer_icon_bg_color       = get_theme_mod('footer_icon_bg_color', '#ffffff');
    $footer_icon_border_color   = get_theme_mod('footer_icon_border_color', '#d9d9d9');
    $footer_icon_hover_color    = get_theme_mod('footer_icon_hover_color', '#ffffff');
    $footer_icon_hover_bg_color = get_theme_mod('footer_icon_hover_bg_color', '#0d6efd');
    ?>
    <style id="theme-footer-dynamic-css">
        :root {
            --theme-footer-bg: <?php echo esc_html($footer_bg_color); ?>;
            --theme-footer-text: <?php echo esc_html($footer_text_color); ?>;
            --theme-footer-heading: <?php echo esc_html($footer_heading_color); ?>;
            --theme-footer-link: <?php echo esc_html($footer_link_color); ?>;
            --theme-footer-hr: <?php echo esc_html($footer_hr_color); ?>;
            --theme-footer-icon: <?php echo esc_html($footer_icon_color); ?>;
            --theme-footer-icon-bg: <?php echo esc_html($footer_icon_bg_color); ?>;
            --theme-footer-icon-border: <?php echo esc_html($footer_icon_border_color); ?>;
            --theme-footer-icon-hover: <?php echo esc_html($footer_icon_hover_color); ?>;
            --theme-footer-icon-hover-bg: <?php echo esc_html($footer_icon_hover_bg_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'theme_footer_dynamic_css', 99);

function theme_get_social_url($network, $username)
{
    $username = theme_sanitize_social_username($username, $network);

    if ($username === '') {
        return '';
    }

    if ($network === 'linkedin') {
        if (preg_match('#^(in|company|school|showcase)/#i', $username)) {
            return esc_url('https://www.linkedin.com/' . trim($username, '/') . '/');
        }

        return esc_url('https://www.linkedin.com/in/' . trim($username, '/') . '/');
    }

    $base_urls = array(
        'facebook'  => 'https://www.facebook.com/',
        'instagram' => 'https://www.instagram.com/',
        'x'         => 'https://x.com/',
    );

    if (!isset($base_urls[$network])) {
        return '';
    }

    return esc_url($base_urls[$network] . trim($username, '/') . '/');
}