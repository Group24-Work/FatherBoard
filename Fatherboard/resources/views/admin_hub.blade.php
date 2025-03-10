<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" href={{asset("css/aboutus.css")}}>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset("js/admin_hub.js")}}"></script>

    </x-slot:head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h2>Welcome Admin</h2>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</x-lowlayout>