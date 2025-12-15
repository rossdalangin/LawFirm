<?php
/**
 * Theme Customizer for Legacy Pro Max
 *
 * @package Legacy_Pro_Max
 */

/**
 * Adds a full suite of background controls to a Customizer section.
 *
 * @param WP_Customize_Manager $wp_customize  The Customizer object.
 * @param string               $section_id    The ID of the section to add controls to.
 * @param string               $setting_prefix A prefix for the setting IDs.
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

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function legacy_pro_max_customize_register( $wp_customize ) {
	// ... (rest of the file remains the same)
}
add_action( 'customize_register', 'legacy_pro_max_customize_register' );
