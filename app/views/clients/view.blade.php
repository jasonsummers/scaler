@extends('clients.main')

@section('title')
Clients | {{ $client->name }}
@endsection

@section('appWindow')
@parent
<div>
	{{ Form::model($client, array('route' => 'clients.save')) }}
		<section class="loginform cf">
			@include('clients.forms.client')

			{{ Form::hidden('id', $client->id )}}

			{{ Form::token() }}
			<div style="display:block;clear:both">
			{{ Form::submit('Save') }}<br />


	{{ Form::close() }}

	Created: {{ $client->created_at }}<br />
	Updated: {{ $client->updated_at }}<br />
	Last Change By: {{ $client->lastChangedByUser->name }}
</div>
	</section>
</div>
	@include('notes')

@endsection