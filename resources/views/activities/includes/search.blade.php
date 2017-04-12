<form action="#search-results" method="get" name="search-form" id="search-form" class="collapse{{ $search['search-submitted'] ? ' in' : '' }}">
    <div class="form-group">
        <label for="search-text">{{ trans('general.forms.labels.search-text') }}</label>
        <input type="text" class="form-control" name="search-text" id="search-text" placeholder="{{ trans('general.forms.placeholders.search-text') }}" value="{{ $search['search-text'] }}">
    </div>

    <div class="form-group">
        <label for="activity-type">{{ trans('general.forms.labels.activity-type') }}</label>
        <select class="form-control" name="activity-type" id="activity-type">
            <option value="0">{{ trans('general.forms.options.any') }}</option>
            @foreach($activityTypeOptions as $key => $title)
                @if( $key == $search['activity-type'] )
                    <option value="{{ $key }}" selected="selected">{{ $title }}</option>
                @else
                    <option value="{{ $key }}">{{ $title }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="difficulty-level">{{ trans('general.forms.labels.difficulty-level') }}</label>
        <input type="text"
               class="form-control"
               name="difficulty-level"
               id="difficulty-level"
               value="{{ $search['difficulty-level'] }}"
               data-type="double"
               data-min="{{ $difficultyLevelMinimum }}"
               data-max="{{ $difficultyLevelMaximum }}"
               data-step="1"
               data-grid="true"
               data-grid-num="11">
    </div>

    <div class="form-group">
        <label for="zoo">{{ trans('general.forms.labels.zoo') }}</label>
        <select class="form-control" name="zoo" id="zoo">
            <option value="0">{{ trans('general.forms.options.any') }}</option>
            @foreach($zooOptions as $key => $title)
                @if( $key == $search['zoo'] )
                    <option value="{{ $key }}" selected="selected">{{ $title }}</option>
                @else
                    <option value="{{ $key }}">{{ $title }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="language">{{ trans('general.language') }}</label>
        <select class="form-control" name="language" id="language">
            <option value="0">{{ trans('general.forms.options.any') }}</option>
            @foreach($languageOptions as $key => $title)
                @if ( $key == $search['language'] )
                    <option value="{{ $key }}" selected="selected">{{ $title }}</option>
                @else
                    <option value="{{ $key }}">{{ $title }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="hidden" name="search-submitted" value="1">

        <button type="submit" class="btn btn-success">
            <i class="mdi mdi-search-web" aria-hidden="true"></i>
            {{ trans('general.forms.buttons.search') }}
        </button>
        <a href="{!! route('activity.index') !!}" class="btn btn-default{{ !$search['search-submitted'] ? ' disabled' : '' }}">
            <i class="mdi mdi-refresh" aria-hidden="true"></i>
            {{ trans('general.forms.buttons.reset') }}
        </a>
    </div>
</form>
