@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-10 col-md-8">
                            {{ trans('pages.discount-vouchers.index.heading') }}
                        </div>

                        <div class="col-xs-2 col-md-4">
                            <div class="pull-right">
                                @can('create', 'App\DiscountVoucher')
                                    <a href="{!! route('discount_voucher.create') !!}" class="btn btn-primary" title="{{ trans('general.actions.create') }}">
                                        <i class="mdi mdi-plus" aria-hidden="true"></i>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @if ( count($vouchers) === 0 )
                        <div class="well">{{ trans('pages.discount-vouchers.index.none-found') }}</div>
                    @else
                        @foreach($vouchers as $voucher)
                            <div class="media sz-voucher-{{ $voucher->status ? 'active' : 'inactive' }}" id="{{ $voucher->id }}">
                                <div class="media-left">
                                    <a href="{!! $voucher->getImageUrl() !!}" target="_blank">
                                        <img class="media-object img-rounded sz-img-w64" src="{{ $voucher->getImageUrl() }}" alt="image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right">
                                        @if(Auth::check())
                                                @can('update', $voucher)
                                                    <a href="{!! route('discount_voucher.edit', ['id' => $voucher->id]) !!}" class="btn btn-primary btn-sm" title="{{ trans('general.actions.edit') }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete', $voucher)
                                                    <a href="#" class="btn btn-danger btn-sm" title="{{ trans('general.actions.delete') }}" data-method="delete" data-confirm="{{ trans('general.confirmations.delete') }}" data-action="{!! route('discount_voucher.delete', ['id' => $voucher->id]) !!}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                @endcan
                                        @endif
                                    </div>

                                    <h4 class="media-heading">
                                        {{ $voucher->title }}
                                    </h4>
                                    <p class="sz-display-new-lines">{{ $voucher->description }}</p>
                                    <div class="sz-metadata">
                                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                                        {{ $voucher->duration }}
                                        ({{ trans('general.forms.addons.hours') }})
                                    </div>
                                    @include('discount_vouchers.includes.amount_metadata', ['voucher' => $voucher])
                                    <div class="sz-metadata">
                                        {{ $statusOptions[$voucher->status] }}
                                    </div>
                                </div>
                                @if ( !$loop->last)
                                    <hr>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
