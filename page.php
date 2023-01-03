<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zimed
 */

get_header();
?>

<section class="blog-details">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr((is_active_sidebar('sidebar-1')) ? 'col-lg-8' : 'col-lg-12'); ?>">
				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', 'single');
					the_post_navigation(array(
						'prev_text'                  => wp_kses('<span>' . __('Previous Page', 'zimed') . '</span> %title', 'zimed_allowed_tags'),
						'next_text'                  => wp_kses('<span>' . __('Next Page', 'zimed') . '</span> %title', 'zimed_allowed_tags'),
					));

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
			<?php if (is_active_sidebar('sidebar-1')) : ?>
				<div class="col-lg-4">
					<?php get_sidebar(); ?>
				</div><!-- /.col-lg-4 -->
			<?php endif; ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.blog-one -->

<?php
get_footer();
