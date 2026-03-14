<?php
/**
 * Archive Template (Category List Page)
 *
 * @package NiceHelp
 */

get_header();

$queried = get_queried_object();
$is_term = $queried instanceof WP_Term;

if ($is_term) {
    $icon  = nicehelp_get_cat_icon($queried->term_id);
    $color = nicehelp_get_cat_color($queried->term_id);
    $bg    = nicehelp_get_cat_bg($queried->term_id);
    $archive_title = $queried->name;
    $archive_desc  = $queried->description;
    $archive_count = $queried->count;
} else {
    $icon  = 'book-open';
    $color = '#2563EB';
    $bg    = '#EFF6FF';
    $archive_title = post_type_archive_title('', false) ?: '帮助文章';
    $archive_desc  = '';
    $archive_count = wp_count_posts('help_article')->publish ?? 0;
}
?>

<!-- Breadcrumb -->
<div class="nh-breadcrumb-bar">
    <div class="nh-breadcrumb-bar__inner">
        <?php nicehelp_breadcrumb(); ?>
    </div>
</div>

<!-- Category Hero -->
<section class="nh-cat-hero" style="background-color: <?php echo esc_attr($bg); ?>">
    <div class="nh-cat-hero__inner">
        <div class="nh-cat-hero__icon" style="background-color: <?php echo esc_attr($bg); ?>">
            <i data-lucide="<?php echo esc_attr($icon); ?>" style="color: <?php echo esc_attr($color); ?>"></i>
        </div>
        <h1 class="nh-cat-hero__title"><?php echo esc_html($archive_title); ?></h1>
        <?php if ($archive_desc) : ?>
            <p class="nh-cat-hero__desc"><?php echo wp_kses_post($archive_desc); ?></p>
        <?php endif; ?>
        <div class="nh-cat-hero__stats">
            <span><?php printf(esc_html__('%d 篇文章', 'nicehelp'), (int) $archive_count); ?></span>
        </div>
    </div>
</section>

<!-- Article List -->
<section class="nh-archive-list">
    <div class="nh-archive-list__inner">
        <div class="nh-archive-list__header">
            <h2 class="nh-archive-list__title"><?php esc_html_e('全部文章', 'nicehelp'); ?></h2>
            <div class="nh-archive-list__sort">
                <span><?php esc_html_e('排序：最热门', 'nicehelp'); ?></span>
                <i data-lucide="chevron-down"></i>
            </div>
        </div>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="nh-archive-card">
                    <h3 class="nh-archive-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php if (has_excerpt()) : ?>
                        <p class="nh-archive-card__desc"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 25)); ?></p>
                    <?php endif; ?>
                    <div class="nh-archive-card__meta">
                        <span class="nh-archive-card__tag" style="background-color: <?php echo esc_attr($bg); ?>; color: <?php echo esc_attr($color); ?>">
                            <?php echo esc_html($archive_title); ?>
                        </span>
                        <span class="nh-archive-card__date">
                            <?php printf(esc_html__('更新于 %s', 'nicehelp'), get_the_modified_date()); ?>
                        </span>
                        <span class="nh-archive-card__views">
                            <?php echo esc_html(nicehelp_format_views(nicehelp_get_views())); ?>
                        </span>
                    </div>
                </article>
            <?php endwhile; ?>

            <!-- Pagination -->
            <nav class="nh-pagination" aria-label="<?php esc_attr_e('分页', 'nicehelp'); ?>">
                <?php
                echo paginate_links([
                    'prev_text' => '← ' . __('上一页', 'nicehelp'),
                    'next_text' => __('下一页', 'nicehelp') . ' →',
                    'type'      => 'list',
                ]);
                ?>
            </nav>
        <?php else : ?>
            <p class="nh-archive-list__empty"><?php esc_html_e('该分类下暂无文章。', 'nicehelp'); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
