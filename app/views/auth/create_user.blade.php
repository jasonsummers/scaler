@extends('layouts.app_main');

@section('title')
Create New User
@endsection

@section('appWindow')

	{{ Form::open(array('url' => 'users/create')) }}

		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name') }}
		{{ $errors->first('first_name') }}

		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name') }}
		{{ $errors->first('last_name') }}

		{{ Form::label('username', 'Username:') }}
		{{ Form::text('username') }}
		{{ $errors->first('username') }}

		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password') }}
		{{ $errors->first('password') }}

		{{ Form::label('password_confirmation', 'Confirm Password:') }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation') }}

		{{ Form::label('email', 'Email Address:') }}
		{{ Form::text('email') }}
		{{ $errors->first('email') }}

		{{ Form::label('email_confirmation', 'Confirm Email Address:') }}
		{{ Form::text('email_confirmation') }}
		{{ $errors->first('email_confirmation') }}

		{{ Form::submit('Create User') }}

		{{ Form::token() }}

	{{ Form::close() }}

@endsection