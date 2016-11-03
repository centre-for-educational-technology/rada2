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
                            @if(Auth::user()->can('create', 'App\Activity'))
                                <a href="{!! route('activity.create') !!}" class="btn btn-primary pull-right">
                                    <i class="mdi mdi-plus" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @foreach($activities as $activity)
                        <div class="media">
                            <div class="media-left">
                                <a href="{!! route('activity.show', [ 'id' => $activity->id ]) !!}">
                                    <img class="media-object img-rounded" src="{{ $activity->getFeaturedImageUrl() }}" alt="featured-image" style="width:64px;height:64px;">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{!! route('activity.show', ['id' => $activity->id]) !!}">
                                        {{ $activity->title }}
                                    </a>
                                </h4>
                                <p>{{$activity->description}}</p>
                                @if(Auth::check())
                                    <div class="pull-right">
                                        @can('update', $activity)
                                            <a href="{!! route('activity.edit', ['id' => $activity->id]) !!}" class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $activity)
                                            <!-- TODO This should become a spoofed form with check for user approval -->
                                            <a href="#" class="btn btn-danger btn-sm">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        @endcan
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
