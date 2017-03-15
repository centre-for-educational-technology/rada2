@extends('layouts.app')

@section('footer-scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
            content: function() {
                return $(this).next('.sz-popover-data').html();
            }
        });
    });
</script>
@endsection

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
                <div class="panel-heading">{{ trans('pages.activity-results.heading', [ 'title' => $activity->title ]) }}</div>

                <div class="panel-body">
                    @if ( !$activity->games )
                        <div class="well">{{ trans('pages.dashboard.none-found') }}</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover sz-table-results">
                                <thead>
                                    <tr>
                                        <th>{{ trans('auth.register.form.name') }}</th>
                                        @foreach($activity->activityItems as $item)
                                            <th class="text-center">
                                                <button class="btn badge"
                                                      title="{{ $item->title }}"
                                                      data-toggle="popover"
                                                      data-container="body"
                                                      data-placement="bottom"
                                                      data-html="true"
                                                      data-trigger="focus hover">
                                                      {{ $loop->iteration }}
                                                  </button>
                                                <span class="sz-popover-data" style="display:none;">
                                                    <p class="sz-display-new-lines">{{ $item->description }}</p>
                                                    @if ( $item->isOneCorrectAnswer() || $item->isMultipleCorrectAnswers() )
                                                        <ul class="list-group">
                                                            @foreach( $item->options as $option )
                                                                <li class="list-group-item {{ (bool)$option->correct ? 'list-group-item-success' : 'list-group-item-danger' }}">
                                                                    {{ $option->id }}
                                                                    @if ( $option->image )
                                                                        @php ( $imageUrl = $option->getImageUrl() )
                                                                        &nbsp;
                                                                        <a href="{{ $imageUrl }}" target="blank">
                                                                            <img src="{{ $imageUrl }}" alt="option-image" style="max-height:24px;max-width:24px;">
                                                                        </a>
                                                                    @endif
                                                                    &nbsp;
                                                                    {{ $option->option }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </span>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activity->games as $game)
                                    <tr>
                                        <td class="text-center {{ !$game->complete ? 'warning' : '' }}">
                                        @if( $game->user )
                                            {{ $game->user->name }}
                                        @else
                                            <i class="mdi mdi-incognito" aria-hidden="true"></i>
                                        @endif
                                        </td>
                                        @foreach($activity->activityItems as $item)
                                            @php( $hasAnswer = $game->hasAnswerTo($item->id) )
                                            @php ( $answer = $game->getAnswerTo($item->id) )
                                            <td class=" text-center {{ $hasAnswer ? ( ( $answer && $answer->correct) ? 'success' : 'danger' ) : '' }}">
                                                @if ( $hasAnswer )
                                                    @php ( $answerData = json_decode($answer->answer) )
                                                    @if ( isset($answerData) && isset($answerData->text) )
                                                        <button class="btn btn-sm badge"
                                                        aria-hidden="true"
                                                        data-content="{{ '<p class="sz-display-new-lines">' . $answerData->text . '</p>'}}"
                                                        data-toggle="popover"
                                                        data-container="body"
                                                        data-placement="top"
                                                        data-html="true"
                                                        data-trigger="focus hover">
                                                            <i class="mdi mdi-note-text"></i>
                                                        </botton>
                                                    @elseif ( isset($answerData) && isset($answerData->options) )
                                                        {{ implode(', ', $answerData->options) }}
                                                    @endif

                                                    @if ( $answer->image )
                                                        @php ( $imageUrl = $answer->getImageUrl() )
                                                        <a href="{{ $imageUrl }}" target="_blank">
                                                            <img src="{{ $imageUrl }}" alt="photo">
                                                        </a>
                                                    @endif
                                                @else
                                                    &nbsp;
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
