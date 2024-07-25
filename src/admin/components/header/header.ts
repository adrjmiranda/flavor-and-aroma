import Alpine from 'alpinejs';
import * as styles from './header.module.css';

// Loads the component's html
export function loadHeader(): void {
	const headerContainer = document.getElementById('header-container');
	if (headerContainer) {
		headerContainer.className = styles.header;
		fetch('/assets/js/components/header/header.html')
			.then((response) => response.text())
			.then((html) => {
				headerContainer.innerHTML = html;
			});
	}
}

// Provides a way to re-use x-data contexts
document.addEventListener('alpine:init', () => {
	Alpine.data('header', () => ({
		open: false,
		toggle() {
			this.open = !this.open;
			console.log(this.open);
		},
	}));
});
