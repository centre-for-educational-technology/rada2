@extends('layouts.app')

@section('content')
<div class="container">
    @include('activities.includes.play_modal')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if ( $activity->isOpenGame() )
                        <i class="mdi mdi-earth open-game" aria-hidden="true"></i>
                    @endif
                    {{ $activity->title }}
                </div>

                <div class="panel-body">
                    @include('includes.image-upload-processing-error')
                    @include('activities.includes.game-status', ['activity' => $activity])
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('includes.author', ['author' => $activity->user, 'date' => $activity->created_at])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('activities.includes.actions')
                        </div>
                    </div>
                    @include('activities.includes.play', ['activity' => $activity])
                    @if ($activity->is_template == false)
                    <br />
                    <div class="panel panel-primary">
                        <div class="panel-heading">{{ trans('general.forms.labels.pin-code') }}</div>
                        <div class="panel-body">
                            {{ $activity->pin }}
                        </div>
                    </div>
                    @endif
                    <h3>{{ trans('general.forms.labels.description') }}</h3>
                    <p class="sz-display-new-lines">{{ $activity->description }}</p>
                    @if ($activity->isPublicPath())
                        <h3>{{ trans('general.forms.labels.public-path') }}</h3>
                        <p>{{ trans('general.forms.tooltips.public-path') }}</p>
                    @endif
                    <h3>{{ trans('pages.play.game.rating-label') }}</h3>
                    <p>{{ $activity->getAverageRating() }}</p>
                    <h3>{{ trans('general.forms.labels.playing-time') }}</h3>
                    <p>{{ $activity->playing_time}} {{ trans('general.minutes')}}</p>
                    <h3>{{ trans('general.language') }}</h3>
                    <p>{{ $activity->getLanguage() }}</p>
                    <h3>{{ trans('general.forms.labels.contact-information') }}</h3>
                    <p>{{ $activity->contact_information }}</p>
                    <h3>{{ trans('general.forms.labels.keywords') }}</h3>
                    @foreach ($activity->getKeywordsAsArray() as $keyword)
                    <span class="label-info label">{{ $keyword }}</span>
                    @endforeach
                    <h3>{{ trans('general.forms.labels.subject') }}</h3>
                    @foreach ($activity->getSubjectsAsArray() as $subject)
                    <span class="label-info label">{{ $subject }}</span>
                    @endforeach
                    <h3>{{ trans('general.forms.labels.age_of_participants') }}</h3>
                    <p>{{ $activity->getAgeOfParticipantsString() }}</p>
                    @if ($activity->hasFeaturedImage())
                        <h3>{{ trans('general.forms.labels.featured-image') }}</h3>
                        <div class="image-holder-with-relative-position">
                            <img src="{!! $activity->getFeaturedImageUrl() !!}" alt="featured_image" class="img-rounded sz-img-64x64">
                            @if ($activity->getImage()->hasExternalProvider())
                                @include('includes.external-provider-logo', ['image' => $activity->getImage(), 'absolute' => TRUE])
                            @endif
                        </div>
                    @endif
                    <h3>{{ trans('general.forms.labels.activity-items') }}</h3>
                    @if ( count($activity->activityItems) === 0 )
                        <div class="well">{{ trans('pages.activity-items.index.none-found') }}</div>
                    @else
                        <ul class="list-group">
                            @foreach( $activity->activityItems as $item )
                                <li class="list-group-item" title="{{ $item->description }}">
                                    <a href="{!! route('activity_item.show', ['activity_item' => $item->id]) !!}">
                                        <i class="mdi mdi-link pull-right"></i>
                                    </a>
                                    @can('update', $item)
                                    <a href="{!! route('activity_item.edit', ['activity_item' => $item->id]) !!}">
                                        <i class="mdi mdi-pencil pull-right"></i>
                                    </a>
                                    @endcan
                                    <img class="sz-img-w30" src="{{ $item->icon_url }}" alt="icon">
                                    &nbsp;
                                    {{ $item->title }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
