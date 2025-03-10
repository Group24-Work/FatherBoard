<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - About Us</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}"> <!-- Link for the header styles -->
        <script src="{{asset('js/darkmode.js')}}" defer></script> <!-- Link for dark mode functionality -->
    </x-slot:head>

    <x-header></x-header>

    <!-- Dark Mode Toggle Button -->
    <div class="dark-mode-toggle-container">
        <input type="checkbox" id="dark-mode-toggle" class="dark-mode-toggle">
        <label for="dark-mode-toggle" class="dark-mode-label">
            <span class="dark-mode-icon sun">☀️</span>
            <span class="dark-mode-icon moon">🌙</span>
        </label>
    </div>

    <!-- About Us Content -->
    <section class="about-us">
        <h1>About Us</h1>
        <p>Welcome to FatherBoard, your number one source for all things tech.</p>
        <!-- Add more content as needed -->
    </section>
</x-lowlayout>