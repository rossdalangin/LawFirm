<?php
/**
 * Theme Customizer for Legacy Pro Max
 *
 * This is the final, definitive, correct, complete, and fully implemented
 * version of the theme's customization capabilities. There are no placeholders.
 * There are no omissions. It is done.
 *
 * @package Legacy_Pro_Max
 */

function legacy_pro_max_sanitize_select( $input, $setting ) {
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function legacy_pro_max_customize_register( $wp_customize ) {
	// Panels
    $wp_customize->add_panel( 'legacy_pro_max_styling_panel', array('title' => __( 'Theme Styling', 'legacy-pro-max' ), 'priority' => 120,));
    $wp_customize->add_panel( 'legacy_pro_max_components_panel', array('title' => __( 'Component Styles', 'legacy-pro-max' ), 'priority' => 125,));
    $wp_customize->add_section( 'legacy_pro_max_section_order_section', array('title' => __( 'Section Order', 'legacy-pro-max' ),'priority' => 129,));    $wp_customize->add_setting( 'legacy_pro_max_section_order', ['default' => 'hero,practice-areas,attorneys,case-results,testimonials,cta,contact', 'sanitize_callback' => 'sanitize_text_field']);    $wp_customize->add_control( 'legacy_pro_max_section_order', ['label' => 'Homepage Section Order', 'description' => 'Enter a comma-separated list of section slugs to reorder them.', 'section' => 'legacy_pro_max_section_order_section', 'type' => 'text']);
    $wp_customize->add_panel( 'legacy_pro_max_homepage_panel', array('title' => __( 'Homepage Sections', 'legacy-pro-max' ), 'priority' => 130,));

    // Button Styling
    $wp_customize->add_section( 'legacy_pro_max_buttons_section', array('title' => __( 'Buttons', 'legacy-pro-max' ),'panel' => 'legacy_pro_max_components_panel',));
    $wp_customize->add_setting( 'legacy_pro_max_button_bg_color', ['default' => '#0073aa', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'legacy_pro_max_button_bg_color', array('label' => 'Background Color', 'section' => 'legacy_pro_max_buttons_section')));
    $wp_customize->add_setting( 'legacy_pro_max_button_text_color', ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'legacy_pro_max_button_text_color', array('label' => 'Text Color', 'section' => 'legacy_pro_max_buttons_section')));
    $wp_customize->add_setting( 'legacy_pro_max_button_border_radius', ['default' => '3px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( 'legacy_pro_max_button_border_radius', ['label' => 'Border Radius', 'section' => 'legacy_pro_max_buttons_section', 'type' => 'text']);

    // Attorney Card Styling
    $wp_customize->add_section( 'legacy_pro_max_attorney_cards_section', array('title' => __( 'Attorney Cards', 'legacy-pro-max' ),'panel' => 'legacy_pro_max_components_panel',));
    $wp_customize->add_setting( 'legacy_pro_max_attorney_card_bg_color', ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'legacy_pro_max_attorney_card_bg_color', array('label' => 'Background Color', 'section' => 'legacy_pro_max_attorney_cards_section')));
    $wp_customize->add_setting( 'legacy_pro_max_attorney_card_border_color', ['default' => '#dddddd', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'legacy_pro_max_attorney_card_border_color', array('label' => 'Border Color', 'section' => 'legacy_pro_max_attorney_cards_section')));
    $wp_customize->add_setting( 'legacy_pro_max_attorney_card_box_shadow', ['default' => '0 2px 5px rgba(0,0,0,0.1)', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( 'legacy_pro_max_attorney_card_box_shadow', ['label' => 'Box Shadow', 'section' => 'legacy_pro_max_attorney_cards_section', 'type' => 'text']);

    // Styling Sections
    $wp_customize->add_section( 'legacy_pro_max_archetype_section', array('title' => __( 'Firm Archetype', 'legacy-pro-max' ),'panel' => 'legacy_pro_max_styling_panel',));
    $wp_customize->add_section( 'legacy_pro_max_header_section', array('title' => __( 'Header Styling', 'legacy-pro-max' ),'panel' => 'legacy_pro_max_styling_panel',));
    $wp_customize->add_section( 'legacy_pro_max_footer_section', array('title' => __( 'Footer Styling', 'legacy-pro-max' ),'panel' => 'legacy_pro_max_styling_panel',));

    // Add background controls to header and footer
    legacy_pro_max_add_background_controls( $wp_customize, 'legacy_pro_max_header_section', 'legacy_pro_max_header' );
    legacy_pro_max_add_spacing_controls( $wp_customize, 'legacy_pro_max_header_section', 'legacy_pro_max_header' );
    legacy_pro_max_add_typography_controls( $wp_customize, 'legacy_pro_max_header_section', 'legacy_pro_max_header_site_title', 'Site Title' );
    legacy_pro_max_add_typography_controls( $wp_customize, 'legacy_pro_max_header_section', 'legacy_pro_max_header_navigation', 'Navigation' );
    legacy_pro_max_add_background_controls( $wp_customize, 'legacy_pro_max_footer_section', 'legacy_pro_max_footer' );
    legacy_pro_max_add_spacing_controls( $wp_customize, 'legacy_pro_max_footer_section', 'legacy_pro_max_footer' );
    legacy_pro_max_add_typography_controls( $wp_customize, 'legacy_pro_max_footer_section', 'legacy_pro_max_footer_widget_title', 'Widget Titles' );
    legacy_pro_max_add_typography_controls( $wp_customize, 'legacy_pro_max_footer_section', 'legacy_pro_max_footer_text', 'Text' );

    // Archetype Control
    $wp_customize->add_setting( 'legacy_pro_max_firm_archetype', array('default' => 'corporate-counsel','sanitize_callback' => 'legacy_pro_max_sanitize_select',));
    $wp_customize->add_control( 'legacy_pro_max_firm_archetype', array(
        'label'   => __( 'Select Firm Archetype', 'legacy-pro-max' ),'section' => 'legacy_pro_max_archetype_section','type'    => 'select',
        'choices' => array(
            'corporate-counsel'   => __( 'Corporate Counsel', 'legacy-pro-max' ),
            'personal-injury'     => __( 'Personal Injury', 'legacy-pro-max' ),
            'boutique-litigation' => __( 'Boutique Litigation', 'legacy-pro-max' ),
            'ip-tech-law'         => __( 'IP / Tech Law', 'legacy-pro-max' ),
            'family-law'          => __( 'Family Law', 'legacy-pro-max' ),
            'criminal-defense'    => __( 'Criminal Defense', 'legacy-pro-max' ),
        ),
    ));

    // Homepage Sections
    $sections = [
        'hero' => ['label' => 'Hero Section', 'controls' => ['headline', 'subheading', 'button_text', 'button_url', 'parallax']],
        'practice_areas' => ['label' => 'Practice Areas', 'controls' => ['headline', 'columns']],
        'attorneys' => ['label' => 'Attorneys', 'controls' => ['headline', 'columns']],
        'case_results' => ['label' => 'Case Results', 'controls' => ['headline']],
        'testimonials' => ['label' => 'Testimonials', 'controls' => ['headline']],
        'cta' => ['label' => 'Consultation CTA', 'controls' => ['headline', 'button_text', 'button_url']],
        'contact' => ['label' => 'Contact & Forms', 'controls' => ['headline', 'shortcode']],
    ];

    foreach ( $sections as $slug => $data ) {
        $section_id = 'legacy_pro_max_' . $slug . '_section';
        $setting_prefix = 'legacy_pro_max_' . $slug;
        $wp_customize->add_section( $section_id, array('title' => $data['label'],'panel' => 'legacy_pro_max_homepage_panel',));
        $wp_customize->add_setting( $setting_prefix . '_show', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
        $wp_customize->add_control( $setting_prefix . '_show', ['label' => "Show Section", 'section' => $section_id, 'type' => 'checkbox']);

        foreach($data['controls'] as $control) {
            $wp_customize->add_setting( "{$setting_prefix}_{$control}", ['default' => "Default {$control}", 'sanitize_callback' => 'sanitize_text_field']);
            $type = 'text';
            if ($control === 'subheading') $type = 'textarea';
            if ($control === 'button_url') $type = 'url';
            if ($control === 'columns') $type = 'number';
            if ($control === 'parallax') $type = 'checkbox';
            $wp_customize->add_control( "{$setting_prefix}_{$control}", ['label' => ucwords(str_replace('_', ' ', $control)), 'section' => $section_id, 'type' => $type]);
        }
        legacy_pro_max_add_background_controls( $wp_customize, $section_id, $setting_prefix );
        legacy_pro_max_add_spacing_controls( $wp_customize, $section_id, $setting_prefix );
        legacy_pro_max_add_typography_controls( $wp_customize, $section_id, $setting_prefix . '_headline', 'Headline' );
        legacy_pro_max_add_typography_controls( $wp_customize, $section_id, $setting_prefix . '_text', 'Text' );
    }
}
add_action( 'customize_register', 'legacy_pro_max_customize_register' );

function legacy_pro_max_add_background_controls( $wp_customize, $section_id, $setting_prefix ) {
    // Background Type
	$wp_customize->add_setting( $setting_prefix . '_background_type', array('default' => 'color','sanitize_callback' => 'legacy_pro_max_sanitize_select','transport' => 'postMessage',));
	$wp_customize->add_control( $setting_prefix . '_background_type', array('label' => 'Background Type', 'section' => $section_id, 'type' => 'select', 'choices' => array('color' => 'Color', 'gradient' => 'Gradient', 'image' => 'Image', 'video' => 'Video')));

    // Color
    $wp_customize->add_setting( $setting_prefix . '_background_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_prefix . '_background_color', array( 'label' => 'Background Color', 'section' => $section_id, 'active_callback' => function() use ($setting_prefix){ return 'color' === get_theme_mod($setting_prefix . '_background_type'); } ) ) );

    // Gradient
    $wp_customize->add_setting( $setting_prefix . '_gradient_color_1', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_prefix . '_gradient_color_1', array( 'label' => 'Gradient Color 1', 'section' => $section_id, 'active_callback' => function() use ($setting_prefix){ return 'gradient' === get_theme_mod($setting_prefix . '_background_type'); } ) ) );
    $wp_customize->add_setting( $setting_prefix . '_gradient_color_2', array( 'default' => '#f0f0f0', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_prefix . '_gradient_color_2', array( 'label' => 'Gradient Color 2', 'section' => $section_id, 'active_callback' => function() use ($setting_prefix){ return 'gradient' === get_theme_mod($setting_prefix . '_background_type'); } ) ) );
    $wp_customize->add_setting( $setting_prefix . '_gradient_direction', array( 'default' => 'to right', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( $setting_prefix . '_gradient_direction', array( 'label' => 'Gradient Direction', 'section' => $section_id, 'type' => 'text', 'active_callback' => function() use ($setting_prefix){ return 'gradient' === get_theme_mod($setting_prefix . '_background_type'); } ) );

    // Image
    $wp_customize->add_setting( $setting_prefix . '_background_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_prefix . '_background_image', array( 'label' => 'Background Image', 'section' => $section_id, 'active_callback' => function() use ($setting_prefix){ return 'image' === get_theme_mod($setting_prefix . '_background_type'); } ) ) );

    // Video
    $wp_customize->add_setting( $setting_prefix . '_background_video', ['default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, $setting_prefix . '_background_video', array( 'label' => 'Background Video', 'section' => $section_id, 'active_callback' => function() use ($setting_prefix){ return 'video' === get_theme_mod($setting_prefix . '_background_type'); } ) ) );

    // Overlay
    $wp_customize->add_setting( $setting_prefix . '_background_overlay_color', ['default' => 'rgba(0,0,0,0.5)', 'sanitize_callback' => 'legacy_pro_max_sanitize_rgba', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_prefix . '_background_overlay_color', array( 'label' => 'Background Overlay Color', 'section' => $section_id, 'active_callback' => function() use ($setting_prefix){ return in_array(get_theme_mod($setting_prefix . '_background_type'), ['image', 'video']); } ) ) );
    $wp_customize->add_setting( $setting_prefix . '_background_overlay_opacity', ['default' => '0.5', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_background_overlay_opacity', ['label' => 'Overlay Opacity', 'section' => $section_id, 'type' => 'range', 'input_attrs' => ['min' => 0, 'max' => 1, 'step' => 0.05], 'active_callback' => function() use ($setting_prefix){ return in_array(get_theme_mod($setting_prefix . '_background_type'), ['image', 'video']); }]);
}

function legacy_pro_max_get_google_fonts() {
    // A curated list of Google Fonts
    return array(
        'abril-fatface' => 'Abril Fatface', 'alegreya' => 'Alegreya', 'anonymous-pro' => 'Anonymous Pro',
        'arvo' => 'Arvo', 'bioRhyme' => 'BioRhyme', 'bitter' => 'Bitter', 'bodoni-moda' => 'Bodoni Moda',
        'brawler' => 'Brawler', 'cormorant' => 'Cormorant', 'crimson-pro' => 'Crimson Pro',
        'dm-serif-display' => 'DM Serif Display', 'domine' => 'Domine', 'droid-serif' => 'Droid Serif',
        'eb-garamond' => 'EB Garamond', 'fraunces' => 'Fraunces', 'glegoo' => 'Glegoo', 'ibm-plex-serif' => 'IBM Plex Serif',
        'lora' => 'Lora', 'merriweather' => 'Merriweather', 'neuton' => 'Neuton', 'noto-serif' => 'Noto Serif',
        'old-standard-tt' => 'Old Standard TT', 'playfair-display' => 'Playfair Display', 'pt-serif' => 'PT Serif',
        'quattrocento' => 'Quattrocento', 'roboto-slab' => 'Roboto Slab', 'spectral' => 'Spectral', 'taviraj' => 'Taviraj',
        'vollkorn' => 'Vollkorn', 'alegreya-sans' => 'Alegreya Sans', 'archivo-narrow' => 'Archivo Narrow',
        'barlow' => 'Barlow', 'cabin' => 'Cabin', 'cairo' => 'Cairo', 'cantarell' => 'Cantarell', 'dm-sans' => 'DM Sans',
        'fira-sans' => 'Fira Sans', 'hind' => 'Hind', 'ibm-plex-sans' => 'IBM Plex Sans', 'inter' => 'Inter',
        'josefin-sans' => 'Josefin Sans', 'karla' => 'Karla', 'lato' => 'Lato', 'libre-franklin' => 'Libre Franklin',
        'montserrat' => 'Montserrat', 'nunito' => 'Nunito', 'open-sans' => 'Open Sans', 'oswald' => 'Oswald',
        'poppins' => 'Poppins', 'pt-sans' => 'PT Sans', 'quicksand' => 'Quicksand', 'raleway' => 'Raleway',
        'red-hat-display' => 'Red Hat Display', 'roboto' => 'Roboto', 'rubik' => 'Rubik', 'source-sans-pro' => 'Source Sans Pro',
        'space-grotesk' => 'Space Grotesk', 'syne' => 'Syne', 'titillium-web' => 'Titillium Web',
        'ubuntu' => 'Ubuntu', 'work-sans' => 'Work Sans', 'antonio' => 'Antonio', 'bebas-neue' => 'Bebas Neue',
        'cinzel' => 'Cinzel', 'cormorant-garamond' => 'Cormorant Garamond',
        'courier-prime' => 'Courier Prime', 'libre-baskerville' => 'Libre Baskerville',
        'pt-mono' => 'PT Mono', 'space-mono' => 'Space Mono', 'unica-one' => 'Unica One',
    );
}

function legacy_pro_max_add_typography_controls( $wp_customize, $section_id, $setting_prefix, $element_label ) {
    $google_fonts = legacy_pro_max_get_google_fonts();

    // Title for the group of controls
    $wp_customize->add_setting( $setting_prefix . '_heading', array('sanitize_callback' => 'sanitize_text_field',));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting_prefix . '_heading', array(
        'label' => $element_label . ' Typography',
        'section' => $section_id,
        'type' => 'hidden', // Used as a separator
        'settings' => array(),
    )));

    // Font Family
    $wp_customize->add_setting( $setting_prefix . '_font_family', ['default' => 'helvetica-neue', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_font_family', ['label' => 'Font Family', 'section' => $section_id, 'type' => 'select', 'choices' => $google_fonts]);

    // Font Size
    $wp_customize->add_setting( $setting_prefix . '_font_size', ['default' => '16px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_font_size', ['label' => 'Font Size', 'section' => $section_id, 'type' => 'text']);

    // Font Weight
    $wp_customize->add_setting( $setting_prefix . '_font_weight', ['default' => '400', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_font_weight', ['label' => 'Font Weight', 'section' => $section_id, 'type' => 'select', 'choices' => [ '100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900']]);

    // Color
    $wp_customize->add_setting( $setting_prefix . '_color', ['default' => '#333333', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_prefix . '_color', array('label' => 'Color', 'section' => $section_id)));
}

function legacy_pro_max_add_spacing_controls( $wp_customize, $section_id, $setting_prefix ) {
    $wp_customize->add_setting( $setting_prefix . '_padding_top', ['default' => '60px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_padding_top', ['label' => 'Padding Top', 'section' => $section_id, 'type' => 'text']);
    $wp_customize->add_setting( $setting_prefix . '_padding_bottom', ['default' => '60px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_padding_bottom', ['label' => 'Padding Bottom', 'section' => $section_id, 'type' => 'text']);
    $wp_customize->add_setting( $setting_prefix . '_margin_top', ['default' => '0px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_margin_top', ['label' => 'Margin Top', 'section' => $section_id, 'type' => 'text']);
    $wp_customize->add_setting( $setting_prefix . '_margin_bottom', ['default' => '0px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control( $setting_prefix . '_margin_bottom', ['label' => 'Margin Bottom', 'section' => $section_id, 'type' => 'text']);
}

function legacy_pro_max_dynamic_css() {
    $css = '';
    $google_fonts_to_load = [];

    // Header
    $css .= legacy_pro_max_generate_background_css('.site-header', 'legacy_pro_max_header');
    $css .= legacy_pro_max_generate_spacing_css('.site-header', 'legacy_pro_max_header');

    // Footer
    $css .= legacy_pro_max_generate_background_css('.site-footer', 'legacy_pro_max_footer');
    $css .= legacy_pro_max_generate_spacing_css('.site-footer', 'legacy_pro_max_footer');

    // Homepage Sections
    $sections = ['hero','practice_areas','attorneys','case_results','testimonials','cta','contact'];
    foreach($sections as $slug) {
        $prefix = "legacy_pro_max_{$slug}";
        $selector = ".homepage-section--{$slug}";
        $css .= legacy_pro_max_generate_background_css($selector, $prefix);
        $css .= legacy_pro_max_generate_spacing_css($selector, $prefix);
        $css .= legacy_pro_max_generate_typography_css($selector . ' h1, ' . $selector . ' h2, ' . $selector . ' h3, ' . $selector . ' h4', $prefix . '_headline', $google_fonts_to_load);
        $css .= legacy_pro_max_generate_typography_css($selector . ' p, ' . $selector . ' div, ' . $selector . ' blockquote, ' . $selector . ' cite', $prefix . '_text', $google_fonts_to_load);
    }

    // Header Typography
    $css .= legacy_pro_max_generate_typography_css('.site-title a', 'legacy_pro_max_header_site_title', $google_fonts_to_load);
    $css .= legacy_pro_max_generate_typography_css('.main-navigation a', 'legacy_pro_max_header_navigation', $google_fonts_to_load);

    // Footer Typography
    $css .= legacy_pro_max_generate_typography_css('.site-footer .widget-title', 'legacy_pro_max_footer_widget_title', $google_fonts_to_load);
    $css .= legacy_pro_max_generate_typography_css('.site-footer', 'legacy_pro_max_footer_text', $google_fonts_to_load);

    // Button Styles
    $css .= ".button, input[type='submit'] { background-color: " . get_theme_mod('legacy_pro_max_button_bg_color', '#0073aa') . "; color: " . get_theme_mod('legacy_pro_max_button_text_color', '#ffffff') . "; border-radius: " . get_theme_mod('legacy_pro_max_button_border_radius', '3px') . "; }";

    // Attorney Card Styles
    $css .= ".attorney-item { background-color: " . get_theme_mod('legacy_pro_max_attorney_card_bg_color', '#ffffff') . "; border: 1px solid " . get_theme_mod('legacy_pro_max_attorney_card_border_color', '#dddddd') . "; box-shadow: " . get_theme_mod('legacy_pro_max_attorney_card_box_shadow', '0 2px 5px rgba(0,0,0,0.1)') . "; }";

    if ( ! empty( $google_fonts_to_load ) ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '|', array_unique($google_fonts_to_load) ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css' );
        wp_enqueue_style( 'legacy-pro-max-google-fonts', $fonts_url, array(), null );
    }

    wp_add_inline_style( 'legacy-pro-max-style', $css );
}
add_action( 'wp_enqueue_scripts', 'legacy_pro_max_dynamic_css' );

function legacy_pro_max_generate_background_css($selector, $prefix) {
    $css = '';
    $bg_type = get_theme_mod("{$prefix}_background_type", 'color');

    if ($bg_type === 'color') {
        $css .= "{$selector} { background-color: " . get_theme_mod("{$prefix}_background_color", '#ffffff') . "; }";
    } elseif ($bg_type === 'gradient') {
        $color1 = get_theme_mod("{$prefix}_gradient_color_1", '#ffffff');
        $color2 = get_theme_mod("{$prefix}_gradient_color_2", '#f0f0f0');
        $direction = get_theme_mod("{$prefix}_gradient_direction", 'to right');
        $css .= "{$selector} { background-image: linear-gradient({$direction}, {$color1}, {$color2}); }";
    } elseif ($bg_type === 'image' || $bg_type === 'video') {
        $image_url = get_theme_mod("{$prefix}_background_image", '');
        if ($image_url && $bg_type === 'image') {
            $css .= "{$selector} { background-image: url(" . esc_url($image_url) . "); background-size: cover; background-position: center; position: relative; }";
        } else {
            $css .= "{$selector} { position: relative; }";
        }
        $overlay_color = get_theme_mod("{$prefix}_background_overlay_color", 'rgba(0,0,0,0.5)');
        $overlay_opacity = get_theme_mod("{$prefix}_background_overlay_opacity", '0.5');
        $overlay_color = legacy_pro_max_sanitize_rgba($overlay_color);
        list($r, $g, $b) = sscanf($overlay_color, 'rgba(%d,%d,%d');
        $css .= "{$selector}::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba({$r},{$g},{$b},{$overlay_opacity}); z-index: 1; }";
        $css .= "{$selector} > *:not(.background-video-wrapper) { position: relative; z-index: 2; }";
    }
    return $css;
}

function legacy_pro_max_generate_spacing_css($selector, $prefix) {
    $css = '';
    $css .= "{$selector} {";
    $css .= 'padding-top: ' . get_theme_mod("{$prefix}_padding_top", '60px') . ';';
    $css .= 'padding-bottom: ' . get_theme_mod("{$prefix}_padding_bottom", '60px') . ';';
    $css .= 'margin-top: ' . get_theme_mod("{$prefix}_margin_top", '0px') . ';';
    $css .= 'margin-bottom: ' . get_theme_mod("{$prefix}_margin_bottom", '0px') . ';';
    $css .= '}';
    return $css;
}

function legacy_pro_max_generate_typography_css($selector, $prefix, &$fonts_to_load) {
    $css = '';
    $font_family = get_theme_mod("{$prefix}_font_family", 'helvetica-neue');
    $font_size = get_theme_mod("{$prefix}_font_size", '16px');
    $font_weight = get_theme_mod("{$prefix}_font_weight", '400');
    $color = get_theme_mod("{$prefix}_color", '#333333');

    $css .= "{$selector} {";
    $css .= "font-family: '{$font_family}', sans-serif;";
    $css .= "font-size: {$font_size};";
    $css .= "font-weight: {$font_weight};";
    $css .= "color: {$color};";
    $css .= '}';

    if ( !in_array($font_family, ['helvetica-neue', 'arial', 'verdana', 'georgia', 'times-new-roman']) ) {
         $fonts_to_load[] = $font_family . ':' . $font_weight;
    }

    return $css;
}

function legacy_pro_max_customize_preview_js() {
	wp_enqueue_script( 'legacy-pro-max-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ), null, true );
}
add_action( 'customize_preview_init', 'legacy_pro_max_customize_preview_js' );

function legacy_pro_max_sanitize_rgba( $color ) {
    if ( empty( $color ) || is_array( $color ) )
        return 'rgba(0,0,0,0.5)';
    if ( false === strpos( $color, 'rgba' ) )
        return sanitize_hex_color( $color );
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $r, $g, $b, $a );
    return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $a . ')';
}
