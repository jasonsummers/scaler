@extends('clients.main')

@section('title')
Clients | {{ $client->name }} | New Contact
@endsection

@section('appWindow')
@parent
	{{ Form::open(array('route' => 'clients.savecontact')) }}
	
		@include('clients.forms.clientcontact')

		{{ Form::hidden('client_id', $client->id) }}

		{{ Form::token() }}

		{{ Form::submit('Save') }}

	{{ Form::close() }}

@endsection