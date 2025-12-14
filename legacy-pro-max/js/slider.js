document.addEventListener('DOMContentLoaded', () => {
	const sliders = document.querySelectorAll('.testimonials-slider');

	sliders.forEach(slider => {
		const slides = slider.querySelectorAll('.testimonial-slide');
		const prevButton = slider.querySelector('.prev');
		const nextButton = slider.querySelector('.next');
		let currentSlide = 0;

		gsap.set(slides, { opacity: 0, display: 'none' });
		gsap.set(slides[0], { opacity: 1, display: 'block' });

		const showSlide = (n) => {
			gsap.to(slides[currentSlide], { opacity: 0, display: 'none', duration: 0.5 });
			gsap.to(slides[n], { opacity: 1, display: 'block', duration: 0.5 });
			currentSlide = n;
		};

		const nextSlide = () => {
			const next = (currentSlide + 1) % slides.length;
			showSlide(next);
		};

		const prevSlide = () => {
			const prev = (currentSlide - 1 + slides.length) % slides.length;
			showSlide(prev);
		};

		if (slides.length > 0) {
			nextButton.addEventListener('click', nextSlide);
			prevButton.addEventListener('click', prevSlide);

			// Keyboard navigation
			slider.addEventListener('keydown', (e) => {
				if (e.key === 'ArrowRight') {
					nextSlide();
				} else if (e.key === 'ArrowLeft') {
					prevSlide();
				}
			});
		}
	});
});
