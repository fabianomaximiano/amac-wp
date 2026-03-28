<?php
get_header();

if (have_posts()) :
    $tax_query = new WP_Query([
        'post_type'      => 'produtos',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => [
            'menu_order' => 'ASC',
            'date'       => 'ASC',
        ],
        'tax_query'      => [
            [
                'taxonomy' => 'categoria_produto',
                'field'    => 'term_id',
                'terms'    => get_queried_object_id(),
            ],
        ],
    ]);

    if (function_exists('chaveiro_render_produtos_archive_content')) {
        chaveiro_render_produtos_archive_content($tax_query);
    }

    wp_reset_postdata();
else :
    if (function_exists('chaveiro_render_produtos_archive_content')) {
        chaveiro_render_produtos_archive_content();
    }
endif;

get_footer();