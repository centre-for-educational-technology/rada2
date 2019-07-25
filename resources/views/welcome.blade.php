@extends('layouts.app')

@section('footer-scripts')
    <script>
        window.RADA = <?php echo json_encode([
            'config' => [
                'base_url' => url('/'),
                'pin_length' => 5
            ]
        ]); ?>;
        window.Laravel.locale = '<?php echo App::getLocale(); ?>';
        window.Laravel.translations = <?php echo json_encode([
            'play' => trans('general.actions.play')
        ]); ?>
    </script>
    <script src="{{ elixir('js/welcome.js') }}"></script>
@endsection

@section('content')
<div class="container sz-welcome-page">
    <div class="row" id="sz-quick-play">
        <div class="col-xs-12">
            <div class="text-center">
                <open-game-by-entering-pin-code></open-game-by-entering-pin-code>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="jumbotron col-xs-12">
            <h1 class="text-center">{{ trans('pages.welcome.jumbotron.information.heading') }}</h1>
            <p class="text-center">{{ trans('pages.welcome.jumbotron.information.content') }}</p>
            <h2 class="text-center">{{ trans('pages.welcome.jumbotron.schools.heading')}}</h2>
            <p class="text-center">{!! trans('pages.welcome.jumbotron.schools.content') !!}</p>
            @if (Auth::guest())
                <p class="row">
                    <p class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3 text-center">
                        <a class="btn btn-primary btn-sm" href="{{ url('/login') }}" role="button">{{ trans('general.forms.buttons.login-or-register') }}</a>
                    </p>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
