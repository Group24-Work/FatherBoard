<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" href={{ asset('css/products.css') }}>
        <script src={{ asset('js/products.js') }}></script>
        <link rel="stylesheet" href={{asset('css/aboutus.css')}}>
        <title>Products</title>
    </x-slot:head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <?php

                ?>
    <template id="template_product">


        <style>
            .price {
                color: black;
            }
        </style>

        <slot name="ProductImage">No image available</slot>
        <h2>
            <slot name="Title">No Title</slot>
        </h2>
        <p>
            <b>

                <span>£<slot class="price" name="Price">0.00</slot></span>


            </b>
        </p>

        <span><slot class="basketButton" name="basketButton">Add to Basket</slot></span>   
    </template>
    <?php


;
?>




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
        <p style="margin-top:30px" ;>Unsure of your needs? Use our questionnaire!</p>
        <a href=/questionnaire><button id=filter-button
                style="background-color: black; color: white; margin-top:0px;">Questionnaire</button></a>

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
            <p>temp</p>
            <span slot="Title">{{ implode(' ', array_slice(explode(' ', $item['Title']), 0, 7)) }}</span>
            <span slot="Price"> {{$item["Price"]}}</span>
            <span slot=basketButton>
            <form action="{{ route('basketAdd') }}" method="POST">
                @csrf <!-- Include CSRF token for security -->
                <input type="hidden" name="product_id" value="{{ $item['ID'] }}">
               <button type="submit" class="basketButton" id="basket_button">Add to Basket</button></span>
            </form>

        </product-element>
        <?php

    }
}
;
    ?>
    </div>
</x-lowlayout>