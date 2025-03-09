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
        <link rel="stylesheet" href=<?php echo e(asset('css/products.css')); ?>>
        <script src=<?php echo e(asset('js/products.js')); ?>></script>
        <link rel="stylesheet" href=<?php echo e(asset('css/aboutus.css')); ?>>
        <title>Products</title>
     <?php $__env->endSlot(); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">



<template  id="template_product">
    <style>
        .price
        {
            color:black;
        }
        </style>
    <h2><slot name="Title">Unknown Title</slot></h2>
    <p><slot name="Description">Unknown Description</slot></p>
    <p><slot class="price" name="Manufacturer">Unknown Manufacturer</slot></p>
</template>
<!-- header.html -->
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






<div class="filter-sidebar filter"> <!--https://dev.to/clairecodes/how-to-make-a-sticky-sidebar-with-two-lines-of-css-2ki7-->
    <h3>Filter By:</h3>
    <div class="categories"> <!--https://stackoverflow.com/a/48316156-->
        <h4 style="padding-left: 1.563rem;">Category:</h4>
        <br>
        <div class="checkbox">
            <label><input type="checkbox" rel="Memory"/>Memory</label>
            </div>   
        <br>
        <div class="checkbox">
            <label><input type="checkbox" rel="CPU" href="CPUs"/>CPUs</label>
        </div>   
        <br>
        <div class="checkbox">
            <label><input type="checkbox" rel="Prebuilt" />Prebuilt Computers</label>
        </div>   
        <br>
        <div class="checkbox">
            <label><input type="checkbox" rel="GPU" />GPUs</label>
        </div>   
        <br>
        <div class="checkbox">
            <label><input type="checkbox" rel="PSU" />PSUs</label>
        </div>   
        <br>

    </div>

    <br>
    <hr>
    <br>

    <h4 style="padding-left: 1.563rem;">Price:</h4>
    <br>

    <div class="prices">
        <div class="checkbox">
            <label><input type="checkbox" rel="50-100" /> £50-100 </label>
        </div>
        <br>

        <div class="checkbox">
            <label><input type="checkbox" rel="100-200"/> £100-200 </label>
        </div>
        <br>
        <div class="checkbox">
            <label><input type="checkbox" rel="200-300" />£200-300 </label>
        </div>
        <br>

        <div class="checkbox">
            <label><input type="checkbox" rel="300-400" />£300-400</label>
        </div>
        <br>

        <div class="checkbox">
            <label><input type="checkbox" rel="400-500" /> £400-500</label>
        </div>
        <br>

        <div class="checkbox">
            <label><input type="checkbox" rel="500+" /> £500+ </label>
        </div>

    </div>
    <button id="filter-button">Filter</button>

</div>
<div id="ProductContainer">
    <?php
    if (count($data) > 0) {
    foreach($data as $item)
    {
            ?>


            <product-element class="ProductItem">
                <p hidden class="product_identity"> <?php echo e($item["id"]); ?> </p>
                <span slot="Title"><?php echo e($item['Title']); ?></span>
                <span slot="Description"><?php echo e($item['Description']); ?></span>
                <span slot="Manufacturer"> <?php echo e($item->price()->first()["price"]); ?></span>

            </product-element>
            <?php

    }};
    ?>
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
<?php endif; ?>

<?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/products.blade.php ENDPATH**/ ?>