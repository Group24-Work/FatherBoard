<x-lowlayout>
    <x-slot:head>
        <title>Forgot Credentials</title>
        <link rel="stylesheet" href="{{asset("/css/forgot_credentials.css")}}">
        <script src="{{asset("/js/forgot_credentials.js")}}"></script>
    </x-slot:head>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="wrapper">

    <form method="POST" action="/forgot" id="password_form">
        <h1>Forgot Password</h1>

        <input type="text" name="Email" id="email_input" placeholder="Email" class="text-input">
        <input type="submit" id="submit_button">
    </form>
</div>

</x-lowlayout>




{{-- <x-lowlayout>
    <x-slot:head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth_message.css')}}">
    <script src={{ asset('js/login.js') }}></script>
    <title>Login</title>
    </x-slot:head>

    <div class="wrapper">

        <form action="./_login" method="POST" id="login_form">

   

            <div class="register">
                <p id="newUserText">New user? <a href="{{route('register')}}">Create a new account!</a></p>
            </div>

        </form>
    <div class="wrapper">




    <p></p>
</x-lowlayout> --}}