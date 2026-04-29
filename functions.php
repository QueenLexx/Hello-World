<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function pr_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'perspective-reflectives' ),
        'footer'  => __( 'Footer Menu', 'perspective-reflectives' ),
    ) );
}
add_action( 'after_setup_theme', 'pr_setup' );

function pr_enqueue_scripts() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'perspective-reflectives-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_script(
        'perspective-reflectives-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
    wp_localize_script( 'perspective-reflectives-main', 'prData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'pr_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'pr_enqueue_scripts' );

function pr_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'perspective-reflectives' ),
        'id'            => 'shop-sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widgets', 'perspective-reflectives' ),
        'id'            => 'footer-widgets',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'pr_widgets_init' );

// Remove WooCommerce default styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Set WooCommerce image dimensions
add_action( 'after_setup_theme', function() {
    add_image_size( 'product-thumb', 600, 500, true );
} );

// Breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', function( $defaults ) {
    $defaults['delimiter'] = ' &rsaquo; ';
    return $defaults;
} );

// Newsletter form handler
function pr_newsletter_subscribe() {
    check_ajax_referer( 'pr_nonce', 'nonce' );
    $email = sanitize_email( $_POST['email'] ?? '' );
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'perspective-reflectives' ) ) );
    }
    // Hook into your preferred email marketing service here
    wp_send_json_success( array( 'message' => __( 'Thank you for subscribing!', 'perspective-reflectives' ) ) );
}
add_action( 'wp_ajax_pr_newsletter', 'pr_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_pr_newsletter', 'pr_newsletter_subscribe' );
