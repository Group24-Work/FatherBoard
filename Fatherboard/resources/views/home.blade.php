<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Homepage</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
    </x-slot:head>


    <x-header></x-header>
    <div class="homeContainer">
        <div class="homeText">
            <h1>FatherBoard is the PC Parts Retailer that welcomes new builders.</h1>
        </div>
        <div class="homeSubtitle">
            <p>We offer a wide range of products, and a <a href="{{ route('questionnaire') }}"> questionnaire </a> to
                help find the parts you need!</p>
            <p>Read more <a href="{{ route('about') }}"> about us</a>, or <a href="{{route('products')}}"> click here to
                    view our products!</a>
        </div>
        <div class="shopButton">
            <a href="{{route('products')}}" id="shopButton"> Shop Now!</a>
        </div>
        <br>
        <br>
        <br>
        <br>
        
    </div>
    <section class="top-product">
        <div class="top-product-content">
            <h1 id="topTitle">Our Top Products!</h1>

            <div class="products-container">
                <div class="product-card">
                    <img src="{{ asset('images/product_images/' . $topproduct->id . '.jpg') }}"
                        alt="{{$topproduct->Title}}">
                    <div class="top-product-details">
                        <h3>{{ implode(' ', array_slice(explode(' ', $topproduct->Title), 0, 7)) }}</h3>
                        <a href="https://cs2team24.cs2410-web01pvm.aston.ac.uk/product/{{$topproduct->id}}"
                            class="shop-now">Shop Now</a>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('images/product_images/' . $secondproduct->id . '.jpg') }}"
                        alt="{{$secondproduct->Title}}">
                    <div class="top-product-details">
                        <h3>{{ implode(' ', array_slice(explode(' ', $secondproduct->Title), 0, 7)) }}</h3>
                        <a href="https://cs2team24.cs2410-web01pvm.aston.ac.uk/product/{{$secondproduct->id}}"
                            class="shop-now">Shop Now</a>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('images/product_images/' . $thirdproduct->id . '.jpg') }}"
                        alt="{{$thirdproduct->Title}}">
                    <div class="top-product-details">
                        <h3>{{ implode(' ', array_slice(explode(' ', $thirdproduct->Title), 0, 7)) }}</h3>
                        <a href="https://cs2team24.cs2410-web01pvm.aston.ac.uk/product/{{$thirdproduct->id}}"
                            class="shop-now">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-footer-space>
    </x-footer-space>
    <x-footer>
    </x-footer>

    <br>
</x-lowlayout>