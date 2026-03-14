<?php get_header(); ?>

<?php get_template_part( 'template-parts/nav' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
<div class="article-wrapper">
    <article class="article">
        <div class="post-meta">
            <h1 class="post-meta__title"><?php the_title(); ?></h1>
        </div>
        <div class="post-meta__divider"></div>
        <div class="post-body entry-content">
            <?php the_content(); ?>
        </div>
    </article>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>
