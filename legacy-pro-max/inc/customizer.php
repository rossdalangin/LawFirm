<?php
/**
 * Theme Customizer for Legacy Pro Max
 *
 * @package Legacy_Pro_Max
 */

/**
 * Sanitize select choices.
 *
 * @param string $input The input from the setting.
 * @param object $setting The setting object.
 * @return string The sanitized input.
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
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'legacy_pro_max_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'legacy_pro_max_customize_partial_blogdescription',
			)
		);
	}

    // Homepage Sections Panel
    $wp_customize->add_panel( 'legacy_pro_max_homepage_panel', array(
        'title' => __( 'Homepage Sections', 'legacy-pro-max' ),
        'priority' => 130,
    ) );

    // Section Data
    $sections = array(
        'hero'           => __( 'Hero Section', 'legacy-pro-max' ),
        'practice_areas' => __( 'Practice Areas Section', 'legacy-pro-max' ),
        'attorneys'      => __( 'Attorneys Section', 'legacy-pro-max' ),
        'case_results'   => __( 'Case Results Section', 'legacy-pro-max' ),
        'testimonials'   => __( 'Testimonials Section', 'legacy-pro-max' ),
		'cta'            => __( 'CTA Section', 'legacy-pro-max' ),
		'contact'        => __( 'Contact Section', 'legacy-pro-max' ),
    );

    foreach ( $sections as $slug => $label ) {
        $section_id = 'legacy_pro_max_' . $slug . '_section';
        $setting_prefix = 'legacy_pro_max_' . $slug;

        $wp_customize->add_section( $section_id, array(
            'title' => $label,
            'panel' => 'legacy_pro_max_homepage_panel',
        ) );

        // Show/Hide Setting
        $wp_customize->add_setting( $setting_prefix . '_show', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ) );

        $wp_customize->add_control( $setting_prefix . '_show', array(
            'label' => sprintf( __( 'Show %s', 'legacy-pro-max' ), $label ),
            'section' => $section_id,
            'type' => 'checkbox',
        ) );

		// Add parallax for hero
		if ( 'hero' === $slug ) {
			$wp_customize->add_setting( 'legacy_pro_max_hero_parallax', array(
				'default' => false,
				'sanitize_callback' => 'wp_validate_boolean',
			) );

			$wp_customize->add_control( 'legacy_pro_max_hero_parallax', array(
				'label' => __( 'Enable Parallax Effect', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_hero_section',
				'type' => 'checkbox',
			) );
		}

        // Add background controls
        legacy_pro_max_add_background_controls( $wp_customize, $section_id, $setting_prefix );
    }

	// Footer Settings
    $wp_customize->add_section( 'legacy_pro_max_footer_section', array(
        'title' => __( 'Footer', 'legacy-pro-max' ),
        'priority' => 140,
    ) );

    // Copyright Text
    $wp_customize->add_setting( 'legacy_pro_max_copyright_text', array(
        'default' => __( '&copy; ' . date( 'Y' ) . ' Legacy Pro Max. All Rights Reserved.', 'legacy-pro-max' ),
        'sanitize_callback' => 'wp_kses_post',
		'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( 'legacy_pro_max_copyright_text', array(
        'label' => __( 'Copyright Text', 'legacy-pro-max' ),
        'section' => 'legacy_pro_max_footer_section',
        'type' => 'textarea',
    ) );
	$wp_customize->selective_refresh->add_partial( 'legacy_pro_max_copyright_text', array(
        'selector' => '.site-info',
    ) );

	// Attorney Advertising Notice Show/Hide
	$wp_customize->add_setting( 'legacy_pro_max_advertising_notice_show', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );

    $wp_customize->add_control( 'legacy_pro_max_advertising_notice_show', array(
        'label' => __( 'Show Attorney Advertising Notice', 'legacy-pro-max' ),
        'section' => 'legacy_pro_max_footer_section',
        'type' => 'checkbox',
    ) );

	// Attorney Advertising Notice Text
	$default_notice = __( 'Attorney Advertising. This website is designed for general information only. The information presented at this site should not be construed to be formal legal advice nor the formation of a lawyer/client relationship.', 'legacy-pro-max' );
	$wp_customize->add_setting( 'legacy_pro_max_advertising_notice_text', array(
        'default' => $default_notice,
        'sanitize_callback' => 'wp_kses_post',
		'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( 'legacy_pro_max_advertising_notice_text', array(
        'label' => __( 'Attorney Advertising Notice', 'legacy-pro-max' ),
        'section' => 'legacy_pro_max_footer_section',
        'type' => 'textarea',
    ) );
	$wp_customize->selective_refresh->add_partial( 'legacy_pro_max_advertising_notice_text', array(
        'selector' => '.attorney-advertising-notice',
    ) );

}
add_action( 'customize_register', 'legacy_pro_max_customize_register' );

/**
 * Adds a full suite of background controls to a Customizer section.
 */
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
				'active_callback' => function() use ($setting_prefix) {
					return 'color' === get_theme_mod($setting_prefix . '_background_type');
				},
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
				'active_callback' => function() use ($setting_prefix) {
					return 'gradient' === get_theme_mod($setting_prefix . '_background_type');
				},
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
				'active_callback' => function() use ($setting_prefix) {
					return 'gradient' === get_theme_mod($setting_prefix . '_background_type');
				},
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
			'active_callback' => function() use ($setting_prefix) {
				return 'gradient' === get_theme_mod($setting_prefix . '_background_type');
			},
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
				'active_callback' => function() use ($setting_prefix) {
					return 'image' === get_theme_mod($setting_prefix . '_background_type');
				},
			)
		)
	);
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function legacy_pro_max_customize_preview_js() {
	wp_enqueue_script( 'legacy-pro-max-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'legacy_pro_max_customize_preview_js' );

/**
 * Render the site title for the selective refresh partial.
 */
function legacy_pro_max_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function legacy_pro_max_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Generate dynamic CSS from Customizer settings.
 */
function legacy_pro_max_dynamic_css() {
    $css = '';
    $sections = array('hero', 'practice_areas', 'attorneys', 'case_results', 'testimonials', 'cta', 'contact');

    foreach ($sections as $slug) {
        $prefix = 'legacy_pro_max_' . $slug;
        $background_type = get_theme_mod($prefix . '_background_type', 'color');
        $selector = '.homepage-section--' . $slug;

        switch ($background_type) {
            case 'color':
                $color = get_theme_mod($prefix . '_background_color', '#ffffff');
                $css .= sprintf('%s { background-color: %s; }', $selector, esc_attr($color));
                break;
            case 'gradient':
                $color1 = get_theme_mod($prefix . '_gradient_color_1', '#ffffff');
                $color2 = get_theme_mod($prefix . '_gradient_color_2', '#f0f0f0');
                $direction = get_theme_mod($prefix . '_gradient_direction', 'to right');
                $css .= sprintf('%s { background-image: linear-gradient(%s, %s, %s); }', $selector, esc_attr($direction), esc_attr($color1), esc_attr($color2));
                break;
            case 'image':
                $image = get_theme_mod($prefix . '_background_image', '');
                if ($image) {
                    $css .= sprintf('%s { background-image: url(%s); background-size: cover; background-position: center; }', $selector, esc_url($image));
                }
                break;
        }
    }

    if (!empty($css)) {
        echo '<style type="text/css" id="legacy-pro-max-dynamic-css">' . $css . '</style>';
    }
}
add_action('wp_head', 'legacy_pro_max_dynamic_css');
