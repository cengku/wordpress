<?php
/**
 * Theme Setup
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 28,
        'width'       => 28,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ]);
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    register_nav_menus([
        'primary'          => __('Primary Navigation', 'nicehelp'),
        'footer-product'   => __('Footer Product', 'nicehelp'),
        'footer-resources' => __('Footer Resources', 'nicehelp'),
        'footer-company'   => __('Footer Company', 'nicehelp'),
    ]);

    $GLOBALS['content_width'] = 1280;
});
