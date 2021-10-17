@extends('candidates.main')

@section('title')
Candidates | New
@endsection

@section('appWindow')

	{{ Form::open(array('route' => 'candidates.save')) }}

		@include('candidates.forms.candidate')

		{{ Form::token() }}

		{{ Form::submit('save') }}

	{{ Form::close() }}

@endsection