@extends('layouts.app')

@section('header-styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/css/ion.rangeSlider.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/css/ion.rangeSlider.skinFlat.min.css" rel="stylesheet">
@endsection

@section('footer-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/js/ion.rangeSlider.min.js"></script>
<script>
    $(document).ready(function() {
        $('#difficulty-level').ionRangeSlider({});
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-10 col-md-8">
                            {{ trans('pages.activities.index.heading') }}
                        </div>

                        <div class="col-xs-2 col-md-4">
                            <div class="pull-right">
                                @can('create', 'App\Activity')
                                    <a href="{!! route('activity.create') !!}" class="btn btn-primary" title="{{ trans('general.actions.create') }}">
                                        <i class="mdi mdi-plus" aria-hidden="true"></i>
                                    </a>
                                @endcan
                                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#search-form" aria-expanded="false" aria-controls="search-form" title="{{ trans('general.forms.buttons.search') }}">
                                    <i class="mdi mdi-search-web" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('activities.includes.search')

                </div>

                <div class="panel-body" id="search-results">
                    @if ( count($activities) === 0 )
                        <div class="well">{{ trans('pages.activities.index.none-found') }}</div>
                    @else
                        @foreach($activities as $activity)
                            <div class="media">
                                <div class="media-left">
                                    <a href="{!! route('activity.show', [ 'id' => $activity->id ]) !!}">
                                        <img class="media-object img-rounded sz-img-64x64" src="{{ $activity->getFeaturedImageUrl() }}" alt="featured-image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{!! route('activity.show', ['id' => $activity->id]) !!}">
                                            {{ $activity->title }}
                                        </a>
                                    </h4>
                                    @include('activities.includes.game-status', ['activity' => $activity])
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            @include('includes.author', ['author' => $activity->user, 'date' => $activity->created_at])
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            @include('activities.includes.actions')
                                        </div>
                                    </div>
                                    <p class="sz-display-new-lines">{{$activity->description}}</p>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-crosshairs" aria-hidden="true"></i>
                                        {{ $activity->getActivityType() }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-hexagon-multiple" aria-hidden="true"></i>
                                        {{ $activity->difficulty_level_start }} - {{ $activity->difficulty_level_end }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                                        {{ $activity->playing_time}} {{ trans('general.minutes')}}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                                        {{ $activity->getLanguage() }}
                                    </div>
                                    @if( $activity->contact_information )
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-contact-mail" aria-hidden="true"></i>
                                        {{ $activity->contact_information }}
                                    </div>
                                    @endif
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                                        {{ $activity->getZoo() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center">
                            {{ $activities->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
