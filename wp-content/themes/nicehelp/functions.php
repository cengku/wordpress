<?php
/**
 * NiceHelp Theme Functions
 *
 * @package NiceHelp
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

define('NICEHELP_VERSION', '1.0.0');
define('NICEHELP_DIR', get_template_directory());
define('NICEHELP_URI', get_template_directory_uri());

// Theme setup
require_once NICEHELP_DIR . '/inc/theme-setup.php';
require_once NICEHELP_DIR . '/inc/enqueue.php';
require_once NICEHELP_DIR . '/inc/custom-post-types.php';
require_once NICEHELP_DIR . '/inc/template-tags.php';
require_once NICEHELP_DIR . '/inc/widgets.php';
require_once NICEHELP_DIR . '/inc/seed-data.php';
