<?php get_header(); ?>

<?php get_template_part( 'template-parts/nav' ); ?>

<div class="archive-header">
    <?php
    if ( is_category() ) {
        echo '<h1 class="archive-title">' . single_cat_title( '', false ) . '</h1>';
        echo '<p class="archive-desc">' . esc_html( category_description() ) . '</p>';
    } elseif ( is_tag() ) {
        echo '<h1 class="archive-title"># ' . single_tag_title( '', false ) . '</h1>';
    } elseif ( is_author() ) {
        echo '<h1 class="archive-title">' . get_the_author() . '</h1>';
    } elseif ( is_date() ) {
        echo '<h1 class="archive-title">' . get_the_date( 'Y年n月' ) . '</h1>';
    } else {
        echo '<h1 class="archive-title">归档</h1>';
    }
    ?>
</div>

<div class="blog-list-section">
    <div class="post-list">
        <?php
        $index = 0;
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
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
        else :
        ?>
        <p style="text-align:center;color:#888;">暂无漫谈</p>
        <?php endif; ?>
    </div>
    <?php the_posts_pagination( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) ); ?>
</div>

<?php get_footer(); ?>
