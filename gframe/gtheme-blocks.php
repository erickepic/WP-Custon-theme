<?php

/**
 * Register Gtheme ACF Blocks using block.json
 */
function gtheme_register_blocks() {
    $blocks_path = get_template_directory() . '/gframe/blocks/';
    $blocks = glob($blocks_path . 'gtheme-*', GLOB_ONLYDIR);

    if ($blocks) {
        foreach ($blocks as $block) {
            if (file_exists($block . '/block.json')) {
                register_block_type($block);
            }
        }
    }
}
add_action('init', 'gtheme_register_blocks');

/**
 * Theme Setup & Gutenberg Support
 */
function gtheme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    // Add support for core custom logo.
    add_theme_support('custom-logo');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Editor Styles
    add_theme_support('editor-styles');
    add_editor_style('css/global.css');

    // Register Navigation Menus
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'mobile-menu' => 'Mobile Menu',
        'footer-menu' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'gtheme_setup');

/**
 * ACF JSON Support
 */
add_filter('acf/settings/save_json', function($path) {
    return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});

/**
 * Theme Options Page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title' => 'Theme General Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );
}

/**
 * Inline Styles System (Support for gtheme-section background/padding)
 */
add_action('get_footer', function () {
    global $gwp_blockdeskstyles, $gwp_blockmobstyles;

    if (empty($gwp_blockdeskstyles) && empty($gwp_blockmobstyles)) {
        return;
    }

    $styles = "$gwp_blockdeskstyles@media(max-width:600px){" . $gwp_blockmobstyles . "}";

    wp_register_style('gblockstyles', false);
    wp_enqueue_style('gblockstyles');
    wp_add_inline_style('gblockstyles', $styles);
}, 100);
