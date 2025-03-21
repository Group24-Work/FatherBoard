<x-lowlayout>

    <x-slot:head>
        <link rel="stylesheet" href={{ asset('css/product.css') }}>
        <link rel="stylesheet" href={{asset('css/aboutus.css')}}>

        <script src={{ asset('js/product.js') }}></script>
        <title>Create Product</title>
    </x-slot:head>

    <x-adminh></x-adminh>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="exit">
        <a href="{{asset(route("adminIndex"))}}">
            <p>Exit</p>

            <svg class="icon" fill="#000000" height="3rem" width="3rem" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 56 56"
                xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path
                            d="M54.424,28.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.208,15.293 c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.087,27H20.501c-0.552,0-1,0.447-1,1s0.448,1,1,1h30.586L40.794,39.293 c-0.391,0.391-0.391,1.023,0,1.414C40.989,40.902,41.245,41,41.501,41s0.512-0.098,0.707-0.293l11.999-11.999 C54.299,28.616,54.373,28.505,54.424,28.382z">
                        </path>
                        <path
                            d="M36.501,33c-0.552,0-1,0.447-1,1v20h-32V2h32v20c0,0.553,0.448,1,1,1s1-0.447,1-1V1c0-0.553-0.448-1-1-1h-34 c-0.552,0-1,0.447-1,1v54c0,0.553,0.448,1,1,1h34c0.552,0,1-0.447,1-1V34C37.501,33.447,37.053,33,36.501,33z">
                        </path>
                    </g>
                </g>
            </svg>
        </a>
    </div>
    <main id="product">
        <div id="content">
            <form action="{{ route('created')}}" method='POST'>
                @csrf
                <div class="text-input">
                    <input type="text" name="Title" id="Title" placeholder="Title" required>
                </div>
                <div class="text-input">
                    <input type="text" name="Description" id="Description" placeholder="Description" required>
                </div>
                <div class="text-input">
                    <input type="text" name='Manufacturer' id="Manufacturer" placeholder="Manufacturer" required />
                </div>
                <div class="text-input">
                    <input type="text" name='Type' id="Type" placeholder="Type" required />
                </div>
                <div class="text-input">
                    <input type="text" name='Price' id="Price" placeholder="Price" required />
                </div>
                <!--
                <div class="text-input">
                    <input type="text" name='Stock' id ="Stock" placeholder="Current Stock" required />
                </div>
                -->
                <input type="submit" name="submit" id="submit" value="Create">

            </form>
        </div>
    </main>

</x-lowlayout>