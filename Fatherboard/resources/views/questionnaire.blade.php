<x-lowlayout>
    <x-slot:head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FatherBoard - Requirements Questionnaire</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/aboutus.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/questionnaire.css')}}">
        <script src="{{asset('js/questionnaire.js')}}" defer></script>


    </x-slot:head>

    <x-header>

    </x-header>

    <div class="container">
        <form id="questionnaire-form">
            @csrf
            <h2> Select Your Preferences</h2>
            <div>
                @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->name }}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            <button type="submit"> Apply Filter</button>
        </form>
    </div>


</x-lowlayout>