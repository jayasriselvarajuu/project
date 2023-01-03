;
(function($) {
    "use strict";
    var blog_metabox_div = $('#_zimed_blog_page_option');
    blog_metabox_div.hide();
    $('#page_template').on('change', function() {
        if ($(this).find('option:selected').val() == 'blog-2.php') {
            blog_metabox_div.show();
        } else {
            blog_metabox_div.hide();
        }
    });
    if (zimed_page_template.template != 'blog-2.php') {
        blog_metabox_div.hide();
    } else {
        blog_metabox_div.show();
    }
})(jQuery)