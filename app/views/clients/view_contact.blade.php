@extends('clients.main')

@section('title')
Clients | {{ $contact->client->name }} | {{ $contact->name }}
@endsection

@section('appWindow')
@parent
	{{ Form::model($contact, array('route' => 'clients.savecontact')) }}
	
		@include('clients.forms.clientcontact')

		{{ Form::hidden('id', $contact->id) }}

		{{ Form::token() }}

		{{ Form::submit('Save') }}

	{{ Form::close() }}

	Created: {{ $contact->created_at }}
	Updated: {{ $contact->updated_at }}
	Last Change By: {{ $contact->lastChangedByUser->name }}

	@include('notes')

@endsection