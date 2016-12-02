@extends('layouts.app')

@section('header-scripts')
<script>
    window.zooGeolocationOptions = <?php echo json_encode(App\ActivityItem::getZooGeolocationOptions()); ?>
</script>
@endsection

@section('footer-scripts')
<script src="{{ asset('js/create_activity_item.js') }}"></script>
<script src="//maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&amp;callback=initMap" async defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open([
            'url' => 'activity_items',
            'files' => true,
            'class' => 'form-horizontal',
            'role' => 'form',
        ]) !!}
            <div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', trans('general.forms.labels.title'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group">
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
                    <div class="input-group">
                        {!! Form::textarea('description', null, [
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
                    <div class="input-group">
                        {!! Form::select('type', App\ActivityItem::getQuestionTypeOptions(), null, [
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

            <div class="form-group{{ $errors->has('zoo') ? ' has-error' : '' }}">
                {!! Form::label('zoo', trans('general.forms.labels.zoo'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group">
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

            <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                {!! Form::label('language', trans('general.forms.labels.language'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group">
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

            <div class="form-group{{ ( $errors->has('latitude') || $errors->has('longitude') ) ? ' has-error' : '' }}">
                {!! Form::label('location', trans('general.forms.labels.location'), [
                    'class' => 'col-md-4 control-label',
                ]) !!}
                <div class="col-md-6">
                    <div class="input-group">
                        {!! Form::text('latitude', null, [
                            'class' => 'form-control',
                            'id' => 'latitude',
                        ]) !!}
                        {!! Form::text('longitude', null, [
                            'class' => 'form-control',
                            'id' => 'longitude',
                        ]) !!}

                        <div id="map" style="width:320px;height:240px;"></div>

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
</div>
@endsection
