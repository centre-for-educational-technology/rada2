@extends('layouts.app')

@section('content')
<div class="container">
    <div id="sz-landing-carousel" class="carousel slide" data-ride="carousel" style="max-width:900px;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#sz-landing-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#sz-landing-carousel" data-slide-to="1"></li>
            <li data-target="#sz-landing-carousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ asset('img/header/img-1.jpg') }}" alt="slide" class="img-responsive center-block">
            </div>
            <div class="item">
                <img src="{{ asset('img/header/img-2.jpg') }}" alt="slide" class="img-responsive center-block">
            </div>
            <div class="item">
                <img src="{{ asset('img/header/img-3.jpg') }}" alt="slide" class="img-responsive center-block">
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#sz-landing-carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#sz-landing-carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row" style="margin-top:30px;">
        <div class="jumbotron col-md-6 col-md-offset-3">
            <h1 style="text-align:center;">{{ trans('pages.welcome.jumbotron.heading') }}</h1>
            <p style="text-align:center;">{{ trans('pages.welcome.jumbotron.content') }}</p>
            <p class="row">
                <p class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
                    <a class="btn btn-primary btn-sm" href="{{ url('/register') }}" role="button">{{ trans('auth.register.form.btn.register') }}</a>
                    <a class="btn btn-primary btn-sm" href="{{ url('/login') }}" role="button">{{ trans('auth.login.form.btn.login') }}</a>
                </p>
            </p>
        </div>
    </div>

    <!-- 16:9 aspect ratio -->
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/81C45FD4E3I?controls=0&showinfo=0" allowfullscreen></iframe>
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
