@extends('candidates.main')

@section('title')
Candidates | {{ $candidate->name }}
@endsection

@section('appWindow')

	{{ Form::model($candidate, array('route' => 'candidates.save')) }}

		@include('candidates.forms.candidate')

		{{ Form::hidden('id', $candidate->id) }}

		{{ Form::token() }}

		{{ Form::submit('save') }}

	{{ Form::close() }}

	Created: {{ $candidate->created_at }}
	Updated: {{ $candidate->updated_at }}
	Last Change By: {{ $candidate->lastChangedByUser->name }}

	@include('notes')

@endsection