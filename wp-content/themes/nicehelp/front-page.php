<?php
/**
 * Front Page Template
 *
 * @package NiceHelp
 */

get_header();
?>

<!-- Hero Section -->
<section class="nh-hero">
    <div class="nh-hero__inner">
        <div class="nh-hero__badge">
            <i data-lucide="sparkles"></i>
            <span><?php esc_html_e('知识库与文档中心', 'nicehelp'); ?></span>
        </div>

        <h1 class="nh-hero__title"><?php esc_html_e('我们能帮您什么？', 'nicehelp'); ?></h1>

        <p class="nh-hero__subtitle">
            <?php esc_html_e('搜索知识库或浏览以下主题，查找答案、教程和指南。', 'nicehelp'); ?>
        </p>

        <form class="nh-hero__search" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <i data-lucide="search" class="nh-hero__search-icon"></i>
            <input type="search" name="s" class="nh-hero__search-input"
                   placeholder="<?php esc_attr_e('搜索文章、指南、教程...', 'nicehelp'); ?>"
                   value="<?php echo esc_attr(get_search_query()); ?>" />
            <button type="submit" class="nh-btn nh-btn--primary">
                <?php esc_html_e('搜索', 'nicehelp'); ?>
            </button>
        </form>

        <div class="nh-hero__quick-links">
            <span class="nh-hero__quick-label"><?php esc_html_e('热门搜索：', 'nicehelp'); ?></span>
            <?php
            $popular_tags = ['快速入门', '安装指南', '故障排除', 'API'];
            foreach ($popular_tags as $tag) :
            ?>
                <a href="<?php echo esc_url(home_url('/?s=' . urlencode($tag))); ?>" class="nh-tag">
                    <?php echo esc_html($tag); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Category Section -->
<section class="nh-categories">
    <div class="nh-categories__inner">
        <div class="nh-categories__header">
            <span class="nh-section-label"><?php esc_html_e('按主题浏览', 'nicehelp'); ?></span>
            <h2 class="nh-section-title"><?php esc_html_e('热门帮助主题', 'nicehelp'); ?></h2>
            <p class="nh-section-subtitle"><?php esc_html_e('按分类查找答案', 'nicehelp'); ?></p>
        </div>

        <div class="nh-categories__grid">
            <?php
            $categories = get_terms([
                'taxonomy'   => 'help_category',
                'hide_empty' => false,
                'number'     => 6,
            ]);

            if (!empty($categories) && !is_wp_error($categories)) :
                foreach ($categories as $cat) :
                    $icon  = nicehelp_get_cat_icon($cat->term_id);
                    $color = nicehelp_get_cat_color($cat->term_id);
                    $bg    = nicehelp_get_cat_bg($cat->term_id);
                    $count = $cat->count;
            ?>
                <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="nh-category-card">
                    <div class="nh-category-card__icon" style="background-color: <?php echo esc_attr($bg); ?>">
                        <i data-lucide="<?php echo esc_attr($icon); ?>" style="color: <?php echo esc_attr($color); ?>"></i>
                    </div>
                    <h3 class="nh-category-card__title"><?php echo esc_html($cat->name); ?></h3>
                    <p class="nh-category-card__desc"><?php echo esc_html($cat->description); ?></p>
                    <span class="nh-category-card__count" style="color: <?php echo esc_attr($color); ?>">
                        <?php echo esc_html($count . ' 篇文章 →'); ?>
                    </span>
                </a>
            <?php
                endforeach;
            else :
                $demo_cats = [
                    ['icon' => 'rocket', 'title' => '快速入门', 'desc' => '快速设置指南、入门步骤和新用户必备配置。', 'count' => 12, 'color' => '#2563EB', 'bg' => '#EFF6FF'],
                    ['icon' => 'settings', 'title' => '账户与设置', 'desc' => '管理您的个人资料、偏好设置、账单和团队设置。', 'count' => 18, 'color' => '#16A34A', 'bg' => '#F0FDF4'],
                    ['icon' => 'puzzle', 'title' => '集成', 'desc' => '连接第三方工具、API、Webhook 和自动化工作流。', 'count' => 24, 'color' => '#D97706', 'bg' => '#FEF3C7'],
                    ['icon' => 'shield', 'title' => '安全与隐私', 'desc' => '双重认证、数据加密、访问控制和合规功能。', 'count' => 9, 'color' => '#DB2777', 'bg' => '#FDF2F8'],
                    ['icon' => 'book-open', 'title' => '教程与指南', 'desc' => '分步教程、视频教程和最佳实践指南。', 'count' => 32, 'color' => '#7C3AED', 'bg' => '#F5F3FF'],
                    ['icon' => 'wrench', 'title' => '故障排除', 'desc' => '常见问题、错误信息、调试技巧和快速解决方案。', 'count' => 15, 'color' => '#EA580C', 'bg' => '#FFF7ED'],
                ];
                foreach ($demo_cats as $cat) :
            ?>
                <div class="nh-category-card">
                    <div class="nh-category-card__icon" style="background-color: <?php echo esc_attr($cat['bg']); ?>">
                        <i data-lucide="<?php echo esc_attr($cat['icon']); ?>" style="color: <?php echo esc_attr($cat['color']); ?>"></i>
                    </div>
                    <h3 class="nh-category-card__title"><?php echo esc_html($cat['title']); ?></h3>
                    <p class="nh-category-card__desc"><?php echo esc_html($cat['desc']); ?></p>
                    <span class="nh-category-card__count" style="color: <?php echo esc_attr($cat['color']); ?>">
                        <?php echo esc_html($cat['count'] . ' 篇文章 →'); ?>
                    </span>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Featured Articles Section -->
