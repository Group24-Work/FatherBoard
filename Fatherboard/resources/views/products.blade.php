
<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" href="{{asset('css/products.css')}}">
        <script src="{{asset('/js/products.js')}}"></script>
    </x-slot:head>

<div class="wrapper">
    <div class="filter-sidebar filter"> <!--https://dev.to/clairecodes/how-to-make-a-sticky-sidebar-with-two-lines-of-css-2ki7-->
        <h3>Filter By:</h3>
        <div class="categories"> <!--https://stackoverflow.com/a/48316156-->
            <h4 style="padding-left: 1.563rem;">Category:</h4>
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="Memory" onchange="change();"/>Memory</label>
                </div>   
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="CPUs" onchange="change();" href="CPUs"/>CPUs</label>
            </div>   
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="Prebuilts" onchange="change();"/>Prebuilt Computers</label>
            </div>   
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="GPUs" onchange="change();"/>GPUs</label>
            </div>   
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="PSUs" onchange="change();"/>PSUs</label>
            </div>   
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="Sale" onchange="change();"/>On Sale</label>

            </div>
        </div>

        <br>
        <hr>
        <br>

        <h4 style="padding-left: 1.563rem;">Price:</h4>
        <br>

        <div class="prices">
            <div class="checkbox">
                <label><input type="checkbox" rel="50-100" onchange="change();"/> £50-100 </label>
            </div>
            <br>

            <div class="checkbox">
                <label><input type="checkbox" rel="100-200" onchange="change();"/> £100-200 </label>
            </div>
            <br>
            <div class="checkbox">
                <label><input type="checkbox" rel="200-300" onchange="change();"/>£200-300 </label>
            </div>
            <br>

            <div class="checkbox">
                <label><input type="checkbox" rel="300-400" onchange="change();"/>£300-400</label>
            </div>
            <br>

            <div class="checkbox">
                <label><input type="checkbox" rel="400-500" onchange="change();"/> £400-500</label>
            </div>
            <br>

            <div class="checkbox">
                <label><input type="checkbox" rel="500+" onchange="change();"/> £500+ </label>
            </div>

        </div>


        </p>
        </div>

        <template  id="template_product">
            <h2><slot name="Title">Unknown Title</slot></h2>
            <p><slot name="Description">Unknown Description</slot></p>
            <p><slot name="Manufacturer">Unknown Manufacturer</slot></p>
        </template>
        
    <div class="main-content">
        <h2>Main Content</h2>
        <div id="ProductContainer">
            <div class="CPUs 100-200">
                <h2>CPU 1</h2>
            </div>
            <?php
                foreach ($data as $index=>$item)
                {
                    ?>
                    <product-element class="ProductItem">
                        <p hidden class="product_identity"> {{$item["id"]}} </p>
                        <span slot="Title">{{ $item['Title'] }}</span>
                        <span slot="Description">{{ $item['Description'] }}</span>
                        <span slot="Manufacturer"> {{ $item['Manufacturer']  }}</span>
        
                    </product-element>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

</x-lowlayout>