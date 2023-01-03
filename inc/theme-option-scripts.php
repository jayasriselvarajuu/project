<?php

/**
 * zimed functions for getting inline styles from theme customizer
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zimed
 */

if (!function_exists('zimed_theme_customizer_scripts')) :
	function zimed_theme_customizer_scripts()
	{

		// zimed color option

		$zimed_inline_style = '';


		$zimed_inline_style .= ':root {--thm-base: ' . get_theme_mod('theme_base_color', sanitize_hex_color('#ee464b')) . '; --thm-black: ' . get_theme_mod('theme_black_color', sanitize_hex_color('#272839')) . '; --thm-gray: ' . get_theme_mod('theme_gray_color', sanitize_hex_color('#f4f4f8')) . '; }';

		$zimed_inner_banner_bg = !empty(get_theme_mod('header_banner_image')) ? get_theme_mod('header_banner_image') : esc_url(get_template_directory_uri() . '/assets/images/background/inner-banner-bg.png');
		$zimed_inline_style .= '.page-header { background-image: url(' . $zimed_inner_banner_bg . '); }';



		if (is_page()) {

			$zimed_page_title_padding = '';

			$zimed_page_title_padding_top = get_post_meta(get_the_ID(), 'zimed_page_content_padding_top', true);
			$zimed_page_title_padding_bottom = get_post_meta(get_the_ID(), 'zimed_page_content_padding_bottom', true);

			$zimed_page_title_padding = '.full-width-page, .blog-details, .blog-grid-page, .blog-sidebar-page {padding-top: ' . $zimed_page_title_padding_top . ';padding-bottom: ' . $zimed_page_title_padding_bottom . ';}';
			$zimed_inline_style .= $zimed_page_title_padding;

			$zimed_page_color_base = !empty(get_post_meta(get_the_ID(), '_zimed_base_color', true)) ? get_post_meta(get_the_ID(), '_zimed_base_color', true) : get_theme_mod('theme_base_color', sanitize_hex_color('#ee464b'));
			$zimed_page_color_black = !empty(get_post_meta(get_the_ID(), '_zimed_black_color', true)) ? get_post_meta(get_the_ID(), '_zimed_black_color', true) : get_theme_mod('theme_black_color', sanitize_hex_color('#272839'));
			$zimed_page_color_gray = !empty(get_post_meta(get_the_ID(), '_zimed_gray_color', true)) ? get_post_meta(get_the_ID(), '_zimed_gray_color', true) : get_theme_mod('theme_gray_color', sanitize_hex_color('#f4f4f8'));
			$zimed_page_color_values = ':root {--thm-base: ' . $zimed_page_color_base . '; --thm-black: ' . $zimed_page_color_black . '; --thm-gray: ' . $zimed_page_color_gray . '; }';
			$zimed_inline_style .= $zimed_page_color_values;

			$zimed_page_header_image = empty(get_post_meta(get_the_ID(), 'zimed_set_header_image', true)) ? $zimed_inner_banner_bg : get_post_meta(get_the_ID(), 'zimed_set_header_image', true);

			$zimed_inline_style .= '.page-header { background-image: url(' . esc_url( $zimed_page_header_image ) . '); }';
		}



		wp_add_inline_style('zimed-style', $zimed_inline_style);
	}
endif;

add_action('wp_enqueue_scripts', 'zimed_theme_customizer_scripts');
