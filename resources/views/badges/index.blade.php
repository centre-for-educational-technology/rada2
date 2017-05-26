@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('navbar.badges') }}
                </div>

                <div class="panel-body">
                    @if ( count($badges) > 0 )
                        @foreach($badges as $badge)
                            <div class="media" id="{{ $badge->type }}">
                                <div class="media-left">
                                    <a href="{!! $badge->getCriteriaUrl() !!}">
                                        <img class="media-object" src="{{ $badge->getImageUrl() }}" alt="image" style="width:125px;height:125px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        {{ $badge->name }}
                                    </h4>
                                    <p>{{$badge->description}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
