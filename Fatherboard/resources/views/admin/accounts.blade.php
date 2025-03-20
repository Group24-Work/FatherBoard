<x-lowlayout>
    <x-slot:head>
        <title>Account Management</title>
        <link rel="stylesheet" href="{{asset('/css/admin_accounts.css')}}">
        <script src="{{asset('/js/admin_accounts.js')}}"></script>
    </x-slot:head>

    <h3>Account Management</h3>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        </input>
    
    
        <button id="user_search_button">Search</button>
    
        <div id="emailSuggestion_container">

    </div>
</x-lowlayout>