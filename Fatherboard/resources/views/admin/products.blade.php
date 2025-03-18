
<x-lowlayout>
    <x-slot:head>
        <title>Product Management</title>
    </x-slot:head>

    <h2>Product Management</h2>


    <?php

    foreach($products as $product)
    {
        ?>
        <p>{{$product["id"]}}</p>
        <p>{{$product["Title"]}}</p>
        <p>{{$product["Description"]}}</p>

        <?php
    }
    ?>
</x-lowlayout>