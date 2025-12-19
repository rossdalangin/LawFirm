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

    // ==========================================================================
    //  ISOLATION TEST
    // ==========================================================================
    // All other bindings are commented out. We are only testing this one control.

    wp.customize( 'legacy_pro_max_hero_headline_color', function( value ) {
        value.bind( function( to ) {
            $( '.homepage-section--hero h1' ).css( 'color', to );
        } );
    } );

    bindSimpleUpdate( 'legacy_pro_max_hero_headline', '.homepage-section--hero h1' );


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


    /*

	// Helper function to update background
	function updateSectionBackground( sectionClass, prefix ) {
		// ... (All original code is commented out for this test)
	}

	// Configuration Object
	var elements = {
        // ... (All original code is commented out for this test)
    };

    // Component Bindings
    // ... (All original code is commented out for this test)


	// Main Loop for Bindings
	for ( var key in elements ) {
		// ... (All original code is commented out for this test)
	}

    */

} )( jQuery );
