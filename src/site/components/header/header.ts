import Alpine from 'alpinejs';
import * as styles from './header.module.css';

// Loads the component's html
export async function loadHeader(): Promise<void> {
	const headerContainer = document.getElementById('header-container');
	if (headerContainer) {
		headerContainer.className = styles.header;
		await fetch('http://localhost:8000/site/components/header', {
			method: 'GET',
		})
			.then((response) => {
				return response.text();
			})
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
