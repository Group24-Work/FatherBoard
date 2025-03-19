<x-lowlayout>
    <x-slot:head>
        <title>Forgot Credentials</title>
        <script src="{{asset("/js/forgot_credentials.js")}}"></script>
    </x-slot:head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h3>Forgot Password</h3>

    
    <form method="POST" action="/forgot" id="password_form">
        <input type="text" name="Email" id="email_input">
        <input type="submit" id="submit_button">
    </form>
</x-lowlayout>