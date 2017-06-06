@extends('layouts.app')

@section('footer-scripts')
<script src="{{ elixir('js/welcome.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row" id="sz-quick-play">
        <div class="col-xs-12">
            <button class="btn btn-default sz-quick-play-btn">
                <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                {{ trans('pages.welcome.btn.play-smart-zoos') }}
            </button>
        </div>

        <div class="col-xs-12" style="display:none;">
            <div class="text-center">
                <h2>
                    {{ trans('pages.welcome.choose-location')}}:
                </h2>
            </div>

            @foreach ( $zooOptions as $key => $option)
                <a href="{!! route('activity.index', ['zoo' => $key]) !!}" class="btn btn-default sz-quick-play-btn sz-quick-play-zoo-btn">
                    {{ $option }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="row" style="margin-top:30px;">
        <div class="jumbotron col-xs-12">
            <h1 style="text-align:center;">{{ trans('pages.welcome.jumbotron.heading') }}</h1>
            <p style="text-align:center;">{{ trans('pages.welcome.jumbotron.content') }}</p>
            @if (Auth::guest())
                <p class="row">
                    <p class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
                        <a class="btn btn-primary btn-sm" href="{{ url('/register') }}" role="button">{{ trans('auth.register.form.btn.register') }}</a>
                        <a class="btn btn-primary btn-sm" href="{{ url('/login') }}" role="button">{{ trans('auth.login.form.btn.login') }}</a>
                    </p>
                </p>
            @endif
        </div>
    </div>

    <div class="row" style="margin-top:30px;">
        <div class="col-xs-6 col-md-3">
            <a href="http://centralbaltic.eu" class="thumbnail" target="_blank">
                <img src="{{ asset('img/logos/interreg.png') }}" alt="logo">
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="http://www.skansen.se" class="thumbnail" target="_blank">
                <img src="{{ asset('img/logos/skansen.png') }}" alt="logo">
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="http://www.korkeasaari.fi" class="thumbnail" target="_blank">
                <img src="{{ asset('img/logos/korkeasaari.jpg') }}" alt="Korkeasaari">
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="http://tallinnzoo.ee" class="thumbnail" target="_blank">
                <img src="{{ asset('img/logos/tallinn-zoo.jpg') }}" alt="logo">
            </a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs6 col-md-3">
            <h4 style="font-weight:900;">About the Project</h4>
            <ul>
                <li>List item</li>
                <li>List item</li>
                <li>
                    List item
                    <ul>
                        <li>Sub-list Item</li>
                        <li>Sub-list Item</li>
                    </ul>
                </li>
                <li>List item</li>
            </ul>
        </div>
        <div class="col-xs6 col-md-3">
            <h4 style="font-weight:900;">About the Project</h4>
            <ul>
                <li>List item</li>
                <li>List item</li>
                <li>
                    List item
                    <ul>
                        <li>Sub-list Item</li>
                        <li>Sub-list Item</li>
                    </ul>
                </li>
                <li>List item</li>
            </ul>
        </div>
        <div class="col-xs6 col-md-3">
            <h4 style="font-weight:900;">About the Project</h4>
            <ul>
                <li>List item</li>
                <li>List item</li>
                <li>
                    List item
                    <ul>
                        <li>Sub-list Item</li>
                        <li>Sub-list Item</li>
                    </ul>
                </li>
                <li>List item</li>
            </ul>
        </div>
        <div class="col-xs6 col-md-3">
            <h4 style="font-weight:900;">About the Project</h4>
            <ul>
                <li>List item</li>
                <li>List item</li>
                <li>
                    List item
                    <ul>
                        <li>Sub-list Item</li>
                        <li>Sub-list Item</li>
                    </ul>
                </li>
                <li>List item</li>
            </ul>
        </div>
    </div>
</div>
@endsection
