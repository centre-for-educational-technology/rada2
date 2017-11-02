<form class="sz-play-action-form" action="{{ route('activity.start', ['id' => $activity->id]) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-success btn-sm" title="{{ trans('general.actions.play') }}">
      <i class="mdi mdi-play-circle-outline"></i>
    </button>
</form>
