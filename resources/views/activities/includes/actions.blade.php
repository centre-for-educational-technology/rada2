<div class="pull-right">
    <div class="btn-group" role="group" aria-label="Task actions">
        @if(Auth::check())
            @can('startStop', $activity)
                @if ($activity->is_template == false)
                    @if ($activity->started)
                        <a href="{!! route('activity.mark-stopped', [
                            'activity' => $activity->id
                        ]) !!}"
                           class="btn btn-danger btn-sm"
                           title="{{ trans('general.actions.mark-stopped') }}">
                            <i class="mdi mdi-stop"></i>
                        </a>
                    @else
                        <a href="{!! route('activity.mark-started', [
                            'activity' => $activity->id
                        ]) !!}"
                           class="btn btn-success btn-sm"
                           title="{{ trans('general.actions.mark-started') }}">
                            <i class="mdi mdi-play"></i>
                        </a>
                    @endif
                @endif
            @endcan
            @can('duplicate', $activity)
                <a href="{!! route('activity.duplicate', ['activity' => $activity->id]) !!}" class="btn btn-primary btn-sm" title="{{ trans('general.actions.duplicate') }}">
                    <i class="mdi mdi-content-copy"></i>
                </a>
            @endcan
            @can('update', $activity)
                <a href="{!! route('activity.edit', ['activity' => $activity->id]) !!}" class="btn btn-primary btn-sm" title="{{ trans('general.actions.edit') }}">
                    <i class="mdi mdi-pencil"></i>
                </a>
            @endcan
            @can('delete', $activity)
                <a href="#" class="btn btn-danger btn-sm" title="{{ trans('general.actions.delete') }}" data-method="delete" data-confirm="{{ trans('general.confirmations.delete') }}" data-action="{!! route('activity.delete', ['activity' => $activity->id]) !!}">
                    <i class="mdi mdi-delete"></i>
                </a>
            @endcan
        @endif
    </div>
</div>
