<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;

add_action('init', function () {
    // Help Article CPT
    register_post_type('help_article', [
        'labels' => [
            'name'               => __('帮助文章', 'nicehelp'),
            'singular_name'      => __('帮助文章', 'nicehelp'),
            'add_new'            => __('新增文章', 'nicehelp'),
            'add_new_item'       => __('新增帮助文章', 'nicehelp'),
            'edit_item'          => __('编辑帮助文章', 'nicehelp'),
            'view_item'          => __('查看帮助文章', 'nicehelp'),
            'search_items'       => __('搜索帮助文章', 'nicehelp'),
            'not_found'          => __('未找到文章', 'nicehelp'),
            'not_found_in_trash' => __('回收站中未找到文章', 'nicehelp'),
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'help', 'with_front' => false],
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions'],
        'menu_icon'    => 'dashicons-book-alt',
        'show_in_rest' => true,
    ]);

    // Help Category Taxonomy
    register_taxonomy('help_category', 'help_article', [
        'labels' => [
            'name'          => __('帮助分类', 'nicehelp'),
            'singular_name' => __('帮助分类', 'nicehelp'),
            'search_items'  => __('搜索分类', 'nicehelp'),
            'all_items'     => __('所有分类', 'nicehelp'),
            'edit_item'     => __('编辑分类', 'nicehelp'),
            'add_new_item'  => __('新增分类', 'nicehelp'),
        ],
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => ['slug' => 'help-category', 'with_front' => false],
        'show_in_rest' => true,
    ]);
});

// Track article views
function nicehelp_track_views(): void {
    if (is_singular('help_article')) {
        $post_id = get_the_ID();
        $views = (int) get_post_meta($post_id, '_nicehelp_views', true);
        update_post_meta($post_id, '_nicehelp_views', $views + 1);
    }
}
add_action('wp_head', 'nicehelp_track_views');

// Get article view count
function nicehelp_get_views(int $post_id = 0): int {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return (int) get_post_meta($post_id, '_nicehelp_views', true);
}

// Add category meta fields (icon, color)
add_action('help_category_add_form_fields', function () {
    ?>
    <div class="form-field">
        <label for="nicehelp_cat_icon"><?php esc_html_e('图标名称 (Lucide)', 'nicehelp'); ?></label>
        <input type="text" name="nicehelp_cat_icon" id="nicehelp_cat_icon" value="folder" />
        <p class="description"><?php esc_html_e('Lucide 图标名称，例如 rocket, shield, book-open', 'nicehelp'); ?></p>
    </div>
    <div class="form-field">
        <label for="nicehelp_cat_color"><?php esc_html_e('强调色', 'nicehelp'); ?></label>
        <input type="text" name="nicehelp_cat_color" id="nicehelp_cat_color" value="#2563EB" />
    </div>
    <div class="form-field">
        <label for="nicehelp_cat_bg"><?php esc_html_e('背景色', 'nicehelp'); ?></label>
        <input type="text" name="nicehelp_cat_bg" id="nicehelp_cat_bg" value="#EFF6FF" />
    </div>
    <?php
});

add_action('created_help_category', function (int $term_id) {
    update_term_meta($term_id, 'nicehelp_cat_icon', sanitize_text_field($_POST['nicehelp_cat_icon'] ?? 'folder'));
    update_term_meta($term_id, 'nicehelp_cat_color', sanitize_hex_color($_POST['nicehelp_cat_color'] ?? '#2563EB'));
    update_term_meta($term_id, 'nicehelp_cat_bg', sanitize_hex_color($_POST['nicehelp_cat_bg'] ?? '#EFF6FF'));
});

add_action('help_category_edit_form_fields', function ($term) {
    $icon  = get_term_meta($term->term_id, 'nicehelp_cat_icon', true) ?: 'folder';
    $color = get_term_meta($term->term_id, 'nicehelp_cat_color', true) ?: '#2563EB';
    $bg    = get_term_meta($term->term_id, 'nicehelp_cat_bg', true) ?: '#EFF6FF';
    ?>
    <tr class="form-field">
        <th><label for="nicehelp_cat_icon"><?php esc_html_e('图标名称 (Lucide)', 'nicehelp'); ?></label></th>
        <td><input type="text" name="nicehelp_cat_icon" id="nicehelp_cat_icon" value="<?php echo esc_attr($icon); ?>" /></td>
    </tr>
    <tr class="form-field">
        <th><label for="nicehelp_cat_color"><?php esc_html_e('强调色', 'nicehelp'); ?></label></th>
        <td><input type="text" name="nicehelp_cat_color" id="nicehelp_cat_color" value="<?php echo esc_attr($color); ?>" /></td>
    </tr>
    <tr class="form-field">
        <th><label for="nicehelp_cat_bg"><?php esc_html_e('背景色', 'nicehelp'); ?></label></th>
        <td><input type="text" name="nicehelp_cat_bg" id="nicehelp_cat_bg" value="<?php echo esc_attr($bg); ?>" /></td>
    </tr>
    <?php
});

add_action('edited_help_category', function (int $term_id) {
    update_term_meta($term_id, 'nicehelp_cat_icon', sanitize_text_field($_POST['nicehelp_cat_icon'] ?? 'folder'));
    update_term_meta($term_id, 'nicehelp_cat_color', sanitize_hex_color($_POST['nicehelp_cat_color'] ?? '#2563EB'));
    update_term_meta($term_id, 'nicehelp_cat_bg', sanitize_hex_color($_POST['nicehelp_cat_bg'] ?? '#EFF6FF'));
});

// 让搜索同时包含 help_article 和 post 类型
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', ['help_article', 'post', 'page']);
    }
});

// AJAX 搜索处理
add_action('wp_ajax_nicehelp_search', 'nicehelp_ajax_search');
add_action('wp_ajax_nopriv_nicehelp_search', 'nicehelp_ajax_search');

function nicehelp_ajax_search(): void {
    check_ajax_referer('nicehelp_nonce', 'nonce');
    $query = sanitize_text_field($_GET['q'] ?? '');
    if (empty($query)) {
        wp_send_json_success([]);
    }
    $results = new WP_Query([
        'post_type'      => ['help_article', 'post', 'page'],
        'posts_per_page' => 5,
        's'              => $query,
    ]);
    $items = [];
    while ($results->have_posts()) {
        $results->the_post();
        $items[] = [
            'title' => get_the_title(),
            'url'   => get_permalink(),
            'excerpt' => wp_trim_words(get_the_excerpt(), 20),
        ];
    }
    wp_reset_postdata();
    wp_send_json_success($items);
}
