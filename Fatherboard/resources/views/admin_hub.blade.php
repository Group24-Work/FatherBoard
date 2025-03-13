<x-lowlayout>
    <x-slot:head>
        {{-- <link rel="stylesheet" href={{asset("css/aboutus.css")}}> --}}
        <link rel="stylesheet" href={{asset("css/admin_hub.css")}}>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset("js/admin_hub.js")}}"></script>

    </x-slot:head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main>
        <h2>Welcome Admin</h2>
        <div class="chartContainer" id="revenueContainer">
            <canvas class="chart" id="revenue"></canvas>
        </div>
        <div class="chartContainer" id="revenueTypeContainer">
            <canvas class="chart" id="revenueType_chart"></canvas>
        </div>

        <div class="chartContainer" id="registrationContainer">
            <canvas class="chart" id="registration_chart"></canvas>
        </div>
    </main>

    <div>
        <p>Exit</p>
    </div>
    <div>
        <div>
            <p>Overview</p>
        </div>
        <div>

        <p>Revenue(Statistics)</p>
        </div>

        <div>

        <p>Account Management</p>
        </div>

        <div>

        <p>Product Management</p>
        </div>

        <div>

        <p>Messages</p>
        </div>

    </div>

</x-lowlayout>