import Alpine from 'alpinejs';
import * as styles from './content.module.css';

// Loads the component's html
export async function loadContent(): Promise<void> {
	const contentContainer = document.getElementById('content-container');
	if (contentContainer) {
		contentContainer.className = styles.content;
		await fetch('http://localhost:8000/site/components/content', {
			method: 'GET',
		})
			.then((response) => {
				return response.text();
			})
			.then((html) => {
				contentContainer.innerHTML = html;
			});
	}
}

// Provides a way to re-use x-data contexts
document.addEventListener('alpine:init', () => {
	Alpine.data('content', () => ({
		open: false,
		toggle() {
			this.open = !this.open;
			console.log(this.open);
		},
	}));
});
