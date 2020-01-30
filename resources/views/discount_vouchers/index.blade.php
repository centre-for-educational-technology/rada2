@extends('layouts.app')

@section('footer-scripts')
<script src="{{ asset(mix('js/discount_vouchers.js')) }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ trans('pages.discount-vouchers.index.heading') }}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <h3>{{ trans('pages.profile.labels.discount-vouchers-earned') }}</h3>
                    <div class="well well-sm text-center">
                        <p>
                            {{ trans('pages.profile.discount-vouchers.information') }}
                        </p>
                        <p>
                            <strong>{{ trans('pages.profile.discount-vouchers.how-to-redeem') }}</strong>
                        </p>
                    </div>

                    @if ( $vouchers &&  count($vouchers) > 0 )
                        <div class="row">
                            @foreach ( $vouchers as $voucher )
                            @php( $isRedeemable = !( $voucher->pivot->spent || \Carbon\Carbon::parse($voucher->pivot->valid_until) < Carbon\Carbon::now() ) )
                            <div class="discount-voucher col-sm-6 col-md-4{{ !$isRedeemable ? ' invalid-or-spent' : '' }}" data-valid-until="{{ \Carbon\Carbon::parse($voucher->pivot->valid_until)->toIso8601String() }}">
                                <div class="thumbnail">
                                    <img src="{{ $voucher->getImageUrl() }}" alt="image">
                                    <div class="caption">
                                        <h4>{{ $voucher->title }}</h4>
                                        <p>{{ $voucher->description }}</p>
                                        <p class="valid-until">
                                            <strong>{{ trans('pages.profile.labels.valid-until') }}</strong>
                                            <span></span>
                                        </p>
                                        <p class="text-center">
                                            <button
                                                class="btn btn-discount-voucher-spend discount-voucher-spend"
                                                data-confirm="{{ trans('pages.profile.confirmations.discount-voucher-spend') }}"
                                                data-voucher-id="{{ $voucher->id }}"
                                                role="button"
                                                {{ !$isRedeemable ? ' disabled="disabled"' : '' }}>
                                                {{ trans('general.actions.discount-voucher-spend') }}
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if ( $loop->iteration % 3 === 0 )
                                </div>
                                <div class="row">
                            @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
