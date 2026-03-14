<?php get_header(); ?>

<?php get_template_part( 'template-parts/nav' ); ?>

<div class="error-header">
    <h1 class="error-title">404</h1>
    <p class="error-desc">页面未找到，可能已被移除或地址有误。</p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hero-btn" style="color:#888;border-color:#DDD;margin-top:20px;">返回首页</a>
</div>

<?php get_footer(); ?>
