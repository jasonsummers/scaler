@extends('layouts.master')

@section('title')
	Forgotten Password
@endsection

@section('content')

	{{ Form::open(array('url' => 'users/create')) }}

		Please enter your username

		{{ Form::label('username', 'Username:') }}
		{{ Form::text('username') }}
		{{ $errors->first('username') }}

		{{ From::submit('Reset Password') }}

		{{ Form::token() }}

	{{ Form::close() }}

@endsection