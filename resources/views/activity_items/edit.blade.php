@extends('layouts.app')

@section('header-scripts')
<script>
    window.Laravel.zooGeolocationOptions = <?php echo json_encode(App\ActivityItem::getZooGeolocationOptions()); ?>;
    window.Laravel.activityItemQuestionData = <?php echo json_encode($activity_item->getQuestionData()); ?>;
    window.Laravel.activityItemFormId = 'edit-activity-item';
    window.Laravel.activityItemAssetsBaseUrl = '<?php echo asset( 'uploads/images/' . $activity_item->getStoragePath() ); ?>';
</script>
@endsection

@section('footer-scripts')
<script src="{{ asset('js/create_edit_activity_item.js') }}"></script>
<script src="//maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&amp;callback=initMap" async defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open([
            'url' => 'activity_items/' . $activity_item->id,
            'files' => true,
            'class' => 'form-horizontal',
            'role' => 'form',
            'name' => 'edit-activity-item',
            'id' => 'edit-activity-item',
            'method' => 'put'
        ]) !!}
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

            <div class="form-group">
                {!! Form::label('description', trans('general.forms.labels.description'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group col-xs-12">
                        {!! Form::textarea('description', $activity_item->description, [
                            'class' => 'form-control',
                            'rows' => '3',
                        ]) !!}
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                {!! Form::label('type', trans('general.forms.labels.question-type'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group col-xs-12">
                        {!! Form::select('type', App\ActivityItem::getQuestionTypeOptions(), $activity_item->type, [
                            'class' => 'form-control',
                            'disabled' => 'disabled'
                        ]) !!}
                    </div>

                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif

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
                        {!! Form::select('zoo', Activity::getZooOptions(), $activity_item->zoo, [
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

            <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                {!! Form::label('language', trans('general.forms.labels.language'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group col-xs-12">
                        <span class="input-group-addon">
                            <i class="mdi mdi-translate" aria-hidden="true"></i>
                        </span>
                        {!! Form::select('language', Activity::getLanguageOptions(), $activity_item->language, [
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
</div>
@endsection
