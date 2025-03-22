<x-lowlayout>
    <x-slot:head>

        <link rel="stylesheet" href={{asset("css/aboutus.css")}}>
        <link rel="stylesheet" href={{asset("css/admin_hub.css")}}>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset("js/admin_hub.js")}}"></script>

    </x-slot:head>
    <x-adminh></x-adminh>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="exit">
        <a href="{{asset(route("settings"))}}">
            <p>Exit</p>

            <svg class="icon" fill="#000000" height="3rem" width="3rem" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 56 56"
                xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path
                            d="M54.424,28.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.208,15.293 c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.087,27H20.501c-0.552,0-1,0.447-1,1s0.448,1,1,1h30.586L40.794,39.293 c-0.391,0.391-0.391,1.023,0,1.414C40.989,40.902,41.245,41,41.501,41s0.512-0.098,0.707-0.293l11.999-11.999 C54.299,28.616,54.373,28.505,54.424,28.382z">
                        </path>
                        <path
                            d="M36.501,33c-0.552,0-1,0.447-1,1v20h-32V2h32v20c0,0.553,0.448,1,1,1s1-0.447,1-1V1c0-0.553-0.448-1-1-1h-34 c-0.552,0-1,0.447-1,1v54c0,0.553,0.448,1,1,1h34c0.552,0,1-0.447,1-1V34C37.501,33.447,37.053,33,36.501,33z">
                        </path>
                    </g>
                </g>
            </svg>
        </a>
    </div>
    <template id="email_suggestion_item_template">
        <style>
            .email_item {
                border: 1px black solid;
            }
        </style>
        <div class="email_item">
            <p>
                <span>Name : </span>
                <slot name="Name">No Name</slot>
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
        <div id="charts">
            <h2>Welcome Admin</h2>

            

        <div id="action_container">
            <div id="current_overview">
                <p>Overview</p>
            </div>
            <div>
                <a href="{{route("accounts")}}">

                    <p>Account Management</p>
                </a>
            </div>
            <div>
                <a href="{{route("tagpage")}}">
                    <p>Tag Management</p>
                </a>
            </div>
            <div>
                <a href="{{route("tagindex")}}">
                    <p>Product Management</p>

                </a>
            </div>

            <div>
                <a href="{{route("messages")}}">
                    <p>Messages</p>

                </a>
            </div>
            <div>
                <a href="{{route("adminIndex")}}">

                    <p>Product Management (Interactive)</p>
                </a>
            </div>
            {{--
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
                </input>


                <button id="user_search_button">Search</button>

                <div id="emailSuggestion_container">

                </div> --}}
            </div>


        </div>


    </main>













</x-lowlayout>