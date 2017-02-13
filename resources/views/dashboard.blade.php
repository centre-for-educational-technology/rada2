@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('pages.dashboard.heading', [ 'name' => Auth::user()->name ]) }}</div>

                <div class="panel-body">
                    <h4>{{ trans('pages.dashboard.games-and-activities') }}</h4>
                    @if ( count($games) === 0 )
                        <div class="well">{{ trans('pages.dashboard.none-found') }}</div>
                    @endif

                    @foreach($games as $game)
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{ $game->activity->title }}</strong>
                            </div>
                            <div class="col-xs-4">
                                @if ( $game->isComplete() )
                                    {{ trans('pages.dashboard.finished', [ 'date' => date(trans('general.date-time.formats.short'), strtotime($game->updated_at)) ])}}
                                @else
                                    {{ trans('pages.dashboard.started', [ 'date' => date(trans('general.date-time.formats.short'), strtotime($game->created_at)) ])}}
                                @endif
                            </div>
                            <div class="col-xs-2">
                                @if ( $game->isComplete() )
                                    <a href="{!! route('game.play', ['id' => $game->id]) !!}" class="btn btn-success btn-sm">{{ trans('pages.dashboard.btn.play-again' )}}</a>
                                @else
                                    <a href="{!! route('game.play', ['id' => $game->id]) !!}" class="btn btn-success btn-sm">{{ trans('pages.dashboard.btn.continue' )}}</a>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-12">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-{{ $game->complete ? 'success' : 'info' }}" style="min-width: 2em; width: {{ $game->getCompletionPercentage() }}%;">
                                        <span class="sr-only">{{ $game->getCompletionPercentage() }}</span>
                                        {{ $game->getCompletionPercentage() }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <h4>{{ trans('pages.dashboard.market-and-card-trading' )}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
