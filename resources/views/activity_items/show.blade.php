@extends('layouts.app')

@section('footer-scripts')
@if ( Session::has('activityItemCreated') )
<script>
    $(document).ready(function() {
        if ( window.opener ) {
            window.opener.postMessage({
                type: 'addActivityItem',
                activityItem: <?php echo json_encode($activity_item); ?>
            }, window.origin);
        }
    });
</script>
@endif
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $activity_item->title }}
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('includes.author', ['author' => $activity_item->user, 'date' => $activity_item->created_at])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('activity_items.includes.actions')
                        </div>
                    </div>
                    @if ( $activity_item->hasImage() )
                        <h3>{{ trans('general.forms.labels.image') }}</h3>
                        <img src="{!! $activity_item->getImageUrl() !!}" alt="image" class="img-responsive">
                    @endif
                    <h3>{{ trans('general.forms.labels.question-type') }}</h3>
                    <p>{{ $activity_item->getQuestionType() }}</p>
                    <h3>{{ trans('general.forms.labels.question-or-information') }}</h3>
                    <p class="sz-display-new-lines">{{ $activity_item->description }}</p>
                    @if ( $activity_item->isEmbeddedContent() )
                        <p class="embed-responsive embed-responsive-16by9">
                            {!! html_entity_decode($activity_item->embedded_content) !!}
                        </p>
                    @elseif ( $activity_item->isOneCorrectAnswer() || $activity_item->isMultipleCorrectAnswers() )
                        @php ( $canViewCorrectAnswer = ( Auth::user() && Auth::user()->can('viewCorrectAnswer', $activity_item) ) )
                        <ul class="media-list sz-options-list">
                        @foreach( $activity_item->options as $option )
                            <li class="media sz-option">
                                @if ( $option->image )
                                    <div class="media-left">
                                        <a href="{{ $option->getImageUrl() }}" target="_blank">
                                            <img class="media-object" src="{{ $option->getImageUrl() }}" alt="option-image">
                                        </a>
                                    </div>
                                @endif

                                <div class="media-body">
                                    <h4 class="media-heading">
                                        {{ $option->option }}
                                    </h4>
                                </div>

                                <div class="media-right media-middle">
                                    @if ( !$canViewCorrectAnswer )
                                        @if ( $activity_item->isOneCorrectAnswer() )
                                            <i class="mdi mdi-radiobox-blank" aria-hidden="true"></i>
                                        @elseif ( $activity_item->isMultipleCorrectAnswers() )
                                            <i class="mdi mdi-checkbox-blank-outline" aria-hidden="true"></i>
                                        @endif
                                    @elseif ( $option->isCorrect() )
                                        @if ( $activity_item->isOneCorrectAnswer() )
                                            <i class="mdi mdi-radiobox-marked sz-option-correct" aria-hidden="true"></i>
                                        @elseif ( $activity_item->isMultipleCorrectAnswers() )
                                            <i class="mdi mdi-checkbox-marked-outline sz-option-correct" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        @if ( $activity_item->isOneCorrectAnswer() )
                                            <i class="mdi mdi-radiobox-blank sz-option-incorrect" aria-hidden="true"></i>
                                        @elseif ( $activity_item->isMultipleCorrectAnswers() )
                                            <i class="mdi mdi-checkbox-blank-outline sz-option-incorrect" aria-hidden="true"></i>
                                        @endif
                                    @endif
                              </div>
                            </li>
                        @endforeach
                        </ul>
                    @elseif ( $activity_item->isMatchPairs() )
                        @can('viewCorrectAnswer', $activity_item)
                            <ul class="list-group sz-pairs-list">
                                @foreach( $activity_item->pairs as $pair )
                                    <li class="list-group-item sz-pair">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="media sz-pair">
                                                    @if ( $pair->image )
                                                        <div class="media-left">
                                                            <a href="{{ $pair->getOptionImageUrl() }}" target="_blank">
                                                                <img class="media-object" src="{{ $pair->getOptionImageUrl() }}" alt="option-image">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            {{ $pair->option }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="media">
                                                    @if ( $pair->image_match )
                                                        <div class="media-left">
                                                            <a href="{{ $pair->getOptionMatchImageUrl() }}" target="_blank">
                                                                <img class="media-object" src="{{ $pair->getOptionMatchImageUrl() }}" alt="option-image">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            {{ $pair->option_match }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endcan

                        @cannot('viewCorrectAnswer', $activity_item)
                            <div class="row">
                                <div class="col-xs-6">
                                    <ul class="list-group-item sz-pair">
                                        @foreach( $activity_item->pairs->shuffle() as $pair )
                                            <li class="list-group-item sz-pair">
                                                <div class="media sz-pair">
                                                    @if ( $pair->image )
                                                        <div class="media-left">
                                                            <a href="{{ $pair->getOptionImageUrl() }}" target="_blank">
                                                                <img class="media-object" src="{{ $pair->getOptionImageUrl() }}" alt="option-image">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            {{ $pair->option }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-xs-6">
                                    <ul class="list-group-item sz-pair">
                                        @foreach( $activity_item->pairs->shuffle() as $pair )
                                            <li class="list-group-item sz-pair">
                                                <div class="media">
                                                    @if ( $pair->image_match )
                                                        <div class="media-left">
                                                            <a href="{{ $pair->getOptionMatchImageUrl() }}" target="_blank">
                                                                <img class="media-object" src="{{ $pair->getOptionMatchImageUrl() }}" alt="option-image">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            {{ $pair->option_match }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endcannot
                    @endif
                    <h3>{{ trans('general.language') }}</h3>
                    <p>{{ trans('general.languages.' . $activity_item->language) }}</p>
                    <h3>{{ trans('general.forms.labels.location') }}</h3>
                    <p>
                        <iframe width="100%" height="240" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key={{ config('services.maps.google.api_key') }}&amp;center={{ $activity_item->latitude}},{{ $activity_item->longitude }}&amp;zoom=18&amp;maptype=satellite&amp;q={{ $activity_item->latitude}},{{ $activity_item->longitude }}"></iframe>
                    </p>
                    @can('viewAccessCode', $activity_item)
                        @if ( $activity_item->access_code )
                            <h3>{{ trans('general.forms.labels.access-code') }}</h3>
                            <p>{{ $activity_item->access_code }}</p>
                        @endif
                        @if ( $activity_item->access_code_clues )
                            <h3>{{ trans('general.forms.labels.access-code-clues') }}</h3>
                            <p>{{ $activity_item->access_code_clues }}</p>
                        @endif
                    @endcan

                    @if ( $activity_item->read_more )
                        <h3>{{ trans('general.forms.labels.read-more') }}</h3>
                        <p>
                            <a href="{{ $activity_item->read_more }}" target="_blank">{{ $activity_item->read_more }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
