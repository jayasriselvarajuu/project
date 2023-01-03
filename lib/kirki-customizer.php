<?php

$zimed_config_id = 'zimed_customize';

Kirki::add_config($zimed_config_id, array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
));


/**
 * theme option panel master
 */

Kirki::add_panel('zimed_theme_opt', array(
	'priority'    => 240,
	'title'       => esc_html__('Zimed Options', 'zimed'),
	'description' => esc_html__('Zimed Theme options panel', 'zimed'),
));

/**
 * General options
 */
Kirki::add_section('zimed_theme_general', array(
	'title'          => esc_html__('General Settings', 'zimed'),
	'description'    => esc_html__('Zimed General Settings.', 'zimed'),
	'panel'          => 'zimed_theme_opt',
	'priority'       => 160,
));


// theme base color
Kirki::add_field($zimed_config_id, [
	'type'        => 'color',
	'settings'    => 'theme_base_color',
	'label'       => __('Select Theme Base color', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => sanitize_hex_color('#ee464b'),
]);


// theme black color
Kirki::add_field($zimed_config_id, [
	'type'        => 'color',
	'settings'    => 'theme_black_color',
	'label'       => __('Select Theme Black color', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => sanitize_hex_color('#272839'),
]);

// theme gray color
Kirki::add_field($zimed_config_id, [
	'type'        => 'color',
	'settings'    => 'theme_gray_color',
	'label'       => __('Select Theme Gray color', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => sanitize_hex_color('#f4f4f8'),
]);




// general options fields

Kirki::add_field($zimed_config_id, [
	'type'        => 'switch',
	'settings'    => 'preloader',
	'label'       => esc_html__('Preloader Visibility', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => 'on',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__('Enable', 'zimed'),
		'off' => esc_html__('Disable', 'zimed'),
	],
]);


Kirki::add_field($zimed_config_id, [
	'type'        => 'color',
	'settings'    => 'preloader_color',
	'label'       => esc_html__('Preloader Color', 'zimed'),
	'description' => esc_html__('Add your custom preloader color.', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => sanitize_hex_color('#ee464b'),
	'active_callback'  => [
		[
			'setting'  => 'preloader',
			'operator' => '===',
			'value'    => 'on',
		],
	]
]);


Kirki::add_field($zimed_config_id, [
	'type'        => 'switch',
	'settings'    => 'scroll_to_top',
	'label'       => esc_html__('Back to top Visibility', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => 'on',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__('Enable', 'zimed'),
		'off' => esc_html__('Disable', 'zimed'),
	],
]);

Kirki::add_field($zimed_config_id, [
	'type'        => 'select',
	'settings'    => 'scroll_to_top_icon',
	'label'       => esc_html__('Select Back to top icon', 'zimed'),
	'section'     => 'zimed_theme_general',
	'default'     => 'fa-angle-up',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => zimed_get_fa_icons(),
	'active_callback'  => [
		[
			'setting'  => 'scroll_to_top',
			'operator' => '===',
			'value'    => 'on',
		],
	]
]);




// background image
Kirki::add_field($zimed_config_id, [
	'type'        => 'image',
	'settings'    => 'error_404_image',
	'label'       => esc_html__('Custom 404 Image', 'zimed'),
	'section'     => 'zimed_theme_general',
]);

// page header background image
Kirki::add_field($zimed_config_id, [
	'type'        => 'image',
	'settings'    => 'page_header_bg_image',
	'label'       => esc_html__('Page Header Background Image', 'zimed'),
	'section'     => 'zimed_theme_general',
]);




/**
 * Header options
 */

Kirki::add_section('zimed_theme_header', array(
	'title'          => esc_html__('Header Settings', 'zimed'),
	'description'    => esc_html__('Zimed Header Settings.', 'zimed'),
	'panel'          => 'zimed_theme_opt',
	'priority'       => 160,
));



// set logo width
Kirki::add_field($zimed_config_id, [
	'type'        => 'text',
	'settings'    => 'header_logo_width',
	'label'       => __('Add Logo size in px', 'zimed'),
	'section'     => 'zimed_theme_header',
	'default'     => esc_html(105),
]);


// stricky menu color
Kirki::add_field($zimed_config_id, [
	'type'        => 'color',
	'settings'    => 'header_stricked_menu_link_color',
	'label'       => __('Select Stricky Menu Link Color', 'zimed'),
	'section'     => 'zimed_theme_header',
	'default'     => sanitize_hex_color('#ffffff'),
	'active_callback'  => [
		[
			'setting'  => 'header_stricked_menu',
			'operator' => '==',
			'value'    => true,
		],
	]
]);


// solid color
Kirki::add_field($zimed_config_id, [
	'type'        => 'color',
	'settings'    => 'header_stricked_menu_bg_solid_color',
	'label'       => __('Select Sticky background Color', 'zimed'),
	'section'     => 'zimed_theme_header',
	'default'     => sanitize_hex_color('#272839'),
	'active_callback'  => [
		[
			'setting'  => 'header_stricked_menu',
			'operator' => '==',
			'value'    => true,
		],
	]
]);



Kirki::add_field($zimed_config_id, [
	'type'        => 'checkbox',
	'settings'    => 'header_btn_switch',
	'label'       => esc_html__('Header Btn Visibility', 'zimed'),
	'section'     => 'zimed_theme_header',
	'default'     => true,
	'priority'    => 10,
]);


Kirki::add_field($zimed_config_id, [
	'type'     => 'text',
	'settings' => 'header_btn_text',
	'label'    => esc_html__('Add Button', 'zimed'),
	'section'  => 'zimed_theme_header',
	'default'  => esc_html__('Btn Text', 'zimed'),
	'priority' => 10,
	'active_callback'  => function () {
		$switch_value = get_theme_mod('header_btn_switch', true);

		if (true === $switch_value) {
			return true;
		}
		return false;
	},
]);

Kirki::add_field($zimed_config_id, [
	'type'     => 'link',
	'settings' => 'header_btn_link',
	'label'    => __('Btn Link', 'zimed'),
	'section'  => 'zimed_theme_header',
	'default'  => '#',
	'priority' => 10,
	'active_callback'  => function () {
		$switch_value = get_theme_mod('header_btn_switch', true);

		if (true === $switch_value) {
			return true;
		}
		return false;
	},
]);



// stricky switch
Kirki::add_field($zimed_config_id, [
	'type'        => 'checkbox',
	'settings'    => 'header_stricked_menu',
	'label'       => esc_html__('Stricky Header', 'zimed'),
	'section'     => 'zimed_theme_header',
	'default'     => true,
	'priority'    => 10,
]);

// header banner breadcrumb
Kirki::add_field($zimed_config_id, [
	'type'        => 'switch',
	'settings'    => 'breadcrumb_opt',
	'label'       => esc_html__('Breadcrumb Visibility', 'zimed'),
	'section'     => 'zimed_theme_header',
	'default'     => 'on',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__('Enable', 'zimed'),
		'off' => esc_html__('Disable', 'zimed'),
	],
]);


/**
 * Mobile Menu
 */

Kirki::add_section('zimed_theme_mobile_menu', array(
	'title'          => esc_html__('Mobile Menu Settings', 'zimed'),
	'description'    => esc_html__('Zimed Mobile Menu Settings.', 'zimed'),
	'panel'          => 'zimed_theme_opt',
	'priority'       => 160,
));

Kirki::add_field($zimed_config_id, [
	'type'     => 'textarea',
	'settings' => 'zimed_mobile_menu_text',
	'label'    => esc_html__('Mobile Menu Content', 'zimed'),
	'section'  => 'zimed_theme_mobile_menu',
	'default'  => esc_html__('Lorem Ipsum is simply dummy text the printing and setting industry. Lorm Ipsum has been the industry', 'zimed'),
	'priority' => 10,
]);

Kirki::add_field($zimed_config_id, [
	'type'        => 'repeater',
	'label'       => esc_html__('Select Social Icons', 'zimed'),
	'section'     => 'zimed_theme_mobile_menu',
	'priority'    => 10,
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__('Social Icons', 'zimed'),
	],
	'button_label' => esc_html__('Add new Icon', 'zimed'),
	'settings'     => 'mobile_menu_social_icons',
	'default'      => [
		[
			'link_icon' => 'fa-facebook',
			'link_url' => esc_url('http://facebook.com'),
		],
	],
	'fields' => [
		'link_icon'  => [
			'type'        => 'select',
			'label'       => esc_html__('Social Icon', 'zimed'),
			'description' => esc_html__('Select Social Icons', 'zimed'),
			'default'     => 'fa-facebook',
			'choices'     => zimed_get_fa_icons(),
		],
		'link_url' => [
			'type'        => 'text',
			'label'       => esc_html__('Link Url', 'zimed'),
			'description' => esc_html__('Add social profile links', 'zimed'),
			'default'     => esc_url('https://facebook.com/'),
		],
	]
]);




/**
 * Footer options
 */

Kirki::add_section('zimed_theme_footer', array(
	'title'          => esc_html__('Footer Settings', 'zimed'),
	'description'    => esc_html__('Zimed Footer Settings.', 'zimed'),
	'panel'          => 'zimed_theme_opt',
	'priority'       => 160,
));

// Footer options fields
Kirki::add_field($zimed_config_id, [
	'type'        => 'checkbox',
	'settings'    => 'footer_custom',
	'label'       => esc_html__('Enable Custom Footer', 'zimed'),
	'section'     => 'zimed_theme_footer',
	'default'     => false,
	'priority'    => 10,
]);

// Get Footer Custom Post
Kirki::add_field($zimed_config_id, [
	'type'        => 'select',
	'settings'    => 'footer_custom_post',
	'label'       => esc_html__('Select Footer Type', 'zimed'),
	'choices'     => zimed_post_query('footer'),
	'section'     => 'zimed_theme_footer',
	'priority'    => 10,
	'active_callback' => function () {
		if (true == post_type_exists('footer') && true == get_theme_mod('footer_custom')) {
			return true;
		} else {
			return false;
		}
	},
]);


Kirki::add_field($zimed_config_id, [
	'type'     => 'text',
	'settings' => 'footer_copytext',
	'label'    => esc_html__('Text Control', 'zimed'),
	'section'  => 'zimed_theme_footer',
	'default'  => esc_html__('© copyright 2021 by ', 'zimed') . wp_kses('<a href="#">Layerdrops.com</a>', 'zimed_allowed_tags'),
	'priority' => 10,
	'sanitize_callback' => function ($input) {
		return wp_kses($input, 'zimed_allowed_tags');;
	},
	'active_callback' => function () {
		if (false == get_theme_mod('footer_custom')) {
			return true;
		}
	},
]);

Kirki::add_field($zimed_config_id, [
	'type'        => 'repeater',
	'label'       => esc_html__('Select Footer Social Icons', 'zimed'),
	'section'     => 'zimed_theme_footer',
	'priority'    => 10,
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__('Footer Social Icons', 'zimed'),
	],
	'button_label' => esc_html__('Add new Icon', 'zimed'),
	'settings'     => 'footer_social_icons',
	'active_callback' => function () {
		if (false == get_theme_mod('footer_custom')) {
			return true;
		}
	},
	'default'      => [
		[
			'link_icon' => esc_html('fa-facebook-f'),
			'link_url' => esc_url('http://facebook.com'),
		],
	],
	'fields' => [
		'link_icon'  => [
			'type'        => 'select',
			'label'       => esc_html__('Social Icon', 'zimed'),
			'description' => esc_html__('Select Social Icons', 'zimed'),
			'default'     => esc_html('fa-facebook-f'),
			'choices'     => zimed_get_fa_icons(),
		],
		'link_url' => [
			'type'        => 'text',
			'label'       => esc_html__('Link Url', 'zimed'),
			'description' => esc_html__('Add social profile links', 'zimed'),
			'default'     => esc_url('https://facebook.com/'),
		],
	]
]);
