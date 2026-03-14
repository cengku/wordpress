<?php
/**
 * Widgets
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;

add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Help Sidebar', 'nicehelp'),
        'id'            => 'help-sidebar',
        'description'   => __('Sidebar for help article pages', 'nicehelp'),
        'before_widget' => '<div id="%1$s" class="nh-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="nh-widget__title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('Footer Area', 'nicehelp'),
        'id'            => 'footer-area',
        'description'   => __('Footer widget area', 'nicehelp'),
        'before_widget' => '<div id="%1$s" class="nh-footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="nh-footer-widget__title">',
        'after_title'   => '</h4>',
    ]);
});
