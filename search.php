<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zimed
 */


get_header();
?>


<section class="blog-sidebar blog-one">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr((is_active_sidebar('sidebar-1')) ? 'col-lg-8' : 'col-lg-12'); ?>">
                <div class="row">
                    <?php if (have_posts()) : ?>

                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                        ?>
                            <div class="col-lg-12">
                                <?php get_template_part('template-parts/content', 'search'); ?>
                            </div><!-- /.col-lg-12 -->
                        <?php endwhile; ?>

                        <div class="col-lg-12">
                            <div class="post-pagination">
                                <?php zimed_pagination(); ?>
                            </div><!-- /.blog-post-pagination -->
                        </div><!-- /.col-lg-12 -->

                    <?php else : ?>
                        <?php get_template_part('template-parts/content', 'none'); ?>
                    <?php endif; ?>
                </div><!-- /.row -->


            </div><!-- /.col-lg-8 -->
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <div class="col-lg-4">
                    <?php get_sidebar(); ?>
                </div><!-- /.col-lg-4 -->
            <?php endif; ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-details -->

<?php
get_footer();
