<div class="media sz-author">
    <div class="media-left">
        <i class="mdi mdi-account-circle" aria-hidden="true"></i>
    </div>
    <div class="media-body">
        <div>{{ $author->name }}</div>
        <div class="sz-date">
            <i class="mdi mdi-clock" aria-hidden="true"></i>
            {{ date(trans('general.date-time.formats.short'), strtotime($date)) }}
        </div>
    </div>
</div>
