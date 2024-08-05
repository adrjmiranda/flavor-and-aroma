import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
	Alpine.data('file_image_handler', () => ({
		handleFileChange(event: Event) {
			const input = event.target as HTMLInputElement;

			if (input.files && input.files[0]) {
				const file = input.files[0];
				const previewDiv = document.querySelector(
					'.add_post_image_preview'
				) as HTMLDivElement;

				const fileURL = URL.createObjectURL(file);

				previewDiv.style.backgroundImage = `url(${fileURL})`;
			}
		},
	}));
});
