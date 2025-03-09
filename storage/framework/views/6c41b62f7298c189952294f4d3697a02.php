<?php if (isset($component)) { $__componentOriginal833e98bc68ba0a213b1da0b005c0aa12 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.lowlayout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('lowlayout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('head', null, []); ?> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Homepage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/aboutus.css')); ?>"> <!-- Link for the header styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/home.css')); ?>"> <!-- Link for homepage-specific styles -->
     <?php $__env->endSlot(); ?>


    <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12)): ?>
<?php $attributes = $__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12; ?>
<?php unset($__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal833e98bc68ba0a213b1da0b005c0aa12)): ?>
<?php $component = $__componentOriginal833e98bc68ba0a213b1da0b005c0aa12; ?>
<?php unset($__componentOriginal833e98bc68ba0a213b1da0b005c0aa12); ?>
<?php endif; ?><?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/home.blade.php ENDPATH**/ ?>