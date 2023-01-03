<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zimed
 */

?>

<?php if (false == get_theme_mod('footer_custom', false)) : ?>
    <footer class="site-footer">
        <div class="site-footer__bottom">
            <div class="container">
                <?php $zimed_footer_social_settings = get_theme_mod('footer_social_icons'); ?>
                <div class="inner-container <?php echo esc_attr(!empty($zimed_footer_social_settings) ? '' : 'text-center'); ?>">
                    <?php if (!empty($zimed_footer_social_settings)) : ?>
                        <div class="site-footer__social">
                            <?php
                            if (!empty($zimed_footer_social_settings)) :
                                foreach ($zimed_footer_social_settings as $zimed_footer_social_setting) : ?>
                                    <a href="<?php echo esc_url($zimed_footer_social_setting['link_url']); ?>" class="fab <?php echo esc_attr($zimed_footer_social_setting['link_icon']); ?>"></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div><!-- /.site-footer__social -->
                    <?php endif; ?>
                    <?php $zimed_footer_copy_text = !empty(get_theme_mod('footer_copytext')) ? get_theme_mod('footer_copytext') : esc_html__('© copyright 2021 by ', 'zimed') . wp_kses('<a href="#">Layerdrops.com</a>', 'zimed_allowed_tags') ?>
                    <p><?php echo wp_kses($zimed_footer_copy_text, 'zimed_allowed_tags'); ?></p>
                </div><!-- /.inner-container -->
            </div><!-- /.container -->
        </div><!-- /.site-footer__bottom -->
    </footer><!-- /.site-footer -->

<?php endif; ?>

<?php if (true == get_theme_mod('footer_custom', false) && true == post_type_exists('footer')) : ?>

    <?php
    // the query
    $zimed_footer_post_query_args = array(
        'p' => get_theme_mod('footer_custom_post'),
        'post_type' => 'footer',

    );
    $zimed_footer_post_query = new WP_Query($zimed_footer_post_query_args); ?>

    <?php if ($zimed_footer_post_query->have_posts()) : ?>

        <!-- pagination here -->

        <!-- the loop -->
        <?php while ($zimed_footer_post_query->have_posts()) : $zimed_footer_post_query->the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
        <!-- end of the loop -->

        <!-- pagination here -->

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php esc_html__('Sorry, no posts matched your criteria.', 'zimed'); ?></p>
    <?php endif; ?>

<?php endif; ?>


</div><!-- /.page-wrapper -->

<?php if ('on' == get_theme_mod('scroll_to_top', 'off')) : ?>
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa <?php echo esc_attr(get_theme_mod('scroll_to_top_icon', 'fa-angle-up')); ?>"></i></a>
<?php endif; ?>

<div class="side-menu__block">


    <div class="side-menu__block-overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div><!-- /.side-menu__block-overlay -->
    <div class="side-menu__block-inner ">
        <div class="side-menu__top justify-content-between align-items-center">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="main-nav__logo">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) {
                    echo '<img src="' . esc_url($logo[0]) . '" width="' . esc_attr(get_theme_mod('header_logo_width', esc_attr('105'))) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                } else {
                    echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
                } ?>
            </a>
            <a href="#" class="side-menu__toggler side-menu__close-btn"><i class="fa fa-times"></i></a>
        </div><!-- /.side-menu__top -->


        <nav class="mobile-nav__container">
            <!-- content is loading via js -->
        </nav>
        <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
        <div class="side-menu__content">
            <?php
            $zimed_mobile_menu_content = get_theme_mod('zimed_mobile_menu_text'); ?>
            <?php echo wp_kses($zimed_mobile_menu_content, 'zimed_allowed_tags'); ?>
            <?php $zimed_mobile_menu_social_settings = get_theme_mod('mobile_menu_social_icons'); ?>
            <?php if (!empty($zimed_mobile_menu_social_settings)) : ?>
                <div class="side-menu__social">
                    <?php
                    foreach ($zimed_mobile_menu_social_settings as $zimed_mobile_menu_social_setting) : ?>
                        <a href="<?php echo esc_url($zimed_mobile_menu_social_setting['link_url']); ?>" class="fab <?php echo esc_attr($zimed_mobile_menu_social_setting['link_icon']); ?>"></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div><!-- /.side-menu__content -->
    </div><!-- /.side-menu__block-inner -->
</div><!-- /.side-menu__block -->


<?php wp_footer(); ?>

</body>

</html>