/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// -------------------------------------------------------------------------- //
	//                           Helper Functions                                 //
	// -------------------------------------------------------------------------- //

	function bindText( settingId, selector ) {
		wp.customize( settingId, function( value ) { value.bind( function( to ) { $( selector ).text( to ); } ); } );
	}
    function bindCss( settingId, selector, property ) {
        wp.customize( settingId, function( value ) { value.bind( function( to ) { $( selector ).css( property, to ); } ); } );
    }

	// -------------------------------------------------------------------------- //
	//                           Core WordPress Settings                          //
	// -------------------------------------------------------------------------- //
	bindText( 'blogname', '.site-branding .site-title a' );
	bindText( 'blogdescription', '.site-branding .site-description' );

	// -------------------------------------------------------------------------- //
	//                           Component: Buttons                               //
	// -------------------------------------------------------------------------- //
    bindCss( 'legacy_pro_max_button_bg_color', '.button, input[type="submit"]', 'background-color' );
    bindCss( 'legacy_pro_max_button_text_color', '.button, input[type="submit"]', 'color' );
    bindCss( 'legacy_pro_max_button_border_radius', '.button, input[type="submit"]', 'border-radius' );

	// -------------------------------------------------------------------------- //
	//                           Component: Attorney Cards                        //
	// -------------------------------------------------------------------------- //
    bindCss( 'legacy_pro_max_attorney_card_bg_color', '.attorney-item', 'background-color' );
    bindCss( 'legacy_pro_max_attorney_card_border_color', '.attorney-item', 'border-color' );
    bindCss( 'legacy_pro_max_attorney_card_box_shadow', '.attorney-item', 'box-shadow' );

	// -------------------------------------------------------------------------- //
	//                           Header                                           //
	// -------------------------------------------------------------------------- //
    // Spacing
    bindCss( 'legacy_pro_max_header_padding_top', '.site-header', 'padding-top' );
    bindCss( 'legacy_pro_max_header_padding_bottom', '.site-header', 'padding-bottom' );
    // Typography
    bindCss( 'legacy_pro_max_header_site_title_color', '.site-branding .site-title a', 'color' );
    bindCss( 'legacy_pro_max_header_site_title_font_size', '.site-branding .site-title a', 'font-size' );
    bindCss( 'legacy_pro_max_header_site_title_font_weight', '.site-branding .site-title a', 'font-weight' );
    bindCss( 'legacy_pro_max_header_navigation_color', '.main-navigation a', 'color' );
    bindCss( 'legacy_pro_max_header_navigation_font_size', '.main-navigation a', 'font-size' );
    bindCss( 'legacy_pro_max_header_navigation_font_weight', '.main-navigation a', 'font-weight' );

	// -------------------------------------------------------------------------- //
	//                           Footer                                           //
	// -------------------------------------------------------------------------- //
    bindCss( 'legacy_pro_max_footer_padding_top', '.site-footer', 'padding-top' );
    bindCss( 'legacy_pro_max_footer_padding_bottom', '.site-footer', 'padding-bottom' );
    bindCss( 'legacy_pro_max_footer_widget_title_color', '.site-footer .widget-title', 'color' );
    bindCss( 'legacy_pro_max_footer_text_color', '.site-footer, .site-footer a', 'color' );

	// -------------------------------------------------------------------------- //
	//                           Section: Hero                                    //
	// -------------------------------------------------------------------------- //
    bindText( 'legacy_pro_max_hero_headline', '.homepage-section--hero h1' );
    bindText( 'legacy_pro_max_hero_subheading', '.homepage-section--hero p' );
    bindText( 'legacy_pro_max_hero_button_text', '.homepage-section--hero .button' );
    bindCss( 'legacy_pro_max_hero_padding_top', '.homepage-section--hero', 'padding-top' );
    bindCss( 'legacy_pro_max_hero_padding_bottom', '.homepage-section--hero', 'padding-bottom' );
    bindCss( 'legacy_pro_max_hero_headline_color', '.homepage-section--hero h1', 'color' );
    bindCss( 'legacy_pro_max_hero_headline_font_size', '.homepage-section--hero h1', 'font-size' );
    bindCss( 'legacy_pro_max_hero_text_color', '.homepage-section--hero p', 'color' );
    bindCss( 'legacy_pro_max_hero_text_font_size', '.homepage-section--hero p', 'font-size' );

	// -------------------------------------------------------------------------- //
	//                        Backgrounds (Special Handling)                      //
	// -------------------------------------------------------------------------- //
    // This part remains complex, but is now isolated.
    var backgroundSections = [ 'header', 'footer', 'hero', 'practice_areas', 'attorneys', 'case_results', 'testimonials', 'cta', 'contact' ];

    backgroundSections.forEach(function(section) {
        var prefix = 'legacy_pro_max_' + section;
        var selector = (section === 'header') ? '.site-header' : (section === 'footer') ? '.site-footer' : '.homepage-section--' + section;

        [ '_background_type', '_background_color', '_gradient_color_1', '_gradient_color_2', '_gradient_direction', '_background_image', '_background_video', '_background_overlay_color', '_background_overlay_opacity' ].forEach(function(suffix) {
            wp.customize(prefix + suffix, function(value) {
                value.bind(function(to) {
                    updateSectionBackground(selector, prefix);
                });
            });
        });
    });

	function updateSectionBackground( sectionClass, prefix ) {
		var type = wp.customize( prefix + '_background_type' ) ? wp.customize( prefix + '_background_type' ).get() : 'color';
		var $section = $( sectionClass );
        var $styleTag = $( '#legacy-pro-max-' + prefix + '-styles' );
        if ($styleTag.length === 0) { $styleTag = $( '<style id="legacy-pro-max-' + prefix + '-styles" />' ).appendTo( 'head' ); }
        var css = '';
		$section.css( { 'background-image': 'none', 'background-color': 'transparent', 'background': 'none' } );
        $section.find('.background-video-wrapper').remove();

		if ( 'color' === type ) {
			$section.css( 'background-color', wp.customize( prefix + '_background_color' ).get() );
		} else if ( 'gradient' === type ) {
			$section.css( 'background-image', 'linear-gradient(' + wp.customize( prefix + '_gradient_direction' ).get() + ', ' + wp.customize( prefix + '_gradient_color_1' ).get() + ', ' + wp.customize( prefix + '_gradient_color_2' ).get() + ')' );
		} else if ( 'image' === type ) {
			$section.css( 'background-image', 'url(' + wp.customize( prefix + '_background_image' ).get() + ')' );
		} else if ( 'video' === type ) {
            var videoURL = wp.customize( prefix + '_background_video').get();
            if ( videoURL ) { $section.prepend('<div class="background-video-wrapper"><video playsinline autoplay muted loop><source src="' + videoURL + '" type="video/mp4"></video></div>'); }
        }

        if ( ['image', 'video'].indexOf(type) > -1 ) {
            var overlayColor = wp.customize( prefix + '_background_overlay_color' ).get();
            var overlayOpacity = wp.customize( prefix + '_background_overlay_opacity' ).get();
            if (overlayColor) {
                var rgba = overlayColor.match(/\d+/g);
                if (rgba && rgba.length >= 3) {
                     css += sectionClass + '::before { background-color: rgba(' + rgba[0] + ',' + rgba[1] + ',' + rgba[2] + ',' + overlayOpacity + '); }';
                }
            }
        } else {
            css += sectionClass + '::before { background-color: transparent; }';
        }
        $styleTag.html(css);
	}

} )( jQuery );
