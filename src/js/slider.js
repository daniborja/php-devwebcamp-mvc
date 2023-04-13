import Swiper from 'swiper';
import 'swiper/css';

document.addEventListener('DOMContentLoaded', () => {
    if (!document.querySelector('.slider')) return;

    const options = {};
    new Swiper('.slider', options);
});
