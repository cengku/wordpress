<?php get_header(); ?>

<?php
$hero_image = get_header_image();
if ( ! $hero_image ) {
    $hero_image = get_template_directory_uri() . '/assets/images/default-thumb.svg';
}
?>
<section class="hero-section" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
    <?php get_template_part( 'template-parts/nav', null, array( 'hero' => true ) ); ?>
    <div class="hero-body">
        <h1 class="hero-title"><?php bloginfo( 'name' ); ?></h1>
        <p class="hero-subtitle"><?php bloginfo( 'description' ); ?></p>
        <div class="hero-divider"></div>
        <a href="#blog-list" class="hero-btn">探索漫谈</a>
    </div>
    <div class="hero-bottom">
        <svg class="scroll-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </div>
</section>

<section id="blog-list" class="blog-list-section">
    <div class="section-header">
        <h2 class="section-title">最新文章</h2>
    </div>
    <div class="post-list">
        <?php
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $blog_query = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 10,
            'paged'          => $paged,
        ) );
        $index = 0;
        if ( $blog_query->have_posts() ) :
            while ( $blog_query->have_posts() ) : $blog_query->the_post();
                $index++;
                $is_odd = ( $index % 2 === 1 );
                $thumb_url = mantang_get_thumbnail_url( get_the_ID() );
                $cats = get_the_category();
                $cat_name = $cats ? $cats[0]->name : '漫谈';
        ?>
        <?php if ( $index > 1 ) : ?><div class="post-divider"></div><?php endif; ?>
        <article class="post-card <?php echo $is_odd ? 'post-card--odd' : 'post-card--even'; ?>">
            <?php if ( $is_odd ) : ?>
            <div class="post-card__thumb" style="background-image: url('<?php echo esc_url( $thumb_url ); ?>');"></div>
            <div class="post-card__info">
                <span class="post-card__cat"><?php echo esc_html( $cat_name ); ?></span>
                <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="post-card__desc"><?php echo esc_html( mantang_excerpt( 120 ) ); ?></p>
                <span class="post-card__date"><?php echo get_the_date( 'Y.m.d' ); ?></span>
            </div>
            <?php else : ?>
            <div class="post-card__info">
                <span class="post-card__cat"><?php echo esc_html( $cat_name ); ?></span>
                <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="post-card__desc"><?php echo esc_html( mantang_excerpt( 120 ) ); ?></p>
                <span class="post-card__date"><?php echo get_the_date( 'Y.m.d' ); ?></span>
            </div>
            <div class="post-card__thumb" style="background-image: url('<?php echo esc_url( $thumb_url ); ?>');"></div>
            <?php endif; ?>
        </article>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <?php if ( $blog_query->max_num_pages > 1 ) : ?>
    <nav class="pagination">
        <?php
        echo paginate_links( array(
            'total'   => $blog_query->max_num_pages,
            'current' => $paged,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
        ) );
        ?>
    </nav>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
