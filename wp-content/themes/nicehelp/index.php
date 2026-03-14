<?php
/**
 * Main Index Template
 *
 * @package NiceHelp
 */

get_header();
?>

<section class="nh-archive-list">
    <div class="nh-archive-list__inner">
        <div class="nh-archive-list__header">
            <h1 class="nh-archive-list__title">全部帮助文章</h1>
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
                        <span class="nh-archive-card__date"><?php echo esc_html(get_the_modified_date()); ?></span>
                    </div>
                </article>
            <?php endwhile; ?>

            <nav class="nh-pagination" aria-label="分页">
                <?php
                echo paginate_links([
                    'prev_text' => '← 上一页',
                    'next_text' => '下一页 →',
                    'type'      => 'list',
                ]);
                ?>
            </nav>
        <?php else : ?>
            <p>暂无文章。</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
