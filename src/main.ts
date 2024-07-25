import Alpine from 'alpinejs';

import { loadHeader } from './components/header/header';

window.Alpine = Alpine;
Alpine.start();

// Inicialização do Alpine.js
document.addEventListener('alpine:init', () => {
	Alpine.data('header', () => ({
		open: false,
		toggle() {
			this.open = !this.open;
		},
	}));
});

document.addEventListener('DOMContentLoaded', () => {
	loadHeader();
});
