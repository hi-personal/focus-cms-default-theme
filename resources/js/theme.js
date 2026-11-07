/*
    Focus Default Theme JS
*/

console.log('Focus Default Theme JS');

import Alpine from 'alpinejs';
import Cookies from 'js-cookie';
import jQuery from 'jquery';
import 'iconify-icon';
import PhotoSwipeLightbox from 'photoswipe/lightbox';
import PhotoSwipe from 'photoswipe';

window.Alpine = Alpine;
window.$ = window.jQuery = jQuery;
window.Cookies = Cookies;
window.PhotoSwipe = PhotoSwipe;
window.PhotoSwipeLightbox = PhotoSwipeLightbox;

Alpine.start();

import './ps.js';
import './footer.js';

// console.log('theme.js loaded');