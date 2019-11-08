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
        .box-bg-white {
            background-color: #fff;
        }
        .question-container {
            position: relative;
            padding: 15px;
            display: block;
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

        select.form-control {
            display: inline;
            width: auto;
            margin: 0 10px;
        }

        .mdi-check-circle-outline::before,
        .mdi-checkbox-blank-circle-outline::before,
        .mdi-trophy-award::before,
        .mdi-check::before,
        .mdi-close::before {
            font-size: 14px !important;
        }
        .mdi-flash::before,
        .mdi-crosshairs::before,
        .mdi-timer-sand::before {
            font-size: 16px !important;
        }

        img {
            width: 100%;
            height: auto;
        }

        #map {
            height: 500px;
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
                                        <th colspan="2">
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
                                    <td>
                                        <a href="#"
                                           class="mdi mdi-google-maps pull-right mdi-18px open-player-map"
                                           title="{{ trans('pages.manage.game.exercise-summary.map-title') }}"
                                           data-game-id="{{ $player->game_id }}"
                                        ></a>
                                    </td>
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

                    <!-- Tasks summary segment -->

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
                                                    <i class="mdi mdi-crosshairs" title="{{ trans('pages.manage.game.exercise-summary.type-title') }}"></i>
                                                    {{ $gameOptions[$exercise->exercise_type] }}
                                                </span>
                                                @if($exercise->is_flash == 1)
                                                <i class="mdi mdi-flash" title="{{ trans('pages.manage.game.exercise-summary.flash-title') }}"></i>
                                                @endif
                                                @if($exercise->time_limit == 1)
                                                <i class="mdi mdi-timer-sand" title="{{ trans('pages.manage.game.exercise-summary.time-title') }}"></i>
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

                    <!-- Tasks segment -->

                    <p>
                        <a class="box box-bg"
                           data-toggle="collapse"
                           href="#tasks"
                           role="button"
                           aria-expanded="false">
                            <span class="h2">{{ trans('pages.manage.game.tasks.title') }}</span>
                            <i class="mdi @if($segmentType == 'tasks') mdi-chevron-up @else mdi-chevron-down @endif h2"></i>
                        </a>
                    </p>
                    <div>
                        <div class="collapse @if($segmentType == 'tasks') in @endif" id="tasks">
                            <div class="filter-container">
                                <span>{{ trans('pages.manage.game.tasks.filter') }}</span>
                                <select id="players-select" class="form-control">
                                    <option value="">{{ trans('pages.manage.game.tasks.select-all-players') }}</option>
                                    @foreach($players as $player)
                                        @php
                                            $selected = '';
                                            if ($currentPlayer && $currentPlayer === $player->game_id) {
                                                $selected = 'selected="selected"';
                                            }
                                        @endphp
                                        <option value="{{ $player->game_id }}" <?= $selected ?> >{{ $player->user_name }}</option>
                                    @endforeach
                                </select>
                                <select id="task-select" class="form-control">
                                    <option value="">{{ trans('pages.manage.game.tasks.select-all-tasks') }}</option>
                                    @foreach($exercises as $exercise)
                                        @php
                                            $selected = '';
                                            if ($currentTask && (int) $currentTask === $exercise->id) {
                                                $selected = 'selected="selected"';
                                            }
                                        @endphp
                                        <option value="{{ $exercise->id }}" <?= $selected ?> >{{ $exercise->exercise }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="exercises-container">
                                @foreach($exercises as $exercise)
                                    <div class="exercise" id="exercise-{{ $exercise->id }}">
                                        <p>
                                            <a class="box box-bg"
                                               data-toggle="collapse"
                                               href="#tasks-{{ $exercise->id }}"
                                               role="button"
                                               aria-expanded="false">
                                                <span class="h2">{{ $exercise->exercise }}</span>
                                                <i class="mdi mdi-chevron-down h2"></i>
                                                <br/>
                                                <span>{{ \App\ActivityItem::getMaxPoints($exercise->points) }} {{ trans('pages.manage.game.tasks.points') }}</span>
                                            </a>
                                        </p>
                                        <div>
                                            <div class="collapse" id="tasks-{{ $exercise->id }}">

                                                <div class="question-container">
                                                    <span class="sz-metadata">
                                                        <i class="mdi mdi-crosshairs" title="{{ trans('pages.manage.game.exercise-summary.type-title') }}"></i>
                                                        {{ $gameOptions[$exercise->exercise_type] }}
                                                    </span>
                                                    <br />
                                                    <div>{{ $exercise->question }}</div>

                                                    @if($exercise->question_image)
                                                        <img src="/uploads/images/activity_items/{{ $exercise->id }}/{{ $exercise->question_image }}" />
                                                    @endif

                                                    @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::ONE_CORRECT_ANSWER ||
                                                    $exercise->exercise_type == \App\Options\QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS )
                                                        <table class="table table-bordered">
                                                            @php
                                                            $questions = \App\Repository\GameRepository::getQuestionsForGameStatistics($game, $exercise->id);
                                                            $points = json_decode($exercise->points, true);
                                                            @endphp
                                                            @foreach($questions as $question)
                                                                <tr>
                                                                    <td>{{ $question->option }}</td>
                                                                    <td>
                                                                        @if($question->correct == 1 && $points !== null && count($points) > 0)
                                                                            {{ array_shift($points) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($question->correct == 1)
                                                                            <i class="mdi mdi-check"></i>
                                                                        @else
                                                                            <i class="mdi mdi-close"></i>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    @endif

                                                    @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::MATCH_PAIRS)
                                                        <table class="table table-bordered">
                                                        @php
                                                        $pairs = \App\Repository\GameRepository::getMatchPairsForGameStatistics($game, $exercise->id);
                                                        $points = json_decode($exercise->points, true);
                                                        @endphp
                                                        @foreach($pairs as $pair)
                                                            <tr>
                                                                <td>{{ $pair->option }}</td>
                                                                <td>
                                                                    @if($pair->image)
                                                                        <img src="{{ '/uploads/images/activity_items/' . $exercise->id . '/' . $pair->image }}" />
                                                                    @endif
                                                                </td>
                                                                <td>{{ $pair->option_match }}</td>
                                                                <td>
                                                                    @if($pair->image_match)
                                                                        <img src="{{ '/uploads/images/activity_items/' . $exercise->id . '/' . $pair->image_match }}" />
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ array_shift($points) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </table>
                                                    @endif

                                                    @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::MISSING_WORD)
                                                        <div>{!! \App\ActivityItem::getMissingWordText($exercise->missing_word) !!}</div>
                                                    @endif

                                                    @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::EMBEDDED_CONTENT)
                                                        <div>{{ $exercise->embedded_content }}</div>
                                                    @endif

                                                </div>

                                                <div class="answer-container">
                                                    @php
                                                    $gameDataArray = \App\Repository\GameRepository::getGameDataForGameStatisticsByActivityItemId($game, $exercise->id)
                                                    @endphp
                                                    @foreach($gameDataArray as $gameData)
                                                        <div class="box box-bg answer-item game-{{ $gameData->game_id }}">
                                                            <div>{{ trans('pages.manage.game.tasks.answer-from') }} {{ $gameData->user_name }}</div>
                                                            <div>{{ $gameData->answer_time }}</div>
                                                            <div>
                                                                @if($gameData->grade !== null)
                                                                    <i class="mdi mdi-check-circle-outline"></i>
                                                                    {{ trans('pages.manage.game.tasks.graded') }}
                                                                @else
                                                                    <i class="mdi mdi-checkbox-blank-circle-outline"></i>
                                                                    {{ trans('pages.manage.game.tasks.not-graded') }}
                                                                @endif

                                                                <i class="mdi mdi-trophy-award"></i>
                                                                {{ trans('pages.manage.game.tasks.points') }}:
                                                                {{ $gameData->grade ?? 0 }}/{{ \App\ActivityItem::getMaxPoints($exercise->points) }}
                                                            </div>

                                                            <div class="box box-bg-white">
                                                                <span class="sz-metadata">
                                                                    <i class="mdi mdi-crosshairs" title="{{ trans('pages.manage.game.exercise-summary.type-title') }}"></i>
                                                                    {{ $gameOptions[$exercise->exercise_type] }}
                                                                </span>
                                                                <br />
                                                                @if($gameData->answer_image)
                                                                    <img src="/uploads/images/activities/{{ $exercise->activity_id }}/{{ $gameData->game_id }}/{{ $gameData->answer_image }}" />
                                                                @endif

                                                                @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::ONE_CORRECT_ANSWER ||
                                                            $exercise->exercise_type == \App\Options\QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS )
                                                                    <table class="table table-bordered">
                                                                        @php
                                                                            $questions = \App\Repository\GameRepository::getQuestionsForGameStatistics($game, $exercise->id);
                                                                            $points = json_decode($exercise->points, true);
                                                                            $answerOptionsData = json_decode($gameData->answer, true);
                                                                            $answerOptions = $answerOptionsData['options'] ?? [];
                                                                        @endphp
                                                                        @foreach($questions as $question)
                                                                            <tr>
                                                                                <td>{{ $question->option }}</td>
                                                                                <td>
                                                                                    @if($question->correct == 1 && in_array($question->id, $answerOptions))
                                                                                        {{ array_shift($points) }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if($question->correct == 1 && in_array($question->id, $answerOptions))
                                                                                        <i class="mdi mdi-check"></i>
                                                                                    @else
                                                                                        <i class="mdi mdi-close"></i>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                @endif

                                                                @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::MATCH_PAIRS)
                                                                    <table class="table table-bordered">
                                                                        @php
                                                                            $pairs = \App\Repository\GameRepository::getMatchPairsForGameStatistics($game, $exercise->id);
                                                                            $points = json_decode($exercise->points, true);
                                                                        @endphp
                                                                        @foreach($pairs as $pair)
                                                                            <tr>
                                                                                <td>{{ $pair->option }}</td>
                                                                                <td>
                                                                                    @if($pair->image)
                                                                                        <img src="{{ '/uploads/images/activity_items/' . $exercise->id . '/' . $pair->image }}" />
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $pair->option_match }}</td>
                                                                                <td>
                                                                                    @if($pair->image_match)
                                                                                        <img src="{{ '/uploads/images/activity_items/' . $exercise->id . '/' . $pair->image_match }}" />
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    {{ array_shift($points) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                @endif

                                                                @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::MISSING_WORD)
                                                                    @php
                                                                    $missingWordData = json_decode($gameData->answer, true);
                                                                    $missingWord = $missingWordData['text'] ?? '';
                                                                    @endphp
                                                                    <div>{!! \App\ActivityItem::getMissingWordText($missingWord, $exercise->missing_word) !!}</div>
                                                                @endif

                                                                @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::FREEFORM_ANSWER)
                                                                    @php
                                                                        $data = json_decode($gameData->answer, true);
                                                                        $text = $data['text'] ?? '';
                                                                    @endphp
                                                                    <div>{{ $text }}</div>
                                                                @endif

                                                                @if($exercise->exercise_type == \App\Options\QuestionTypeOptions::EMBEDDED_CONTENT)
                                                                    @php
                                                                        $data = json_decode($gameData->answer, true);
                                                                        $text = $data['text'] ?? '';
                                                                    @endphp
                                                                    <div>{!! $text !!}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>


    <div ref="modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-player-map" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
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

        function onTasksFilter() {
            var $answerItem =  $('.answer-item');
            var gameId = $('#players-select').val();
            var taskId = $('#task-select').val();
            var hideGames = gameId.length > 0;
            var hideTasks = taskId.length > 0;

            $answerItem.removeClass('hidden');
            if (hideGames) {
                $answerItem.addClass('hidden');
                $('.game-' + gameId).removeClass('hidden');
            }

            $('.exercise').each(function () {

                $(this).removeClass('hidden');
                var found = false;
                if (hideTasks) {
                    $(this).addClass('hidden');
                    if ($(this).attr('id') === 'exercise-' + taskId) {
                        $(this).find('.answer-container .answer-item').each(function () {
                            if ($(this).hasClass('hidden') === false) {
                                found = true;
                            }
                        });
                        if (found === true) {
                            $(this).removeClass('hidden');
                        }
                    }
                } else {
                    $(this).find('.answer-container .answer-item').each(function () {
                        if ($(this).hasClass('hidden') === false) {
                            found = true;
                        }
                    });
                    if (found === false) {
                        $(this).addClass('hidden');
                    }
                }

            });
        }

        $('#task-select').on('change', function () {
            onTasksFilter();
        });

        $('#players-select').on('change', function () {
            onTasksFilter();
        });

        onTasksFilter();

        var map;
        var markers = [];
        var lines = [];
        var bestMarkers = [];
        var infoWindow = null;

        $('.open-player-map').on('click', function () {
            resetMapData();
            $('.modal').modal('show');
            getPlayerPositions($(this).data('game-id'));
        });
        $('.close-player-map').on('click', function () {
            $('.modal').modal('hide');
            resetMapData();
        });

        function resetMapData() {
            for(var i=0; i<markers.length; i++) {
                var marker = markers[i];
                marker.setMap(null);
            }
            for(var i=0; i<lines.length; i++) {
                var line = lines[i];
                line.setMap(null);
            }
            markers = [];
            lines = [];
            bestMarkers = [];
        }

        function getPlayerPositions(gameId) {
            $.get('/api/games/' + gameId + '/get-player-positions', function(data) {
                if (typeof data.positions !== 'undefined') {
                    addMarkers({
                        answers: data.answers,
                        positions: data.positions
                    })
                }
            });
        }

        function addMarkers(data) {
            var positions = data.positions;
            var answers = data.answers;
            var positionsLength = positions.length;
            var answersLength = answers.length;
            var lastMarker = null;
            for(var i=0; i<positionsLength; i++) {
                var position = positions[i];
                var latitude = position.latitude;
                var longitude = position.longitude;
                var time = position.created_at;
                var marker = getNewMarker(time, latitude, longitude);
                markers.push(marker);
                if (lastMarker !== null) {
                    addLine(marker, lastMarker);
                }
                lastMarker = marker;

                map.setCenter(new google.maps.LatLng(
                    position.latitude,
                    position.longitude
                ));
            }
            for(var i=0; i<answersLength; i++) {
                var answer = answers[i];
                var time = answer.updated_at;
                var id = answer.id;
                var title = answer.title;
                var answerDate = new Date(time);
                var currDiff = 0;
                var bestDiff = 10000000;
                var bestDate = new Date(0,0,0);
                var bestMarkerIndex = 0;
                for(var j=0; j<positionsLength; j++) {
                    var position = positions[j];
                    var time = position.created_at;
                    var date = new Date(time);
                    currDiff = Math.abs(answerDate - date);
                    if (currDiff < bestDiff) {
                        bestDiff = currDiff;
                        bestDate = date;
                        bestMarkerIndex = j;
                    }
                }
                if (bestMarkers.filter(marker => {
                    return marker.infoWindowData.filter(data => {
                        return data.date.getTime() === bestDate.getTime();
                    }).length > 0;
                }).length <= 0) {
                    var bestMarker = markers[bestMarkerIndex];
                    bestMarker.setIcon({
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: 'yellow',
                        fillOpacity: 1.0,
                        scale: 4.5,
                        strokeColor: 'yellow',
                        strokeWeight: 0.5
                    });
                    bestMarker.infoWindowData = [
                        {
                            date: bestDate,
                            title: title
                        }
                    ];
                    bestMarkers.push(bestMarker);

                    bestMarker.addListener('click', function() {
                        openNewInfoWindow(this);
                    });
                } else {
                    bestMarker.infoWindowData.push({
                        date: bestDate,
                        title: title
                    });
                }
            }
        }

        function closeInfoWindow() {
            if ( infoWindow && infoWindow.getMap() ) {
                infoWindow.close();
            }
        }

        function openNewInfoWindow(marker) {
            this.closeInfoWindow();
            var content = '';
            var data = marker.infoWindowData;
            var dataLength = data.length;
            for(var i=0; i<dataLength; i++) {
                var date = data[i].date;
                var formatted_date = date.getFullYear() + "-" +
                    (date.getMonth() + 1) + "-" +
                    date.getDate() + " " +
                    date.getHours() + ":" +
                    date.getMinutes() + ":" +
                    date.getSeconds();
                content += '{{ trans('pages.manage.game.player-summary.answered') }} "' +
                    data[i].title +
                    '" {{ trans('pages.manage.game.player-summary.at') }} ' +
                    formatted_date +
                    "\n<br />";
                infoWindow.setContent(content);
            }
            infoWindow.open(map, marker);

            return true;
        }

        function addLine(marker, lastMarker) {
            var line = new google.maps.Polyline({
                path: [
                    lastMarker.getPosition(),
                    marker.getPosition()
                ],
                strokeColor: 'red',
                strokeWeight: 2,
                strokeOpacity: 0.4,
                icons: [{
                    icon: {
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                        fillColor: 'red',
                        strokeColor: 'red',
                        fillOpacity: 1.0,
                        strokeOpacity: 1.0,
                        scale: 4
                    },
                    offset: '50px',
                }],
                geodesic: true,
                map: map,
                zIndex: 2
            });
            lines.push(line);
        }

        function getNewMarker(title, latitude, longitude) {
            var marker = new google.maps.Marker({
                title: title,
                position: {
                    lat: Number(latitude),
                    lng: Number(longitude)
                },
                map: map,
                animation: google.maps.Animation.DROP
            });

            marker.setIcon({
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: 'red',
                fillOpacity: 1.0,
                scale: 0.5,
                strokeColor: 'red',
                strokeWeight: 0.5
            });

            return marker;
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });

            infoWindow = new google.maps.InfoWindow({
                disableAutoPan: true
            });
        }

    </script>

    <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&callback=initMap"
            async defer
    ></script>
@endsection