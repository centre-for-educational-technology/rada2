@extends('layouts.app')

@section('header-scripts')
<script>
    window.Laravel.zooGeolocationOptions = <?php echo json_encode($zooGeolocationOptions); ?>;
    window.Laravel.activityItemQuestionData = <?php echo json_encode($questionData); ?>;
    window.Laravel.activityItemFormId = 'edit-activity-item';
    window.Laravel.activityItemAssetsBaseUrl = '<?php echo asset( 'uploads/images/' . $activity_item->getStoragePath() ); ?>';
    window.Laravel.hasImage = <?php echo json_encode($activity_item->hasImage()); ?>;
    window.Laravel.removedImages = <?php echo json_encode(old('removed-option-images') ? old('removed-option-images') : []); ?>;
    window.Laravel.removedImageMatches = <?php echo json_encode(old('removed-option-match-images') ? old('removed-option-match-images') : []); ?>;
    window.Laravel.map = <?php echo json_encode(['enableStreetView' => config('services.maps.google.enable_street_view'),]); ?>;
    window.Laravel.questionTypeConstants = {!! json_encode([
        'INFORMATION' => \App\Options\QuestionTypeOptions::INFORMATION,
        'ONE_CORRECT_ANSWER' => \App\Options\QuestionTypeOptions::ONE_CORRECT_ANSWER,
        'MULTIPLE_CORRECT_ANSWERS' => \App\Options\QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS,
        'FREEFORM_ANSWER' => \App\Options\QuestionTypeOptions::FREEFORM_ANSWER,
        'MATCH_PAIRS' => \App\Options\QuestionTypeOptions::MATCH_PAIRS,
        'EMBEDDED_CONTENT' => \App\Options\QuestionTypeOptions::EMBEDDED_CONTENT,
        'PHOTO' => \App\Options\QuestionTypeOptions::PHOTO,
        'MISSING_WORD' => \App\Options\QuestionTypeOptions::MISSING_WORD
    ]) !!};
    window.Laravel.translations = <?php echo json_encode([
        'pts' => trans('general.forms.placeholders.pts')
    ]); ?>;
</script>
@endsection

@section('footer-scripts')
@include('activity_items.includes.locales')
<script src="{{ elixir('js/create_edit_activity_item.js') }}"></script>
<script src="//maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&amp;callback=initMap" async defer></script>
@endsection

