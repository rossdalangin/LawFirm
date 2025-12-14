document.addEventListener('DOMContentLoaded', () => {
	const motionMatchMedia = window.matchMedia('(prefers-reduced-motion)');

	// -------------------------------------------------------------------------- //
	//                              Helper Functions                              //
	// -------------------------------------------------------------------------- //

	const isReducedMotion = () => motionMatchMedia.matches;

	// -------------------------------------------------------------------------- //
	//                              Scroll Animations                             //
	// -------------------------------------------------------------------------- //

	const scrollTriggeredEntrances = () => {
		if (isReducedMotion()) return;

		const elements = document.querySelectorAll('[data-animation="scroll-entrance"]');
		elements.forEach(element => {
			gsap.from(element, {
				scrollTrigger: {
					trigger: element,
					start: 'top 80%',
				},
				opacity: 0,
				y: 50,
				duration: 1,
				ease: 'power4.out',
			});
		});
	};

	// -------------------------------------------------------------------------- //
	//                              Button Hovers                                 //
	// -------------------------------------------------------------------------- //

	const buttonHovers = () => {
		if (isReducedMotion()) return;

		const buttons = document.querySelectorAll('.btn');
		buttons.forEach(button => {
			button.addEventListener('mouseenter', () => {
				gsap.to(button, {
					scale: 1.05,
					duration: 0.3,
					ease: 'power2.out',
				});
			});

			button.addEventListener('mouseleave', () => {
				gsap.to(button, {
					scale: 1,
					duration: 0.3,
					ease: 'power2.in',
				});
			});
		});
	};


	// -------------------------------------------------------------------------- //
	//                                  Parallax                                  //
	// -------------------------------------------------------------------------- //

	const parallax = () => {
		if (isReducedMotion() || window.innerWidth < 1024) return;

		gsap.utils.toArray('[data-parallax]').forEach(section => {
			const image = section.querySelector('img');
			gsap.to(image, {
				yPercent: 20,
				ease: 'none',
				scrollTrigger: {
					trigger: section,
					start: 'top bottom',
					end: 'bottom top',
					scrub: true,
				},
			});
		});
	};


	// -------------------------------------------------------------------------- //
	//                               Initialization                               //
	// -------------------------------------------------------------------------- //

	const initAnimations = () => {
		scrollTriggeredEntrances();
		buttonHovers();
		parallax();
	};

	initAnimations();
	motionMatchMedia.addEventListener('change', initAnimations);
});
