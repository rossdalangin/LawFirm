<?php
/**
 * Legacy Pro Max functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Legacy_Pro_Max
 */

if ( ! defined( 'LEGACY_PRO_MAX_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'LEGACY_PRO_MAX_VERSION', '1.0.0' );
}

if ( ! function_exists( 'legacy_pro_max_setup' ) ) :
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

		// Register widget area.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'legacy-pro-max' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'legacy-pro-max' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'legacy_pro_max_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function legacy_pro_max_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'legacy_pro_max_content_width', 640 );
}
add_action( 'after_setup_theme', 'legacy_pro_max_content_width', 0 );

/**
 * Get the current firm archetype.
 *
 * @return string The slug of the current archetype.
 */
function legacy_pro_max_get_current_archetype() {
	return get_theme_mod( 'legacy_pro_max_firm_archetype', 'boutique-litigation' );
}

/**
 * Register Google fonts for Legacy Pro Max.
 *
 * @return string Google fonts URL for the theme.
 */
function legacy_pro_max_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$archetype = legacy_pro_max_get_current_archetype();

	switch ( $archetype ) {
		case 'boutique-litigation':
			$fonts[] = 'EB+Garamond:ital,wght@0,400;0,700;1,400;1,700';
			$fonts[] = 'Roboto+Condensed:wght@400;700';
			break;
		case 'corporate-counsel':
			$fonts[] = 'Lora:ital,wght@0,400;0,700;1,400;1,700';
			$fonts[] = 'Montserrat:wght@400;700';
			break;
		case 'personal-injury':
			$fonts[] = 'Oswald:wght@400;700';
			$fonts[] = 'Lato:ital,wght@0,300;0,400;0,700;1,400';
			break;
		case 'ip-tech-law':
			$fonts[] = 'Roboto+Mono:wght@400;700';
			$fonts[] = 'Roboto:wght@300;400;700';
			break;
		case 'family-law':
			$fonts[] = 'Playfair+Display:ital,wght@0,400;0,700;1,400';
			$fonts[] = 'Raleway:wght@400;700';
			break;
		case 'criminal-defense':
			$fonts[] = 'Bitter:wght@400;700';
			$fonts[] = 'Open+Sans:wght@400;700';
			break;
		default:
			$fonts[] = 'Merriweather:ital,wght@0,300;0,400;0,700;1,400';
			$fonts[] = 'Lato:ital,wght@0,300;0,400;0,700;1,400';
			break;
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg(
			array(
				'family'  => implode( '&family=', $fonts ),
				'display' => 'swap',
			),
			'https://fonts.googleapis.com/css2'
		);
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function legacy_pro_max_scripts() {
	// Enqueue Google Fonts.
	wp_enqueue_style( 'legacy-pro-max-fonts', legacy_pro_max_fonts_url(), array(), null );

	// Enqueue the design system stylesheet.
	wp_enqueue_style( 'legacy-pro-max-design-system', get_template_directory_uri() . '/css/design-system.css', array(), LEGACY_PRO_MAX_VERSION );

	// Enqueue the archetype stylesheet.
	$archetype = legacy_pro_max_get_current_archetype();
	if ( $archetype ) {
		wp_enqueue_style( 'legacy-pro-max-archetype-' . $archetype, get_template_directory_uri() . '/css/' . $archetype . '.css', array( 'legacy-pro-max-design-system' ), LEGACY_PRO_MAX_VERSION );
	}

	// Enqueue the main stylesheet.
	wp_enqueue_style( 'legacy-pro-max-style', get_stylesheet_uri(), array( 'legacy-pro-max-design-system' ), LEGACY_PRO_MAX_VERSION );
	wp_style_add_data( 'legacy-pro-max-style', 'rtl', 'replace' );

	// Enqueue GSAP.
	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js', array(), '3.13.0', true );

	// Enqueue theme animations.
	wp_enqueue_script( 'legacy-pro-max-animations', get_template_directory_uri() . '/js/animations.js', array( 'gsap' ), LEGACY_PRO_MAX_VERSION, true );

	// Enqueue conversion scripts.
	if ( get_theme_mod( 'legacy_pro_max_enable_exit_intent_modal', false ) ) {
		wp_enqueue_script( 'legacy-pro-max-conversion', get_template_directory_uri() . '/js/conversion.js', array(), LEGACY_PRO_MAX_VERSION, true );
	}

	// Enqueue slider script.
	wp_enqueue_script( 'legacy-pro-max-slider', get_template_directory_uri() . '/js/slider.js', array(), LEGACY_PRO_MAX_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'legacy_pro_max_scripts' );

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Block Editor settings.
 */
function legacy_pro_max_block_editor_settings() {

	// Add theme support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	$editor_styles = array(
		'css/design-system.css',
	);

	$archetype = legacy_pro_max_get_current_archetype();
	if ( $archetype ) {
		$editor_styles[] = 'css/' . $archetype . '.css';
	}

	add_editor_style( $editor_styles );

}
add_action( 'after_setup_theme', 'legacy_pro_max_block_editor_settings' );

/**
 * Register Gutenberg blocks.
 */
function legacy_pro_max_register_blocks() {

	// Register the Hero block.
	register_block_type( get_template_directory() . '/blocks/hero' );
	register_block_type( get_template_directory() . '/blocks/practice-areas' );
	register_block_type( get_template_directory() . '/blocks/attorneys' );
	register_block_type( get_template_directory() . '/blocks/case-results' );
	register_block_type( get_template_directory() . '/blocks/testimonials' );

}
add_action( 'init', 'legacy_pro_max_register_blocks' );

/**
 * Register custom block category.
 */
function legacy_pro_max_register_block_category( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'legacy-pro-max-blocks',
				'title' => __( 'Legacy Pro Max Blocks', 'legacy-pro-max' ),
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'legacy_pro_max_register_block_category', 10, 2 );

/**
 * One Click Demo Import setup.
 */
function legacy_pro_max_ocdi_import_files() {
	return array(
		array(
			'import_file_name'           => 'Boutique Litigation',
			'import_file_url'            => get_template_directory_uri() . '/demo-content/boutique-litigation/content.xml',
			'import_widget_file_url'     => get_template_directory_uri() . '/demo-content/boutique-litigation/widgets.wie',
			'import_customizer_file_url' => get_template_directory_uri() . '/demo-content/boutique-litigation/customizer.dat',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo-content/boutique-litigation/preview.svg',
		),
		array(
			'import_file_name'           => 'Corporate Counsel',
			'import_file_url'            => get_template_directory_uri() . '/demo-content/corporate-counsel/content.xml',
			'import_widget_file_url'     => get_template_directory_uri() . '/demo-content/corporate-counsel/widgets.wie',
			'import_customizer_file_url' => get_template_directory_uri() . '/demo-content/corporate-counsel/customizer.dat',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo-content/corporate-counsel/preview.svg',
		),
		array(
			'import_file_name'           => 'Personal Injury',
			'import_file_url'            => get_template_directory_uri() . '/demo-content/personal-injury/content.xml',
			'import_widget_file_url'     => get_template_directory_uri() . '/demo-content/personal-injury/widgets.wie',
			'import_customizer_file_url' => get_template_directory_uri() . '/demo-content/personal-injury/customizer.dat',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo-content/personal-injury/preview.svg',
		),
		array(
			'import_file_name'           => 'IP / Tech Law',
			'import_file_url'            => get_template_directory_uri() . '/demo-content/ip-tech-law/content.xml',
			'import_widget_file_url'     => get_template_directory_uri() . '/demo-content/ip-tech-law/widgets.wie',
			'import_customizer_file_url' => get_template_directory_uri() . '/demo-content/ip-tech-law/customizer.dat',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo-content/ip-tech-law/preview.svg',
		),
		array(
			'import_file_name'           => 'Family Law',
			'import_file_url'            => get_template_directory_uri() . '/demo-content/family-law/content.xml',
			'import_widget_file_url'     => get_template_directory_uri() . '/demo-content/family-law/widgets.wie',
			'import_customizer_file_url' => get_template_directory_uri() . '/demo-content/family-law/customizer.dat',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo-content/family-law/preview.svg',
		),
		array(
			'import_file_name'           => 'Criminal Defense',
			'import_file_url'            => get_template_directory_uri() . '/demo-content/criminal-defense/content.xml',
			'import_widget_file_url'     => get_template_directory_uri() . '/demo-content/criminal-defense/widgets.wie',
			'import_customizer_file_url' => get_template_directory_uri() . '/demo-content/criminal-defense/customizer.dat',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo-content/criminal-defense/preview.svg',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'legacy_pro_max_ocdi_import_files' );
