<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" type="text/css" href={{ asset("css/order_individual.css") }}>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->
    </x-slot:head>

    <x-header></x-header>
    @if ($orders->order_status === 'Pending')
        <form action="{{ route('orders.return', $order) }}" method="get">
            @csrf
            <button type="submit" class="btn btn-danger">Return Order</button>
        </form>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div id="order_block">
        <div id="order_container">
            <?php
foreach ($data as $x) {
            ?>
            <div class="item_order">
                <img src={{asset("images/product_images/" . $x["image"] . ".jpg")}}></img>
                <h2>{{$x["Title"]}}</h2>
            </div>
            <?php
}
            ?>
        </div>

        <div class="return-button-container">
            @if ($order->status !== 'returned')
                <a href="{{ route('returns.create', $order->id) }}" class="btn btn-warning">
                    Return Order
                </a>
            @else
                <span class="text-success">Order already returned</span>
            @endif
        </div>
    </div>
</x-lowlayout>