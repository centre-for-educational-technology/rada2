<form class="sz-play-action-form" action="{{ route('activity.start', ['id' => $activity->id]) }}" method="POST">
    {{ csrf_field() }}
    {!! Form::hidden('exit_url', url()->full(), []) !!}
    <button type="submit" class="btn btn-play btn-sm" title="{{ trans('general.actions.play') }}">
      <i class="mdi mdi-play-circle-outline"></i>
    </button>
</form>
