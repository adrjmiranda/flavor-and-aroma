import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
	Alpine.data('navbar_toggle', () => ({
		state: true,
		toggle() {
			const navbarLinks = document.querySelector(
				'.navbar_links'
			) as HTMLUListElement;
			const navbarSearch = document.querySelector(
				'.navbar_search'
			) as HTMLDivElement;

			if (navbarLinks && navbarSearch) {
				if (this.state) {
					navbarLinks.style.display = 'flex';
					navbarSearch.style.display = 'flex';
				} else {
					navbarLinks.style.display = 'none';
					navbarSearch.style.display = 'none';
				}
			}

			this.state = !this.state;
		},
	}));
});
