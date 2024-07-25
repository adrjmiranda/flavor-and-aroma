import Alpine from 'alpinejs';

import { loadHeader } from './site/components/header/header';
import { loadContent } from './site/components/content/content';
import { loadFooter } from './site/components/footer/footer';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
	loadHeader();
	loadContent();
	loadFooter();
});
