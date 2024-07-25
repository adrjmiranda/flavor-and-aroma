import Alpine from 'alpinejs';
import * as styles from './footer.module.css';

// Loads the component's html
export async function loadFooter(): Promise<void> {
	const footerContainer = document.getElementById('footer-container');
	if (footerContainer) {
		footerContainer.className = styles.footer;
		await fetch('http://localhost:8000/site/components/footer', {
			method: 'GET',
		})
			.then((response) => {
				return response.text();
			})
			.then((html) => {
				footerContainer.innerHTML = html;
			});
	}
}

// Provides a way to re-use x-data contexts
document.addEventListener('alpine:init', () => {
	Alpine.data('footer', () => ({
		open: false,
		toggle() {
			this.open = !this.open;
			console.log(this.open);
		},
	}));
});
