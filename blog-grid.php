<?php

/**
 * Template Name: Blog Grid Layout
 *
 * Page Template File
 *
 * @package zimed
 */

get_header();
?>

<section class="blog-one blog-one__grid">
    <div class="container">
        <div class="row">
            <?php
            $zimed_default_posts_per_page = get_option('posts_per_page');
            $zimed_blog_grid_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $zimed_blog_grid_query = new WP_Query(array(
                'post_type' => 'post',
                'paged'          => $zimed_blog_grid_paged,
                'posts_per_page' => $zimed_default_posts_per_page,
            ));
            ?>
            <?php if ($zimed_blog_grid_query->have_posts()) : ?>

                <?php
                /* Start the Loop */
                while ($zimed_blog_grid_query->have_posts()) :
                    $zimed_blog_grid_query->the_post();
                    /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                ?>

                    <div class="col-lg-4 col-md-6">
                        <div id="post-<?php the_ID(); ?>" <?php post_class('blog-one__single'); ?>>
                            <div class="blog-one__image">
                                <?php zimed_post_thumbnail('zimed_core_350x289'); ?>
                            </div><!-- /.blog-one__image -->
                            <div class="blog-one__content">
                                <ul class="blog-one__meta list-unstyled">
                                    <li><a href="#"><i class="far fa-clock"></i> <?php the_time('d') ?> <?php the_time('F') ?></a></li>
                                    <li><?php zimed_comments_meta('blog-one'); ?></li>
                                </ul><!-- /.blog-one__meta list-unstyled -->
                                <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                                <a href="<?php echo get_the_permalink(); ?>" class="blog-one__link"><i class="zimed-icon-right-arrow"></i></a>
                                <!-- /.blog-one__link -->
                            </div><!-- /.blog-one__content -->
                        </div><!-- /.blog-one__single -->
                    </div><!-- /.col-lg-4 -->

                <?php endwhile; ?>
                <div class="col-lg-12">
                    <div class="post-pagination">
                        <?php zimed_custom_query_pagination($zimed_blog_grid_paged, $zimed_blog_grid_query->max_num_pages); ?>
                    </div><!-- /.blog-post-pagination -->
                </div><!-- /.col-lg-12 -->
            <?php else : ?>
                <div class="col-lg-12">
                    <?php get_template_part('template-parts/content', 'none'); ?>
                </div><!-- /.col-lg-12 -->
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>


        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-one -->

<?php get_footer(); ?>