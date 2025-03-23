<x-lowlayout>
    <x-slot:head>
        <title>Product Management</title>
        <link rel="stylesheet" href={{asset(path: 'css/aboutus.css')}}>
        <link rel="stylesheet" href="{{asset("/css/admin_products.css")}}">
        <link rel="stylesheet" href={{ asset('css/product.css') }}>


        <script src="{{asset("/js/admin_products.js")}}"></script>
    </x-slot:head>
    <x-adminh></x-adminh>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="exit">
        <a href="{{asset(route("adminHub"))}}">
            <p>Exit</p>

            <svg class="icon" fill="#000000" height="3rem" width="3rem" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 56 56"
                xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path
                            d="M54.424,28.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.208,15.293 c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.087,27H20.501c-0.552,0-1,0.447-1,1s0.448,1,1,1h30.586L40.794,39.293 c-0.391,0.391-0.391,1.023,0,1.414C40.989,40.902,41.245,41,41.501,41s0.512-0.098,0.707-0.293l11.999-11.999 C54.299,28.616,54.373,28.505,54.424,28.382z">
                        </path>
                        <path
                            d="M36.501,33c-0.552,0-1,0.447-1,1v20h-32V2h32v20c0,0.553,0.448,1,1,1s1-0.447,1-1V1c0-0.553-0.448-1-1-1h-34 c-0.552,0-1,0.447-1,1v54c0,0.553,0.448,1,1,1h34c0.552,0,1-0.447,1-1V34C37.501,33.447,37.053,33,36.501,33z">
                        </path>
                    </g>
                </g>
            </svg>
        </a>
    </div>
    <h2>Product Management</h2>


    <main>

        {{-- <table>
            <tr>
                <td>ninja</td>
                <td>ninja</td>
            </tr>
            <tr>asdsad</tr>

        </table>
        --}}
        <div id="product_specific_container">
            <p id="product_title"></p>
            <p id="product_id" hidden></p>
            <div id="product_stock_area">
                
            </div>
            <button id="add_tag">+</button>
            <div id="tag_container">
                <div id="product_tags"></div>
            </div>
            <div>
                <select id="tag_options">
                </select>
            </div>
        </div>

        <div id="product_region">
            <table id="product_table">


                <?php

foreach ($products as $product) {

        ?>
                <tr class="product_row">

                    <td class="product_id">{{$product["id"]}}</td>
                    <td name="product_title">{{$product["Title"]}}</td>
                    <td class="table_description">{{$product["Description"]}}</td>
                    <td class="product_stock">{{$product["Stock"]}}</td>
                    <td name="product_tags">
                        <?php
    foreach ($product["Tags"] as $tag) {
                ?>
                        <span> {{$tag->Name}}</span>

                        <?php
    }
            ?>
                </tr>

                <?php
}
    ?>
        </div>
        </table>

    </main>
</x-lowlayout>