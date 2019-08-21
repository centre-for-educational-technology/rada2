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
            'pages.grading.index.switch-label' => trans('pages.grading.index.switch-label')
        ]) !!};
        window.Laravel.answers = {!! json_encode($answers) !!};
        window.Laravel.questionTypes = {!! json_encode($questionTypes) !!}
    </script>
    <script src="{{ elixir('js/grading.js') }}"></script>
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