@section('content')
<div class="container">
    {!! Form::open([
        'url' => 'tasks/' . $activity_item->id,
        'files' => true,
        'class' => 'form-horizontal',
        'role' => 'form',
        'name' => 'edit-activity-item',
        'id' => 'edit-activity-item',
        'method' => 'put',
        'data-unload-protection' => 'true',
    ]) !!}
        @include('includes.readd-pictures-alert', [ 'errors' => $errors, ])
        <div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', trans('general.forms.labels.title'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::text('title', $activity_item->title, [
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
                        'ref' => 'image',
                    ]) !!}
                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" data-trigger="hover" data-container="body" title="{{ trans('general.forms.tooltips.remove-image') }}">
                        {!! Form::checkbox('remove_image', 1, false, [
                            'ref' => 'removeImage',
                            'v-bind:disabled' => 'canRemoveImage()',
                        ]) !!}
                    </span>
                    <span class="input-group-addon">
                        <a href="#" class="btn btn-warning btn-xs" v-on:click="resetImage" ref="removeImage" v-on:click="resetImage" v-bind:disabled="!canResetImage">
                            <i class="mdi mdi-delete" aria-hidden="true"></i>
                        </a>
                    </span>
                </div>

                <p class="help-block" data-loading-text="{{ trans('general.forms.alerts.image-loading-text') }}">
                    @if ($activity_item->hasImage())
                        <img src="{!! $activity_item->getImageUrl() !!}" alt="image" class="img-rounded pull-left sz-uploaded-image-preview">
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

        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            {!! Form::label('type', trans('general.forms.labels.question-type'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::hidden('type', $activity_item->type, [
                        'class' => 'form-control',
                    ]) !!}
                    {!! Form::select('type', $questionTypeOptions, $activity_item->type, [
                        'class' => 'form-control',
                        'disabled' => 'disabled'
                    ]) !!}
                </div>

                @if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description', trans('general.forms.labels.question-or-information'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::textarea('description', $activity_item->description, [
                        'class' => 'form-control',
                        'rows' => '3',
                        'placeholder' => trans('general.forms.placeholders.question-or-information'),
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('missing-word') ? ' has-error' : '' }}">
            <div class="col-md-6 col-md-offset-4">
                <div id="question-type-information" class="sz-question" v-if="questionType == {{ \App\Options\QuestionTypeOptions::INFORMATION }}">
                        <span class="help-block">
                            {{ trans('general.forms.help.question-types.information') }}
                        </span>
                </div>

                <one-correct-answer v-if="questionType == {{ \App\Options\QuestionTypeOptions::ONE_CORRECT_ANSWER }}"></one-correct-answer>

                <multiple-correct-answers v-if="questionType == {{ \App\Options\QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS }}"></multiple-correct-answers>

                <div id="question-type-freeform-answer" class="sz-question" v-if="questionType == {{ \App\Options\QuestionTypeOptions::FREEFORM_ANSWER }}">
                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.freeform-answer') }}
                    </span>
                </div>

                <match-pairs v-if="questionType == {{ \App\Options\QuestionTypeOptions::MATCH_PAIRS }}"></match-pairs>


                <div id="question-type-embedded-content" class="sz-question" v-if="questionType == {{ \App\Options\QuestionTypeOptions::EMBEDDED_CONTENT }}">
                    {!! Form::textarea('embedded-content', $activity_item->embedded_content, [
                        'class' => 'form-control',
                        'rows' => '3',
                        'placeholder' => trans('general.forms.placeholders.embedded-content'),
                    ]) !!}

                    <span class="help-block">
                            {{ trans('general.forms.help.question-types.embedded-content') }}
                        </span>
                </div>

                <div id="question-type-photo" class="sz-question" v-if="questionType == {{ \App\Options\QuestionTypeOptions::PHOTO }}">
                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.photo') }}
                    </span>
                </div>

                <div id="question-type-missing-word" class="sz-question" v-if="questionType == {{ \App\Options\QuestionTypeOptions::MISSING_WORD }}">
                    {!! Form::textarea('missing-word', $activity_item->missing_word, [
                        'class' => 'form-control',
                        'rows' => '3',
                        'placeholder' => trans('general.forms.placeholders.missing-word'),
                    ]) !!}

                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.missing-word') }}
                    </span>

                    @if ($errors->has('missing-word'))
                        <span class="help-block">
                            <strong>{{ trans('general.messages.error.missing-word') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

    <div v-if="questionType == {{ \App\Options\QuestionTypeOptions::MISSING_WORD }}">
        @include('activity_items.includes.points-element', [
        'points' => $activity_item->points,
        'pointsText' => 'maximum-points-available',
        'pointsDescription' => 'maximum-points-available-missing-word'
        ])
    </div>
    <div v-if="questionType != {{ \App\Options\QuestionTypeOptions::MISSING_WORD }}">
        @include('activity_items.includes.points-element', [
        'points' => $activity_item->points,
        'pointsText' => 'maximum-points-available'
        ])
    </div>

        <div class="form-group{{ ( $errors->has('answering_time') || $errors->has('answering_time') ) ? ' has-error' : '' }}">
            {!! Form::label('answering_time', trans('general.forms.labels.answering_time'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12 col-sm-8">
                    {!! Form::hidden('answering_time', $activity_item->answering_time, [
                        'ref' => 'answeringTime',
                    ]) !!}
                    <?php
                    $hours = [];
                    $minutes = [];
                    $seconds = [];
                    for($i=0; $i<100; $i++) {
                        if ($i<60) {
                            $seconds[] = $i;
                            $minutes[] = $i;
                        }
                        $hours[] = $i;
                    }
                    ?>
                    <div style="display: block; float: left; width: 29%;">
                        {!! Form::select('answering_time_hour', $hours, null, [
                            'class' => 'form-control answering-time',
                            'style' => 'display: table-cell; width: 70%;',
                        ]) !!}
                        {!! Form::label('answering_time_hour', trans('general.forms.labels.time.hour'), [
                            'class' => 'control-label answering-time-label'
                        ]) !!}
                    </div>
                    <div style="display: block; float: left; width: 29%;">
                        {!! Form::select('answering_time_minute', $minutes, null, [
                            'class' => 'form-control answering-time',
                            'style' => 'display: table-cell; width: 70%; border-radius: 0;'
                        ]) !!}
                        {!! Form::label('answering_time_minute', trans('general.forms.labels.time.minute'), [
                            'class' => 'control-label answering-time-label'
                        ]) !!}
                    </div>
                    <div style="display: block; float: left; width: 29%;">
                        {!! Form::select('answering_time_second', $seconds, null, [
                            'class' => 'form-control answering-time',
                            'style' => 'display: table-cell; width: 70%; border-radius: 0;'
                        ]) !!}
                        {!! Form::label('answering_time_second', trans('general.forms.labels.time.second'), [
                            'class' => 'control-label answering-time-label'
                        ]) !!}
                    </div>
                    <div style="display: block;float: left;width: 13%;border-right: 1px solid #ccc;border-radius: 3px;">
                        <span class="input-group-addon"
                              data-toggle="tooltip"
                              data-placement="left"
                              data-trigger="hover"
                              title="{{ trans('pages.activity-items.create-or-edit.tooltips.answering-time') }}"
                              style="height: 36px;"
                        >
                            {!! Form::checkbox('answering_time_check', 1, $activity_item->answering_time_check, [
                                'ref' => 'answeringTimeCheck',
                            ]) !!}
                        </span>
                    </div>
                </div>

                @if ($errors->has('answering_time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('answering_time') }}</strong>
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
                    {!! Form::select('language', $languageOptions, $activity_item->language, [
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

    <div class="form-group">
        {!! Form::label('is_flash', trans('general.forms.labels.is-flash'), [
            'class' => 'col-md-4 control-label',
            'for' => 'is-flash'
        ]) !!}
        <div class="col-md-6">
            <div class="input-group col-xs-12">
                {!! Form::checkbox('is_flash', 1, $activity_item->is_flash, [
                    'class' => 'is-flash-checkbox',
                    'id' => 'is_flash',
                    'style' => 'margin-top: 11px;'
                ]) !!}
            </div>
        </div>
    </div>

        <div class="form-group location-container{{ ( $errors->has('latitude') || $errors->has('longitude') ) ? ' has-error' : '' }}">
            {!! Form::label('location', trans('general.forms.labels.location'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::hidden('latitude', $activity_item->latitude, [
                        'class' => 'form-control',
                        'id' => 'latitude',
                    ]) !!}
                    {!! Form::hidden('longitude', $activity_item->longitude, [
                        'class' => 'form-control',
                        'id' => 'longitude',
                    ]) !!}

                    <div id="map" style="width:100%;height:320px;"></div>

                    <p class="help-block">
                        {{ trans('general.forms.help.map') }}
                    </p>
                </div>

                @if ($errors->has('latitude'))
                    <span class="help-block">
                        <strong>{{ $errors->first('latitude') }}</strong>
                    </span>
                @endif

                @if ($errors->has('longitude'))
                    <span class="help-block">
                        <strong>{{ $errors->first('longitude') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('access_code_clues') ? ' has-error' : '' }}">
            {!! Form::label('access_code_clues', trans('general.forms.labels.access-code-clues'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::text('access_code_clues', $activity_item->access_code_clues, [
                        'class' => 'form-control',
                        'placeholder' => trans('general.forms.placeholders.access-code-clues'),
                    ]) !!}
                </div>

                @if ($errors->has('access_code_clues'))
                    <span class="help-block">
                        <strong>{{ $errors->first('access_code_clues') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('access_code') ? ' has-error' : '' }}">
            {!! Form::label('access_code', trans('general.forms.labels.access-code'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::text('access_code', $activity_item->access_code, [
                        'class' => 'form-control',
                        'placeholder' => trans('general.forms.placeholders.access-code'),
                    ]) !!}
                </div>

                @if ($errors->has('access_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('access_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('read_more') ? ' has-error' : '' }}">
            {!! Form::label('read_more', trans('general.forms.labels.read-more'), [
                'class' => 'col-md-4 control-label',
            ]) !!}
            <div class="col-md-6">
                <div class="input-group col-xs-12">
                    {!! Form::url('read_more', $activity_item->read_more, [
                        'class' => 'form-control',
                        'placeholder' => trans('general.forms.placeholders.read-more'),
                    ]) !!}
                </div>

                @if ($errors->has('read_more'))
                    <span class="help-block">
                        <strong>{{ $errors->first('read_more') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="alert alert-info hidden submit-loading-text">
                    {{ trans('general.forms.alerts.form-submit-loading-text') }}
                </div>
                {!! Form::submit(trans('general.forms.buttons.save'), [
                    'class' => 'btn btn-primary btn-bypass-unload-protection',
                ])!!}
                {!! Html::link(route('activity_item.index'), trans('general.forms.buttons.cancel'), [
                    'class' => 'btn btn-default btn-bypass-unload-protection',
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection
