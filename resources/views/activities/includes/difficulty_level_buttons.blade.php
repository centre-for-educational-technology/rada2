@php($difficultyLevelOptionsClasses = [1 => 'success', 2 => 'warning', 3 => 'danger'])
@foreach($difficultyLevelOptions as $optValue => $optLabel)
    <div class="btn-group" role="group">
        {!! Form::button($optLabel, [
            'class' => 'btn btn-' . $difficultyLevelOptionsClasses[$optValue] . ( ( $optValue == $difficultyLevel  ) ? ' active' : '' ),
            'data-value' => $optValue,
            'role' => 'button'
        ]) !!}
    </div>
@endforeach
