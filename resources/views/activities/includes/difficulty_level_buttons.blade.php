@php($difficultyLevelOptionsClasses = [1 => 'success', 2 => 'warning', 3 => 'danger'])
@foreach($difficultyLevelOptions as $optValue => $optLabel)
    {!! Form::button($optLabel, [
        'class' => 'btn btn-' . $difficultyLevelOptionsClasses[$optValue] . ( ( $optValue == $difficultyLevel  ) ? ' active' : '' ),
        'data-value' => $optValue,
    ]) !!}
@endforeach
