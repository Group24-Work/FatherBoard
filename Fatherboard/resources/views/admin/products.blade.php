<x-lowlayout>
    <x-slot:head>
        <title>Product Management</title>
        <link rel="stylesheet" href={{asset(path: 'css/aboutus.css')}}>
        <link rel="stylesheet" href="{{asset("/css/admin_products.css")}}">
        <link rel="stylesheet" href={{ asset('css/product.css') }}>


        <script src="{{asset("/js/admin_products.js")}}"></script>
    </x-slot:head>
    <x-header>

    </x-header>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <td>{{$product["Stock"]}}</td>
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