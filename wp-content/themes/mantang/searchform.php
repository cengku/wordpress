<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text">搜索：</span>
        <input type="search" class="search-field" placeholder="搜索文章…" value="<?php echo get_search_query(); ?>" name="s" style="padding:10px 16px;border:1px solid #DDD;border-radius:4px;font-family:'Inter',sans-serif;font-size:14px;width:100%;max-width:400px;outline:none;">
    </label>
    <button type="submit" class="search-submit hero-btn" style="color:#888;border-color:#DDD;margin-left:8px;cursor:pointer;background:none;">搜索</button>
</form>
