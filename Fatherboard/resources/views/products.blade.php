<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Products</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}"> <!-- Link for products styles -->
        <script src="{{asset('js/darkmode.js')}}" defer></script> <!-- Link for dark mode functionality -->
    </x-slot:head>

    <x-header></x-header>

    <!-- Dark Mode Toggle Button -->
    <div class="dark-mode-toggle-container">
        <input type="checkbox" id="dark-mode-toggle" class="dark-mode-toggle">
        <label for="dark-mode-toggle" class="dark-mode-label">
            <span class="dark-mode-icon sun">☀️</span>
            <span class="dark-mode-icon moon">🌙</span>
        </label>
    </div>

    <!-- Products Content -->
    <section class="products">
        <h1>Our Products</h1>
        <p>Explore our wide range of products.</p>
        <!-- Add more content as needed -->
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <template id="template_product">
        <style>
            .price {
                color: black;
            }
        </style>

        <slot name="ProductImage">No image available</slot>
        <h2>
            <slot name="Title">Unknown Title</slot>
        </h2>
        <p>
            <b>
                <slot class="price" name="Manufacturer">Unknown Manufacturer</slot>
            </b>
        </p>

    </template>
    <!-- header.html -->
    <x-header></x-header>






    <div class="filter-sidebar filter">
        <!--https://dev.to/clairecodes/how-to-make-a-sticky-sidebar-with-two-lines-of-css-2ki7-->
        <h3>Filter By:</h3>
        <div class="categories"> <!--https://stackoverflow.com/a/48316156-->
            <h4 style="padding-left: 1.563rem;">Category:</h4>
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="Memory" />Memory</label>
            </div>
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="CPU" href="CPUs" />CPUs</label>
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
                <label><input type="checkbox" rel="100-200" /> £100-200 </label>
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
        <button id="filter-button" style="background-color: purple; color: white;">Filter</button>

    </div>
    <div id="ProductContainer">
        <?php
if (count($data) > 0) {
    foreach ($data as $item) {
            ?>


        <product-element class="ProductItem">
            <img slot="ProductImage" src="{{ asset('images/product_images/' . $item['Image'] . '.jpg') }}"
                alt="product image" class="product-image">
            <p hidden class="product_identity"> {{$item["ID"]}} </p>
            <p>crazy killer u</p>
            <span slot="Title">{{ implode(' ', array_slice(explode(' ', $item['Title']), 0, 7)) }}</span>

            <span slot="Manufacturer"> £{{ $item["Price"] }}</span>

        </product-element>
        <?php

    }
}
;
    ?>
    </div>
</x-lowlayout>