@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="{!! route('dashboard') !!}">{{ trans('pages.dashboard.title') }}</a></li>
                @can('viewResultsIndex', 'App\Activity')
                <li role="presentation" class="active"><a href="{!! route('results') !!}">{{ trans('pages.activity-results-index.title') }}</a></li>
                @endcan
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('pages.activity-results-index.heading') }}</div>

                <div class="panel-body">
                    @if ( count($zoos) > 0 )
                        <h4>{{ trans('pages.activity-results-index.zoos') }}</h4>
                        <p>
                            @foreach($zoos as $zoo)
                                <span class="badge">{{ $zoo }}</span>
                            @endforeach
                        </p>
                    @endif

                    @if ( count($activities) === 0 )
                        <div class="well">{{ trans('pages.dashboard.none-found') }}</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ trans('general.forms.labels.title')}}</th>
                                        <th>{{ trans('general.forms.labels.zoo') }}</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                    <tr>
                                        <td>
                                            <a href="{!! route('activity.results', ['id' => $activity->id]) !!}">
                                                {{ $activity->title }}
                                            </a>
                                        </td>
                                        <td>{{ $activity::getZoo($activity->zoo) }}</td>
                                        <td>{{ $activity->games()->count() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

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
