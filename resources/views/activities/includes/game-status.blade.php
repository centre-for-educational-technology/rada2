@if ( Auth::check() )
    @php( $gameStatus = $activity->getUserGameStatus() )
    @if ( $gameStatus === 1 )
        <div class="alert alert-success sz-activity-status" role="alert">
            {{ trans('general.activity-status.complete') }}
        </div>
    @elseif ( $gameStatus === 0)
        <div class="alert alert-info sz-activity-status" role="alert">
            {{ trans('general.activity-status.ongoing') }}
        </div>
    @endif
@endif
