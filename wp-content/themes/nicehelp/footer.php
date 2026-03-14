<?php
/**
 * Footer Template
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;
?>
</main>

<footer class="nh-footer">
    <div class="nh-footer__inner">
        <div class="nh-footer__top">
            <div class="nh-footer__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nh-footer__logo">
                    <i data-lucide="book-open"></i>
                    <span><?php bloginfo('name'); ?></span>
                </a>
                <p class="nh-footer__desc">
                    <?php echo esc_html(get_bloginfo('description') ?: '您的完整知识库和帮助中心。查找所有产品的答案、教程和文档。'); ?>
                </p>
            </div>

            <div class="nh-footer__col">
                <h4 class="nh-footer__col-title">产品</h4>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-product',
                    'container'      => false,
                    'menu_class'     => 'nh-footer__links',
                    'depth'          => 1,
                    'fallback_cb'    => function () {
                        echo '<ul class="nh-footer__links">';
                        echo '<li><a href="#">文档</a></li>';
                        echo '<li><a href="#">API 参考</a></li>';
                        echo '<li><a href="#">更新日志</a></li>';
                        echo '<li><a href="#">状态</a></li>';
                        echo '</ul>';
                    },
                ]);
                ?>
            </div>

            <div class="nh-footer__col">
                <h4 class="nh-footer__col-title">资源</h4>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-resources',
                    'container'      => false,
                    'menu_class'     => 'nh-footer__links',
                    'depth'          => 1,
                    'fallback_cb'    => function () {
                        echo '<ul class="nh-footer__links">';
                        echo '<li><a href="#">博客</a></li>';
                        echo '<li><a href="#">社区</a></li>';
                        echo '<li><a href="#">教程</a></li>';
                        echo '<li><a href="#">网络研讨会</a></li>';
                        echo '</ul>';
                    },
                ]);
                ?>
            </div>

            <div class="nh-footer__col">
                <h4 class="nh-footer__col-title">公司</h4>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-company',
                    'container'      => false,
                    'menu_class'     => 'nh-footer__links',
                    'depth'          => 1,
                    'fallback_cb'    => function () {
                        echo '<ul class="nh-footer__links">';
                        echo '<li><a href="#">关于我们</a></li>';
                        echo '<li><a href="#">招聘</a></li>';
                        echo '<li><a href="#">隐私政策</a></li>';
                        echo '<li><a href="#">服务条款</a></li>';
                        echo '</ul>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="nh-footer__divider"></div>

        <div class="nh-footer__bottom">
            <p class="nh-footer__copyright">
                &copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. 保留所有权利。
            </p>
            <div class="nh-footer__bottom-links">
                <a href="#">隐私</a>
                <a href="#">条款</a>
                <a href="#">网站地图</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
