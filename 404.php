<?php

/**
 * 404 page
 * @package zimed
 */

get_header();
?>

<section class="error-404 text-center">
    <div class="container">
        <?php if (!empty(get_theme_mod('error_404_image'))) : ?>
            <img class="error-404__image img-fluid" src="<?php echo esc_url(get_theme_mod('error_404_image')); ?>" alt="<?php echo esc_attr__('error page image', 'zimed'); ?>">
        <?php endif; ?>
        <h2><?php esc_html_e('Sorry We Can\'t Find That Page!', 'zimed') ?></h2>
        <p><?php esc_html_e('The Page You Requested Could Not Be Found.', 'zimed') ?></p>

        <?php get_search_form(); ?>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="thm-btn"><?php esc_html_e('Back to Home', 'zimed') ?></a>

    </div><!-- /.container -->
</section><!-- /.error-404 -->

<?php
get_footer();
