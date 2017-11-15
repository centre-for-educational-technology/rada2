@if ( $activity->discountVoucher && $activity->discountVoucher->canBeAwarded() )
    <div class="sz-metadata">
        <i class="mdi mdi-sale" aria-hidden="true"></i>
        <a href="#"
           class="btn btn-default btn-xs"
           data-toggle="discountVoucher">
           {{ $activity->discountVoucher->title }}
        </a>
    </div>
    <div class="row" style="display:none;">
        <div class="col-xs-12">
            <div class="thumbnail">
                <img src="{{ $activity->discountVoucher->getImageUrl() }}" alt="image">
                <div class="caption">
                    <a href="{!! route('discount_voucher.index', ['#' . $activity->discountVoucher->id]) !!}">
                        <h3>{{ $activity->discountVoucher->title}}</h3>
                    </a>
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
    </div>
@endif
