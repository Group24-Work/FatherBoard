
<x-lowlayout>
    <x-slot:head>
        <title>Product Management</title>
    </x-slot:head>

    <h2>Product Management</h2>

    <div>

        {{-- <table>
            <tr>
                <td>ninja</td>
                <td>ninja</td>
            </tr>
            <tr>asdsad</tr>

        </table>
        <table> --}}

    <?php

    foreach($products as $product)
    {

        ?>
        <tr>

        <td>{{$product["id"]}}</td>
        <td>{{$product["Title"]}}</td>
        <td>{{$product["Description"]}}</td>
        <td>{{$product["Stock"]}}</td>

         </tr>

        <?php
    }
    ?>
     </table>

    </div>
</x-lowlayout>