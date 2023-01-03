<?php

/**
 * Template Name: Full-width
 */

get_header()
?>

<div class="full-width-page">
    <?php
    while (have_posts()) : the_post();
        the_content();
        echo wp_kses('<div class="clear-both"></div>', 'zimed_allowed_tags');
    endwhile;
    ?>
</div><!-- /.full-width-page -->
<?php
get_footer();
