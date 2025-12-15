/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// ... (existing code for site title, description, etc.)

	// -------------------------------------------------------------------------- //
	//                           Homepage Sections                                //
	// -------------------------------------------------------------------------- //

	// Helper function to update background
	function updateSectionBackground( sectionClass, prefix ) {
		var type = wp.customize( prefix + '_background_type' ).get();
		var color = wp.customize( prefix + '_background_color' ).get();
		var color1 = wp.customize( prefix + '_gradient_color_1' ).get();
		var color2 = wp.customize( prefix + '_gradient_color_2' ).get();
		var direction = wp.customize( prefix + '_gradient_direction' ).get();
		var image = wp.customize( prefix + '_background_image' ).get();

		if ( 'color' === type ) {
			$( sectionClass ).css( 'background', color );
		} else if ( 'gradient' === type ) {
			$( sectionClass ).css( 'background', 'linear-gradient(' + direction + ', ' + color1 + ', ' + color2 + ')' );
		} else if ( 'image' === type ) {
			$( sectionClass ).css( 'background-image', 'url(' + image + ')' );
		}
	}

	var sections = [ 'hero', 'practice_areas', 'attorneys', 'case_results', 'testimonials' ];
	sections.forEach( function( section ) {
		var prefix = 'legacy_pro_max_' + section;
		var selector = '.homepage-section--' + section;

		[
			prefix + '_background_type',
			prefix + '_background_color',
			prefix + '_gradient_color_1',
			prefix + '_gradient_color_2',
			prefix + '_gradient_direction',
			prefix + '_background_image',
		].forEach( function( setting ) {
			wp.customize( setting, function( value ) {
				value.bind( function( to ) {
					updateSectionBackground( selector, prefix );
				} );
			} );
		} );
	} );

} )( jQuery );
