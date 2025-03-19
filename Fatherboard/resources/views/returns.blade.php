<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/returns.css') }}">
    </x-slot:head>

    <x-header></x-header>

    <div class="container mt-5">
        <h2>Return Order #{{ $order->id }}</h2>

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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.return.store', $orders->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="reason">Reason for Return:</label>
                <textarea name="reason" id="reason" class="form-control" rows="4"
                    required>{{ old('reason') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Confirm Return</button>
        </form>
    </div>
</x-lowlayout>