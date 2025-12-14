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
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// -------------------------------------------------------------------------- //
	//                           Homepage Sections                                //
	// -------------------------------------------------------------------------- //

	// Helper function to update background
	function updateSectionBackground( sectionClass, typeSetting, colorSetting, gradient1Setting, gradient2Setting, directionSetting ) {
		var type = wp.customize( typeSetting ).get();
		var color = wp.customize( colorSetting ).get();
		var color1 = wp.customize( gradient1Setting ).get();
		var color2 = wp.customize( gradient2Setting ).get();
		var direction = wp.customize( directionSetting ).get();

		if ( 'color' === type ) {
			$( sectionClass ).css( 'background', color );
		} else {
			$( sectionClass ).css( 'background', 'linear-gradient(' + direction + ', ' + color1 + ', ' + color2 + ')' );
		}
	}

	// Hero Section
	[
		'legacy_pro_max_hero_background_type',
		'legacy_pro_max_hero_background_color',
		'legacy_pro_max_hero_gradient_color_1',
		'legacy_pro_max_hero_gradient_color_2',
		'legacy_pro_max_hero_gradient_direction',
	].forEach( function( setting ) {
		wp.customize( setting, function( value ) {
			value.bind( function( to ) {
				updateSectionBackground(
					'.hero',
					'legacy_pro_max_hero_background_type',
					'legacy_pro_max_hero_background_color',
					'legacy_pro_max_hero_gradient_color_1',
					'legacy_pro_max_hero_gradient_color_2',
					'legacy_pro_max_hero_gradient_direction'
				);
			} );
		} );
	} );

	wp.customize( 'legacy_pro_max_hero_headline_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.hero .hero__headline' ).css( 'color', to );
		} );
	} );
	wp.customize( 'legacy_pro_max_hero_subheading_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.hero .hero__subheading' ).css( 'color', to );
		} );
	} );


	// Practice Areas Section
	[
		'legacy_pro_max_practice_areas_background_type',
		'legacy_pro_max_practice_areas_background_color',
		'legacy_pro_max_practice_areas_gradient_color_1',
		'legacy_pro_max_practice_areas_gradient_color_2',
		'legacy_pro_max_practice_areas_gradient_direction',
	].forEach( function( setting ) {
		wp.customize( setting, function( value ) {
			value.bind( function( to ) {
				updateSectionBackground(
					'.wp-block-group.homepage-section:nth-of-type(1)',
					'legacy_pro_max_practice_areas_background_type',
					'legacy_pro_max_practice_areas_background_color',
					'legacy_pro_max_practice_areas_gradient_color_1',
					'legacy_pro_max_practice_areas_gradient_color_2',
					'legacy_pro_max_practice_areas_gradient_direction'
				);
			} );
		} );
	} );
	wp.customize( 'legacy_pro_max_practice_areas_heading_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.wp-block-group.homepage-section:nth-of-type(1) h2' ).css( 'color', to );
		} );
	} );

	// Attorneys Section
	[
		'legacy_pro_max_attorneys_background_type',
		'legacy_pro_max_attorneys_background_color',
		'legacy_pro_max_attorneys_gradient_color_1',
		'legacy_pro_max_attorneys_gradient_color_2',
		'legacy_pro_max_attorneys_gradient_direction',
	].forEach( function( setting ) {
		wp.customize( setting, function( value ) {
			value.bind( function( to ) {
				updateSectionBackground(
					'.wp-block-group.homepage-section:nth-of-type(2)',
					'legacy_pro_max_attorneys_background_type',
					'legacy_pro_max_attorneys_background_color',
					'legacy_pro_max_attorneys_gradient_color_1',
					'legacy_pro_max_attorneys_gradient_color_2',
					'legacy_pro_max_attorneys_gradient_direction'
				);
			} );
		} );
	} );
	wp.customize( 'legacy_pro_max_attorneys_heading_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.wp-block-group.homepage-section:nth-of-type(2) h2' ).css( 'color', to );
		} );
	} );

	// Case Results Section
	[
		'legacy_pro_max_case_results_background_type',
		'legacy_pro_max_case_results_background_color',
		'legacy_pro_max_case_results_gradient_color_1',
		'legacy_pro_max_case_results_gradient_color_2',
		'legacy_pro_max_case_results_gradient_direction',
	].forEach( function( setting ) {
		wp.customize( setting, function( value ) {
			value.bind( function( to ) {
				updateSectionBackground(
					'.wp-block-group.homepage-section:nth-of-type(3)',
					'legacy_pro_max_case_results_background_type',
					'legacy_pro_max_case_results_background_color',
					'legacy_pro_max_case_results_gradient_color_1',
					'legacy_pro_max_case_results_gradient_color_2',
					'legacy_pro_max_case_results_gradient_direction'
				);
			} );
		} );
	} );
	wp.customize( 'legacy_pro_max_case_results_heading_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.wp-block-group.homepage-section:nth-of-type(3) h2' ).css( 'color', to );
		} );
	} );

	// Testimonials Section
	[
		'legacy_pro_max_testimonials_background_type',
		'legacy_pro_max_testimonials_background_color',
		'legacy_pro_max_testimonials_gradient_color_1',
		'legacy_pro_max_testimonials_gradient_color_2',
		'legacy_pro_max_testimonials_gradient_direction',
	].forEach( function( setting ) {
		wp.customize( setting, function( value ) {
			value.bind( function( to ) {
				updateSectionBackground(
					'.wp-block-group.homepage-section:nth-of-type(4)',
					'legacy_pro_max_testimonials_background_type',
					'legacy_pro_max_testimonials_background_color',
					'legacy_pro_max_testimonials_gradient_color_1',
					'legacy_pro_max_testimonials_gradient_color_2',
					'legacy_pro_max_testimonials_gradient_direction'
				);
			} );
		} );
	} );
	wp.customize( 'legacy_pro_max_testimonials_heading_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.wp-block-group.homepage-section:nth-of-type(4) h2' ).css( 'color', to );
		} );
	} );

	// Practice Area Cards Background
	wp.customize( 'legacy_pro_max_practice_area_background_type', function( value ) {
		value.bind( function( to ) {
			updatePracticeAreaBackground();
		} );
	} );
	wp.customize( 'legacy_pro_max_practice_area_background_color', function( value ) {
		value.bind( function( to ) {
			updatePracticeAreaBackground();
		} );
	} );
	wp.customize( 'legacy_pro_max_practice_area_gradient_color_1', function( value ) {
		value.bind( function( to ) {
			updatePracticeAreaBackground();
		} );
	} );
	wp.customize( 'legacy_pro_max_practice_area_gradient_color_2', function( value ) {
		value.bind( function( to ) {
			updatePracticeAreaBackground();
		} );
	} );
	wp.customize( 'legacy_pro_max_practice_area_gradient_direction', function( value ) {
		value.bind( function( to ) {
			updatePracticeAreaBackground();
		} );
	} );

	function updatePracticeAreaBackground() {
		var type = wp.customize( 'legacy_pro_max_practice_area_background_type' ).get();
		var color = wp.customize( 'legacy_pro_max_practice_area_background_color' ).get();
		var color1 = wp.customize( 'legacy_pro_max_practice_area_gradient_color_1' ).get();
		var color2 = wp.customize( 'legacy_pro_max_practice_area_gradient_color_2' ).get();
		var direction = wp.customize( 'legacy_pro_max_practice_area_gradient_direction' ).get();

		if ( 'color' === type ) {
			$( '.practice-area-card' ).css( 'background', color );
		} else {
			$( '.practice-area-card' ).css( 'background', 'linear-gradient(' + direction + ', ' + color1 + ', ' + color2 + ')' );
		}
	}

	// Typography
	wp.customize( 'legacy_pro_max_heading_font_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'color', to );
		} );
	} );
	wp.customize( 'legacy_pro_max_heading_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'font-size', to );
		} );
	} );
	wp.customize( 'legacy_pro_max_heading_font_weight', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'font-weight', to );
		} );
	} );
	wp.customize( 'legacy_pro_max_body_font_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
		} );
	} );
	wp.customize( 'legacy_pro_max_body_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'font-size', to );
		} );
	} );
	wp.customize( 'legacy_pro_max_body_font_weight', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'font-weight', to );
		} );
	} );

} )( jQuery );
