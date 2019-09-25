@if ( Auth::check() )
    @if ( $activity->started )
        <div class="alert alert-success sz-activity-status" role="alert">
            {{ trans('general.activity-status.ongoing') }}
        </div>
    @else
        <div class="alert alert-danger sz-activity-status" role="alert">
            {{ trans('general.activity-status.stopped') }}
        </div>
    @endif
@endif
