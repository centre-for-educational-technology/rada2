@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('includes.dashboard_nav', [ 'activeTab' => 'results', ])
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('pages.activity-results-index.heading') }}</div>

                <div class="panel-body">
                    @if ( count($activities) === 0 )
                        <div class="well">{{ trans('pages.dashboard.none-found') }}</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ trans('general.forms.labels.title')}}</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                    <tr>
                                        <td>
                                            <a href="{!! route('activity.results', ['activity' => $activity->id]) !!}">
                                                {{ $activity->title }}
                                            </a>
                                        </td>
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
