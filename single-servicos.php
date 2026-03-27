<?php
get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        if (function_exists('chaveiro_render_servicos_archive_content')) {
            chaveiro_render_servicos_archive_content();
        }

    endwhile;
endif;

get_footer();