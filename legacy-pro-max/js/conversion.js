document.addEventListener('DOMContentLoaded', () => {

	// -------------------------------------------------------------------------- //
	//                              Exit-Intent Modal                             //
	// -------------------------------------------------------------------------- //

	const exitIntentModal = () => {
		const modal = document.getElementById('exit-intent-modal');
		if (!modal) return;

		const closeModal = () => {
			modal.style.display = 'none';
		};

		const showModal = () => {
			modal.style.display = 'block';
		};

		// Close modal when clicking on the close button or outside the modal
		modal.addEventListener('click', (e) => {
			if (e.target.classList.contains('close-modal') || e.target.id === 'exit-intent-modal') {
				closeModal();
			}
		});

		// Close modal when pressing the Escape key
		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape') {
				closeModal();
			}
		});


		// Show modal on exit intent
		document.addEventListener('mouseleave', (e) => {
			if (e.clientY <= 0) {
				showModal();
			}
		});

	};

	exitIntentModal();

});
