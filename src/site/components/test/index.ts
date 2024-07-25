import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
	Alpine.data('test', () => ({
		open: false,
		toggle() {
			console.log(this.open);
			this.open = !this.open;
		},
	}));
});
