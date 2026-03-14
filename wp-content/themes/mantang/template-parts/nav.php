<nav class="site-nav <?php echo isset( $args['hero'] ) && $args['hero'] ? 'site-nav--hero' : 'site-nav--post'; ?>">
    <div class="nav-left">
        <?php
        if ( has_nav_menu( 'primary-left' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'primary-left',
                'container'      => false,
                'items_wrap'     => '<ul class="menu">%3$s</ul>',
                'walker'         => new Mantang_Nav_Walker(),
                'depth'          => 2,
            ) );
        } else {
            mantang_fallback_nav_left();
        }
        ?>
    </div>
    <div class="nav-center">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo"><?php bloginfo( 'name' ); ?></a>
    </div>
    <div class="nav-right">
        <?php
        if ( has_nav_menu( 'primary-right' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'primary-right',
                'container'      => false,
                'items_wrap'     => '<ul class="menu">%3$s</ul>',
                'walker'         => new Mantang_Nav_Walker(),
                'depth'          => 2,
            ) );
        } else {
            mantang_fallback_nav_right();
        }
        ?>
    </div>
</nav>
