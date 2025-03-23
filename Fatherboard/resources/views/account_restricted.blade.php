<x-lowlayout>
    <x-slot:head>
        <link rel="stylesheet" href="{{asset("/css/account_restricted.css")}}">

    </x-slot:head>


    <div id="restrict_box">
        <div id="restrict_content">
        <object class="option_icon admin_icon" type="image/svg+xml"
        data="{{asset("/images/setting_images/restricted.svg")}}"></object>

        <h3>
            Your account is restricted
        </h3>

        <a id="button_back" href="{{route("home")}}">
            <button>Go Back</button>
        </a>
    </div>

    </div>
</x-lowlayout>