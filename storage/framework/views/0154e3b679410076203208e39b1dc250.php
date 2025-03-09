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
        <link rel="stylesheet" href=<?php echo e(asset('css/aboutus.css')); ?>>
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
    <div class="split left"> <!--https://www.w3schools.com/howto/howto_css_split_screen.asp -->
            <div class="centered"> 
            <h1>About Us</h1>
            <br>

            <p style="text-align: left;">FatherBoard was founded in 2024 by 9 Computer Science students. <br>
                Our goal is to provide reasonably priced PC parts to hobbyists, fanatics and professionals alike.
                <br>
                <br>
                <br>
                As students, we understand the difficulty in finding appropriately priced computer parts, and how these prices create a high barrier to entry.
                This means that many individuals interesed in PC building, cannot reasonably access the hobby.
                <br>
                <br>
                We wanted to fix this, and share our enjoyment of PC parts and PC building. 
                <br>
                <br>
                At FatherBoard, we believe in transparent communication. If you have any issues or queries, please <a href="Contact.html">contact us.</a>
            </p>
            </div>
        </div>
        <div class="split right">
            <div class="centered">
                <br>
                <br>
                <br>
                <br>
                <img src="<?php echo e(asset('images/front_images/FatherboardBackground.png')); ?>" id="logo"alt="FatherBoard Logo" width="1000" height="700">
            </div>
            
        </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12)): ?>
<?php $attributes = $__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12; ?>
<?php unset($__attributesOriginal833e98bc68ba0a213b1da0b005c0aa12); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal833e98bc68ba0a213b1da0b005c0aa12)): ?>
<?php $component = $__componentOriginal833e98bc68ba0a213b1da0b005c0aa12; ?>
<?php unset($__componentOriginal833e98bc68ba0a213b1da0b005c0aa12); ?>
<?php endif; ?><?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/about.blade.php ENDPATH**/ ?>