<section class="nh-featured">
    <div class="nh-featured__inner">
        <div class="nh-featured__header">
            <div class="nh-featured__header-left">
                <span class="nh-section-label"><?php esc_html_e('精选文章', 'nicehelp'); ?></span>
                <h2 class="nh-section-title--sm"><?php esc_html_e('最近更新', 'nicehelp'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('help_article')); ?>" class="nh-link">
                <?php esc_html_e('查看全部文章 →', 'nicehelp'); ?>
            </a>
        </div>

        <div class="nh-featured__list">
            <?php
            $featured = new WP_Query([
                'post_type'      => ['help_article', 'post'],
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);

            if ($featured->have_posts()) :
                while ($featured->have_posts()) : $featured->the_post();
                    $post_type = get_post_type();
                    if ($post_type === 'help_article') {
                        $terms = get_the_terms(get_the_ID(), 'help_category');
                        $cat_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '帮助文章';
                        $type_class = 'nh-article-row__cat--help';
                    } else {
                        $cats = get_the_category();
                        $cat_name = !empty($cats) ? $cats[0]->name : '日志';
                        $type_class = 'nh-article-row__cat--post';
                    }
            ?>
                <a href="<?php the_permalink(); ?>" class="nh-article-row">
                    <div class="nh-article-row__content">
                        <div class="nh-article-row__meta">
                            <span class="nh-article-row__cat <?php echo esc_attr($type_class); ?>"><?php echo esc_html($cat_name); ?></span>
                            <span class="nh-article-row__date"><?php echo esc_html(get_the_date()); ?></span>
                        </div>
                        <h3 class="nh-article-row__title"><?php the_title(); ?></h3>
                        <p class="nh-article-row__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
                    </div>
                    <i data-lucide="chevron-right" class="nh-article-row__arrow"></i>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $demo_articles = [
                    ['cat' => '日志', 'type' => 'post', 'title' => '2026 年 2 月产品更新日志', 'desc' => '本月新增功能、改进和修复的完整列表。'],
                    ['cat' => '快速入门', 'type' => 'help', 'title' => '如何设置您的账户', 'desc' => '账户设置流程的完整指南。'],
                    ['cat' => '日志', 'type' => 'post', 'title' => '新功能：团队协作工作区', 'desc' => '全新团队协作功能正式上线，支持多人实时编辑。'],
                    ['cat' => '集成', 'type' => 'help', 'title' => '连接您的第一个 API 集成', 'desc' => 'API 集成设置的分步指南。'],
                    ['cat' => '日志', 'type' => 'post', 'title' => '系统维护通知：2 月 25 日', 'desc' => '计划维护时间及影响范围说明。'],
                    ['cat' => '故障排除', 'type' => 'help', 'title' => '常见登录问题及解决方案', 'desc' => '最常见登录问题的快速修复方法。'],
                ];
                foreach ($demo_articles as $article) :
                    $type_class = $article['type'] === 'post' ? 'nh-article-row__cat--post' : 'nh-article-row__cat--help';
            ?>
                <div class="nh-article-row">
                    <div class="nh-article-row__content">
                        <div class="nh-article-row__meta">
                            <span class="nh-article-row__cat <?php echo esc_attr($type_class); ?>"><?php echo esc_html($article['cat']); ?></span>
                            <span class="nh-article-row__date">2026-02-23</span>
                        </div>
                        <h3 class="nh-article-row__title"><?php echo esc_html($article['title']); ?></h3>
                        <p class="nh-article-row__excerpt"><?php echo esc_html($article['desc']); ?></p>
                    </div>
                    <i data-lucide="chevron-right" class="nh-article-row__arrow"></i>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="nh-faq">
    <div class="nh-faq__inner">
        <div class="nh-faq__header">
            <span class="nh-section-label"><?php esc_html_e('常见问题', 'nicehelp'); ?></span>
            <h2 class="nh-section-title"><?php esc_html_e('常见问题解答', 'nicehelp'); ?></h2>
            <p class="nh-section-subtitle"><?php esc_html_e('找不到您需要的答案？请联系我们的支持团队。', 'nicehelp'); ?></p>
        </div>

        <div class="nh-faq__list">
            <?php
            $faqs = [
                ['q' => '如何重置密码？', 'a' => '您可以在登录页面点击"忘记密码"链接来重置密码。输入您的邮箱地址，我们将发送重置链接。'],
                ['q' => '如何更改订阅计划？', 'a' => '前往 设置 → 账单 → 更改计划。您可以随时升级或降级计划，更改将在下一个计费周期开始时生效。'],
                ['q' => '我可以导出数据吗？', 'a' => '可以，您可以从 设置 → 数据管理 → 导出 中导出所有数据。我们支持 CSV、JSON 和 XML 格式。'],
                ['q' => '如何邀请团队成员？', 'a' => '前往 设置 → 团队 → 邀请成员。输入他们的邮箱地址并选择角色，他们将收到加入工作区的邀请邮件。'],
                ['q' => '免费计划包含哪些内容？', 'a' => '免费计划包含最多 3 名团队成员、5 个项目、基础集成和社区支持。升级到专业版可获得无限访问权限。'],
            ];
            foreach ($faqs as $i => $faq) :
            ?>
                <div class="nh-faq__item<?php echo $i === 1 ? ' is-open' : ''; ?>">
                    <button class="nh-faq__question" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
                        <span><?php echo esc_html($faq['q']); ?></span>
                        <i data-lucide="chevron-down"></i>
                    </button>
                    <div class="nh-faq__answer"<?php echo $i !== 1 ? ' hidden' : ''; ?>>
                        <p><?php echo esc_html($faq['a']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="nh-cta">
    <div class="nh-cta__inner">
        <div class="nh-cta__content">
            <h2 class="nh-cta__title"><?php esc_html_e('仍然需要帮助？', 'nicehelp'); ?></h2>
            <p class="nh-cta__desc">
                <?php esc_html_e('我们的支持团队全天候为您服务。联系我们，我们将在 2 小时内回复您。', 'nicehelp'); ?>
            </p>
            <div class="nh-cta__buttons">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="nh-btn nh-btn--primary nh-btn--lg">
                    <i data-lucide="mail"></i>
                    <?php esc_html_e('联系支持', 'nicehelp'); ?>
                </a>
                <a href="#" class="nh-btn nh-btn--outline nh-btn--lg">
                    <i data-lucide="message-circle"></i>
                    <?php esc_html_e('在线聊天', 'nicehelp'); ?>
                </a>
            </div>
        </div>

        <div class="nh-cta__cards">
            <div class="nh-cta__card">
                <div class="nh-cta__card-icon" style="background-color: #EFF6FF">
                    <i data-lucide="message-circle" style="color: #2563EB"></i>
                </div>
                <h3><?php esc_html_e('在线聊天', 'nicehelp'); ?></h3>
                <p><?php esc_html_e('平均响应时间：2 分钟', 'nicehelp'); ?></p>
            </div>
            <div class="nh-cta__card">
                <div class="nh-cta__card-icon" style="background-color: #F0FDF4">
                    <i data-lucide="phone" style="color: #16A34A"></i>
                </div>
                <h3><?php esc_html_e('电话支持', 'nicehelp'); ?></h3>
                <p><?php esc_html_e('周一至周五 9:00-18:00', 'nicehelp'); ?></p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
