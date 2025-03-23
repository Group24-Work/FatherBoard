<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/order_individual.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/aboutus.css') }}">
        <!-- Link for the header styles -->
    </x-slot:head>

    <x-header></x-header>


    <div id="return_container">

        <a href="/settings#!history">

            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="-2 -2 24 24"
                stroke=currentColor>

                <g transform="scale(-1,1) translate(-20,0)">

                    <path
                        d="M10 20A10 10 0 1 0 0 10a10 10 0 0 0 10 10zM8.711 4.3l5.7 5.766L8.7 15.711l-1.4-1.422 4.289-4.242-4.3-4.347z" />

                </g>

            </svg>

        </a>

    </div>


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
            <h2>Order Number: #{{$orders->order_number}}</h2>
            @foreach ($data as $x)
                <div class="item_order">
                    <img src="{{ asset('images/product_images/' . $x['image'] . '.jpg') }}" />
                    <h2>{{ $x['Title'] }}</h2>
                    <h2>£{{ $x['price'] }}</h2>
                    <h2>QUANTITY</h2>

                </div>
            @endforeach
        </div>


    </div>
</x-lowlayout>