/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

const bootstrap = require('bootstrap');

// loads AOS library
AOS.init();

const filterCategory = document.querySelector('.category');
const filterForm = document.getElementById('filter-form');
const filterActive = document.querySelector('.chk-active');
filterCategory.addEventListener('change', () => {
    filterForm.submit();
})
filterActive.addEventListener('change', () => {
    filterForm.submit();
})