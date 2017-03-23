@extends('layouts.app')

@section('header-styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/css/ion.rangeSlider.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/css/ion.rangeSlider.skinFlat.min.css" rel="stylesheet">
@endsection

@section('footer-scripts')
@include('activities.includes.locales')
@include('activities.includes.options')
<script src="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/js/ion.rangeSlider.min.js"></script>
<script src="{{ elixir('js/create_edit_activity.js') }}"></script>
@endsection

@section('content')
<div class="container">
    {!! Form::open([
        'url' => 'activities',
        'files' => true,
        'class' => 'form-horizontal activity-create',
        'role' => 'form',
    ]) !!}
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            {!! Form::label('type', trans('general.forms.labels.activity-type'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::select('type', Activity::getActivityTypeOptions(), null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                @if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', trans('general.forms.labels.title'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::text('title', null, [
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
                    {!! Form::textarea('description', null, [
                        'class' => 'form-control',
                        'rows' => '3',
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="form-group{{ ( $errors->has('difficulty_level_start') || $errors->has('difficulty_level_end') ) ? ' has-error' : '' }}">
            {!! Form::label('difficulty_level', trans('general.forms.labels.difficulty-level'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::hidden('difficulty_level', '', [
                        'id' => 'difficulty_level',
                        'class' => 'form-control',
                        'data-type' => 'double',
                        'data-min' => Activity::getDifficultyLevelMinimum(),
                        'data-max' => Activity::getDifficultyLevelMaximum(),
                        'data-from' => Activity::getDifficultyLevelMinimum(),
                        'data-to' => Activity::getDifficultyLevelMaximum(),
                        'data-step' => 1,
                        'data-grid' => 'true',
                        'data-grid-num' => 11,
                        'ref' => 'difficultyLevel',
                    ]) !!}
                    {!! Form::number('difficulty_level_start', Activity::getDifficultyLevelMinimum(), [
                        'class' => 'form-control',
                        'min' => Activity::getDifficultyLevelMinimum(),
                        'max' => Activity::getDifficultyLevelMaximum(),
                        'style' => 'display:none;',
                        'ref' => 'difficultyLevelStart',
                    ]) !!}
                    {!! Form::number('difficulty_level_end', Activity::getDifficultyLevelMaximum(), [
                        'class' => 'form-control',
                        'min' => Activity::getDifficultyLevelMinimum(),
                        'max' => Activity::getDifficultyLevelMaximum(),
                        'style' => 'display:none;',
                        'ref' => 'difficultyLevelEnd',
                    ]) !!}

                    <p class="help-block">
                        {{ trans('general.forms.help.difficulty-level') }}
                    </p>
                </div>

                @if ($errors->has('difficulty_level_start'))
                    <span class="help-block">
                        <strong>{{ $errors->first('difficulty_level_start') }}</strong>
                    </span>
                @endif

                @if ($errors->has('difficulty_level_end'))
                    <span class="help-block">
                        <strong>{{ $errors->first('difficulty_level_end') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('playing_time') ? ' has-error' : '' }}">
            {!! Form::label('playing_time', trans('general.forms.labels.playing-time'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-timer" aria-hidden="true"></i>
                    </span>
                    {!! Form::number('playing_time', 0, [
                        'class' => 'form-control',
                        'min' => 0,
                    ]) !!}
                </div>

                <p class="help-block">
                    {{ trans('general.forms.help.playing-time') }}
                </p>

                @if ($errors->has('playing_time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('playing_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
            {!! Form::label('language', trans('general.language'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                    </span>
                    {!! Form::select('language', Activity::getLanguageOptions(), null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                @if ($errors->has('language'))
                    <span class="help-block">
                        <strong>{{ $errors->first('language') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('contact_information') ? ' has-error' : '' }}">
            {!! Form::label('contact_information', trans('general.forms.labels.contact-information'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-contact-mail" aria-hidden="true"></i>
                    </span>
                    {!! Form::text('contact_information', null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                @if ($errors->has('contact_information'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contact_information') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('featured_image') ? ' has-error' : '' }}">
            {!! Form::label('featured_image', trans('general.forms.labels.featured-image'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-image" aria-hidden="true"></i>
                    </span>
                    {!! Form::file('featured_image', [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                <p class="help-block">
                    {{ trans('general.forms.help.featured-image') }}
                </p>

                @if ($errors->has('featured_image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('featured_image') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('zoo') ? ' has-error' : '' }}">
            {!! Form::label('zoo', trans('general.forms.labels.zoo'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                    </span>
                    {!! Form::select('zoo', Activity::getZooOptions(), null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                @if ($errors->has('zoo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zoo') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('items') ? ' has-error' : '' }}">
            {!! Form::label('items', trans('general.forms.labels.activity-items'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12" id="activity-items">
                    <activity-items v-bind:api-url="apiUrl"></activity-items>
                </div>
            </div>
        </div>

        <div class="form-group{{ ( $errors->has('proximity_radius') || $errors->has('proximity_check') ) ? ' has-error' : '' }}">
            {!! Form::label('radius', trans('general.forms.labels.proximity'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="mdi mdi-radar" aria-hidden="true"></i>
                    </span>
                    {!! Form::number('proximity_radius', '', [
                        'class' => 'form-control',
                        'min' => 25,
                        'max' => 100,
                        'ref' => 'proximityRadius',
                    ]) !!}
                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" data-trigger="hover" title="{{ trans('pages.activities.create-or-edit.tooltips.proximity-check') }}">
                        {!! Form::checkbox('proximity_check', 1, true, [
                            'ref' => 'proximityCheck',
                        ]) !!}
                    </span>
                </div>
                <p class="help-block">
                    {{ trans('pages.activities.create-or-edit.help.proximity', ['default' => config('services.maps.allowed_distance')]) }}
                </p>

                @if ($errors->has('proximity_radius'))
                    <span class="help-block">
                        <strong>{{ $errors->first('proximity_radius') }}</strong>
                    </span>
                @endif

                @if ($errors->has('proximity_check'))
                    <span class="help-block">
                        <strong>{{ $errors->first('proximity_check') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {!! Form::submit(trans('general.forms.buttons.create'), [
                    'class' => 'btn btn-primary',
                ])!!}
                {!! Html::link(route('activity.index'), trans('general.forms.buttons.cancel'), [
                    'class' => 'btn btn-default',
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection
