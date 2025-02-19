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
        <title>FatherBoard - Basket</title>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/aboutus.css')); ?>"> <!-- Link for the header styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/basket.css')); ?>"> <!-- Link for basket styles -->
        <script src="<?php echo e(asset('js/basket.js')); ?>" defer></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script> <!--Scripts needed for jQuery-->
     <?php $__env->endSlot(); ?>

        <!-- Header Section (unchanged, linked to stylesheet.css) -->
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

<body>
    <main class="basket-page">
        <div class="basket-container">

    <h2>Your Basket</h2>
    <?php if(session('success')): ?>
    <p><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <?php if(empty($basket)): ?>
    <div id="basket-items" class="basket-items hidden">

    <p> Your Basket is Empty!</p>
    <?php else: ?> 
    <div class="tablediv">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>SubTotal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $basket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item['name']); ?></td>
            <td><?php echo e($item['price']); ?></td>
        </div>
            <td>

                <form method="POST" action="<?php echo e(route('basketUpdate')); ?>">
                    <?php echo csrf_field(); ?>
    <input type="hidden" name="product_id" value="<?php echo e($item['product_id']); ?>">
    <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1">
    <button type="submit"> Update</button>
                </form>

            </td>

            <td><?php echo e($item['price'] * (int)$item['quantity']); ?> </td>

            <td>
                <form method="POST" action="<?php echo e(route('basketRemove')); ?>">
                    <?php echo csrf_field(); ?>
    <input type="hidden" name="product_id" value="<?php echo e($item['product_id']); ?>">
    <button type="submit">Remove</button>
    </form>
            </td></tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>
    <button id="checkout-btn" href="<?php echo e(route('basketCheckout')); ?>">Proceed To Checkout</button>
    <?php endif; ?>
</div>
</main>
            </body>
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
<?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/basket.blade.php ENDPATH**/ ?>