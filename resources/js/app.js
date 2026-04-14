import './bootstrap';
import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const swiperElement = document.querySelector('.swiper');

    if (swiperElement) {
        new Swiper(swiperElement, {
            modules: [Navigation, Pagination],
            loop: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
});
