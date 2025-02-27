<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" type="text/css" href={{ asset("css/order_individual.css") }}>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->

    </x-slot:head>

    
    <x-header></x-header>



    <div id="return_container">
        <b>Return Back</b>
    </div>



    <div id="order_block">
        <p>{{}}</p>
    <div id="order_container">
    <?php
        foreach($data as $x)
        {
            ?>
            <div class="item_order">
            <img src={{asset("images/product_images/" . $x["id"].".jpg")}}></img>
            <h2>{{$x["Title"]}}</h2>

            </div>
            <?php
        }
        ?>
    </div>
    </div>
</x-lowlayout>