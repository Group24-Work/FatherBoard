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

    <body>
        <h1 class="title">Requirements Questionnaire</h1>
        <p class="subtitle">This page will ask a series of questions, designed to help you pick the PC parts most suited
            to your needs.</p>

        <div class="wrapper" id="questionContainer">
            <h3 id="question">Question Placeholder</h3>
            <select id="choice"></select>
            <div id="buttons">
                <button id="btnNext">Next</button>
            </div>
        </div>
        <div id="submitContainer">
            <div>
            </div>
        <form id="questionnaireForm" method="POST" action="{{ route('questionnaire.process') }}">
            @csrf
            {{-- <svg class="icon" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 31.357 31.357" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M15.255,0c5.424,0,10.764,2.498,10.764,8.473c0,5.51-6.314,7.629-7.67,9.62c-1.018,1.481-0.678,3.562-3.475,3.562 c-1.822,0-2.712-1.482-2.712-2.838c0-5.046,7.414-6.188,7.414-10.343c0-2.287-1.522-3.643-4.066-3.643 c-5.424,0-3.306,5.592-7.414,5.592c-1.483,0-2.756-0.89-2.756-2.584C5.339,3.683,10.084,0,15.255,0z M15.044,24.406 c1.904,0,3.475,1.566,3.475,3.476c0,1.91-1.568,3.476-3.475,3.476c-1.907,0-3.476-1.564-3.476-3.476 C11.568,25.973,13.137,24.406,15.044,24.406z"></path> </g> </g></svg> --}}

            <input type="hidden" id="selected_tags" name="selected_tags" value="">
            <input type="hidden" id="question_responses" name="question_responses" value="">
            <button id="btnSubmit" type="submit" style="display: none;">Submit</button>
        </form>
    </div>
    </body>
    <x-footer-space>
    </x-footer-space>
    <x-footer>


    </x-footer>
</x-lowlayout>