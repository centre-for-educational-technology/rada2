@extends('layouts.app')

@section('footer-scripts')
<script src="{{ elixir('js/search_activities.js') }}"></script>
<script src="{{ elixir('js/qr_code_modal.js') }}"></script>
@endsection

@section('content')
<div class="container">
    @include('activities.includes.qrcode_modal')
    @include('activities.includes.play_modal')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-10 col-md-8">
                            {{ trans('pages.activities.index.heading') }}
                        </div>

                        <div class="col-xs-2 col-md-4">
                            <div class="pull-right">
                                @can('create', 'App\Activity')
                                    <a href="{!! route('activity.create') !!}" class="btn btn-primary" title="{{ trans('general.actions.create') }}">
                                        <i class="mdi mdi-plus" aria-hidden="true"></i>
                                    </a>
                                @endcan
                                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#search-form" aria-expanded="false" aria-controls="search-form" title="{{ trans('general.forms.buttons.search') }}">
                                    <i class="mdi mdi-search-web" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('activities.includes.search')

                </div>

                <div class="panel-body" id="search-results">
                    @if ( count($activities) === 0 )
                        <div class="well">{{ trans('pages.activities.index.none-found') }}</div>
                    @else
                        @foreach($activities as $activity)
                            <div class="media">
                                <div class="media-left">
                                    <a href="{!! route('activity.show', [ 'id' => $activity->id ]) !!}">
                                        <img class="media-object img-rounded sz-img-64x64" src="{{ $activity->getFeaturedImageUrl() }}" alt="featured-image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    @include('activities.includes.actions')
                                    <h4 class="media-heading">
                                        <a href="{!! route('activity.show', ['id' => $activity->id]) !!}">
                                            {{ $activity->title }}
                                        </a>
                                    </h4>
                                    <p class="sz-display-new-lines">{{$activity->description}}</p>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                                        {{ $activity->getLanguage() }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-hexagon-multiple" aria-hidden="true"></i>
                                        {{ $activity->getDifficultyLevel() }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                                        {{ $activity->playing_time}} {{ trans('general.minutes')}}
                                    </div>
                                    @include('activities.includes.discount_voucher', ['activity' => $activity])
                                    @include('activities.includes.play', ['activity' => $activity])
                                </div>
                                @if ( !$loop->last)
                                    <hr>
                                @endif
                            </div>
                        @endforeach

                        <div class="text-center">
                            {{ $activities->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
