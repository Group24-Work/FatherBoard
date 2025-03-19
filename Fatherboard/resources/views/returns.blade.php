<x-lowlayout>
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href={{ asset("css/order_individual.css") }}>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->

        </x-slot:head>


        <x-header></x-header>

        @extends('layouts.app')

        @section('content')
            <div class="container">
                <h2>Return Order #{{ $orders->id }}</h2>
                <p>Status: {{ $orders->order_status }}</p>

                <form action="{{ route('orders.return.store', $order) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Return</label>
                        <textarea class="form-control" id="reason" name="reason" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger">Confirm Return</button>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        @endsection

</x-lowlayout>