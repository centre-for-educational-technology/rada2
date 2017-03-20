@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-10">
                            {{ trans('pages.activity-items.index.heading') }}
                        </div>

                        <div class="col-xs-2">
                            @can('create', 'App\ActivityItem')
                                <a href="{!! route('activity_item.create') !!}" class="btn btn-primary pull-right" title="{{ trans('general.actions.create') }}">
                                    <i class="mdi mdi-plus" aria-hidden="true"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @if ( count($activity_items) === 0 )
                        <div class="well">{{ trans('pages.activity-items.index.none-found') }}</div>
                    @else
                        @foreach($activity_items as $activity_item)
                            <div class="media">
                                <div class="media-left">
                                    <a href="{!! route('activity_item.show', [ 'id' => $activity_item->id ]) !!}">
                                        <img class="media-object img-rounded sz-img-64x64" src="{{ asset('img/logos/logo-square.png') }}" alt="featured-image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{!! route('activity_item.show', ['id' => $activity_item->id]) !!}">
                                            {{ $activity_item->title }}
                                        </a>
                                    </h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            @include('includes.author', ['author' => $activity_item->user, 'date' => $activity_item->created_at])
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            @include('activity_items.includes.actions')
                                        </div>
                                    </div>
                                    <p class="sz-display-new-lines">{{$activity_item->description}}</p>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-account-circle" aria-hidden="true"></i>
                                        {{ $activity_item->user->name }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-crosshairs" aria-hidden="true"></i>
                                        {{ $activity_item::getQuestionType($activity_item->type) }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                                        {{ Activity::getZoo($activity_item->zoo) }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                                        {{ trans('general.languages.' . $activity_item->language) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center">
                            {{ $activity_items->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
