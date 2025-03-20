<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Checkout</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/checkout_success.css')}}"> <!-- Link for homepage-specific styles -->
    </x-slot:head>
    <x-header></x-header>
    <x-slot:title>
        success
    </x-slot:title>
    <div class=wrapper>
        <div id=wrapperHeader>
            <h1>Checkout Complete</h1>
        </div
    </div>
    <x-slot:sheet>
    </x-slot:sheet>
</x-lowlayout>
