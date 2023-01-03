<?php

/**
 * zimed functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zimed
 */

if (!function_exists('zimed_setup')) :

	function zimed_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on zimed, use a find and replace
		 * to change 'zimed' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('zimed', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'zimed'),
			'menu-2' => esc_html__('One Page Menu', 'zimed'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 26,
			'width'       => 105,
			'flex-width'  => true,
			'flex-height' => true,
		));

		/**
		 * Add support for editor styles.
		 *
		 */
		add_theme_support('align-wide');
		add_theme_support('editor-styles');
		add_editor_style('style-editor.css');
		add_theme_support('responsive-embeds');
	}

endif;

add_action('after_setup_theme', 'zimed_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zimed_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('zimed_content_width', 770);
}
add_action('after_setup_theme', 'zimed_content_width', 0);

// google font process

function zimed_fonts_url()
{
	$font_url = '';

	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ('off' !== _x('on', 'Google font: on or off', 'zimed')) {
		$font_url = add_query_arg('family', urlencode('Barlow:200,300,400,500,600,700,800,900&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
	}

	return esc_url_raw($font_url);
}

/**
 * Enqueue scripts and styles.
 */
function zimed_scripts()
{
	wp_enqueue_style('zimed-fonts', zimed_fonts_url(), array(), null);
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.2.1');
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), '4.2.1');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), '5.12.0');

	wp_enqueue_style('zimed-font-icon', get_template_directory_uri() . '/assets/css/zimed-icon.css', array(), '1.0');
	wp_enqueue_style('zimed-new-font-icon', get_template_directory_uri() . '/assets/css/zimed-new-icon.css', array(), '1.0');
	wp_enqueue_style('zimed-main', get_template_directory_uri() . '/assets/css/main.css', array(), time());
	wp_enqueue_style('zimed-style', get_stylesheet_uri(), array(), time());
	wp_enqueue_style('zimed-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), time());


	wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing.min.js', array('jquery'), '1.3', true);
	wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/js/isotope.js', array('jquery'), '2.1.1', true);


	wp_enqueue_script('zimed-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), time(), true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'zimed_scripts');




// Gutenberg editor assets
function zimed_enqueue_block_assets()
{
	wp_enqueue_style('zimed-editor-fonts', zimed_fonts_url(), array(), null);
	wp_enqueue_style('font-awesome-all', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), '5.12.0');
}
add_action('enqueue_block_assets', 'zimed_enqueue_block_assets');


function zimed_admin_scripts($hook)
{
	if (isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])) {
		$post_id = empty($_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
	}
	if ('post.php' == $hook || 'post-new.php' == $hook) {
		wp_enqueue_script('zimed-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), time(), true);
	}
	if ('post.php' == $hook) {
		$page_template = get_post_meta($post_id, '_wp_page_template', true);
		wp_localize_script('zimed-admin-script', 'zimed_page_template', array('template' => $page_template));
	}
}
add_action('admin_enqueue_scripts', 'zimed_admin_scripts');

/*
* theme image sizes
*/
add_image_size('zimed_core_350x289', 350, 289, true); // blogs grid
add_image_size('zimed_core_770x457', 770, 457, true); // blog large thumbnail

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zimed_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'zimed'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'zimed'),
		'before_widget' => '<div id="%1$s" class="sidebar-single  widget %2$s">',
		'after_widget'  => '</div><!-- /.sidebar-single -->',
		'before_title'  => '<h3 class="sidebar__title">',
		'after_title'   => '</h3><!-- /.sidebar__title -->',
	));
}
add_action('widgets_init', 'zimed_widgets_init');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Implement the TGMPA feature.
 */
require get_template_directory() . '/lib/tgmpa-activator.php';

/**
 * Implement the breadcrumb feature.
 */
require get_template_directory() . '/lib/zimed-wp-breadcrumb.php';

/**
 * Implement the customizer feature.
 */
if (class_exists('Kirki')) {
	require get_template_directory() . '/lib/kirki-customizer.php';
	require get_template_directory() . '/inc/theme-option-scripts.php';
}

/*
* one click deomon import
*/
if (class_exists('OCDI_Plugin')) {
	require get_template_directory() . '/inc/demo-import.php';
}
