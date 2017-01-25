@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $activity_item->title }}
                </div>

                <div class="panel-body">
                    @include('activity_items.actions')
                    <h3>{{ trans('general.forms.labels.description') }}</h3>
                    <p class="sz-display-new-lines">{{ $activity_item->description }}</p>
                    <h3>{{ trans('general.forms.labels.question-type') }}</h3>
                    <p>{{ $activity_item::getQuestionType($activity_item->type) }}</p>
                    @if ( $activity_item->isEmbeddedContent() )
                        <p>{!! html_entity_decode($activity_item->embedded_content) !!}</p>
                    @elseif ( $activity_item->isOneCorrectAnswer() || $activity_item->isMultipleCorrectAnswers() )
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
                                    @if ( $option->isCorrect() )
                                        @if ( $activity_item->isOneCorrectAnswer() )
                                            <i class="mdi mdi-radiobox-marked sz-option-correct" aria-hidden="true"></i>
                                        @elseif ( $activity_item->isMultipleCorrectAnswers() )
                                            <i class="mdi mdi-checkbox-marked-circle-outline sz-option-correct" aria-hidden="true"></i>
                                        @endif
                                    @else
                                        @if ( $activity_item->isOneCorrectAnswer() )
                                            <i class="mdi mdi-radiobox-blank sz-option-incorrect" aria-hidden="true"></i>
                                        @elseif ( $activity_item->isMultipleCorrectAnswers() )
                                            <i class="mdi mdi-checkbox-blank-circle-outline sz-option-incorrect" aria-hidden="true"></i>
                                        @endif
                                    @endif
                              </div>
                            </li>
                        @endforeach
                        </ul>
                    @elseif ( $activity_item->isMatchPairs() )
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
                    @endif
                    <h3>{{ trans('general.forms.labels.zoo') }}</h3>
                    <p>{{ Activity::getZoo($activity_item->zoo) }}</p>
                    <h3>{{ trans('general.forms.labels.language') }}</h3>
                    <p>{{ trans('general.languages.' . $activity_item->language) }}</p>
                    <h3>{{ trans('general.forms.labels.location') }}</h3>
                    <p>
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $activity_item->latitude}},{{ $activity_item->longitude }}&amp;zoom=18&amp;size=240x180&amp;maptype=hybrid&amp;markers=color:red%7C{{ $activity_item->latitude}},{{ $activity_item->longitude }}&amp;style=feature:poi%7Cvisibility:off&amp;style=feature:transit.station%7Cvisibility:off&amp;key={{ config('services.maps.google.api_key') }}" alt="map">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
