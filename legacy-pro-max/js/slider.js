document.addEventListener('DOMContentLoaded', () => {
	const sliders = document.querySelectorAll('.testimonials-slider');

	sliders.forEach(slider => {
		const slides = slider.querySelectorAll('.testimonial-slide');
		const prevButton = slider.querySelector('.prev');
		const nextButton = slider.querySelector('.next');
		let currentSlide = 0;

		const showSlide = (n) => {
			slides.forEach((slide, index) => {
				slide.classList.remove('active');
				slide.setAttribute('aria-hidden', 'true');
			});
			slides[n].classList.add('active');
			slides[n].setAttribute('aria-hidden', 'false');
		};

		const nextSlide = () => {
			currentSlide = (currentSlide + 1) % slides.length;
			showSlide(currentSlide);
		};

		const prevSlide = () => {
			currentSlide = (currentSlide - 1 + slides.length) % slides.length;
			showSlide(currentSlide);
		};

		if (slides.length > 0) {
			showSlide(currentSlide);

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
