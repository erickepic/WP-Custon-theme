<?php

// Admin styles
function gtheme_admin_styles()
{
    wp_enqueue_style('global-admin', get_template_directory_uri() . '/css/global-admin.css', false, GTHEME_VERSION);
}
add_action('admin_head', 'gtheme_admin_styles');

// Frontend styles
function gtheme_include_styles()
{
    // Fonts
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', false, GTHEME_VERSION);
    
    // Vendor
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', false, '8.0.1');
    wp_register_style('swiperstyles', get_template_directory_uri() . '/css/swiper.css', false, GTHEME_VERSION);
    
    // Core
    wp_register_style('animations', get_template_directory_uri() . '/css/animations.css', false, GTHEME_VERSION);
    wp_register_style('global', get_template_directory_uri() . '/css/global.css', false, GTHEME_VERSION);
    wp_register_style('custom', get_template_directory_uri() . '/css/custom.css', false, GTHEME_VERSION);
    wp_register_style('header', get_template_directory_uri() . '/css/header.css', false, GTHEME_VERSION);
    wp_register_style('modal', get_template_directory_uri() . '/css/modal.css', false, GTHEME_VERSION);
    wp_register_style('footer', get_template_directory_uri() . '/css/footer.css', false, GTHEME_VERSION);

    // Enqueue
    wp_enqueue_style('normalize');
    wp_enqueue_style('montserrat');
    wp_enqueue_style('swiperstyles');
    wp_enqueue_style('animations');
    wp_enqueue_style('global');
    wp_enqueue_style('custom');
    wp_enqueue_style('header');
    wp_enqueue_style('modal');
    wp_enqueue_style('footer');

    if (is_single()) {
        wp_register_style('single', get_template_directory_uri() . '/css/single.css', false, GTHEME_VERSION);
        wp_enqueue_style('single');
    }
}
add_action('wp_enqueue_scripts', 'gtheme_include_styles');

// Frontend scripts
function gtheme_include_scripts()
{
    // Vendor
    wp_register_script('swiper-bundle', get_stylesheet_directory_uri() . '/js/lib/swiper-bundle.min.js', false, GTHEME_VERSION, true);
    wp_register_script('aos-animations', get_template_directory_uri() . '/js/lib/aos-animations.js', array(), GTHEME_VERSION, true);
    wp_register_script('lazyload', get_template_directory_uri() . '/js/lib/lazysizes-v5.3.2.min.js', array(), '5.3.2', true);

    // Custom
    wp_register_script('gtheme-global', get_stylesheet_directory_uri() . '/js/global.js', array('jquery'), GTHEME_VERSION, true);

    // Enqueue
    wp_enqueue_script('swiper-bundle');
    wp_enqueue_script('aos-animations');
    wp_enqueue_script('lazyload');
    wp_enqueue_script('gtheme-global');
}
add_action("wp_enqueue_scripts", "gtheme_include_scripts");

/**
 * Add async/defer to specific scripts
 */
function gtheme_script_loader_tag($tag, $handle) {
    $defer_scripts = array('gtheme-global', 'lazyload');
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'gtheme_script_loader_tag', 10, 2);