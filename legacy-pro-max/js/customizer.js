/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding .site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding .site-description' ).text( to );
		} );
	} );

	// -------------------------------------------------------------------------- //
	//                           Helper Functions                                 //
	// -------------------------------------------------------------------------- //

	// Helper function for simple text/html updates.
	function bindSimpleUpdate( settingId, selector, isHtml ) {
		wp.customize( settingId, function( value ) {
			value.bind( function( to ) {
				if ( isHtml ) {
					$( selector ).html( to );
				} else {
					$( selector ).text( to );
				}
			} );
		} );
	}

	// Helper function to update background
	function updateSectionBackground( sectionClass, prefix ) {
		var type = wp.customize( prefix + '_background_type' ) ? wp.customize( prefix + '_background_type' ).get() : 'color';
		var $section = $( sectionClass );
        var $styleTag = $( '#legacy-pro-max-' + prefix + '-styles' );

        if ( $styleTag.length === 0 ) {
            $styleTag = $( '<style id="legacy-pro-max-' + prefix + '-styles" />' ).appendTo( 'head' );
        }

        var css = '';

        // Reset all background properties
		$section.css( {
            'background-image': 'none',
            'background-color': 'transparent',
            'background': 'none'
        } );

        $section.find('.background-video-wrapper').remove();

		if ( 'color' === type ) {
			$section.css( 'background-color', wp.customize( prefix + '_background_color' ).get() );
		} else if ( 'gradient' === type ) {
            var color1 = wp.customize( prefix + '_gradient_color_1' ).get();
            var color2 = wp.customize( prefix + '_gradient_color_2' ).get();
            var direction = wp.customize( prefix + '_gradient_direction' ).get();
			$section.css( 'background-image', 'linear-gradient(' + direction + ', ' + color1 + ', ' + color2 + ')' );
		} else if ( 'image' === type ) {
			$section.css( 'background-image', 'url(' + wp.customize( prefix + '_background_image' ).get() + ')' );
		} else if ( 'video' === type ) {
            var videoURL = wp.customize( prefix + '_background_video').get();
            if ( videoURL ) {
                var videoHTML = '<div class="background-video-wrapper"><video playsinline autoplay muted loop><source src="' + videoURL + '" type="video/mp4"></video></div>';
                $section.prepend(videoHTML);
            }
        }

        // Handle Overlays for Image and Video
        if ( ['image', 'video'].indexOf(type) > -1 ) {
            var overlayColor = wp.customize( prefix + '_background_overlay_color' ).get();
            var overlayOpacity = wp.customize( prefix + '_background_overlay_opacity' ).get();

            if (overlayColor) {
                var rgba = overlayColor.match(/\d+/g);
                if (rgba && rgba.length >= 3) {
                     css += sectionClass + '::before { background-color: rgba(' + rgba[0] + ',' + rgba[1] + ',' + rgba[2] + ',' + overlayOpacity + '); }';
                } else {
                     css += sectionClass + '::before { background-color: ' + overlayColor + '; opacity: ' + overlayOpacity + '; }'; // Fallback
                }
            }
        } else {
            css += sectionClass + '::before { background-color: transparent; }';
        }

        $styleTag.html(css);
	}

	// -------------------------------------------------------------------------- //
	//                           Configuration Object                             //
	// -------------------------------------------------------------------------- //

	var elements = {
        'header': {
            selector: '.site-header',
            typography: [
                { key: 'site_title', selector: '.site-branding .site-title a' },
                { key: 'navigation', selector: '.main-navigation a' }
            ]
        },
        'footer': {
            selector: '.site-footer',
            typography: [
                { key: 'widget_title', selector: '.site-footer .widget-title' },
                { key: 'text', selector: '.site-footer, .site-footer a, .site-footer .site-info' }
            ]
        },
        'hero': {
            selector: '.homepage-section--hero',
			content: [
				{ key: 'headline', selector: '.homepage-section--hero h1' },
				{ key: 'subheading', selector: '.homepage-section--hero p' },
				{ key: 'button_text', selector: '.homepage-section--hero .button' },
			],
            typography: [
                { key: 'headline', selector: '.homepage-section--hero h1' },
                { key: 'text', selector: '.homepage-section--hero p' }
            ]
        },
        'practice_areas': {
            selector: '.homepage-section--practice-areas',
			content: [ { key: 'headline', selector: '.homepage-section--practice-areas h2' } ],
            typography: [
                { key: 'headline', selector: '.homepage-section--practice-areas h2' },
                { key: 'text', selector: '.homepage-section--practice-areas .practice-area-item h3, .homepage-section--practice-areas .practice-area-item p' }
            ]
        },
         'attorneys': {
            selector: '.homepage-section--attorneys',
			content: [ { key: 'headline', selector: '.homepage-section--attorneys h2' } ],
            typography: [
                { key: 'headline', selector: '.homepage-section--attorneys h2' },
                { key: 'text', selector: '.homepage-section--attorneys .attorney-item h3, .homepage-section--attorneys .attorney-item .attorney-title' }
            ]
        },
        'case_results': {
            selector: '.homepage-section--case-results',
			content: [ { key: 'headline', selector: '.homepage-section--case-results h2' } ],
            typography: [
                { key: 'headline', selector: '.homepage-section--case-results h2' },
                { key: 'text', selector: '.homepage-section--case-results .case-result-item h4, .homepage-section--case-results .case-result-item .case-result-amount' }
            ]
        },
        'testimonials': {
            selector: '.homepage-section--testimonials',
			content: [ { key: 'headline', selector: '.homepage-section--testimonials h2' } ],
            typography: [
                { key: 'headline', selector: '.homepage-section--testimonials h2' },
                { key: 'text', selector: '.homepage-section--testimonials blockquote, .homepage-section--testimonials cite' }
            ]
        },
        'cta': {
            selector: '.homepage-section--cta',
			content: [
				{ key: 'headline', selector: '.homepage-section--cta h2' },
				{ key: 'button_text', selector: '.homepage-section--cta .button' },
			],
            typography: [
                { key: 'headline', selector: '.homepage-section--cta h2' },
                { key: 'text', selector: '.homepage-section--cta .button' }
            ]
        },
        'contact': {
            selector: '.homepage-section--contact',
			content: [ { key: 'headline', selector: '.homepage-section--contact h2' } ],
            typography: [
                { key: 'headline', selector: '.homepage-section--contact h2' },
                { key: 'text', selector: '.homepage-section--contact .contact-form' }
            ]
        }
    };

	// -------------------------------------------------------------------------- //
	//                           Component Bindings                               //
	// -------------------------------------------------------------------------- //

    // Button Styles
    wp.customize('legacy_pro_max_button_bg_color', function(value) {
        value.bind(function(newVal) { $('.button, input[type="submit"]').css('background-color', newVal); });
    });
    wp.customize('legacy_pro_max_button_text_color', function(value) {
        value.bind(function(newVal) { $('.button, input[type="submit"]').css('color', newVal); });
    });
    wp.customize('legacy_pro_max_button_border_radius', function(value) {
        value.bind(function(newVal) { $('.button, input[type="submit"]').css('border-radius', newVal); });
    });

    // Attorney Card Styles
    wp.customize('legacy_pro_max_attorney_card_bg_color', function(value) {
        value.bind(function(newVal) { $('.attorney-item').css('background-color', newVal); });
    });
    wp.customize('legacy_pro_max_attorney_card_border_color', function(value) {
        value.bind(function(newVal) { $('.attorney-item').css('border-color', newVal); });
    });
     wp.customize('legacy_pro_max_attorney_card_box_shadow', function(value) {
        value.bind(function(newVal) { $('.attorney-item').css('box-shadow', newVal); });
    });

	// -------------------------------------------------------------------------- //
	//                           Main Loop for Bindings                           //
	// -------------------------------------------------------------------------- //

	for ( var key in elements ) {
		var prefix = 'legacy_pro_max_' + key;
		var selector = elements[key].selector;

        // Content Controls
        if (elements[key].content) {
            elements[key].content.forEach(function(item) {
                bindSimpleUpdate(prefix + '_' + item.key, item.selector);
            });
        }

        // Typography Controls
        if (elements[key].typography) {
            elements[key].typography.forEach(function(typo) {
                var typo_prefix = 'legacy_pro_max_' + key + '_' + typo.key;
                var typo_selector = typo.selector;

                ['font_family', 'font_size', 'font_weight', 'color'].forEach(function(prop) {
                     wp.customize(typo_prefix + '_' + prop, function(value) {
                        value.bind(function(newVal) {
                            if (prop === 'font_family') {
                                var fontUrl = 'https://fonts.googleapis.com/css?family=' + newVal.replace(/ /g, '+') + ':400,700';
                                var fontId = 'legacy-pro-max-preview-font-' + newVal.replace(/ /g, '-');
                                if ($('#' + fontId).length === 0) {
                                    $('head').append('<link id="' + fontId + '" rel="stylesheet" type="text/css" href="' + fontUrl + '">');
                                }
                                $(typo_selector).css('font-family', newVal);
                            } else {
                                $(typo_selector).css(prop.replace('_', '-'), newVal);
                            }
                        });
                    });
                });
            });
        }

		// Spacing Controls
        ['padding_top', 'padding_bottom', 'margin_top', 'margin_bottom'].forEach(function(prop) {
            wp.customize(prefix + '_' + prop, function(value) {
                value.bind(function(newVal) {
                    $(selector).css(prop.replace('_', '-'), newVal);
                });
            });
        });

		// Background Controls
		[
			'_background_type', '_background_color', '_gradient_color_1', '_gradient_color_2',
			'_gradient_direction', '_background_image', '_background_video',
            '_background_overlay_color', '_background_overlay_opacity'
		].forEach( function( suffix ) {
			wp.customize( prefix + suffix, function( value ) {
				value.bind( function( to ) {
					updateSectionBackground( selector, prefix );
				} );
			} );
		} );
	} );

} )( jQuery );
