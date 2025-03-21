<x-lowlayout>
    <x-slot:head>
        <title>Account Management</title>
        <link rel="stylesheet" href="{{asset('/css/admin_accounts.css')}}">
        <script src="{{asset('/js/admin_accounts.js')}}"></script>
    </x-slot:head>


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <template id="email_suggestion_item_template">
        <style>

            .email_item
            {
                border: 1px solid black;
                border-radius: 0.3rem;
                margin: 0.5rem;
                display:flex;
                justify-content: space-between;
                align-items: center;
                width:80%;
            }
            .email_content
            {
                width:50%;
            }
            
            .alter_icon {
                height: 2rem;
                width: 2rem;
                margin: 0 0.5rem;
            }
            #options
            {
                width:20%;
            }
        </style>
        <div class="email_item">

            <div class="email_content">
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
        <div id="options">
            <svg class="delete_svg alter_icon" fill="red" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 482.428 482.429" xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <g>
                            <path
                                d="M381.163,57.799h-75.094C302.323,25.316,274.686,0,241.214,0c-33.471,0-61.104,25.315-64.85,57.799h-75.098 c-30.39,0-55.111,24.728-55.111,55.117v2.828c0,23.223,14.46,43.1,34.83,51.199v260.369c0,30.39,24.724,55.117,55.112,55.117 h210.236c30.389,0,55.111-24.729,55.111-55.117V166.944c20.369-8.1,34.83-27.977,34.83-51.199v-2.828 C436.274,82.527,411.551,57.799,381.163,57.799z M241.214,26.139c19.037,0,34.927,13.645,38.443,31.66h-76.879 C206.293,39.783,222.184,26.139,241.214,26.139z M375.305,427.312c0,15.978-13,28.979-28.973,28.979H136.096 c-15.973,0-28.973-13.002-28.973-28.979V170.861h268.182V427.312z M410.135,115.744c0,15.978-13,28.979-28.973,28.979H101.266 c-15.973,0-28.973-13.001-28.973-28.979v-2.828c0-15.978,13-28.979,28.973-28.979h279.897c15.973,0,28.973,13.001,28.973,28.979 V115.744z">
                            </path>
                            <path
                                d="M171.144,422.863c7.218,0,13.069-5.853,13.069-13.068V262.641c0-7.216-5.852-13.07-13.069-13.07 c-7.217,0-13.069,5.854-13.069,13.07v147.154C158.074,417.012,163.926,422.863,171.144,422.863z">
                            </path>
                            <path
                                d="M241.214,422.863c7.218,0,13.07-5.853,13.07-13.068V262.641c0-7.216-5.854-13.07-13.07-13.07 c-7.217,0-13.069,5.854-13.069,13.07v147.154C228.145,417.012,233.996,422.863,241.214,422.863z">
                            </path>
                            <path
                                d="M311.284,422.863c7.217,0,13.068-5.853,13.068-13.068V262.641c0-7.216-5.852-13.07-13.068-13.07 c-7.219,0-13.07,5.854-13.07,13.07v147.154C298.213,417.012,304.067,422.863,311.284,422.863z">
                            </path>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>
    </template>

    <main>
        <div id="query_email_container">
            <h3>Account Management</h3>

            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            </input>
        
        
            <button id="user_search_button">Search</button>
        </div>
    
        <div id="emailSuggestion_container">
            <h3>No matching users</h3>
        </div>

        <div class="single_order" hidden>
            <h2 class="order_">Orders</h2>
            <p class="order_details"></p>
        </div>

        <div id="specific_user">
            <h3>Customer Information</h3>
            <p id="specific_id" hidden></p>
            <p id="specific_name"></p>

            <p id="specific_email"></p>

            {{-- <button id="delete_account">Delete Account</button> --}}

            <div id="order_container">
                
            </div>
        </div>
        </main>

        <div id="exit">
            <a href="{{asset(route("adminHub"))}}">
            <p>Back </p>
    
            <svg class="icon" fill="#000000" height="3rem" width="3rem" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 56 56" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M54.424,28.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.208,15.293 c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.087,27H20.501c-0.552,0-1,0.447-1,1s0.448,1,1,1h30.586L40.794,39.293 c-0.391,0.391-0.391,1.023,0,1.414C40.989,40.902,41.245,41,41.501,41s0.512-0.098,0.707-0.293l11.999-11.999 C54.299,28.616,54.373,28.505,54.424,28.382z"></path> <path d="M36.501,33c-0.552,0-1,0.447-1,1v20h-32V2h32v20c0,0.553,0.448,1,1,1s1-0.447,1-1V1c0-0.553-0.448-1-1-1h-34 c-0.552,0-1,0.447-1,1v54c0,0.553,0.448,1,1,1h34c0.552,0,1-0.447,1-1V34C37.501,33.447,37.053,33,36.501,33z"></path> </g> </g></svg>
        </a>
        </div>
</x-lowlayout>