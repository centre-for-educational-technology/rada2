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
                                    @include('activities.actions')
                                    <h4 class="media-heading">
                                        <a href="{!! route('activity.show', ['id' => $activity->id]) !!}">
                                            {{ $activity->title }}
                                        </a>
                                    </h4>
                                    <div>
                                        <i class="mdi mdi-crosshairs" aria-hidden="true"></i>
                                        <strong>{{ $activity::getActivityType($activity->type) }}</strong>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-hexagon-multiple" aria-hidden="true"></i>
                                        <strong>{{ $activity->difficulty_level_start }} - {{ $activity->difficulty_level_end }}</strong>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                                        <strong>{{ $activity->playing_time}} {{ trans('general.minutes')}}</strong>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                                        <strong>{{ trans('general.languages.' . $activity->language) }}</strong>
                                    </div>
                                    @if( $activity->contact_information )
                                    <div>
                                        <i class="mdi mdi-contact-mail" aria-hidden="true"></i>
                                        <strong>{{ $activity->contact_information }}</strong>
                                    </div>
                                    @endif
                                    <div>
                                        <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                                        <strong>{{ $activity::getZoo($activity->zoo) }}</strong>
                                    </div>
                                    <p class="sz-display-new-lines">{{$activity->description}}</p>
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
