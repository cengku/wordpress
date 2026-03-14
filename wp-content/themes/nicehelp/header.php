<?php
/**
 * Header Template
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="nh-header">
    <div class="nh-header__inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nh-header__logo">
            <i data-lucide="book-open" class="nh-header__logo-icon"></i>
            <span class="nh-header__logo-text"><?php bloginfo('name'); ?></span>
        </a>

        <nav class="nh-header__nav" aria-label="<?php esc_attr_e('主导航', 'nicehelp'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nh-header__menu',
                'depth'          => 1,
                'fallback_cb'    => function () {
                    echo '<ul class="nh-header__menu">';
                    echo '<li class="current-menu-item"><a href="' . esc_url(home_url('/')) . '">首页</a></li>';
                    echo '<li><a href="#">文档</a></li>';
                    echo '<li><a href="#">指南</a></li>';
                    echo '<li><a href="#">API 参考</a></li>';
                    echo '<li><a href="#">社区</a></li>';
                    echo '</ul>';
                },
            ]);
            ?>
        </nav>

        <button class="nh-header__mobile-toggle" aria-label="<?php esc_attr_e('切换菜单', 'nicehelp'); ?>">
            <i data-lucide="menu"></i>
        </button>

        <div class="nh-header__actions">
            <a href="<?php echo esc_url(home_url('/?s=')); ?>" class="nh-header__search-btn" aria-label="<?php esc_attr_e('搜索', 'nicehelp'); ?>">
                <i data-lucide="search"></i>
            </a>
            <?php if (!is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(wp_login_url()); ?>" class="nh-btn nh-btn--primary nh-btn--sm">
                    <?php esc_html_e('登录', 'nicehelp'); ?>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(admin_url()); ?>" class="nh-btn nh-btn--primary nh-btn--sm">
                    <?php esc_html_e('控制台', 'nicehelp'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main id="main-content" class="nh-main">
