@if ($voucher->hasAmountLimitation())
    <div class="sz-metadata">
        <i class="mdi mdi-numeric" aria-hidden="true"></i>
        {{ $voucher->awardedCount() }} / {{ $voucher->amount }} ({{ trans('general.forms.addons.awarded') }})
    </div>
@endif
