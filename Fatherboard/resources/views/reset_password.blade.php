<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" href="{{asset("/css/reset_password.css")}}">
        <script src="{{asset("/js/reset_password.js")}}"></script>
    </x-slot:head>
    <meta name="csrf-token" content="{{ csrf_token() }}">



    

    <div class="wrapper">

        <form method="POST" action="/reset" id="reset_password_form">
            <h3>Password Reset</h3>

            {{-- <label for="new_password">New Password</label> --}}
            <input type="text" class="text-input" placeholder="New Password" name="new_password" id="new_password">
            <input type="submit" id="submit_button">
        
        </form>

{{-- 
        <form method="POST" action="/forgot" id="password_form">
            <h1>Forgot Password</h1>
    
            <input type="text" name="Email" id="email_input" placeholder="Email" class="text-input">
            <input type="submit" id="submit_button">
        </form> --}}
    </div>
</x-lowlayout>





