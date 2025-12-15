( function() {
	const menuToggle = document.querySelector( '.menu-toggle' );
    const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');

	if ( ! menuToggle || ! mobileNavOverlay ) {
		return;
	}

	menuToggle.addEventListener( 'click', function() {
		document.body.classList.toggle( 'mobile-menu-active' );
        mobileNavOverlay.classList.toggle('active');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
	} );

    const closeButton = document.querySelector('.close-mobile-nav');
    if (closeButton) {
        closeButton.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.remove('mobile-menu-active');
            mobileNavOverlay.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        });
    }

} )();
