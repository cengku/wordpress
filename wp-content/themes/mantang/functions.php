<?php
/**
 * 漫谈 Mantang - functions.php
 */

if ( ! defined( 'MANTANG_VERSION' ) ) {
    define( 'MANTANG_VERSION', '1.0.0' );
}

/**
 * Theme setup
 */
function mantang_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header', array(
        'width'       => 1440,
        'height'      => 900,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    set_post_thumbnail_size( 840, 560, true );
    add_image_size( 'mantang-hero', 1440, 900, true );
    add_image_size( 'mantang-post-hero', 1440, 480, true );

    register_nav_menus( array(
        'primary-left'  => __( '导航左侧', 'mantang' ),
        'primary-right' => __( '导航右侧', 'mantang' ),
    ) );
}
add_action( 'after_setup_theme', 'mantang_setup' );

/**
 * Enqueue styles and scripts
 */
function mantang_scripts() {
    wp_enqueue_style( 'mantang-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Noto+Serif+SC:wght@300;400;500;600;700&display=swap', array(), null );
    wp_enqueue_style( 'mantang-style', get_template_directory_uri() . '/assets/css/main.css', array(), MANTANG_VERSION );
    wp_enqueue_style( 'mantang-theme', get_stylesheet_uri(), array( 'mantang-style' ), MANTANG_VERSION );
}
add_action( 'wp_enqueue_scripts', 'mantang_scripts' );

/**
 * Get default thumbnail URL
 */
function mantang_default_thumbnail() {
    return get_template_directory_uri() . '/assets/images/default-thumb.svg';
}

/**
 * Get post thumbnail URL with fallback
 */
function mantang_get_thumbnail_url( $post_id = null, $size = 'post-thumbnail' ) {
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail_url( $post_id, $size );
    }
    return mantang_default_thumbnail();
}

/**
 * Get estimated reading time
 */
function mantang_reading_time( $post_id = null ) {
    $content = get_post_field( 'post_content', $post_id );
    $content = wp_strip_all_tags( $content );
    $length  = mb_strlen( $content );
    $minutes = max( 1, ceil( $length / 500 ) );
    return $minutes;
}

/**
 * Custom excerpt
 */
function mantang_excerpt( $length = 120 ) {
    $content = get_the_content();
    $content = wp_strip_all_tags( $content );
    if ( mb_strlen( $content ) > $length ) {
        $content = mb_substr( $content, 0, $length ) . '……';
    }
    return $content;
}

/**
 * Get related posts (random from same category)
 */
function mantang_get_related_posts( $post_id = null, $count = 5 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $categories = wp_get_post_categories( $post_id );
    $args = array(
        'post__not_in'   => array( $post_id ),
        'posts_per_page' => $count,
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    );
    if ( $categories ) {
        $args['category__in'] = $categories;
    }
    $query = new WP_Query( $args );
    if ( $query->post_count < $count ) {
        $exclude = array( $post_id );
        foreach ( $query->posts as $p ) {
            $exclude[] = $p->ID;
        }
        $fill_args = array(
            'post__not_in'   => $exclude,
            'posts_per_page' => $count - $query->post_count,
            'orderby'        => 'rand',
            'post_status'    => 'publish',
        );
        $fill_query = new WP_Query( $fill_args );
        $query->posts = array_merge( $query->posts, $fill_query->posts );
        $query->post_count = count( $query->posts );
    }
    return $query;
}

/**
 * Custom nav walker - outputs clean markup compatible with WP menu admin
 */
class Mantang_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="sub-menu">';
    }
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = implode( ' ', array_filter( $item->classes ) );
        $output .= '<li class="menu-item ' . esc_attr( $classes ) . '">';
        $output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}

/**
 * Fallback nav
 */
function mantang_fallback_nav_left() {
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="nav-link">Blog</a>';
    echo '<a href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '" class="nav-link">Archive</a>';
}

function mantang_fallback_nav_right() {
    $about = get_page_by_path( 'about' );
    $contact = get_page_by_path( 'contact' );
    if ( $about ) {
        echo '<a href="' . esc_url( get_permalink( $about ) ) . '" class="nav-link">About</a>';
    } else {
        echo '<a href="#" class="nav-link">About</a>';
    }
    if ( $contact ) {
        echo '<a href="' . esc_url( get_permalink( $contact ) ) . '" class="nav-link">Contact</a>';
    } else {
        echo '<a href="#" class="nav-link">Contact</a>';
    }
}
