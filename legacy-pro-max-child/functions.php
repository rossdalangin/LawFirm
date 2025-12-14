<?php
/**
 * Legacy Pro Max Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Legacy_Pro_Max_Child
 */

/**
 * Enqueue scripts and styles.
 */
function legacy_pro_max_child_enqueue_styles() {
	wp_enqueue_style( 'legacy-pro-max-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'legacy_pro_max_child_enqueue_styles' );
