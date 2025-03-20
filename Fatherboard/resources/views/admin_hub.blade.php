<x-lowlayout>
    <x-slot:head>
        {{-- <link rel="stylesheet" href={{asset("css/aboutus.css")}}> --}}
        <link rel="stylesheet" href={{asset("css/admin_hub.css")}}>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset("js/admin_hub.js")}}"></script>

    </x-slot:head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <template id="email_suggestion_item_template">
        <style>
            .email_item
            {
                border: 1px black solid;
            }
        </style>
        <div class="email_item">
            <p>
                <span>Name : </span> <slot name="Name">No Name</slot>
            </p>
            <p>
                <span>Email : </span> 
                <slot name="Email">No First Name</slot>
            </p>
            <p>
                <span>ID : </span> 
                <slot name="ID">No ID</slot>
            </p>
        </div>
    </template>

    <main>
        <h2>Welcome Admin</h2>
        
        <div id="revenue_section">
            <button class="week">Week</button>
            <button class="month">Month</button>
            <div class="chartContainer" id="revenueContainer">
                <canvas class="chart" id="revenue"></canvas>
            </div>
        </div>
        

        <div id="revenueType_section">
            <button class="week">Week</button>
            <button class="month">Month</button>
            <div class="chartContainer" id="revenueTypeContainer">
                <canvas class="chart" id="revenueType_chart"></canvas>
            </div>
        </div>

        <div id="registrationType_section">
            <div class="chartContainer" id="registrationContainer">
                <canvas class="chart" id="registration_chart"></canvas>
            </div>
        </div>
        

    </main>




    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    </input>


    <button id="user_search_button">Search</button>

    <div id="emailSuggestion_container">

    </div>




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