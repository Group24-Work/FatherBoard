<x-lowlayout>
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href={{ asset("css/order_individual.css") }}>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->

        </x-slot:head>


        <x-header></x-header>

        <form action="{{ route('orders.return', $order->id) }}" method="POST">
            @csrf
            <div>
                <label for="return_reason">Reason for Return:</label>
                <select name="return_reason_id" required>
                    @foreach($reasons as $reason)
                        <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="comments">Additional Comments:</label>
                <textarea name="additional_comments" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-danger">Submit Return</button>
        </form>




</x-lowlayout>