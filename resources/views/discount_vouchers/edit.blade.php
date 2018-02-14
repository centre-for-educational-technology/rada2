@extends('layouts.app')

@section('content')
<div class="container">
    {!! Form::open([
        'url' => 'discount_vouchers/' . $voucher->id,
        'files' => true,
        'class' => 'form-horizontal discount-voucher-edit',
        'role' => 'form',
        'method' => 'put',
    ]) !!}
        <div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', trans('general.forms.labels.title'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::text('title', $voucher->title, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description', trans('general.forms.labels.description'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::textarea('description', $voucher->description, [
                        'class' => 'form-control',
                        'rows' => '3',
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
            {!! Form::label('duration', trans('general.forms.labels.duration'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                    </span>
                    {!! Form::number('duration', $voucher->duration, [
                        'class' => 'form-control',
                        'min' => 0,
                    ]) !!}
                    <span class="input-group-addon">
                        {{ trans('general.forms.addons.hours') }}
                    </span>
                </div>

                @if ($errors->has('duration'))
                    <span class="help-block">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
            {!! Form::label('amount', trans('general.forms.labels.amount'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-numeric" aria-hidden="true"></i>
                    </span>
                    {!! Form::number('amount', $voucher->amount, [
                        'class' => 'form-control',
                        'min' => 0,
                    ]) !!}
                </div>

                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            {!! Form::label('status', trans('general.forms.labels.status'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::select('status', $statusOptions, $voucher->status, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                @if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            {!! Form::label('image', trans('general.forms.labels.image'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-image" aria-hidden="true"></i>
                    </span>
                    {!! Form::file('image', [
                        'class' => 'form-control',
                        'accept' => 'image/jpeg, image/png',
                    ]) !!}
                </div>

                <p class="help-block">
                    @if ($voucher->hasImage())
                        <img src="{!! $voucher->getImageUrl() !!}" alt="image" class="img-rounded pull-left sz-uploaded-image-preview">
                    @endif
                    {{ trans('general.forms.help.image') }}
                </p>

                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {!! Form::submit(trans('general.forms.buttons.save'), [
                    'class' => 'btn btn-primary',
                ])!!}
                {!! Html::link(route('discount_voucher.index'), trans('general.forms.buttons.cancel'), [
                    'class' => 'btn btn-default',
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection
