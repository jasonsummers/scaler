@extends('clients.main')

@section('title')
Clients | New
@endsection

@section('appWindow')
@parent

	{{ Form::open(array('route' => 'clients.save')) }}
	
		<section class="loginform cf">
			@include('clients.forms.client')

			{{ Form::token() }}

			{{ Form::submit('Save') }}
		</section>

	{{ Form::close() }}

@endsection