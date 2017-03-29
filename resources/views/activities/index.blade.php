@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-10">
                            {{ trans('pages.activities.index.heading') }}
                        </div>

                        <div class="col-xs-2">
                            @can('create', 'App\Activity')
                                <a href="{!! route('activity.create') !!}" class="btn btn-primary pull-right" title="{{ trans('general.actions.create') }}">
                                    <i class="mdi mdi-plus" aria-hidden="true"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="panel-body">
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
