@extends('layouts.lowlayout')

@section('title', 'FatherBoard - Homepage')

@section('content')
    <x-header></x-header>

    <!-- Dark Mode Toggle Button -->
    <div class="dark-mode-toggle-container">
        <input type="checkbox" id="dark-mode-toggle" class="dark-mode-toggle">
        <label for="dark-mode-toggle" class="dark-mode-label">
            <span class="dark-mode-icon sun">☀️</span>
            <span class="dark-mode-icon moon">🌙</span>
        </label>
    </div>

    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-text">
            <h1>Welcome to FatherBoard</h1>
        </div>
    </section>

    <!-- Category Icons Section -->

    <!-- Carousel Section -->
    <section class="carousel">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="images/front_images/banner1.jpg" alt="Featured Product 1">
            </div>
            <div class="carousel-slide">
                <img src="images/front_images/banner2.jpg" alt="Featured Product 2">
            </div>
            <div class="carousel-slide">
                <img src="images/front_images/banner3.jpg" alt="Featured Product 3">
            </div>
        </div>
        <button class="carousel-btn prev">❮</button>
        <button class="carousel-btn next">❯</button>
    </section>

    <!-- Hot Product Section -->
    <section class="hot-product">
        <h2>🔥 Hot Product of the Month</h2>
        <div class="hot-product-content">
            <img src="images/front_images/3060.png" alt="RTX 3060">
            <div class="hot-product-details">
                <h3>NVIDIA RTX 3060</h3>
                <p>Experience unparalleled gaming performance with the NVIDIA RTX 3060. Perfect for gamers and creators alike.</p>
                <a href="https://cs2team24.cs2410-web01pvm.aston.ac.uk/product/2" class="cta-btn">Shop Now</a>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-container">
            <div class="social-icons">
                <a href="https://facebook.com" target="_blank">
                    <img src="images/front_images/facebook.png" alt="Facebook">
                </a>
                <a href="https://x.com" target="_blank">
                    <img src="images/front_images/twitter.png" alt="Twitter">
                </a>
                <a href="https://instagram.com" target="_blank">
                    <img src="images/front_images/instagram.png" alt="Instagram">
                </a>
                <a href="https://linkedin.com" target="_blank">
                    <img src="images/front_images/linkedin.png" alt="LinkedIn">
                </a>
            </div>
            <div id="footer-link">
                <a href="/about">About Us</a>
            </div>
            <p>&copy; 2024 FatherBoard. All Rights Reserved.</p>
        </div>
    </footer>
    <br>
@endsection

