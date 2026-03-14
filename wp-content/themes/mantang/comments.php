<?php
if ( post_password_required() ) {
    return;
}
?>
<div class="comments-area">
    <?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
        <?php comments_number( '暂无评论', '1 条评论', '% 条评论' ); ?>
    </h3>
    <ol class="comment-list">
        <?php
        wp_list_comments( array(
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 36,
        ) );
        ?>
    </ol>
    <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply'          => '发表评论',
        'label_submit'         => '提交评论',
        'comment_notes_before' => '',
    ) );
    ?>
</div>
