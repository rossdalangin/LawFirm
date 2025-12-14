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
	//                      Section & Card Styling Panel                        //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_panel(
		'legacy_pro_max_section_card_styling',
		array(
			'title'    => __( 'Section & Card Styling', 'legacy-pro-max' ),
			'priority' => 20,
		)
	);

	// -------------------------------------------------------------------------- //
	//                             Typography Panel                              //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_panel(
		'legacy_pro_max_typography',
		array(
			'title'    => __( 'Typography', 'legacy-pro-max' ),
			'priority' => 30,
		)
	);

	// -------------------------------------------------------------------------- //
	//                         Homepage Sections Panel                            //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_panel(
		'legacy_pro_max_homepage_sections',
		array(
			'title'    => __( 'Homepage Sections', 'legacy-pro-max' ),
			'priority' => 40,
		)
	);

	// -------------------------------------------------------------------------- //
	//                              Hero Section                                  //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_hero_section',
		array(
			'title' => __( 'Hero Section', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_homepage_sections',
		)
	);

	// Background Type Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	// Background Type Control
	$wp_customize->add_control(
		'legacy_pro_max_hero_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_hero_section',
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_background_color',
		array(
			'default'           => 'var(--color-primary)',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Background Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_hero_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_hero_section',
			)
		)
	);

	// Gradient Color 1 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_gradient_color_1',
		array(
			'default'           => '#0a2b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 1 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_hero_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_hero_section',
			)
		)
	);

	// Gradient Color 2 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_gradient_color_2',
		array(
			'default'           => '#1e4877',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 2 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_hero_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_hero_section',
			)
		)
	);

	// Gradient Direction Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Direction Control
	$wp_customize->add_control(
		'legacy_pro_max_hero_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_hero_section',
			'type'    => 'text',
		)
	);

	// Headline Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_headline_font_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Headline Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_hero_headline_font_color',
			array(
				'label'   => __( 'Headline Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_hero_section',
			)
		)
	);

	// Subheading Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_hero_subheading_font_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Subheading Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_hero_subheading_font_color',
			array(
				'label'   => __( 'Subheading Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_hero_section',
			)
		)
	);

	// -------------------------------------------------------------------------- //
	//                         Practice Areas Section                             //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_practice_areas_section',
		array(
			'title' => __( 'Practice Areas Section', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_homepage_sections',
		)
	);

	// Background Type Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_areas_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	// Background Type Control
	$wp_customize->add_control(
		'legacy_pro_max_practice_areas_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_practice_areas_section',
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_areas_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Background Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_areas_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_areas_section',
			)
		)
	);

	// Gradient Color 1 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_areas_gradient_color_1',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 1 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_areas_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_areas_section',
			)
		)
	);

	// Gradient Color 2 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_areas_gradient_color_2',
		array(
			'default'           => '#f0f0f0',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 2 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_areas_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_areas_section',
			)
		)
	);

	// Gradient Direction Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_areas_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Direction Control
	$wp_customize->add_control(
		'legacy_pro_max_practice_areas_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_practice_areas_section',
			'type'    => 'text',
		)
	);

	// Heading Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_areas_heading_font_color',
		array(
			'default'           => '#0a2b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_areas_heading_font_color',
			array(
				'label'   => __( 'Heading Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_areas_section',
			)
		)
	);

	// -------------------------------------------------------------------------- //
	//                              Attorneys Section                               //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_attorneys_section',
		array(
			'title' => __( 'Attorneys Section', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_homepage_sections',
		)
	);

	// Background Type Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorneys_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	// Background Type Control
	$wp_customize->add_control(
		'legacy_pro_max_attorneys_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_attorneys_section',
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorneys_background_color',
		array(
			'default'           => '#f9f9f9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Background Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_attorneys_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_attorneys_section',
			)
		)
	);

	// Gradient Color 1 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorneys_gradient_color_1',
		array(
			'default'           => '#f9f9f9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 1 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_attorneys_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_attorneys_section',
			)
		)
	);

	// Gradient Color 2 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorneys_gradient_color_2',
		array(
			'default'           => '#e9e9e9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 2 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_attorneys_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_attorneys_section',
			)
		)
	);

	// Gradient Direction Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorneys_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Direction Control
	$wp_customize->add_control(
		'legacy_pro_max_attorneys_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_attorneys_section',
			'type'    => 'text',
		)
	);

	// Heading Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_attorneys_heading_font_color',
		array(
			'default'           => '#0a2b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_attorneys_heading_font_color',
			array(
				'label'   => __( 'Heading Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_attorneys_section',
			)
		)
	);


	// -------------------------------------------------------------------------- //
	//                             Case Results Section                           //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_case_results_section',
		array(
			'title' => __( 'Case Results Section', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_homepage_sections',
		)
	);

	// Background Type Setting
	$wp_customize->add_setting(
		'legacy_pro_max_case_results_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	// Background Type Control
	$wp_customize->add_control(
		'legacy_pro_max_case_results_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_case_results_section',
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_case_results_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Background Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_case_results_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_case_results_section',
			)
		)
	);

	// Gradient Color 1 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_case_results_gradient_color_1',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 1 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_case_results_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_case_results_section',
			)
		)
	);

	// Gradient Color 2 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_case_results_gradient_color_2',
		array(
			'default'           => '#f0f0f0',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 2 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_case_results_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_case_results_section',
			)
		)
	);

	// Gradient Direction Setting
	$wp_customize->add_setting(
		'legacy_pro_max_case_results_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Direction Control
	$wp_customize->add_control(
		'legacy_pro_max_case_results_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_case_results_section',
			'type'    => 'text',
		)
	);

	// Heading Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_case_results_heading_font_color',
		array(
			'default'           => '#0a2b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_case_results_heading_font_color',
			array(
				'label'   => __( 'Heading Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_case_results_section',
			)
		)
	);


	// -------------------------------------------------------------------------- //
	//                            Testimonials Section                            //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_testimonials_section',
		array(
			'title' => __( 'Testimonials Section', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_homepage_sections',
		)
	);

	// Background Type Setting
	$wp_customize->add_setting(
		'legacy_pro_max_testimonials_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	// Background Type Control
	$wp_customize->add_control(
		'legacy_pro_max_testimonials_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_testimonials_section',
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_testimonials_background_color',
		array(
			'default'           => '#f9f9f9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Background Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_testimonials_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_testimonials_section',
			)
		)
	);

	// Gradient Color 1 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_testimonials_gradient_color_1',
		array(
			'default'           => '#f9f9f9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 1 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_testimonials_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_testimonials_section',
			)
		)
	);

	// Gradient Color 2 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_testimonials_gradient_color_2',
		array(
			'default'           => '#e9e9e9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 2 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_testimonials_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_testimonials_section',
			)
		)
	);

	// Gradient Direction Setting
	$wp_customize->add_setting(
		'legacy_pro_max_testimonials_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Direction Control
	$wp_customize->add_control(
		'legacy_pro_max_testimonials_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_testimonials_section',
			'type'    => 'text',
		)
	);

	// Heading Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_testimonials_heading_font_color',
		array(
			'default'           => '#0a2b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_testimonials_heading_font_color',
			array(
				'label'   => __( 'Heading Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_testimonials_section',
			)
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

	// -------------------------------------------------------------------------- //
	//                         Practice Area Cards Section                        //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_practice_area_cards_section',
		array(
			'title' => __( 'Practice Area Cards', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_section_card_styling',
		)
	);

	// Background Type Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_area_background_type',
		array(
			'default'           => 'color',
			'sanitize_callback' => 'legacy_pro_max_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	// Background Type Control
	$wp_customize->add_control(
		'legacy_pro_max_practice_area_background_type',
		array(
			'label'   => __( 'Background Type', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_practice_area_cards_section',
			'type'    => 'select',
			'choices' => array(
				'color'    => __( 'Color', 'legacy-pro-max' ),
				'gradient' => __( 'Gradient', 'legacy-pro-max' ),
			),
		)
	);

	// Background Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_area_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Background Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_area_background_color',
			array(
				'label'   => __( 'Background Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_area_cards_section',
			)
		)
	);

	// Gradient Color 1 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_area_gradient_color_1',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 1 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_area_gradient_color_1',
			array(
				'label'   => __( 'Gradient Color 1', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_area_cards_section',
			)
		)
	);

	// Gradient Color 2 Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_area_gradient_color_2',
		array(
			'default'           => '#f0f0f0',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Color 2 Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_practice_area_gradient_color_2',
			array(
				'label'   => __( 'Gradient Color 2', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_practice_area_cards_section',
			)
		)
	);

	// Gradient Direction Setting
	$wp_customize->add_setting(
		'legacy_pro_max_practice_area_gradient_direction',
		array(
			'default'           => 'to right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Gradient Direction Control
	$wp_customize->add_control(
		'legacy_pro_max_practice_area_gradient_direction',
		array(
			'label'   => __( 'Gradient Direction', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_practice_area_cards_section',
			'type'    => 'text',
		)
	);

	// -------------------------------------------------------------------------- //
	//                             Body Text Section                              //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_body_text_section',
		array(
			'title' => __( 'Body Text', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_typography',
		)
	);

	// Body Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_body_font_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Body Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_body_font_color',
			array(
				'label'   => __( 'Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_body_text_section',
			)
		)
	);

	// Body Font Size Setting
	$wp_customize->add_setting(
		'legacy_pro_max_body_font_size',
		array(
			'default'           => '16px',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Body Font Size Control
	$wp_customize->add_control(
		'legacy_pro_max_body_font_size',
		array(
			'label'   => __( 'Font Size', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_body_text_section',
			'type'    => 'text',
		)
	);

	// Body Font Weight Setting
	$wp_customize->add_setting(
		'legacy_pro_max_body_font_weight',
		array(
			'default'           => '400',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Body Font Weight Control
	$wp_customize->add_control(
		'legacy_pro_max_body_font_weight',
		array(
			'label'   => __( 'Font Weight', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_body_text_section',
			'type'    => 'text',
		)
	);

	// -------------------------------------------------------------------------- //
	//                              Headings Section                              //
	// -------------------------------------------------------------------------- //

	$wp_customize->add_section(
		'legacy_pro_max_headings_section',
		array(
			'title' => __( 'Headings', 'legacy-pro-max' ),
			'panel' => 'legacy_pro_max_typography',
		)
	);

	// Heading Font Color Setting
	$wp_customize->add_setting(
		'legacy_pro_max_heading_font_color',
		array(
			'default'           => '#0a2b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Color Control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'legacy_pro_max_heading_font_color',
			array(
				'label'   => __( 'Font Color', 'legacy-pro-max' ),
				'section' => 'legacy_pro_max_headings_section',
			)
		)
	);

	// Heading Font Size Setting
	$wp_customize->add_setting(
		'legacy_pro_max_heading_font_size',
		array(
			'default'           => 'clamp(2.5rem, 6vw, 4rem)',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Size Control
	$wp_customize->add_control(
		'legacy_pro_max_heading_font_size',
		array(
			'label'   => __( 'Font Size', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_headings_section',
			'type'    => 'text',
		)
	);

	// Heading Font Weight Setting
	$wp_customize->add_setting(
		'legacy_pro_max_heading_font_weight',
		array(
			'default'           => '700',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	// Heading Font Weight Control
	$wp_customize->add_control(
		'legacy_pro_max_heading_font_weight',
		array(
			'label'   => __( 'Font Weight', 'legacy-pro-max' ),
			'section' => 'legacy_pro_max_headings_section',
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

/**
 * Generate dynamic CSS from Customizer settings.
 */
function legacy_pro_max_dynamic_css() {
	?>
	<style type="text/css">
		<?php
		// Hero Section
		$hero_background_type = get_theme_mod( 'legacy_pro_max_hero_background_type', 'color' );
		if ( 'color' === $hero_background_type ) {
			echo '.hero { background-color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_hero_background_color', 'var(--color-primary)' ) ) . '; }';
		} else {
			echo '.hero { background-image: linear-gradient(' . esc_attr( get_theme_mod( 'legacy_pro_max_hero_gradient_direction', 'to right' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_hero_gradient_color_1', '#0a2b4b' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_hero_gradient_color_2', '#1e4877' ) ) . '); }';
		}
		echo '.hero .hero__headline { color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_hero_headline_font_color', '#ffffff' ) ) . '; }';
		echo '.hero .hero__subheading { color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_hero_subheading_font_color', '#ffffff' ) ) . '; }';

		// Practice Areas Section
		$practice_areas_background_type = get_theme_mod( 'legacy_pro_max_practice_areas_background_type', 'color' );
		if ( 'color' === $practice_areas_background_type ) {
			echo '.wp-block-group.homepage-section:nth-of-type(1) { background-color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_practice_areas_background_color', '#ffffff' ) ) . '; }';
		} else {
			echo '.wp-block-group.homepage-section:nth-of-type(1) { background-image: linear-gradient(' . esc_attr( get_theme_mod( 'legacy_pro_max_practice_areas_gradient_direction', 'to right' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_practice_areas_gradient_color_1', '#ffffff' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_practice_areas_gradient_color_2', '#f0f0f0' ) ) . '); }';
		}
		echo '.wp-block-group.homepage-section:nth-of-type(1) h2 { color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_practice_areas_heading_font_color', '#0a2b4b' ) ) . '; }';

		// Attorneys Section
		$attorneys_background_type = get_theme_mod( 'legacy_pro_max_attorneys_background_type', 'color' );
		if ( 'color' === $attorneys_background_type ) {
			echo '.wp-block-group.homepage-section:nth-of-type(2) { background-color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_attorneys_background_color', '#f9f9f9' ) ) . '; }';
		} else {
			echo '.wp-block-group.homepage-section:nth-of-type(2) { background-image: linear-gradient(' . esc_attr( get_theme_mod( 'legacy_pro_max_attorneys_gradient_direction', 'to right' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_attorneys_gradient_color_1', '#f9f9f9' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_attorneys_gradient_color_2', '#e9e9e9' ) ) . '); }';
		}
		echo '.wp-block-group.homepage-section:nth-of-type(2) h2 { color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_attorneys_heading_font_color', '#0a2b4b' ) ) . '; }';

		// Case Results Section
		$case_results_background_type = get_theme_mod( 'legacy_pro_max_case_results_background_type', 'color' );
		if ( 'color' === $case_results_background_type ) {
			echo '.wp-block-group.homepage-section:nth-of-type(3) { background-color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_case_results_background_color', '#ffffff' ) ) . '; }';
		} else {
			echo '.wp-block-group.homepage-section:nth-of-type(3) { background-image: linear-gradient(' . esc_attr( get_theme_mod( 'legacy_pro_max_case_results_gradient_direction', 'to right' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_case_results_gradient_color_1', '#ffffff' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_case_results_gradient_color_2', '#f0f0f0' ) ) . '); }';
		}
		echo '.wp-block-group.homepage-section:nth-of-type(3) h2 { color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_case_results_heading_font_color', '#0a2b4b' ) ) . '; }';

		// Testimonials Section
		$testimonials_background_type = get_theme_mod( 'legacy_pro_max_testimonials_background_type', 'color' );
		if ( 'color' === $testimonials_background_type ) {
			echo '.wp-block-group.homepage-section:nth-of-type(4) { background-color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_testimonials_background_color', '#f9f9f9' ) ) . '; }';
		} else {
			echo '.wp-block-group.homepage-section:nth-of-type(4) { background-image: linear-gradient(' . esc_attr( get_theme_mod( 'legacy_pro_max_testimonials_gradient_direction', 'to right' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_testimonials_gradient_color_1', '#f9f9f9' ) ) . ', ' . esc_attr( get_theme_mod( 'legacy_pro_max_testimonials_gradient_color_2', '#e9e9e9' ) ) . '); }';
		}
		echo '.wp-block-group.homepage-section:nth-of-type(4) h2 { color: ' . esc_attr( get_theme_mod( 'legacy_pro_max_testimonials_heading_font_color', '#0a2b4b' ) ) . '; }';

		?>
	</style>
	<?php
}
add_action( 'wp_head', 'legacy_pro_max_dynamic_css' );
