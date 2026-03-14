<?php
/**
 * Enqueue scripts and styles
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    // Google Fonts - Inter
    wp_enqueue_style(
        'nicehelp-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Lucide Icons
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest/dist/umd/lucide.min.js',
        [],
        null,
        true
    );

    // Theme stylesheet
    wp_enqueue_style(
        'nicehelp-style',
        NICEHELP_URI . '/assets/css/theme.css',
        ['nicehelp-google-fonts'],
        NICEHELP_VERSION
    );

    // Theme script
    wp_enqueue_script(
        'nicehelp-script',
        NICEHELP_URI . '/assets/js/theme.js',
        ['lucide-icons'],
        NICEHELP_VERSION,
        true
    );

    wp_localize_script('nicehelp-script', 'nicehelp', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('nicehelp_nonce'),
    ]);
});
