<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zimed
 */

?>
<div id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class('blog-details__content')); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="blog-details__image">
            <?php wp_kses(zimed_post_thumbnail('zimed_core_770x457'), 'zimed_allowed_tags'); ?>
        </div><!-- /.blog-details__image -->
    <?php endif; ?>

    <ul class="blog-one__meta list-unstyled">
        <li><?php zimed_posted_by('blog-one'); ?></li>
        <li><?php zimed_comments_meta('blog-one'); ?></li>
    </ul><!-- /.blog-one__meta list-unstyled -->

    <?php the_content(); ?>
    <div class="clear-both"></div>
    <?php wp_link_pages(); ?>


</div><!-- /.blog-details__content -->

<div class="blog-details__bottom d-flex justify-content-between">
    <?php
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list(esc_html__(' ', 'zimed'));
    if ($categories_list) {
        /* translators: 1: list of categories. */
        printf('<p class="blog-details__tags"><span class="cat-links">' . esc_html__('Posted in %1$s', 'zimed') . '</span></p>', $categories_list); // WPCS: XSS OK.
    }

    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'zimed'));
    if ($tags_list) {
        /* translators: 1: list of tags. */
        printf('<p class="blog-details__tags"><span class="tags-links">' . esc_html__('Tagged %1$s', 'zimed') . '</span></p>', $tags_list); // WPCS: XSS OK.
    }
    ?>
</div><!-- /.blog-details__bottom -->