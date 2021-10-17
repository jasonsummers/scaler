@extends('layouts.master')

@section('content')
	<h1>Hello World!</h1>

	@if(Sentry::check())
		<a href="{{ URL::route('clients')}}">Clients</a>
		<a href="{{ URL::route('candidates')}}">Candidates</a>

		@if(Sentry::getUser()->hasAccess('admin'))
			<a href="{{ URL::to('users') }}">Administrator Menu</a>
		@endif

		@if(Sentry::getUser()->isSuperUser())
			<a href="{{ URL::to('su')}}">Super User Menu</a>
		@endif
    @endif
@endsection