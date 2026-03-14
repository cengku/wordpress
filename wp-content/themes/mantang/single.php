<?php get_header(); ?>

<?php get_template_part( 'template-parts/nav' ); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php $hero_url = mantang_get_thumbnail_url( get_the_ID(), 'mantang-post-hero' ); ?>
<div class="post-hero-image" style="background-image: url('<?php echo esc_url( $hero_url ); ?>');"></div>

<div class="article-wrapper">
    <article class="article">
        <div class="post-meta">
            <?php
            $cats = get_the_category();
            $cat_name = $cats ? $cats[0]->name : '漫谈';
            ?>
            <span class="post-meta__cat"><?php echo esc_html( $cat_name ); ?></span>
            <h1 class="post-meta__title"><?php the_title(); ?></h1>
            <span class="post-meta__date"><?php echo get_the_date( 'Y年n月j日' ); ?> &middot; 阅读约 <?php echo mantang_reading_time(); ?> 分钟</span>
        </div>
        <div class="post-meta__divider"></div>
        <div class="post-body entry-content">
            <?php the_content(); ?>
        </div>
        <div class="article-footer">
            <div class="article-footer__divider"></div>
            <?php $tags = get_the_tags(); ?>
            <?php if ( $tags ) : ?>
            <div class="article-tags">
                <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-pill"><?php echo esc_html( $tag->name ); ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="post-navigation">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                ?>
                <div class="post-navigation__prev">
                    <?php if ( $prev ) : ?>
                    <span class="post-navigation__label">上一篇</span>
                    <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="post-navigation__title"><?php echo esc_html( $prev->post_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="post-navigation__next">
                    <?php if ( $next ) : ?>
                    <span class="post-navigation__label">下一篇</span>
                    <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="post-navigation__title"><?php echo esc_html( $next->post_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
    </article>
</div>

<?php
$related = mantang_get_related_posts( get_the_ID(), 5 );
if ( $related->have_posts() ) :
?>
<section class="related-posts-section">
    <div class="section-header">
        <h2 class="section-title">相关推荐</h2>
    </div>
    <div class="post-list">
        <?php
        $ri = 0;
        while ( $related->have_posts() ) : $related->the_post();
            $ri++;
            $is_odd = ( $ri % 2 === 1 );
            $thumb_url = mantang_get_thumbnail_url( get_the_ID() );
            $rcats = get_the_category();
            $rcat_name = $rcats ? $rcats[0]->name : '漫谈';
        ?>
        <?php if ( $ri > 1 ) : ?><div class="post-divider"></div><?php endif; ?>
        <article class="post-card <?php echo $is_odd ? 'post-card--odd' : 'post-card--even'; ?>">
            <?php if ( $is_odd ) : ?>
            <div class="post-card__thumb" style="background-image: url('<?php echo esc_url( $thumb_url ); ?>');"></div>
            <div class="post-card__info">
                <span class="post-card__cat"><?php echo esc_html( $rcat_name ); ?></span>
                <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="post-card__desc"><?php echo esc_html( mantang_excerpt( 120 ) ); ?></p>
                <span class="post-card__date"><?php echo get_the_date( 'Y.m.d' ); ?></span>
            </div>
            <?php else : ?>
            <div class="post-card__info">
                <span class="post-card__cat"><?php echo esc_html( $rcat_name ); ?></span>
                <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="post-card__desc"><?php echo esc_html( mantang_excerpt( 120 ) ); ?></p>
                <span class="post-card__date"><?php echo get_the_date( 'Y.m.d' ); ?></span>
            </div>
            <div class="post-card__thumb" style="background-image: url('<?php echo esc_url( $thumb_url ); ?>');"></div>
            <?php endif; ?>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
