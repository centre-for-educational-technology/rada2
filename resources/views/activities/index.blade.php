@extends('layouts.app')

@section('footer-scripts')
<script src="{{ elixir('js/search_activities.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('a[data-toggle="discountVoucher"]').on('click', function(e) {
            e.preventDefault();
            $(this).parent().next('.row').slideToggle();
        });
    });
</script>
@endsection

@section('content')
<div class="container">
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
                                    @include('activities.includes.actions', ['includePlay' => false])
                                    <h4 class="media-heading">
                                        <a href="{!! route('activity.show', ['id' => $activity->id]) !!}">
                                            {{ $activity->title }}
                                        </a>
                                    </h4>
                                    <p class="sz-display-new-lines">{{$activity->description}}</p>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-hexagon-multiple" aria-hidden="true"></i>
                                        {{ $activity->getDifficultyLevel() }}
                                    </div>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                                        {{ $activity->playing_time}} {{ trans('general.minutes')}}
                                    </div>
                                    @if ( $activity->discountVoucher && $activity->discountVoucher->isActive() )
                                        <div class="sz-metadata">
                                            <i class="mdi mdi-sale" aria-hidden="true"></i>
                                            <a href="#"
                                               class="btn btn-default btn-xs"
                                               data-toggle="discountVoucher">
                                               {{ $activity->discountVoucher->title }}
                                            </a>
                                        </div>
                                        <div class="row" style="display:none;">
                                            <div class="col-xs-12">
                                                <div class="thumbnail">
                                                    <img src="{{ $activity->discountVoucher->getImageUrl() }}" alt="image">
                                                    <div class="caption">
                                                        <a href="{!! route('discount_voucher.index', ['#' . $activity->discountVoucher->id]) !!}">
                                                            <h3>{{ $activity->discountVoucher->title}}</h3>
                                                        </a>
                                                        <p class="sz-metadata">
                                                            <i class="mdi mdi-timer" aria-hidden="true"></i>
                                                            {{ $activity->discountVoucher->duration }}
                                                            {{ trans('general.forms.addons.hours') }}
                                                        </p>
                                                        <p class="sz-display-new-lines">{{ $activity->discountVoucher->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <form class="sz-play-action-form" action="{{ route('activity.start', ['id' => $activity->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-success btn-sm" title="{{ trans('general.actions.play') }}">
                                          <i class="mdi mdi-play-circle-outline"></i>
                                        </button>
                                    </form>
                                </div>
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
