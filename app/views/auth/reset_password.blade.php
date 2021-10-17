@extends('layouts.master')

@section('title')
	Reset Password
@endsection

@section('content')
	
	{{ Form::open(array('url' => 'resetpassword/'.$resetCode)) }}

		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password') }}
		{{ $errors->first('password') }}

		{{ Form::label('password_confirmation', 'Confirm Password:') }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation') }}

		{{ Form::token() }}

		{{ Form::submit('Change Password') }}

	{{ Form::close() }}

@endsection