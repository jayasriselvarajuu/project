<?php
if (!function_exists('zimed_page_title')) :

    // Page Title
    function zimed_page_title()
    {
        if (is_home()) {
            echo esc_html__('Our Blog', 'zimed');
        } elseif (is_archive()) {
            esc_html(the_archive_title());
        } elseif (is_page()) {
            esc_html(the_title());
        } elseif (is_single()) {
            esc_html(the_title());
        } elseif (is_category()) {
            esc_html(single_cat_title());
        } elseif (is_search()) {
            echo esc_html__('Search result for: “', 'zimed') . esc_html(get_search_query()) . '”';
        } elseif (is_404()) {
            echo esc_html__('Page Not Found', 'zimed');
        } else {
            esc_html(the_title());
        }
    }

endif;


if (!function_exists('zimed_menu_fallback_cb')) :
    function zimed_menu_fallback_cb()
    {
        return false;
    }
endif;

if (!function_exists('zimed_excerpt')) :

    // Post's excerpt text
    function zimed_excerpt($get_limit_value, $echo = true)
    {
        $opt = $get_limit_value;
        $excerpt_limit = !empty($opt) ? $opt : 40;
        $excerpt = wp_trim_words(get_the_content(), $excerpt_limit, '');
        if ($echo == true) {
            echo esc_html($excerpt);
        } else {
            return esc_html($excerpt);
        }
    }

endif;

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function zimed_my_search_form($form)
{
    $form = '<form role="search" method="get" class="searchform" action="' . esc_url(home_url('/')) . '" >
        <input type="text" value="' . esc_attr(get_search_query()) . '" name="s" id="s" placeholder="' . esc_attr__('Search here...', 'zimed') . '">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>';

    return $form;
}
add_filter('get_search_form', 'zimed_my_search_form');

if (!function_exists('zimed_comment_form_fields')) :

    function zimed_comment_form_fields($fields)
    {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        unset($fields['cookies']);
        $fields['comment'] = $comment_field;
        return $fields;
    }

endif;

add_filter('comment_form_fields', 'zimed_comment_form_fields');



if (!function_exists('zimed_get_fa_icons')) :

    function zimed_get_fa_icons()
    {
        $data = get_transient('zimed_fa_icons');

        if (empty($data)) {
            global $wp_filesystem;
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();

            $fontAwesome_file =   get_parent_theme_file_path('/assets/css/fontawesome-all.min.css');
            $template_icon_file = get_parent_theme_file_path('/assets/css/zimed-icon.css');
            $template_icon_file_new = get_parent_theme_file_path('/assets/css/zimed-new-icon.css');
            $content = '';

            if ($wp_filesystem->exists($fontAwesome_file)) {
                $content = $wp_filesystem->get_contents($fontAwesome_file);
            } // End If Statement

            if ($wp_filesystem->exists($template_icon_file)) {
                $content .= $wp_filesystem->get_contents($template_icon_file);
            } // End If Statement

            if ($wp_filesystem->exists($template_icon_file_new)) {
                $content .= $wp_filesystem->get_contents($template_icon_file_new);
            } // End If Statement



            $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s*{\s*content/';
            $pattern_two = '/\.(zimed-icon-(?:\w+(?:-)?)+):before\s*{\s*content/';
            $pattern_three = '/\.(zimed-new-icon-(?:\w+(?:-)?)+):before\s*{\s*content/';

            $subject = $content;

            preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
            preg_match_all($pattern_two, $subject, $matches_two, PREG_SET_ORDER);
            preg_match_all($pattern_three, $subject, $matches_three, PREG_SET_ORDER);

            $all_matches = array_merge($matches, $matches_two, $matches_three);

            $icons = array();

            foreach ($all_matches as $match) {
                // $icons[] = array('value' => $match[1], 'label' => $match[1]);
                $icons[] = $match[1];
            }


            $data = $icons;
            set_transient('zimed_fa_icons', $data, 10080); // saved for one week

        }



        return array_combine($data, $data); // combined for key = value
    }


endif;


// custom kses allowed html
if (!function_exists('zimed_kses_allowed_html')) :
    function zimed_kses_allowed_html($tags, $context)
    {
        switch ($context) {
            case 'zimed_allowed_tags':
                $tags = array(
                    'a' => array('href' => array(), 'class' => array()),
                    'b' => array(),
                    'br' => array(),
                    'span' => array('class' => array()),
                    'img' => array('class' => array()),
                    'i' => array('class' => array()),
                    'p' => array('class' => array()),
                    'ul' => array('class' => array()),
                    'li' => array('class' => array()),
                    'div' => array('class' => array()),
                    'strong' => array()
                );
                return $tags;
            default:
                return $tags;
        }
    }

    add_filter('wp_kses_allowed_html', 'zimed_kses_allowed_html', 10, 2);

endif;



if (!function_exists('zimed_post_query')) {
    function zimed_post_query($post_type)
    {
        $post_list = get_posts(array(
            'post_type' => $post_type,
            'showposts' => -1,
        ));
        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $options[$post->ID] = $post->post_title;
            }
            return $options;
        }
    }
}
