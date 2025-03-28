<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Checkout</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/aboutus.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout_success.css') }}">
    </x-slot:head>
    <x-header></x-header>
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
        <div id=wrapperText>
            <p>You can view this order in your <a href=/settings#!history>Order History page.</a></p>
        </div>
        <div id=buttons>
            <a href=/home><button id="home-button" style="background-color: purple; color: white;">Home</button></a>
            <a href=/products><button id="products-button" style="background-color: purple; color: white;">Continue
                    Shopping</button></a>


        </div>
    </div>
            <x-footer-space>
            </x-footer-space>
            <x-footer>
            </x-footer>


</x-lowlayout>