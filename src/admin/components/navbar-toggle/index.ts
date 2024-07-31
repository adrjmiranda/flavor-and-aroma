import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
	Alpine.data('navbar_toggle', () => ({
		state: true,
		toggle() {
			const dashboardSideLinks = document.querySelector(
				'.dashboard_side_links'
			) as HTMLUListElement;

			if (dashboardSideLinks) {
				if (this.state) {
					dashboardSideLinks.style.display = 'flex';
				} else {
					dashboardSideLinks.style.display = 'none';
				}
			}

			this.state = !this.state;
		},
	}));
});
