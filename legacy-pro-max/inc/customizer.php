<?php
/**
 * Theme Customizer for Legacy Pro Max
 *
 * @package Legacy_Pro_Max
 */

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

	// -------------------------------------------------------------------------- //
	//                              Theme Settings Panel                          //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_panel(
		'legacy_pro_max_theme_settings',
		array(
			'title'    => __( 'Theme Settings', 'legacy-pro-max' ),
			'priority' => 10,
		)
	);

	// -------------------------------------------------------------------------- //
	//                             Firm Archetype Section                         //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_archetype_section',
		array(
			'title' => __( 'Firm Archetype', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_theme_settings',
		)
	);

	// Firm Archetype Setting
	$wp_customize->add_setting(
		'legacy_pro_max_firm_archetype',
		array(
			'default'           => 'boutique-litigation',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'refresh', // 'postMessage' would require JS handling
		)
	);

	// Firm Archetype Control
	$wp_customize->add_control(
		'legacy_pro_max_firm_archetype',
		array(
			'label'       => __( 'Select Firm Archetype', 'legacy-pro-max' ),
			'section'     => 'legacy_pro_max_archetype_section',
			'type'        => 'select',
			'choices'     => array(
				'boutique-litigation' => __( 'Boutique Litigation', 'legacy-pro-max' ),
				'corporate-counsel'   => __( 'Corporate Counsel', 'legacy-pro-max' ),
				'personal-injury'     => __( 'Personal Injury', 'legacy-pro-max' ),
				'ip-tech-law'         => __( 'IP / Tech Law', 'legacy-pro-max' ),
				'family-law'          => __( 'Family Law', 'legacy-pro-max' ),
				'criminal-defense'    => __( 'Criminal Defense', 'legacy-pro-max' ),
			),
		)
	);

	// -------------------------------------------------------------------------- //
	//                           Legal Compliance Section                         //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_legal_compliance_section',
		array(
			'title' => __( 'Legal Compliance', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_theme_settings',
		)
	);

	// Attorney Advertising Notice Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorney_advertising_notice',
		array(
			'default'           => __( 'Attorney Advertising. Prior results do not guarantee a similar outcome.', 'legacy-pro-max' ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	// Attorney Advertising Notice Control
	$wp_customize->add_control(
		'legacy_pro_max_attorney_advertising_notice',
		array(
			'label'   => __( 'Attorney Advertising Notice', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_legal_compliance_section',
			'type'    => 'textarea',
		)
	);

	// Show Attorney Advertising Notice Setting
	$wp_customize->add_setting(
		'legacy_pro_max_show_attorney_advertising_notice',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

	// Show Attorney Advertising Notice Control
	$wp_customize->add_control(
		'legacy_pro_max_show_attorney_advertising_notice',
		array(
			'label'   => __( 'Show Attorney Advertising Notice', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_legal_compliance_section',
			'type'    => 'checkbox',
		)
	);

	// -------------------------------------------------------------------------- //
	//                           Conversion Tools Section                         //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_conversion_tools_section',
		array(
			'title' => __( 'Conversion Tools', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_theme_settings',
		)
	);

	// Enable Exit-Intent Modal Setting
	$wp_customize->add_setting(
		'legacy_pro_max_enable_exit_intent_modal',
		array(
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

	// Enable Exit-Intent Modal Control
	$wp_customize->add_control(
		'legacy_pro_max_enable_exit_intent_modal',
		array(
			'label'   => __( 'Enable Exit-Intent Modal', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_conversion_tools_section',
			'type'    => 'checkbox',
		)
	);

	// Exit-Intent Modal Title Setting
	$wp_customize->add_setting(
		'legacy_pro_max_exit_intent_modal_title',
		array(
			'default'           => __( 'Before You Go...', 'legacy-pro-max' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Exit-Intent Modal Title Control
	$wp_customize->add_control(
		'legacy_pro_max_exit_intent_modal_title',
		array(
			'label'   => __( 'Exit-Intent Modal Title', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_conversion_tools_section',
			'type'    => 'text',
		)
	);

	// Exit-Intent Modal Content Setting
	$wp_customize->add_setting(
		'legacy_pro_max_exit_intent_modal_content',
		array(
			'default'           => __( 'Have a question? We offer a free, no-obligation consultation.', 'legacy-pro-max' ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	// Exit-Intent Modal Content Control
	$wp_customize->add_control(
		'legacy_pro_max_exit_intent_modal_content',
		array(
			'label'   => __( 'Exit-Intent Modal Content', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_conversion_tools_section',
			'type'    => 'textarea',
		)
	);

	// Exit-Intent Modal Button Text Setting
	$wp_customize->add_setting(
		'legacy_pro_max_exit_intent_modal_button_text',
		array(
			'default'           => __( 'Request a Free Consultation', 'legacy-pro-max' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Exit-Intent Modal Button Text Control
	$wp_customize->add_control(
		'legacy_pro_max_exit_intent_modal_button_text',
		array(
			'label'   => __( 'Exit-Intent Modal Button Text', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_conversion_tools_section',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'legacy_pro_max_customize_register' );


/**
 * Sanitize select input.
 *
 * @param string $input The input from the Customizer.
 * @param WP_Customize_Setting $setting The particular setting being sanitized.
 * @return string The sanitized input.
 */
function legacy_pro_max_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

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
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function legacy_pro_max_customize_preview_js() {
	wp_enqueue_script( 'legacy-pro-max-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), LEGACY_PRO_MAX_VERSION, true );
}
add_action( 'customize_preview_init', 'legacy_pro_max_customize_preview_js' );
