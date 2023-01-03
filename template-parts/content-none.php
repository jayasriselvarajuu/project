<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zimed
 */

?>

<div class="col-lg-12">
	<div class="blog-no-posts">

		<?php
		if (is_home() && current_user_can('publish_posts')) : ?>

			<p class="sidebar__title text-capitalize"><?php printf(wp_kses(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'zimed'), array('a' => array('href' => array()))), esc_url(admin_url('post-new.php'))); ?></p>

		<?php elseif (is_search()) : ?>

			<p class="sidebar__title text-capitalize"><?php echo esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'zimed'); ?></p>
			<div class="sidebar-single widget widget_search p-0">
				<?php echo get_search_form() ?>
			</div><!-- /.sidebar-single widget widget_search -->
		<?php else : ?>

			<p class="sidebar__title text-capitalize"><?php echo esc_html__('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'zimed'); ?></p>
			<div class="sidebar-single widget widget_search p-0">
				<?php echo get_search_form() ?>
			</div><!-- /.sidebar-single widget widget_search -->
		<?php endif; ?>
	</div><!-- /.blog-one__single -->
</div><!-- /.col-lg-12 -->