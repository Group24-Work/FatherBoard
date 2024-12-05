
<x-layout>
    <x-slot:title>
        s
    </x-slot:title>
    <x-slot:sheet>
        login
    </x-slot:sheet>
    <h2>Log in</h2>


    <form action="./_login" method="POST" id="login_form">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <input type="text" name="email" id="email">
        <input type="text" name="password" id="password">
        <label for="permanent">Persist login after close</label>
        <input type="checkbox" name="permanent" id="permanent">
        <input type="submit" name="submit" id="submit">
    </form>



    <div id="notification_container">
    </div>
    <p></p>
</x-layout>