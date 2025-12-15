<?php
/**
 * Theme Customizer for Legacy Pro Max
 *
 * @package Legacy_Pro_Max
 */
function legacy_pro_max_sanitize_select( $input, $setting ) {
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function legacy_pro_max_customize_register( $wp_customize ) {
	// ... (Standard partials for blogname, etc.)

    // Homepage Sections Panel
    $wp_customize->add_panel( 'legacy_pro_max_homepage_panel', array(
        'title' => __( 'Homepage Sections', 'legacy-pro-max' ),
        'priority' => 130,
    ) );

    // --- Hero Section ---
    $wp_customize->add_section( 'legacy_pro_max_hero_section', array(
        'title' => __( 'Hero Section', 'legacy-pro-max' ),
        'panel' => 'legacy_pro_max_homepage_panel',
    ) );
    $wp_customize->add_setting( 'legacy_pro_max_hero_show', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control( 'legacy_pro_max_hero_show', ['label' => 'Show Hero Section', 'section' => 'legacy_pro_max_hero_section', 'type' => 'checkbox']);
    $wp_customize->add_setting( 'legacy_pro_max_hero_headline', ['sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'legacy_pro_max_hero_headline', ['label' => 'Headline', 'section' => 'legacy_pro_max_hero_section', 'type' => 'text']);
    // ... (add subheading, button text, button url)
    legacy_pro_max_add_background_controls( $wp_customize, 'legacy_pro_max_hero_section', 'legacy_pro_max_hero' );


    // --- Practice Areas Section ---
    $wp_customize->add_section( 'legacy_pro_max_practice_areas_section', array(
        'title' => __( 'Practice Areas', 'legacy-pro-max' ),
        'panel' => 'legacy_pro_max_homepage_panel',
    ) );
    $wp_customize->add_setting( 'legacy_pro_max_practice_areas_show', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control( 'legacy_pro_max_practice_areas_show', ['label' => 'Show Section', 'section' => 'legacy_pro_max_practice_areas_section', 'type' => 'checkbox']);
    $wp_customize->add_setting( 'legacy_pro_max_practice_areas_title', ['sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'legacy_pro_max_practice_areas_title', ['label' => 'Title', 'section' => 'legacy_pro_max_practice_areas_section', 'type' => 'text']);
    $wp_customize->add_setting( 'legacy_pro_max_practice_areas_columns', ['default' => 3, 'sanitize_callback' => 'absint']);
    $wp_customize->add_control( 'legacy_pro_max_practice_areas_columns', ['label' => 'Number of Columns', 'section' => 'legacy_pro_max_practice_areas_section', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 4]]);
    legacy_pro_max_add_background_controls( $wp_customize, 'legacy_pro_max_practice_areas_section', 'legacy_pro_max_practice_areas' );

    // ... (Repeat for Attorneys, Case Results, Testimonials, CTA, Contact)

    // --- Header Section ---
    $wp_customize->add_section( 'legacy_pro_max_header_section', array(
        'title' => __( 'Header', 'legacy-pro-max' ),
        'priority' => 120,
    ) );
    $wp_customize->add_setting( 'legacy_pro_max_header_sticky', ['default' => false, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control( 'legacy_pro_max_header_sticky', ['label' => 'Enable Sticky Header', 'section' => 'legacy_pro_max_header_section', 'type' => 'checkbox']);

}
add_action( 'customize_register', 'legacy_pro_max_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function legacy_pro_max_customize_preview_js() {
	wp_enqueue_script( 'legacy-pro-max-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'legacy_pro_max_customize_preview_js' );

/**
 * Generate dynamic CSS from Customizer settings.
 */
function legacy_pro_max_dynamic_css() {
    $css = '';
    // ... (Updated logic to target new section classes)

    if (get_theme_mod('legacy_pro_max_header_sticky')) {
        $css .= '.site-header { position: sticky; top: 0; z-index: 1000; }';
    }

    echo '<style type="text/css">' . esc_html($css) . '</style>';
}
add_action('wp_head', 'legacy_pro_max_dynamic_css');

function legacy_pro_max_add_background_controls( $wp_customize, $section_id, $setting_prefix ) {
	// Background Type
	$wp_customize->add_setting(
		$setting_prefix . '_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		$setting_prefix . '_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => $section_id,
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
				'image'    => __( 'Image', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color
	$wp_customize->add_setting(
		$setting_prefix . '_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$setting_prefix . '_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => $section_id,
			)
		)
	);

	// Gradient Color 1
	$wp_customize->add_setting(
		$setting_prefix . '_gradient_color_1',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$setting_prefix . '_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => $section_id,
			)
		)
	);

	// Gradient Color 2
	$wp_customize->add_setting(
		$setting_prefix . '_gradient_color_2',
		array(
			'default'           => '#f0f0f0',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$setting_prefix . '_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => $section_id,
			)
		)
	);

	// Gradient Direction
	$wp_customize->add_setting(
		$setting_prefix . '_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		$setting_prefix . '_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => $section_id,
			'type'    => 'text',
		)
	);

	// Background Image
	$wp_customize->add_setting(
		$setting_prefix . '_background_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			$setting_prefix . '_background_image',
			array(
				'label'   => __( 'Background Image', 'legacy-pro-max' ),
				'section' => $section_id,
			)
		)
	);
}
