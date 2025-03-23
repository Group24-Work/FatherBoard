<x-lowlayout>
    <x-slot:head>
        <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
        <link rel="stylesheet" href="{{asset("/css/questionnaire_results.css")}}">
        <script src="{{asset("/js/questionnaire_results.js")}}"></script>
        <title>Questionnaire Results</title>
        <link rel="stylesheet" href={{asset('css/aboutus.css')}}>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--https://www.w3schools.com/HOWTO/howto_css_star_rating.asp-->


    </x-slot:head>

    <x-header>
    </x-header>
    <template id="template_product">


        <style>
            .price {
                color: black;
            }
            .item_options
            {
                position:absolute;
                width:80%;
                left:50%;
                transform: translateX(-50%);
                bottom:5%;
            }
            .item_content:hover
            {
                background-color: rgb(158, 157, 157);

            }
            .item_content
            {
                padding-bottom: 70px;
            }
            .item_reviews
            {
                height:20px;
                width:20px;
            }
        </style>

        <div class="item_content">

            <slot name="ProductImage">No image available</slot>
            <h2>
                <slot name="Title">No Title</slot>
            </h2>
            <p>
                <b>

                    <span>£<slot class="price" name="Price">0.00</slot></span>


                </b>
            </p>
        </div>

    <div class="item_options">

        <span><slot class="basketButton" name="basketButton">Add to Basket</slot></span> 
        <slot class="item_reviews" name="reviews">
            No revs</slot>  
    </div>
    </template>
    <canvas id="confetti">
        
    </canvas>
    <div id="title_content">
        <h3>Questionnaire results</h3>
    </div>

    <div id="ProductContainer">

<?php
    if (count($data) > 0) {
        foreach ($data as $item) {
            $rating = DB::table("reviews")->where("product_id",$item["ID"])->select(DB::raw("avg(rating) as avg_rating"))->first();
            $numOfStars = App\Utility\Utility::numberClosest($rating->avg_rating ?? 0, [1,2,3,4,5]);
    
            $starDisplay="";
            for ($i = 1; $i <=5; $i++){
                if ($i<=$numOfStars){ // using a different star to product page, as that uses images - harder to format being smaller (also can display missing stars)
                    $starDisplay .= '<span class="fa fa-star checked"></span>';
                } else{
                    $starDisplay .= '<span class="fa fa-star"></span>';
                }
            }
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
                   <button type="submit" class="basketButton" id="basket_button">Add to Basket</button>
                </form>
                </span>
                <div slot="reviews"><?php echo $starDisplay; ?></div>
    
            </product-element>
            <?php
    
        }
    };
    ?>
    </div>

</x-lowlayout>