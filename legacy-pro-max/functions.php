<?php
/**
 * Legacy Pro Max functions and definitions
 *
 * This file is the heart of the theme. It is responsible for loading all
 * core features, registering menus and widget areas, and enqueuing all
 * scripts and styles.
 *
 * @package Legacy_Pro_Max
 */

define( '_LPM_VERSION', '2.0.0' ); // Version bump for this major architectural fix.

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function legacy_pro_max_setup() {
	load_theme_textdomain( 'legacy-pro-max', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 100, 'width' => 400, 'flex-width' => true, 'flex-height' => true ) );
	register_nav_menus( array( 'primary' => esc_html__( 'Primary Menu', 'legacy-pro-max' ) ) );
}
add_action( 'after_setup_theme', 'legacy_pro_max_setup' );

/**
 * Register widget areas.
 */
function legacy_pro_max_widgets_init() {
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar( array(
            'name'          => sprintf( esc_html__( 'Footer Column %d', 'legacy-pro-max' ), $i ),
            'id'            => 'footer-' . $i,
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}
add_action( 'widgets_init', 'legacy_pro_max_widgets_init' );

/**
 * Enqueue scripts and styles.
 * This function now correctly loads the selected Firm Archetype stylesheet
 * and enqueues all necessary JavaScript for animations and conversions.
 */
function legacy_pro_max_scripts() {
    // Get the selected archetype from the Customizer.
    $archetype = get_theme_mod('legacy_pro_max_firm_archetype', 'corporate-counsel');

    // Enqueue the base design system and the selected archetype's stylesheet.
    wp_enqueue_style( 'legacy-pro-max-design-system', get_template_directory_uri() . '/css/design-system.css', array(), _LPM_VERSION );
    wp_enqueue_style( 'legacy-pro-max-archetype-style', get_template_directory_uri() . '/css/' . esc_attr($archetype) . '.css', array('legacy-pro-max-design-system'), _LPM_VERSION );
    wp_enqueue_style( 'legacy-pro-max-main-style', get_stylesheet_uri(), array('legacy-pro-max-archetype-style'), _LPM_VERSION );

    // Enqueue GSAP for animations.
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js', array(), null, true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js', array('gsap'), null, true);

    // Enqueue the theme's main JavaScript file which handles all animations and interactions.
    wp_enqueue_script( 'legacy-pro-max-main', get_template_directory_uri() . '/js/animations.js', array('gsap', 'gsap-scrolltrigger'), _LPM_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'legacy_pro_max_scripts' );

/**
 * Load all core theme functionality files from the /inc directory.
 * This is the engine of the theme.
 */
$theme_inc_files = array(
    '/custom-post-types.php', // Registers CPTs like Attorneys, Practice Areas.
    '/template-tags.php',     // Contains custom template functions.
    '/customizer.php',        // The complete, functional Customizer implementation.
    '/demo-import.php',       // Sets Customizer content during demo import.
);

foreach ( $theme_inc_files as $file ) {
    require_once get_template_directory() . '/inc' . $file;
}
