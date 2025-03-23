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

        <form id="questionnaireForm" method="POST" action="{{ route('questionnaire.process') }}">
            @csrf
            <input type="hidden" id="selected_tags" name="selected_tags" value="">
            <input type="hidden" id="question_responses" name="question_responses" value="">
            <button id="btnSubmit" type="submit" style="display: none;">Submit</button>
        </form>
    </body>

</x-lowlayout>