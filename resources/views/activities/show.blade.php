@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $activity->title }}
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('includes.author', ['author' => $activity->user, 'date' => $activity->created_at])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('activities.includes.actions')
                        </div>
                    </div>
                    <h3>{{ trans('general.forms.labels.description') }}</h3>
                    <p class="sz-display-new-lines">{{ $activity->description }}</p>
                    <h3>{{ trans('general.forms.labels.activity-type') }}</h3>
                    <p>{{ $activity::getActivityType($activity->type) }}</p>
                    <h3>{{ trans('general.forms.labels.difficulty-level') }}</h3>
                    <p>{{ $activity->difficulty_level_start }} - {{ $activity->difficulty_level_end }}</p>
                    <h3>{{ trans('general.forms.labels.playing-time') }}</h3>
                    <p>{{ $activity->playing_time}} {{ trans('general.minutes')}}</p>
                    <h3>{{ trans('general.language') }}</h3>
                    <p>{{ trans('general.languages.' . $activity->language) }}</p>
                    <h3>{{ trans('general.forms.labels.contact-information') }}</h3>
                    <p>{{ $activity->contact_information }}</p>
                    @if ($activity->hasFeaturedImage())
                        <h3>{{ trans('general.forms.labels.featured-image') }}</h3>
                        <p>
                            <img src="{!! $activity->getFeaturedImageUrl() !!}" alt="featured_image" class="img-rounded" style="height:64px;width:64px;">
                        </p>
                    @endif
                    <h3>{{ trans('general.forms.labels.zoo') }}</h3>
                    <p>{{ $activity::getZoo($activity->zoo) }}</p>
                    <h3>{{ trans('general.forms.labels.activity-items') }}</h3>
                    @if ( count($activity->activityItems) === 0 )
                        <div class="well">{{ trans('pages.activity-items.index.none-found') }}</div>
                    @else
                        <ul class="list-group">
                            @foreach( $activity->activityItems as $item )
                                <li class="list-group-item">
                                    <a href="{!! route('activity_item.show', ['id' => $item->id]) !!}">
                                        <i class="mdi mdi-link pull-right"></i>
                                    </a>
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
