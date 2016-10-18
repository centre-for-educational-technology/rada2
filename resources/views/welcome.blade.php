@extends('layouts.app')

@section('content')
<div class="container">
    <div id="sz-landing-carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#sz-landing-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#sz-landing-carousel" data-slide-to="1"></li>
            <li data-target="#sz-landing-carousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ asset('img/logo.png') }}" alt="slide">
                <div class="carousel-caption">
                    <h3>First slide label</h3>
                    <p>...</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('img/logo.png') }}" alt="slide">
                <div class="carousel-caption">
                    <h3>Second slide label</h3>
                    <p>...</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('img/logo.png') }}" alt="slide">
                <div class="carousel-caption">
                    <h3>Third slide label</h3>
                    <p>...</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#sz-landing-carousel" role="button" data-slide="prev">
            <i class="glyphicon mdi mdi-chevron-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#sz-landing-carousel" role="button" data-slide="next">
            <i class="glyphicon mdi mdi-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- 16:9 aspect ratio -->
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mXLSDd6AkPo?controls=0&showinfo=0" allowfullscreen></iframe>
    </div>


    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img src="{{ asset('img/logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img src="{{ asset('img/logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img src="{{ asset('img/logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img src="{{ asset('img/logo.png') }}" alt="logo">
            </a>
        </div>
    </div>
</div>
@endsection
