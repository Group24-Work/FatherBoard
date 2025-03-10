document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;

    toggleButton.addEventListener('change', function() {
        body.classList.toggle('dark-mode');
        document.querySelector('header').classList.toggle('dark-mode');
        document.querySelector('footer').classList.toggle('dark-mode');
        document.querySelectorAll('.banner').forEach(el => el.classList.toggle('dark-mode'));
        document.querySelectorAll('.carousel-container').forEach(el => el.classList.toggle('dark-mode'));
        document.querySelectorAll('.hot-product').forEach(el => el.classList.toggle('dark-mode'));
        document.querySelectorAll('.hot-product .hot-product-details').forEach(el => el.classList.toggle('dark-mode'));
    });
});