document.addEventListener("DOMContentLoaded", () => {
    const carouselContainer = document.querySelector(".carousel-container");
    const slides = document.querySelectorAll(".carousel-slide");
    const prevButton = document.querySelector(".carousel-btn.prev");
    const nextButton = document.querySelector(".carousel-btn.next");

    let currentIndex = 0;
    let slideWidth = slides[0].clientWidth;
    let autoSlideInterval;

    // Function to update carousel position
    function updateCarousel() {
        carouselContainer.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    // Next Slide
    function nextSlide() {
        currentIndex = (currentIndex === slides.length - 1) ? 0 : currentIndex + 1;
        updateCarousel();
    }

    // Previous Slide
    function prevSlide() {
        currentIndex = (currentIndex === 0) ? slides.length - 1 : currentIndex - 1;
        updateCarousel();
    }

    // Auto Slide Function
    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    // Event Listeners
    nextButton.addEventListener("click", nextSlide);
    prevButton.addEventListener("click", prevSlide);

    // Pause Auto-Slide on Hover
    carouselContainer.addEventListener("mouseenter", stopAutoSlide);
    carouselContainer.addEventListener("mouseleave", startAutoSlide);

    // Update Slide Width on Resize
    window.addEventListener("resize", () => {
        slideWidth = slides[0].clientWidth;
        updateCarousel();
    });

    startAutoSlide(); // Start Auto-Sliding
});