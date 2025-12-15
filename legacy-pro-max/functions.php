<?php
/**
 * Legacy Pro Max functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Legacy_Pro_Max
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function legacy_pro_max_setup() {
	load_theme_textdomain( 'legacy-pro-max', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array( 'menu-1' => esc_html__( 'Primary', 'legacy-pro-max' ) ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-background', apply_filters( 'legacy_pro_max_custom_background_args', array( 'default-color' => 'ffffff', 'default-image' => '' ) ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-logo', array( 'height' => 250, 'width' => 250, 'flex-width' => true, 'flex-height' => true ) );
}
add_action( 'after_setup_theme', 'legacy_pro_max_setup' );

/**
 * Enqueue scripts and styles.
 */
function legacy_pro_max_scripts() {
    wp_enqueue_style( 'legacy-pro-max-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Merriweather:wght@400;700&display=swap', array(), null );
    wp_enqueue_style( 'legacy-pro-max-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_script( 'legacy-pro-max-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'legacy_pro_max_scripts' );

/**
 * Load core theme functionality.
 */
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/admin-notice.php';

/**
 * Filter front page content to add section wrappers. (To be removed or refactored)
 */
// add_filter( 'the_content', 'legacy_pro_max_filter_front_page_content', 10, 1 );
