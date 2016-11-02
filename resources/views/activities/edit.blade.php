@extends('layouts.app')

@section('header-styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/css/ion.rangeSlider.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/css/ion.rangeSlider.skinFlat.min.css" rel="stylesheet">
@endsection

@section('header-scripts')
<script>
    window.onload = function() {
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.4/js/ion.rangeSlider.min.js')
            .done(function() {
                $('#difficulty_level').ionRangeSlider({
                    onChange: function(data) {
                        $('input[name="difficulty_level_start"]').val(data.from);
                        $('input[name="difficulty_level_end"]').val(data.to);
                    }
                });
            });
    };
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open([
            'url' => 'activities/' . $activity->id,
            'files' => true,
            'class' => 'form-horizontal',
            'role' => 'form',
            'method' => 'put'
        ]) !!}
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                {!! Form::label('type', trans('general.forms.labels.activity-type'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group">
                        {!! Form::select('type', Activity::getActivityTypeOptions(), $activity->type, [
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
                    <div class="input-group">
                        {!! Form::text('title', $activity->title, [
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
                    <div class="input-group">
                        {!! Form::textarea('description', $activity->description, [
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
                    <div class="input-group">
                        {!! Form::hidden('difficulty_level', '', [
                            'id' => 'difficulty_level',
                            'class' => 'form-control',
                            'data-type' => 'double',
                            'data-min' => Activity::getDifficultyLevelMinimum(),
                            'data-max' => Activity::getDifficultyLevelMaximum(),
                            'data-from' => $activity->difficulty_level_start,
                            'data-to' => $activity->difficulty_level_end,
                            'data-step' => 1,
                            'data-grid' => 'true',
                            'data-grid-num' => 11,
                        ]) !!}
                        {!! Form::number('difficulty_level_start', $activity->difficulty_level_start, [
                            'class' => 'form-control',
                            'min' => Activity::getDifficultyLevelMinimum(),
                            'max' => Activity::getDifficultyLevelMaximum(),
                            'style' => 'display:none;',
                        ]) !!}
                        {!! Form::number('difficulty_level_end', $activity->difficulty_level_end, [
                            'class' => 'form-control',
                            'min' => Activity::getDifficultyLevelMinimum(),
                            'max' => Activity::getDifficultyLevelMaximum(),
                            'style' => 'display:none;',
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
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="mdi mdi-timer" aria-hidden="true"></i>
                        </span>
                        {!! Form::number('playing_time', $activity->playing_time, [
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
                {!! Form::label('language', trans('general.forms.labels.language'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="mdi mdi-translate" aria-hidden="true"></i>
                        </span>
                        {!! Form::select('language', Activity::getLanguageOptions(), $activity->language, [
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
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="mdi mdi-contact-mail" aria-hidden="true"></i>
                        </span>
                        {!! Form::text('contact_information', $activity->contact_information, [
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
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="mdi mdi-image" aria-hidden="true"></i>
                        </span>
                        {!! Form::file('featured_image', [
                            'class' => 'form-control',
                        ]) !!}
                    </div>

                    <p class="help-block">
                        @if ($activity->hasFeaturedImage())
                            <img src="{!! $activity->getFeaturedImageUrl() !!}" alt="featured_image" class="img-rounded pull-left" style="height:64px;width:64px;margin-right:10px;">
                        @endif
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
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                        </span>
                        {!! Form::select('zoo', Activity::getZooOptions(), $activity->zoo, [
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

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {!! Form::submit(trans('general.forms.buttons.save'), [
                        'class' => 'btn btn-primary',
                    ])!!}
                    {!! Html::link(route('activity.index'), trans('general.forms.buttons.cancel'), [
                        'class' => 'btn btn-default',
                    ]) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
