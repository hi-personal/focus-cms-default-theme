// --- LOGIKA ÉS FÜGGŐSÉGEK (CSS importok nélkül!) ---
import Alpine  from 'alpinejs';
import 'flyonui/flyonui';
import Cookies from 'js-cookie';
import jQuery from 'jquery';
import PhotoSwipe from 'photoswipe';
import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'boxicons';
import "flyonui/flyonui"

console.log('FocusCMS Theme sikeresen betöltve (Tailwind v4 + FlyonUI)!');

window.Alpine = Alpine;
window.$ = window.jQuery = jQuery;
window.Cookies = Cookies;
window.PhotoSwipe = PhotoSwipe;
window.PhotoSwipeLightbox = PhotoSwipeLightbox;

// ... A PWA és egyéb logikák ...
Alpine.start();

import './ps.js';
import './footer.js';