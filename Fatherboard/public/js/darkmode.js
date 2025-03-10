document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;

    toggleButton.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        document.querySelector('header').classList.toggle('dark-mode');
        document.querySelector('footer').classList.toggle('dark-mode');
        document.querySelector('.banner').classList.toggle('dark-mode');
        document.querySelector('.carousel-container').classList.toggle('dark-mode');
        document.querySelector('.hot-product').classList.toggle('dark-mode');
        document.querySelector('.hot-product .hot-product-details').classList.toggle('dark-mode');
    });
});