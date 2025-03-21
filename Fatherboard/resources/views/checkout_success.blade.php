<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Checkout</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/aboutus.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout_success.css') }}">
    </x-slot:head>
    <x-adminheader></x-adminheader>
    <x-slot:title>
        Success
    </x-slot:title>
    <div class="wrapper">
        <div id="wrapperHeader">
            <h1>Order Confirmed!</h1>
        </div>
        <div id="wrapperSubtitle">
            <p>Thank you for your order!</p>
        </div>
        @if (isset($orderNumber) && $orderNumber)
            <div id="orderNumber">
                <p>Your order number is: #{{ $orderNumber }}</p>
            </div>
        @endif
    </div>
</x-lowlayout>