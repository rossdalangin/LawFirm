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
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function legacy_pro_max_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Legacy Pro Max, use a find and replace
		* to change 'legacy-pro-max' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'legacy-pro-max', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'legacy-pro-max' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'legacy_pro_max_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'legacy_pro_max_setup' );


/**
 * Enqueue scripts and styles.
 */
function legacy_pro_max_scripts() {
	wp_enqueue_style( 'legacy-pro-max-style', get_stylesheet_uri(), array(), _S_VERSION );
	// ... (other scripts)
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
 * Filter front page content to add section wrappers.
 */
function legacy_pro_max_filter_front_page_content( $content ) {
	if ( is_front_page() && ! is_home() ) {
		$blocks = parse_blocks( $content );
		$output = '';

		foreach ( $blocks as $index => $block ) {
			$show_setting_name = '';
			$parallax_setting_name = '';
			$section_class = '';
			$block_slug = '';

			if ( isset( $block['blockName'] ) ) {
				$block_slug = str_replace( 'legacy-pro-max/', '', $block['blockName'] );
				$section_class = 'homepage-section--' . esc_attr($block_slug);

				switch ( $block['blockName'] ) {
					case 'legacy-pro-max/hero':
						$show_setting_name = 'legacy_pro_max_hero_show';
						$parallax_setting_name = 'legacy_pro_max_hero_parallax';
						break;
					case 'legacy-pro-max/practice-areas':
						$show_setting_name = 'legacy_pro_max_practice_areas_show';
						break;
					case 'legacy-pro-max/attorneys':
						$show_setting_name = 'legacy_pro_max_attorneys_show';
						break;
					case 'legacy-pro-max/case-results':
						$show_setting_name = 'legacy_pro_max_case_results_show';
						break;
					case 'legacy-pro-max/testimonials':
						$show_setting_name = 'legacy_pro_max_testimonials_show';
						break;
					case 'legacy-pro-max/cta':
						$show_setting_name = 'legacy_pro_max_cta_show';
						break;
					case 'legacy-pro-max/contact':
						$show_setting_name = 'legacy_pro_max_contact_show';
						break;
				}
			}

			// Skip rendering if the section is disabled in the customizer
			if ( ! empty( $show_setting_name ) && ! get_theme_mod( $show_setting_name, true ) ) {
				continue;
			}

			// Add a unique class for more reliable styling
			$unique_class = 'lpm-section-' . ($index + 1) . '-' . $block_slug;
			$section_classes = trim( $section_class . ' ' . $unique_class );

			$wrapper_attributes = '';
			if ( ! empty( $parallax_setting_name ) && get_theme_mod( $parallax_setting_name, false ) ) {
				$wrapper_attributes = ' data-parallax="true"';
			}

			$output .= '<div class="' . $section_classes . '"' . $wrapper_attributes . '>';
			$output .= render_block( $block );
			$output .= '</div>';
		}
		return $output;
	}
	return $content;
}
add_filter( 'the_content', 'legacy_pro_max_filter_front_page_content', 10, 1 );
