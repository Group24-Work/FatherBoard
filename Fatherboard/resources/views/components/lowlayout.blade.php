<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FatherBoard' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{ $head ?? '' }}
</head>
<body>
    <x-header></x-header>
    {{ $slot }}
    <x-footer></x-footer>
</body>
</html>