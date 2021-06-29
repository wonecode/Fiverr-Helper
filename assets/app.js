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

if (document.querySelector('.category')) {
    const filterCategory = document.querySelector('.category');
    const filterForm = document.getElementById('filter-form');

    filterCategory.addEventListener('change', () => {
        filterForm.submit();
    });

    const filterActive = document.getElementById('filter_category_active');
    filterActive.addEventListener('change', () => {
        filterForm.submit();
    })
}
