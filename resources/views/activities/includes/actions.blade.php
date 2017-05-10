<div class="pull-right">
    <form class="sz-action-form-inline" action="{{ route('activity.start', ['id' => $activity->id]) }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success btn-sm" title="{{ trans('general.actions.play') }}">
          <i class="mdi mdi-play-circle-outline"></i>
        </button>
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
