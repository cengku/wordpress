<?php
/**
 * Search Form Template
 *
 * @package NiceHelp
 */
?>
<form class="nh-hero__search" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <i data-lucide="search" class="nh-hero__search-icon"></i>
    <input type="search" name="s" class="nh-hero__search-input"
           placeholder="搜索文章..."
           value="<?php echo esc_attr(get_search_query()); ?>" />
    <button type="submit" class="nh-btn nh-btn--primary">
        搜索
    </button>
</form>
