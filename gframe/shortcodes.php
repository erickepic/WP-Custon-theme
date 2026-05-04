<?php

// [blog_main_slider]

add_shortcode('blog_main_slider', function () {

    ob_start();





    include_once (get_template_directory(). "/gframe/blocks/blog-main-slide.php");



    $content = ob_get_contents();

    ob_end_clean();



    return $content;

});

// [blog_related_slider]

add_shortcode('blog_related_slider', function () {

    ob_start();





    include_once (get_template_directory(). "/gframe/blocks/blog-related-slide.php");



    $content = ob_get_contents();

    ob_end_clean();



    return $content;

});