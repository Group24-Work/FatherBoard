<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" href="{{asset("/css/reset_password.css")}}">
        <script src="{{asset("/js/reset_password.js")}}"></script>
    </x-slot:head>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <h3>Password Reset</h3>

    <form method="POST" action="/reset" id="reset_password_form">

    <label for="new_password">New Password</label>
    <input type="text" name="new_password" id="new_password">
    <input type="submit">

    </form>
</x-lowlayout>