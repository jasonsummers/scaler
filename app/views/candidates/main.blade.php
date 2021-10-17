@extends('layouts.app_main')

@section('title')
Candidates
@endsection

@section('leftNav')

	<ul>

		<li><a href="{{ URL::route('candidates.new') }}">Create New Candidate</a></li>

	@foreach($candidates as $c)

		<li><a href="{{  URL::route('candidates.view', array('id' => $c->id)) }}">{{ $c->name }}</a></li>

	@endforeach

	<ul>

@endsection