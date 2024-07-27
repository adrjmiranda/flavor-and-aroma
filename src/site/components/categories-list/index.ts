import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
	Alpine.data('categories_list', () => ({
		scrollMenu(event: WheelEvent) {
			event.preventDefault();
			const target = event.currentTarget as HTMLElement;
			target.scrollLeft += event.deltaY;
		},
	}));
});
