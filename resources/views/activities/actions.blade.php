<div class="pull-right">
    <a href="{!! route('activity.start', ['id' => $activity->id]) !!}" class="btn btn-success btn-sm" title="{{ trans('general.actions.play') }}" onclick="event.preventDefault();
             document.getElementById('play-form-{{ $activity->id }}').submit();">
        <i class="mdi mdi-play-circle-outline"></i>
    </a>
    <form id="play-form-{{ $activity->id }}" action="{{ route('activity.start', ['id' => $activity->id]) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @if(Auth::check())
            @can('update', $activity)
                <a href="{!! route('activity.edit', ['id' => $activity->id]) !!}" class="btn btn-primary btn-sm" title="{{ trans('general.actions.edit') }}">
                    <i class="mdi mdi-pencil"></i>
                </a>
            @endcan
            @can('delete', $activity)
                <a href="#" class="btn btn-danger btn-sm" title="{{ trans('general.actions.delete') }}" data-method="delete" data-confirm="{{ trans('general.confirmations.delete') }}" data-action="{!! route('activity.delete', ['id' => $activity->id]) !!}">
                    <i class="mdi mdi-delete"></i>
                </a>
            @endcan
    @endif
</div>
