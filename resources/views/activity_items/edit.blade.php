@extends('layouts.app')

@section('header-scripts')
<script>
    window.Laravel.zooGeolocationOptions = <?php echo json_encode($zooGeolocationOptions); ?>;
    window.Laravel.activityItemQuestionData = <?php echo json_encode($questionData); ?>;
    window.Laravel.activityItemFormId = 'edit-activity-item';
    window.Laravel.activityItemAssetsBaseUrl = '<?php echo asset( 'uploads/images/' . $activity_item->getStoragePath() ); ?>';
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
        'url' => 'activity_items/' . $activity_item->id,
        'files' => true,
        'class' => 'form-horizontal',
        'role' => 'form',
        'name' => 'edit-activity-item',
        'id' => 'edit-activity-item',
        'method' => 'put'
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
                    ]) !!}
                </div>

                <p class="help-block">
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

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div id="question-type-information" class="sz-question" v-if="questionType == 1">
                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.information') }}
                    </span>
                </div>

                <one-correct-answer v-if="questionType == 2"></one-correct-answer>

                <multiple-correct-answers v-if="questionType == 3"></multiple-correct-answers>

                <div id="question-type-freeform-answer" class="sz-question" v-if="questionType == 4">
                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.freeform-answer') }}
                    </span>
                </div>

                <match-pairs v-if="questionType == 5"></match-pairs>


                <div id="question-type-embedded-content" class="sz-question" v-if="questionType == 6">
                    {!! Form::textarea('embedded-content', $activity_item->embedded_content, [
                        'class' => 'form-control',
                        'rows' => '3',
                        'placeholder' => trans('general.forms.placeholders.embedded-content'),
                    ]) !!}

                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.embedded-content') }}
                    </span>
                </div>

                <div id="question-type-photo" class="sz-question" v-if="questionType == 7">
                    <span class="help-block">
                        {{ trans('general.forms.help.question-types.photo') }}
                    </span>
                </div>
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
                    @php ( $zooSelectOptions = [ 'class' => 'form-control'] )
                    @cannot('changeZoo', $activity_item)
                        @php ( $zooSelectOptions['disabled'] = true )
                    @endcannot
                    {!! Form::select('zoo', $zooOptions, $activity_item->zoo, $zooSelectOptions) !!}
                </div>

                @if ($errors->has('zoo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zoo') }}</strong>
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

        <div class="form-group{{ ( $errors->has('latitude') || $errors->has('longitude') ) ? ' has-error' : '' }}">
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
                {!! Form::submit(trans('general.forms.buttons.save'), [
                    'class' => 'btn btn-primary',
                ])!!}
                {!! Html::link(route('activity_item.index'), trans('general.forms.buttons.cancel'), [
                    'class' => 'btn btn-default',
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection
