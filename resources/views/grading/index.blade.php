@extends('layouts.app')

@section('footer-scripts')
    <script>
        window.RADA = {!! json_encode([
            'config' => [
                'base_url' => url('/')
            ]
        ]) !!};
        window.Laravel.locale = '{{ App::getLocale() }}';
        window.Laravel.translations = {!! json_encode([
            'pages.grading.index.heading' => trans('pages.grading.index.heading'),
            'pages.grading.index.none-found' => trans('pages.grading.index.none-found'),
            'pages.grading.index.graded' => trans('pages.grading.index.graded'),
            'pages.grading.index.switch-label' => trans('pages.grading.index.switch-label'),
            'pages.grading.index.grading-info' => trans('pages.grading.index.grading-info'),
            'pages.grading.index.go-back-to-list' => trans('pages.grading.index.go-back-to-list'),
            'pages.grading.index.submit-grade' => trans('pages.grading.index.submit-grade'),
            'pages.grading.index.heading-answer' => trans('pages.grading.index.heading-answer'),
            'pages.grading.index.answer_table.option' => trans('pages.grading.index.answer_table.option'),
            'pages.grading.index.answer_table.correct' => trans('pages.grading.index.answer_table.correct'),
            'pages.grading.index.answer_table.answer' => trans('pages.grading.index.answer_table.answer'),
            'pages.grading.index.answer_table.points' => trans('pages.grading.index.answer_table.points'),
            'pages.grading.index.answer_table.image' => trans('pages.grading.index.answer_table.image'),
            'pages.grading.index.heading-grade' => trans('pages.grading.index.heading-grade'),
            'pages.grading.index.heading-question-information' => trans('pages.grading.index.heading-question-information'),
            'pages.grading.index.heading-previous-grades' => trans('pages.grading.index.heading-previous-grades'),
            'pages.grading.index.details-btn' => trans('pages.grading.index.details-btn'),
            'pages.grading.index.question-type' => trans('pages.grading.index.question-type')
        ]) !!};
        window.Laravel.answers = {!! json_encode($answers) !!};
        window.Laravel.questionTypes = {!! json_encode($questionTypes) !!};
        window.Laravel.viewType = '{{ $viewType }}';
        window.Laravel.currentAnswerId = {{ $currentAnswerId }};
        window.Laravel.currentPage = {{ $currentPage }};
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
    <script src="{{ asset(mix('js/grading.js')) }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="grading-list-container">
            <grading-list :answers="answers"></grading-list>
        </div>
    </div>
</div>
@endsection
