<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FatherBoard')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/darkmode.css') }}">
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
</head>
<body>
    <header>
        <!-- Your header content -->
        <button id="dark-mode-toggle" class="dark-mode-toggle-bottom-right">🌙</button>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Your footer content -->
    </footer>
</body>
</html>