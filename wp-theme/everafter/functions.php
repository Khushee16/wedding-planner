<?php
/**
 * EverAfter Events theme functions.
 *
 * @package EverAfter
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme setup: title tag, thumbnails, custom logo, HTML5, nav menus.
 */
function everafter_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'everafter' ),
        'footer'  => __( 'Footer Menu', 'everafter' ),
    ) );
}
add_action( 'after_setup_theme', 'everafter_setup' );

/**
 * Enqueue Bootstrap 5, Google Fonts and the theme stylesheet.
 */
function everafter_enqueue_assets() {
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    wp_enqueue_style( 'everafter-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Jost:wght@300;400;500;600&display=swap', array(), null );
    wp_enqueue_style( 'everafter-style', get_stylesheet_uri(), array( 'bootstrap' ), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
}
add_action( 'wp_enqueue_scripts', 'everafter_enqueue_assets' );

/**
 * Register a private custom post type to store enquiry submissions
 * (visible in wp-admin under "Enquiries"; never shown on the front end).
 */
function everafter_register_enquiry_cpt() {
    register_post_type( 'everafter_enquiry', array(
        'labels' => array(
            'name'          => __( 'Enquiries', 'everafter' ),
            'singular_name' => __( 'Enquiry', 'everafter' ),
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'supports'            => array( 'title', 'editor', 'custom-fields' ),
        'capability_type'     => 'post',
        'menu_icon'           => 'dashicons-email-alt',
        'menu_position'       => 25,
    ) );
}
add_action( 'init', 'everafter_register_enquiry_cpt' );

/**
 * Fallback menu when no menu is assigned to the Primary location.
 */
function everafter_fallback_menu() {
    echo '<ul class="navbar-nav ms-auto align-items-lg-center">';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'everafter' ) . '</a></li>';
    $packages = get_page_by_path( 'packages' );
    $gallery  = get_page_by_path( 'gallery' );
    if ( $packages ) {
        echo '<li class="nav-item"><a class="nav-link" href="' . esc_url( get_permalink( $packages ) ) . '">' . esc_html__( 'Packages', 'everafter' ) . '</a></li>';
    }
    if ( $gallery ) {
        echo '<li class="nav-item"><a class="nav-link" href="' . esc_url( get_permalink( $gallery ) ) . '">' . esc_html__( 'Gallery', 'everafter' ) . '</a></li>';
    }
    echo '</ul>';
}
