<?php
/**
 * Search Results Template
 *
 * @package NiceHelp
 */

get_header();
?>

<!-- Search Hero -->
<section class="nh-search-hero">
    <div class="nh-search-hero__inner">
        <h1 class="nh-search-hero__title"><?php esc_html_e('搜索结果', 'nicehelp'); ?></h1>

        <form class="nh-search-hero__bar" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <i data-lucide="search" class="nh-search-hero__icon"></i>
            <input type="search" name="s" class="nh-search-hero__input"
                   value="<?php echo esc_attr(get_search_query()); ?>"
                   placeholder="<?php esc_attr_e('搜索...', 'nicehelp'); ?>" />
            <button type="button" class="nh-search-hero__clear" aria-label="<?php esc_attr_e('清除搜索', 'nicehelp'); ?>">
                <i data-lucide="x"></i>
            </button>
        </form>

        <p class="nh-search-hero__info">
            <?php
            printf(
                esc_html__('找到 %d 条关于"%s"的结果', 'nicehelp'),
                $wp_query->found_posts,
                get_search_query()
            );
            ?>
        </p>
    </div>
</section>

<!-- Search Results -->
<div class="nh-search-layout">
    <div class="nh-search-layout__inner">
        <!-- Filter Sidebar -->
        <aside class="nh-search-sidebar">
            <h3 class="nh-search-sidebar__title"><?php esc_html_e('筛选结果', 'nicehelp'); ?></h3>
            <div class="nh-search-sidebar__group">
                <span class="nh-search-sidebar__label"><?php esc_html_e('分类', 'nicehelp'); ?></span>
                <?php
                $categories = get_terms([
                    'taxonomy'   => 'help_category',
                    'hide_empty' => true,
                ]);
                if ($categories && !is_wp_error($categories)) :
                    foreach ($categories as $cat) :
                        $bg = nicehelp_get_cat_bg($cat->term_id);
                        $color = nicehelp_get_cat_color($cat->term_id);
                ?>
                    <a href="<?php echo esc_url(add_query_arg(['help_cat' => $cat->slug], get_search_link(get_search_query()))); ?>"
                       class="nh-search-sidebar__filter<?php echo (isset($_GET['help_cat']) && $_GET['help_cat'] === $cat->slug) ? ' is-active' : ''; ?>">
                        <span><?php echo esc_html($cat->name); ?></span>
                        <span class="nh-search-sidebar__count"><?php echo esc_html($cat->count); ?></span>
                    </a>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </aside>

        <!-- Results List -->
        <div class="nh-search-results">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post();
                    $terms = get_the_terms(get_the_ID(), 'help_category');
                    $cat = ($terms && !is_wp_error($terms)) ? $terms[0] : null;
                ?>
                    <article class="nh-search-card">
                        <div class="nh-search-card__top">
                            <?php if ($cat) : ?>
                                <span class="nh-search-card__cat" style="background-color: <?php echo esc_attr(nicehelp_get_cat_bg($cat->term_id)); ?>; color: <?php echo esc_attr(nicehelp_get_cat_color($cat->term_id)); ?>">
                                    <?php echo esc_html($cat->name); ?>
                                </span>
                            <?php endif; ?>
                            <span class="nh-search-card__relevance"><?php esc_html_e('最佳匹配', 'nicehelp'); ?></span>
                        </div>
                        <h3 class="nh-search-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="nh-search-card__desc"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?></p>
                        <div class="nh-search-card__meta">
                            <span><?php printf(esc_html__('更新于 %s', 'nicehelp'), get_the_modified_date()); ?></span>
                            <span><?php echo esc_html(nicehelp_format_views(nicehelp_get_views())); ?></span>
                        </div>
                    </article>
                <?php endwhile; ?>

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
                <div class="nh-search-empty">
                    <i data-lucide="search-x"></i>
                    <h3><?php esc_html_e('未找到结果', 'nicehelp'); ?></h3>
                    <p><?php esc_html_e('请尝试不同的关键词或浏览我们的分类。', 'nicehelp'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
