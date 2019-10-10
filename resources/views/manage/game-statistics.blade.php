@extends('layouts.app')

@section('header-styles')
    <style>
        .box {
            position: relative;
            padding: 15px;
            border: 1px solid #ccc;
            margin-top: 15px;
            display: block;
        }
        a.box {
            color: #000;
            text-decoration: none;
        }
        a.box:hover {
            color: #000;
        }
        .box-bg {
            background-color: #EEE;
        }
        a.box .mdi-chevron-down.mdi-absolute {
            position: absolute;
            right: 15px;
            top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('pages.manage.statistics.heading') }}
            </div>

            <div class="panel-body">
                <div>
                    <a href="{{ route('manage.statistics.export', [
                        'game' => $game->id
                    ]) }}" class="btn btn-primary" target="_blank">
                        {{ trans('pages.manage.statistics.download-csv') }}
                    </a>
                </div>
                <div>
                    <p>
                        <a class="box box-bg" data-toggle="collapse" href="#game" role="button" aria-expanded="false">
                            <pan class="h2">{{ $game->activity->title }}</pan>
                            <i class="mdi mdi-chevron-down h2"></i>
                            <br>
                            {{ trans('pages.manage.game.exercises-and-points', [
                                'exercises' => $countExercises,
                                'points' => $totalPoints
                            ]) }}
                        </a>
                    </p>
                    <div>
                        <div class="collapse" id="game">
                            {{ $game->activity->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection