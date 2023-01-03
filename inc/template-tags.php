<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package zimed
 */

if (!function_exists('zimed_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time
	 * @param string $element_class_prefix Classes for the element.
	 */
	function zimed_posted_on($element_class_prefix)
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('%s', 'post date', 'zimed'),
			'<a class="' . $element_class_prefix . '__date" href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo  wp_kses($posted_on, 'zimed_allowed_tags'); // WPCS: XSS OK.

	}
endif;

if (!function_exists('zimed_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 * @param string $element_class_prefix Classes for the element.
	 */
	function zimed_posted_by($element_class_prefix)
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('%s', 'post author', 'zimed'),
			'<span class="byline"> <span class="author vcard"><a class="' . esc_attr($element_class_prefix) . '__meta-link url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"> <i class="far fa-clock"></i>' . esc_html(get_the_author()) . '</a></span></span>'
		);

		echo wp_kses($byline, 'zimed_allowed_tags'); // WPCS: XSS OK.

	}
endif;

if (!function_exists('zimed_comments_meta')) :
	/**
	 * Prints HTML with meta information for the current post comments.
	 * @param string $element_class_prefix Classes for the element.
	 */
	function zimed_comments_meta($element_class_prefix)
	{
		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {

			echo wp_kses('<span class="comments-link"> <i class="far fa-comments"></i>', 'zimed_allowed_tags');
			comments_popup_link(
				esc_html__('Post a Comment', 'zimed'),
				esc_html__('1 Comment', 'zimed'),
				esc_html__('% Comments', 'zimed'),
				$element_class_prefix . '__meta-link',
				esc_html__('Comments are Closed', 'zimed')
			);
			echo wp_kses('</span>', 'zimed_allowed_tags');
		}
	}
endif;

if (!function_exists('zimed_pagination')) :
	/**
	 * Prints HTML with post pagination links.
	 */
	function zimed_pagination()
	{
		global $wp_query;
		$links = paginate_links(array(
			'current'   => max(1, get_query_var('paged')),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		));
		echo wp_kses($links, 'zimed_allowed_tags');
	}
endif;

if (!function_exists('zimed_custom_query_pagination')) :
	/**
	 * Prints HTML with post pagination links.
	 */
	function zimed_custom_query_pagination($paged = '', $max_page = '')
	{
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		if (!$paged)
			$paged = get_query_var('paged');
		if (!$max_page)
			$max_page = $wp_query->max_num_pages;

		$links = paginate_links(array(
			'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'     => '?paged=%#%',
			'current'    => max(1, $paged),
			'total'      => $max_page,
			'mid_size'   => 1,
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		));

		echo wp_kses($links, 'zimed_allowed_tags');
	}
endif;


if (!function_exists('zimed_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 * @param boolean $fallback_div div for no thumbnails.
	 */
	function zimed_post_thumbnail($image_size = 'post-thumbnail')
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}
		if (is_singular()) :
			the_post_thumbnail($image_size, array(
				'class' => 'img-fluid',
				'alt' => the_title_attribute(array(
					'echo' => false,
				)),
			));

		else :

			the_post_thumbnail($image_size, array(
				'class' => 'img-fluid',
				'alt' => the_title_attribute(array(
					'echo' => false,
				)),
			));

		endif; // End is_singular().
	}
endif;
