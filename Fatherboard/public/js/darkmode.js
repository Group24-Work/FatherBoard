document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;

    toggleButton.addEventListener('change', function() {
        body.classList.toggle('dark-mode');
        document.querySelector('header').classList.toggle('dark-mode');
        document.querySelector('footer').classList.toggle('dark-mode');
        document.querySelectorAll('.basket-page').forEach(el => el.classList.toggle('dark-mode'));
        document.querySelectorAll('.basket-container').forEach(el => el.classList.toggle('dark-mode'));
    });
});