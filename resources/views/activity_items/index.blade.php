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
                    @endif

                    @foreach($activity_items as $activity_item)
                        <div class="media">
                            <div class="media-left">
                                <a href="{!! route('activity_item.show', [ 'id' => $activity_item->id ]) !!}">
                                    <img class="media-object img-rounded" src="{{ asset('img/logos/logo-square.png') }}" alt="featured-image" style="width:64px;height:64px;">
                                </a>
                            </div>
                            <div class="media-body">
                                @if(Auth::check())
                                    <div class="pull-right">
                                        @can('update', $activity_item)
                                            <a href="{!! route('activity_item.edit', ['id' => $activity_item->id]) !!}" class="btn btn-primary btn-sm" title="{{ trans('general.actions.edit') }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $activity_item)
                                            <!-- TODO This should become a spoofed form with check for user approval -->
                                            <a href="#" class="btn btn-danger btn-sm" title="{{ trans('general.actions.delete') }}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        @endcan
                                    </div>
                                @endif
                                <h4 class="media-heading">
                                    <a href="{!! route('activity_item.show', ['id' => $activity_item->id]) !!}">
                                        {{ $activity_item->title }}
                                    </a>
                                </h4>
                                <p class="sz-display-new-lines">{{$activity_item->description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
