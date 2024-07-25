import * as styles from './header.module.css';

console.log(styles);

// Função para carregar o HTML do componente
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
