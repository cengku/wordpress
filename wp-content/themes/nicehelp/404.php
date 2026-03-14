<?php
/**
 * 404 Template
 *
 * @package NiceHelp
 */

get_header();
?>

<div class="nh-404">
    <i data-lucide="file-question"></i>
    <h1 class="nh-404__title">404</h1>
    <p class="nh-404__desc">您访问的页面不存在或已被移动。请尝试搜索帮助中心。</p>
    <form class="nh-hero__search" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get" style="margin-top: 16px;">
        <i data-lucide="search" class="nh-hero__search-icon"></i>
        <input type="search" name="s" class="nh-hero__search-input"
               placeholder="搜索帮助..." />
        <button type="submit" class="nh-btn nh-btn--primary">搜索</button>
    </form>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nh-btn nh-btn--outline" style="margin-top: 8px;">
        ← 返回帮助中心
    </a>
</div>

<?php get_footer(); ?>
