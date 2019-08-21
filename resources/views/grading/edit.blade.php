@extends('layouts.app')

@section('footer-scripts')
<script>

</script>
<script src="{{ elixir('js/edit_grading.js') }}"></script>
@endsection

@section('content')
<div class="container">
    {!! Form::open([
        'url' => 'grading/' . $answer->id,
        'files' => true,
        'class' => 'form-horizontal activity-edit',
        'role' => 'form',
        'method' => 'put',
        'data-unload-protection' => 'true',
    ]) !!}
        <div id="grading-container"></div>
    {!! Form::close() !!}
</div>
@endsection
