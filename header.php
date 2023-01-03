<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zimed
 */
?>
<!doctype html>
<html <?php esc_attr(language_attributes()); ?>>

<head>
	<meta charset="<?php esc_attr(bloginfo('charset')); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>


	<div class="page-wrapper">

		<?php if ('on' == get_theme_mod('preloader', 'on')) : ?>
			<div class="preloader">
				<div class="lds-ripple">
					<div></div>
					<div></div>
				</div>
			</div><!-- /.preloader -->
		<?php endif; ?>



		<header class="main-nav__header-one ">
			<?php $zimed_header_stricky_class = (true == get_theme_mod('header_stricked_menu', true)) ? 'stricky' : ''; ?>
			<nav class="header-navigation <?php if (!is_user_logged_in()) {
												echo esc_attr($zimed_header_stricky_class);
											}; ?>">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="main-nav__logo-box">
						<a href="<?php echo esc_url(home_url('/')); ?>" class="main-nav__logo">
							<?php
							$custom_logo_id = get_theme_mod('custom_logo');
							$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
							if (has_custom_logo()) {
								echo '<img src="' . esc_url($logo[0]) . '" width="' . esc_attr(get_theme_mod('header_logo_width', esc_attr('105'))) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
							} else {
								echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
							} ?>
						</a>
						<a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i>
							<!-- /.smpl-icon-menu --></a>
					</div><!-- /.logo-box -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<?php $zimed_page_nav_menu_condition = (empty(get_post_meta(get_the_ID(), 'zimed_menu_type', true))) ? 'primary_menu' : get_post_meta(get_the_ID(), 'zimed_menu_type', true); ?>
					<?php if ('primary_menu' == $zimed_page_nav_menu_condition && is_page()) : ?>
						<div class="main-nav__main-navigation">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'menu-1',
								'fallback_cb' => 'zimed_menu_fallback_cb',
								'menu_class' => 'main-nav__navigation-box',
							));
							?>
						</div><!-- /.navbar-collapse -->
					<?php elseif ('one_page_menu' == $zimed_page_nav_menu_condition && is_page()) :  ?>
						<div class="main-nav__main-navigation">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'menu-2',
								'fallback_cb' => 'zimed_menu_fallback_cb',
								'menu_class' => 'main-nav__navigation-box one-page-scroll-menu',
							));
							?>
						</div><!-- /.navbar-collapse -->
					<?php elseif (!is_page()) :  ?>
						<div class="main-nav__main-navigation">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'menu-1',
								'fallback_cb' => 'zimed_menu_fallback_cb',
								'menu_class' => 'main-nav__navigation-box ',
							));
							?>
						</div><!-- /.navbar-collapse -->
					<?php endif; ?>
					<div class="header-one__right">
						<?php if (true == get_theme_mod('header_btn_switch', false)) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link', '#')); ?>" class="thm-btn header__btn"><?php echo esc_html(get_theme_mod('header_btn_text', __('Btn Text', 'zimed'))); ?></a><!-- /.thm-btn header__btn -->
						<?php endif; ?>
					</div><!-- /.header-one__right -->
				</div>
				<!-- /.container -->
			</nav>
		</header><!-- /.main-nav__header-one -->


		<?php $zimed_page_title_condition = empty(get_post_meta(get_the_ID(), 'zimed_show_page_header', true)) ? 'on' : get_post_meta(get_the_ID(), 'zimed_show_page_header', true);
		$zimed_page_title_text = get_post_meta(get_the_ID(), 'zimed_set_header_title', true);
		?>
		<?php if ('off' == $zimed_page_title_condition && is_page()) : ?>

		<?php elseif ('on' == $zimed_page_title_condition && is_page()) :  ?>

			<section class="page-header" style="<?php echo esc_attr((!empty(get_theme_mod('page_header_bg_image'))) ? 'background-image: url(' . get_theme_mod('page_header_bg_image') . ')' : ''); ?>">
				<div class="container">
					<?php if (function_exists('zimed_wp_breadcrumb') && ('on' == get_theme_mod('breadcrumb_opt', 'on'))) {
						zimed_wp_breadcrumb('ul', 'thm-breadcrumb', 'thm-breadcrumb list-unstyled', 'current', true);
					} ?>
					<h2>

						<?php
						if (empty($zimed_page_title_text)) {
							esc_html(zimed_page_title());
						} else {
							echo esc_html($zimed_page_title_text);
						}
						?>

					</h2>

				</div><!-- /.container -->
				<a href="<?php echo esc_url(home_url('/')); ?>" class="page-header__home-link"><i class="fa fa-home"></i></a>
				<!-- /.page-header__home-link -->
			</section><!-- /.page-header -->

		<?php elseif (!is_page()) :  ?>
			<section class="page-header" style="<?php echo esc_attr((!empty(get_theme_mod('page_header_bg_image'))) ? 'background-image: url(' . get_theme_mod('page_header_bg_image') . ')' : ''); ?>">
				<div class="container">
					<?php if (function_exists('zimed_wp_breadcrumb') && ('on' == get_theme_mod('breadcrumb_opt', 'on'))) {
						zimed_wp_breadcrumb('ul', 'thm-breadcrumb', 'thm-breadcrumb list-unstyled', 'current', true);
					} ?>
					<h2>
						<?php esc_html(zimed_page_title()); ?>
					</h2>

				</div><!-- /.container -->
				<a href="<?php echo esc_url(home_url('/')); ?>" class="page-header__home-link"><i class="fa fa-home"></i></a>
				<!-- /.page-header__home-link -->
			</section><!-- /.page-header -->

		<?php endif; ?>