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
        <link rel="stylesheet" href=<?php echo e(asset('css/product.css')); ?>>
        <script src=<?php echo e(asset('js/product.js')); ?>></script>
        <title>Product</title>
     <?php $__env->endSlot(); ?>



    <main id="product">
        <div id="image_container">
            <img src=<?php echo e(asset("images/" . $image)); ?> alt="Image" id="product_image"/>
        </div>
        <div id="content">
            <h2 id="title"><?php echo e($product->Title); ?> </h2>
            <p><?php echo e($product["Description"]); ?> </p>

            <form action="<?php echo e(route('basketAdd')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <button type="submit" id="BasketButton">Add To Basket</button>
            </form>
        </div>

        <div id="review-area">
        <p>
            There is no reviews;
            <p><?php echo e($rating); ?></p>

        <div id="reviews">

                <?php


                foreach($product->reviews()->get() as $rev)
                {
                    ?>
                    <div class="review">
                    <p><?php echo e($rev["review"]); ?></p>
                    <p><?php echo e($rev["rating"]); ?></p>
                    <div>
                    <?php
                }

                ?>
            </p>
        </div>
    </div>

    </main>

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
<?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/product.blade.php ENDPATH**/ ?>