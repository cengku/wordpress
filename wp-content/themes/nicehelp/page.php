<?php
/**
 * Generic Page Template
 *
 * @package NiceHelp
 */

get_header();

while (have_posts()) : the_post();
?>

<div class="nh-article-layout" style="max-width: 900px; margin: 0 auto;">
    <article class="nh-article" style="width: 100%;">
        <header class="nh-article__header">
            <h1 class="nh-article__title"><?php the_title(); ?></h1>
        </header>
        <div class="nh-article__divider"></div>
        <div class="nh-article__body">
            <?php the_content(); ?>
        </div>
    </article>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
