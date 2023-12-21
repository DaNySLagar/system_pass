import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

// window.Swal = require('sweetalert2');

Alpine.plugin(focus);

Alpine.start();
