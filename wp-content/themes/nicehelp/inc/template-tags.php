<?php
/**
 * Template Tags
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;

/**
 * Render breadcrumb navigation
 */
function nicehelp_breadcrumb(): void {
    echo '<nav class="nh-breadcrumb" aria-label="面包屑导航">';
    echo '<a href="' . esc_url(home_url('/')) . '">首页</a>';

    if (is_singular('help_article')) {
        $terms = get_the_terms(get_the_ID(), 'help_category');
        if ($terms && !is_wp_error($terms)) {
            $term = $terms[0];
            echo '<span class="nh-breadcrumb__sep"> / </span>';
            echo '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
        }
        echo '<span class="nh-breadcrumb__sep"> / </span>';
        echo '<span class="nh-breadcrumb__current">' . esc_html(get_the_title()) . '</span>';
    } elseif (is_tax('help_category')) {
        echo '<span class="nh-breadcrumb__sep"> / </span>';
        echo '<span class="nh-breadcrumb__current">' . esc_html(single_term_title('', false)) . '</span>';
    } elseif (is_search()) {
        echo '<span class="nh-breadcrumb__sep"> / </span>';
        echo '<span class="nh-breadcrumb__current">搜索结果</span>';
    }

    echo '</nav>';
}

/**
 * Format view count
 */
function nicehelp_format_views(int $views): string {
    if ($views >= 1000) {
        return number_format($views / 1000, 1) . 'k 次浏览';
    }
    return $views . ' 次浏览';
}

/**
 * Get category icon name
 */
function nicehelp_get_cat_icon(int $term_id): string {
    return get_term_meta($term_id, 'nicehelp_cat_icon', true) ?: 'folder';
}

/**
 * Get category accent color
 */
function nicehelp_get_cat_color(int $term_id): string {
    return get_term_meta($term_id, 'nicehelp_cat_color', true) ?: '#2563EB';
}

/**
 * Get category background color
 */
function nicehelp_get_cat_bg(int $term_id): string {
    return get_term_meta($term_id, 'nicehelp_cat_bg', true) ?: '#EFF6FF';
}
