<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Homepage</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
        <script src="{{asset('js/carousel.js')}}" defer></script> <!-- Link for homepage-specific styles -->
    </x-slot:head>


    <x-header></x-header>

    <div class="title">

    <section class="top-product">
        <div class="top-product-content">
            <img src="images/product_images/1.jpg" alt="RTX 4060">
            <div class="top-product-details">
                <h3>{{ $topproduct->Title }}</h3>
                <a href="https://cs2team24.cs2410-web01pvm.aston.ac.uk/product/{{$topproduct-> id}}" class="shop-now">Shop Now</a>
            </div>
        </div>
    </section>


</footer>
<br>
</x-lowlayout>

