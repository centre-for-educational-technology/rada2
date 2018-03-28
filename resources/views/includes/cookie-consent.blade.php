<div id="sz-cookie-consent" style="display:none;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8 col-md-10">
                <span class="text-muted small">
                    {!! trans('general.cookie-consent.text', ['policy' => route('legal.policy')]) !!}
                </span>
            </div>
            <div class="col-xs-4 col-md-2 text-right">
                <button type="button" class="btn btn-success">
                    {{ trans('general.cookie-consent.button-agree') }}
                </button>
            </div>
        </div>
    </div>
</div>
