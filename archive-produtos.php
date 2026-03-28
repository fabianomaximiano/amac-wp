<?php
get_header();
?>

<?php if (function_exists('chaveiro_render_produtos_archive_content')) : ?>
    <?php chaveiro_render_produtos_archive_content(); ?>
<?php endif; ?>

<?php
get_footer();