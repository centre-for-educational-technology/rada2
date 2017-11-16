@extends('layouts.app')

@section('footer-scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
            content: function() {
                return $(this).next('.sz-popover-data').html();
            }
        });

        $('form[name="filters"]').find('.checkbox > label > input[type="checkbox"]').on('change', function() {
            $(this).parents('form').submit();
        });

        $('form[name="filters"] button[type="reset"]').on('click', function(e) {
            e.preventDefault();
            window.location.replace(window.location.origin + window.location.pathname);
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
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! trans('pages.activity-results.heading', [ 'title' => $activity->title ]) !!}
                        </div>

                        <form name="filters" action="{!! route('activity.results', ['id' => $activity->id]) !!}" class="form-inline col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="pull-right">
                                        <div class="checkbox sz-metadata">
                                            <label>
                                                <input type="checkbox" name="incognito" id="incognito" value="0"{{ $filters['incognito'] ? '' : ' checked'}}>
                                                {{ trans('general.forms.labels.hide-incognito') }}
                                            </label>
                                        </div>
                                        <div class="checkbox sz-metadata">
                                            <label>
                                                <input type="checkbox" name="incomplete" id="incomplete" value="0"{{ $filters['incomplete'] ? '' : ' checked'}}>
                                                {{ trans('general.forms.labels.hide-incomplete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <div class="form-group">
                                        <label for="from">{{ trans('general.forms.labels.from') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="mdi mdi-calendar-clock" aria-hidden="true"></i>
                                            </span>
                                            <input type="datetime-local" name="from" id="from" value="{{ $filters['from'] }}" class="form-control" placeholder="{{ trans('general.forms.placeholders.datetime') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="from">{{ trans('general.forms.labels.until') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="mdi mdi-calendar-clock" aria-hidden="true"></i>
                                            </span>
                                            <input type="datetime-local" name="until" id="until" value="{{ $filters['until'] }}" class="form-control" placeholder="{{ trans('general.forms.placeholders.datetime') }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ trans('general.forms.buttons.apply-filters') }}</button>
                                    <button type="reset" class="btn btn-default">{{ trans('general.forms.buttons.reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel-body">
                    @if ( $games->count() === 0 )
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
                                    @foreach($games as $game)
                                    <tr>
                                        <td class="text-center {{ !$game->isComplete() ? 'warning' : '' }}">
                                        @if( $game->user )
                                            {{ $game->user->name }}
                                        @else
                                            <i class="mdi mdi-incognito" aria-hidden="true"></i>
                                        @endif
                                        <div class="sz-metadata">
                                            <i class="mdi mdi-timer" aria-hidden="true"></i>
                                            {{ date(trans('general.date-time.formats.medium'), strtotime($game->created_at)) }}
                                        </div>
                                        @if ( $game->isComplete())
                                            <div class="sz-metadata">
                                                <i class="mdi mdi-timer-off" aria-hidden="true"></i>
                                                {{ date(trans('general.date-time.formats.medium'), strtotime($game->updated_at)) }}
                                            </div>
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

                            <div class="text-center">
                                {{ $games->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
