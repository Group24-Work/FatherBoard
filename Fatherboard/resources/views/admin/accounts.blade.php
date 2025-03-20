<x-lowlayout>
    <x-slot:head>
        <title>Account Management</title>
        <link rel="stylesheet" href="{{asset('/css/admin_accounts.css')}}">
        <script src="{{asset('/js/admin_accounts.js')}}"></script>
    </x-slot:head>

    <h3>Account Management</h3>

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
        <div id="query_email_container">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            </input>
        
        
            <button id="user_search_button">Search</button>
        </div>
    
        <div id="emailSuggestion_container">
        </div>

        <div id="specific_user">
        </div>
            <h3>Customer Information</h3>
        </main>
</x-lowlayout>