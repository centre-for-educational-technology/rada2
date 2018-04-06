<div class="pull-right">
    @if ( $activity->discountVoucher && $activity->discountVoucher->canBeAwarded() )
        <a href="#" class="btn btn-discount-voucher btn-sm" data-toggle="modal" data-target="#discount-voucher-modal" data-title="{{ $activity->discountVoucher->title }}" data-id="{{ $activity->id }}" title="{{ trans('general.actions.reveal-discount') }}">
            <i class="mdi mdi-sale"></i>
        </a>
    @endif
    <a href="#" class="btn btn-qr-code btn-sm" data-toggle="modal" data-target="#qr-code-modal" data-api-url="{!! route('api.activity.qrcode', ['id' => $activity->id]) !!}" data-title="{{ $activity->title }}" data-download-url="{!! route('activity.qrcode.download', ['id' => $activity->id]) !!}" title="{{ trans('general.actions.get-qr-code') }}">
        <i class="mdi mdi-qrcode"></i>
    </a>
    @if(Auth::check())
            @can('update', $activity)
                <a href="{!! route('activity.edit', ['id' => $activity->id]) !!}" class="btn btn-primary btn-sm" title="{{ trans('general.actions.edit') }}">
                    <i class="mdi mdi-pencil"></i>
                </a>
            @endcan
            @can('delete', $activity)
                <a href="#" class="btn btn-danger btn-sm" title="{{ trans('general.actions.delete') }}" data-method="delete" data-confirm="{{ trans('general.confirmations.delete') }}" data-action="{!! route('activity.delete', ['id' => $activity->id]) !!}">
                    <i class="mdi mdi-delete"></i>
                </a>
            @endcan
    @endif
</div>
