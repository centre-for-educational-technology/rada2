@if ( $activity->discountVoucher && $activity->discountVoucher->canBeAwarded() )
    <div style="display:none;" id="discount-voucher-content-{{ $activity->id }}">
        <div class="thumbnail">
            <img src="{{ $activity->discountVoucher->getImageUrl() }}" alt="image">
            <div class="caption">
                <h3>{{ $activity->discountVoucher->title}}</h3>
                <p class="sz-metadata">
                    <i class="mdi mdi-timer" aria-hidden="true"></i>
                    {{ $activity->discountVoucher->duration }}
                    {{ trans('general.forms.addons.hours') }}
                </p>
                @include('discount_vouchers.includes.amount_metadata', ['voucher' => $activity->discountVoucher])
                <p class="sz-display-new-lines">{{ $activity->discountVoucher->description }}</p>
            </div>
        </div>
    </div>
@endif
