@if(Auth::check())
    <div class="pull-right">
        <div class="btn-group btn-group-sm" role="group" aria-label="Task actions">
            @if ($activity_item->isPhotoAnswer() || $activity_item->isFreeformAnswer())
                <button
                        type="button"
                        class="btn btn-default"
                        data-toggle="tooltip"
                        data-placement="auto top"
                        data-trigger="hover"
                        data-container="body"
                        title="{{ trans('general.forms.tooltips.public-path-answers') }}"
                        @click="onShowPreviousAnswers({{ json_encode($activity_item) }})"
                >
                    <i class="mdi mdi-list-status" aria-hidden="true"></i>
                </button>
            @endif
            @can('update', $activity_item)
                <a href="{!! route('activity_item.edit', ['activity_item' => $activity_item->id]) !!}" class="btn btn-primary" title="{{ trans('general.actions.edit') }}">
                    <i class="mdi mdi-pencil" aria-hidden="true"></i>
                </a>
            @endcan
            @can('delete', $activity_item)
                <a href="#" class="btn btn-danger" title="{{ trans('general.actions.delete') }}" data-method="delete" data-confirm="{{ trans('general.confirmations.delete') }}" data-action="{!! route('activity_item.delete', ['activity_item' => $activity_item->id]) !!}">
                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                </a>
            @endcan
        </div>
    </div>
@endif
