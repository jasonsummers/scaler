@extends('layouts.master')

@section('content')
	<h1>Site Enable / Disable</h1>
	//insert some stuff here
	{{ Form::open(array('url' => 'su/disable')) }}

		{{ Form::submit('Disable Site') }}

		{{ Form::token() }}

	{{ Form::close() }}

	{{ Form::open(array('url' => 'su/enable')) }}

		{{ Form::submit('Enable Site') }}

		{{ Form::token() }}

	{{ Form::close() }}

	<h1>Export Database</h1>
	//some more stuff here

	<h1>Purge database</h1>
	//This is some really nasty shit
@endsection