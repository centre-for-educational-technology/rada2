<form action="#search-results" method="get" name="search-form" id="search-form" class="collapse{{ $search['search-submitted'] ? ' in' : '' }}">
    <div class="form-group">
        <label for="search-text">{{ trans('general.forms.labels.search-text') }}</label>
        <input type="text" class="form-control" name="search-text" id="search-text" placeholder="{{ trans('general.forms.placeholders.search-text') }}" value="{{ $search['search-text'] }}">
    </div>

    <div class="form-group">
        <label for="question-type">{{ trans('general.forms.labels.question-type') }}</label>
        <select class="form-control" name="question-type" id="question-type">
            <option value="0">{{ trans('general.forms.options.any') }}</option>
            @foreach($questionTypeOptions as $key => $title)
                @if( $key == $search['question-type'] )
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
        <a href="{!! route('activity_item.index') !!}" class="btn btn-default{{ !$search['search-submitted'] ? ' disabled' : '' }}">
            <i class="mdi mdi-refresh" aria-hidden="true"></i>
            {{ trans('general.forms.buttons.reset') }}
        </a>
    </div>
</form>
