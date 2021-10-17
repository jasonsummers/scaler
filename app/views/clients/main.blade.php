@extends('layouts.app_main')

@section('title')
Clients
@endsection

@section('leftNav')

	<ul>

		<li><a href="{{ URL::route('clients.new') }}">Create New Client</a></li>

	@foreach($clients as $c)

		<li><a href="{{ URL::route('clients.view', array('id' => $c->id)) }}">{{ $c->name }}</a></li>

	@endforeach

	</ul>

@endsection

@section('appWindow')
	<div id="clientNav">
		@include('clients.clientnav')
	</div>
@endsection