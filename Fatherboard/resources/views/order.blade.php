<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/order_individual.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/aboutus.css') }}">
        <!-- Link for the header styles -->
    </x-slot:head>

    <x-header></x-header>

    @if ($orders->order_status === 'Pending')
        <a href="{{ route('order.return', $orders) }}" class="btn btn-danger">
            Return Order
        </a>
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
            @foreach ($data as $x)
                <div class="item_order">
                    <img src="{{ asset('images/product_images/' . $x['image'] . '.jpg') }}" />
                    <h2>{{ $x['Title'] }}</h2>
                </div>
            @endforeach
        </div>


    </div>
</x-lowlayout>