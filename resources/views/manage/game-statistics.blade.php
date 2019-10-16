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
        #players a, #exercises a {
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
                            <i class="mdi @if($segmentType == 'player') mdi-chevron-up @else mdi-chevron-down @endif h2"></i>
                        </a>
                    </p>
                    <div>
                        <div class="collapse @if($segmentType == 'player') in @endif" id="players">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ trans('pages.manage.game.player-summary.place') }}
                                        </th>
                                        <th>
                                            <a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'player',
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
                                                'segmentType' => 'player',
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
                                                'segmentType' => 'player',
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
                                                'segmentType' => 'player',
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
                                                'segmentType' => 'player',
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
                                                'segmentType' => 'player',
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

                    <!-- Player summary segment -->

                    <p>
                        <a class="box box-bg"
                           data-toggle="collapse"
                           href="#exercises"
                           role="button"
                           aria-expanded="false">
                            <span class="h2">{{ trans('pages.manage.game.exercise-summary.title') }}</span>
                            <i class="mdi @if($segmentType == 'exercise') mdi-chevron-up @else mdi-chevron-down @endif h2"></i>
                        </a>
                    </p>
                    <div>
                        <div class="collapse @if($segmentType == 'exercise') in @endif" id="exercises">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_EXERCISE,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_EXERCISE && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">
                                                {{ trans('pages.manage.game.exercise-summary.exercise') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_EXERCISE)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th class="text-center" colspan="4">{{ trans('pages.manage.game.exercise-summary.player') }}</th>
                                        <th class="text-center" colspan="4">{{ trans('pages.manage.game.exercise-summary.points') }}</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_ANSWERED,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_ANSWERED && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.answered') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_ANSWERED)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_GRADED,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_GRADED && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.graded') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_GRADED)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_NOT_GRADED,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_NOT_GRADED && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.not-graded') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_NOT_GRADED)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_TIME_SPENT,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_TIME_SPENT && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.time-spent') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_TIME_SPENT)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_TOTAL,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_TOTAL && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.total') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_TOTAL)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_AVERAGE,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_AVERAGE && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.average') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_AVERAGE)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_MIN,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_MIN && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.min') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_MIN)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                        <th><a href="{{ route('manage.game-statistics', [
                                                'segmentType' => 'exercise',
                                                'game' => $game->id,
                                                'exerciseSortOrder' => \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_MAX,
                                                'exerciseSortOrderDir' => $exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_MAX && $exerciseSortOrderDir == 'DESC' ? 'ASC' : 'DESC'
                                            ]) }}">{{ trans('pages.manage.game.exercise-summary.max') }}
                                                @if($exerciseSortOrder == \App\Http\Controllers\GameStatisticsController::E_ORDER_BY_TYPE_MAX)
                                                    @if($exerciseSortOrderDir == 'DESC')
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    @else
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    @endif
                                                @endif
                                            </a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exercises as $exercise)
                                        <tr>
                                            <td>
                                                {{ $exercise->exercise }}
                                                <br />
                                                <span class="sz-metadata">
                                                    <i class="mdi mdi-crosshairs"></i>
                                                    {{ $gameOptions[$exercise->exercise_type] }}
                                                </span>
                                                @if($exercise->is_flash == 1)
                                                <i class="mdi mdi-flash"></i>
                                                @endif
                                                @if($exercise->time_limit == 1)
                                                <i class="mdi mdi-timer-sand"></i>
                                                @endif
                                            </td>
                                            <td>{{ $exercise->answered }} / {{ $countPlayers }}</td>
                                            <td>{{ $exercise->graded }}</td>
                                            <td>{{ $exercise->not_graded }}</td>
                                            <td>{{ $exercise->time_spent }}</td>
                                            <td>{{ $exercise->total }}</td>
                                            <td>{{ $exercise->average }}</td>
                                            <td>{{ $exercise->min }}</td>
                                            <td>{{ $exercise->max }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
        $('.box .mdi-chevron-down, .box .mdi-chevron-up').each(function () {
            $(this).closest('a').on('click', function () {
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