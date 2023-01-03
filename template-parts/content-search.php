<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zimed
 */

?>
<div id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class('blog-one__single')); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="blog-one__image">
        <?php wp_kses(zimed_post_thumbnail('zimed_core_770x457'), 'zimed_allowed_tags'); ?>
    </div><!-- /.blog-one__image -->
    <?php endif; ?>

    <div class="blog-one__content">
        <ul class="blog-one__meta list-unstyled">
            <li><?php zimed_posted_by('blog-one'); ?></li>
            <li><?php zimed_comments_meta('blog-one'); ?></li>
        </ul><!-- /.blog-one__meta list-unstyled -->
        <h3 class="blog-one__title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3><!-- /.blog-one__title -->
        <p><?php echo strip_shortcodes( zimed_excerpt( 65, false ) ); ?></p>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="thm-btn blog-one__btn"><?php esc_html_e('Read More', 'zimed'); ?></a>
        <!-- /.blog-one__btn -->
    </div><!-- /.blog-one__content -->
</div><!-- /.blog-one__single -->