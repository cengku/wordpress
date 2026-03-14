<?php
/**
 * Single Help Article Template
 *
 * @package NiceHelp
 */

get_header();

while (have_posts()) : the_post();
    $terms = get_the_terms(get_the_ID(), 'help_category');
    $cat = ($terms && !is_wp_error($terms)) ? $terms[0] : null;
    $cat_color = $cat ? nicehelp_get_cat_color($cat->term_id) : '#2563EB';
    $cat_bg = $cat ? nicehelp_get_cat_bg($cat->term_id) : '#EFF6FF';
?>

<!-- Breadcrumb -->
<div class="nh-breadcrumb-bar">
    <div class="nh-breadcrumb-bar__inner">
        <?php nicehelp_breadcrumb(); ?>
    </div>
</div>

<div class="nh-article-layout">
    <!-- Sidebar -->
    <aside class="nh-article-sidebar">
        <div class="nh-article-sidebar__title">
            <?php esc_html_e('本栏目文章', 'nicehelp'); ?>
        </div>
        <div class="nh-article-sidebar__divider"></div>
        <?php
        if ($cat) :
            $siblings = new WP_Query([
                'post_type'      => 'help_article',
                'posts_per_page' => 10,
                'tax_query'      => [[
                    'taxonomy' => 'help_category',
                    'field'    => 'term_id',
                    'terms'    => $cat->term_id,
                ]],
                'orderby' => 'menu_order',
                'order'   => 'ASC',
            ]);
            while ($siblings->have_posts()) : $siblings->the_post();
        ?>
            <a href="<?php the_permalink(); ?>"
               class="nh-article-sidebar__item<?php echo get_the_ID() === get_queried_object_id() ? ' is-active' : ''; ?>">
                <?php the_title(); ?>
            </a>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </aside>
    <!-- Article Content -->
    <article class="nh-article">
        <header class="nh-article__header">
            <?php if ($cat) : ?>
                <span class="nh-article__badge" style="background-color: <?php echo esc_attr($cat_bg); ?>; color: <?php echo esc_attr($cat_color); ?>">
                    <?php echo esc_html($cat->name); ?>
                </span>
            <?php endif; ?>

            <h1 class="nh-article__title"><?php the_title(); ?></h1>

            <div class="nh-article__meta">
                <span class="nh-article__meta-item">
                    <i data-lucide="user"></i>
                    <?php the_author(); ?>
                </span>
                <span class="nh-article__meta-item">
                    <i data-lucide="calendar"></i>
                    <?php echo esc_html(get_the_modified_date()); ?>
                </span>
                <span class="nh-article__meta-item">
                    <i data-lucide="eye"></i>
                    <?php echo esc_html(nicehelp_format_views(nicehelp_get_views())); ?>
                </span>
                <span class="nh-article__meta-item">
                    <i data-lucide="clock"></i>
                    <?php
                    $word_count = str_word_count(wp_strip_all_tags(get_the_content()));
                    $reading_time = max(1, ceil($word_count / 200));
                    printf(esc_html__('%d 分钟阅读', 'nicehelp'), $reading_time);
                    ?>
                </span>
            </div>
        </header>

        <div class="nh-article__divider"></div>

        <div class="nh-article__body">
            <?php the_content(); ?>
        </div>

        <div class="nh-article__divider"></div>

        <!-- Feedback -->
        <div class="nh-article__feedback">
            <p class="nh-article__feedback-label"><?php esc_html_e('这篇文章对您有帮助吗？', 'nicehelp'); ?></p>
            <div class="nh-article__feedback-buttons">
                <button class="nh-btn nh-btn--outline nh-btn--sm" data-feedback="yes">
                    <i data-lucide="thumbs-up"></i> <?php esc_html_e('有帮助', 'nicehelp'); ?>
                </button>
                <button class="nh-btn nh-btn--outline nh-btn--sm" data-feedback="no">
                    <i data-lucide="thumbs-down"></i> <?php esc_html_e('没帮助', 'nicehelp'); ?>
                </button>
            </div>
        </div>

        <div class="nh-article__divider"></div>

        <!-- Prev/Next Navigation -->
        <nav class="nh-article__nav">
            <?php
            $prev = get_previous_post(true, '', 'help_category');
            $next = get_next_post(true, '', 'help_category');
            ?>
            <?php if ($prev) : ?>
                <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="nh-article__nav-link nh-article__nav-link--prev">
                    <span class="nh-article__nav-label">← <?php esc_html_e('上一篇', 'nicehelp'); ?></span>
                    <span class="nh-article__nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                </a>
            <?php endif; ?>
            <?php if ($next) : ?>
                <a href="<?php echo esc_url(get_permalink($next)); ?>" class="nh-article__nav-link nh-article__nav-link--next">
                    <span class="nh-article__nav-label"><?php esc_html_e('下一篇', 'nicehelp'); ?> →</span>
                    <span class="nh-article__nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                </a>
            <?php endif; ?>
        </nav>
    </article>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
