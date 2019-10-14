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

        #players .mdi-chevron-down, #players .mdi-chevron-up {
            line-height: 12px;
            height: 12px;
            vertical-align: middle;
        }
        #players a {
            color: #636b6f;
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

                    <!-- GAME DATA -->

                    <p>
                        <a class="box box-bg"
                           data-toggle="collapse"
                           href="#game"
                           role="button"
                           aria-expanded="false">
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

                    <!-- Player summary segment -->

                    <p>
                        <a class="box box-bg"
                           data-toggle="collapse"
                           href="#players"
                           role="button"
                           aria-expanded="false">
                            <span class="h2">{{ trans('pages.manage.game.player-summary.title') }}</span>
                            <i class="mdi mdi-chevron-down h2"></i>
                        </a>
                    </p>
                    <div>
                        <div class="collapse" id="players">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ trans('pages.manage.game.player-summary.place') }}
                                        </th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'game' => $game->id,
                                                'playersSortOrder' => 2,
                                                'playersSortOrderDir' => $playersSortOrder == 2 && $playersSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.player-summary.player') }}
                                                @if($playersSortOrder == 2)
                                                    @if($playersSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'game' => $game->id,
                                                'playersSortOrder' => 1,
                                                'playersSortOrderDir' => $playersSortOrder == 1 && $playersSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.player-summary.points') }}
                                                @if($playersSortOrder == 1)
                                                    @if($playersSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'game' => $game->id,
                                                'playersSortOrder' => 3,
                                                'playersSortOrderDir' => $playersSortOrder == 3 && $playersSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.player-summary.time') }}
                                                @if($playersSortOrder == 3)
                                                    @if($playersSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="text-center" colspan="3">
                                            {{ trans('pages.manage.game.player-summary.nr-exercises') }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'game' => $game->id,
                                                'playersSortOrder' => 4,
                                                'playersSortOrderDir' => $playersSortOrder == 4 && $playersSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.player-summary.answered') }}
                                                @if($playersSortOrder == 4)
                                                    @if($playersSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'game' => $game->id,
                                                'playersSortOrder' => 5,
                                                'playersSortOrderDir' => $playersSortOrder == 5 && $playersSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.player-summary.graded') }}
                                                @if($playersSortOrder == 5)
                                                    @if($playersSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'game' => $game->id,
                                                'playersSortOrder' => 6,
                                                'playersSortOrderDir' => $playersSortOrder == 6 && $playersSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.player-summary.not-graded') }}
                                                @if($playersSortOrder == 6)
                                                    @if($playersSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                            @foreach ($players as $index => $player)
                                <tr>
                                    <td>{{ ($index + 1) }}</td>
                                    <td>{{ $player->user_name }}</td>
                                    <td>{{ $player->points }}</td>
                                    <td>{{ $player->time }}</td>
                                    <td>{{ $player->count_answers }}/{{ $player->count_questions }}</td>
                                    <td>{{ $player->graded }}</td>
                                    <td>{{ $player->not_graded }}</td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        $('.box .mdi-chevron-down').each(function () {
            var $box = $(this).closest('a').on('click', function () {
                var $mdi = $(this).find('.mdi');
                if ($mdi.hasClass('mdi-chevron-down')) {
                    $mdi.removeClass('mdi-chevron-down');
                    $mdi.addClass('mdi-chevron-up');
                } else {
                    $mdi.addClass('mdi-chevron-down');
                    $mdi.removeClass('mdi-chevron-up');
                }
            });
        });
    </script>
@endsection