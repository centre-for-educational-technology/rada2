<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="200x200" href="{{ asset('img/logos/logo-square.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RADA') }}</title>

    <!-- Styles -->
    <link href="//cdn.jsdelivr.net/npm/animate.css@3.6.1/animate.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'isLoggedIn' => Auth::check(),
            'userName' => Auth::check() ? Auth::user()->name : trans('pages.play.game.not-logged-in'),
        ]); ?>;
        window.RADA = <?php echo json_encode([
            'config' => [
                'base_url' => url('/'),
                'game_url' => $game_url,
                'locale' => App::getLocale()
            ],
            'data' => [
                'game' => $game_data,
                'translations' => [
                    'complete' => trans('pages.play.game.stopped-heading'),
                    'results-heading' => trans('pages.play.game.results-heading'),
                    'task-is-pending-an-evaluation' => trans('pages.play.game.task-is-pending-an-evaluation'),
                    'read-more-about' => trans('pages.play.game.read-more-about')
                ]
            ],
        ]);
        ?>;

        window.Laravel.questionTypeConstants = {!! json_encode([
        'INFORMATION' => \App\Options\QuestionTypeOptions::INFORMATION,
        'ONE_CORRECT_ANSWER' => \App\Options\QuestionTypeOptions::ONE_CORRECT_ANSWER,
        'MULTIPLE_CORRECT_ANSWERS' => \App\Options\QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS,
        'FREEFORM_ANSWER' => \App\Options\QuestionTypeOptions::FREEFORM_ANSWER,
        'MATCH_PAIRS' => \App\Options\QuestionTypeOptions::MATCH_PAIRS,
        'EMBEDDED_CONTENT' => \App\Options\QuestionTypeOptions::EMBEDDED_CONTENT,
        'PHOTO' => \App\Options\QuestionTypeOptions::PHOTO,
        'MISSING_WORD' => \App\Options\QuestionTypeOptions::MISSING_WORD
    ]) !!};
    </script>
</head>
<body>
<div id="sz-play-app">
    <game-results-modal ref="resultsModal" v-bind:game="game" v-bind:base-url="baseUrl"></game-results-modal>
</div>

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
<script src="{{ elixir('js/stopped.js') }}"></script>
@include('services.analytics')
@include('services.userreport')

</body>
</html>
