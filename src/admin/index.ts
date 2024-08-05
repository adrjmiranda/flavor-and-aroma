import Alpine from 'alpinejs';
import Quill from './editor';

// Components
import './components/navbar-toggle';
import './components/file-image-handler';

// Init post editor
Quill;

window.Alpine = Alpine;
Alpine.start();
