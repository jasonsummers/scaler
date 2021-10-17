@extends('auth.user_list');

@section('title')
Users | {{ $user->name }}
@endsection

@section('appWindow')

	{{ Form::model($user, array('url' => 'users/update')) }}

		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name') }}
		{{ $errors->first('first_name') }}

		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name') }}
		{{ $errors->first('last_name') }}

		{{ Form::label('username', 'Username:') }}
		{{ Form::text('username') }}
		{{ $errors->first('username') }}

		Change the users Email Address:

		{{ Form::label('email', 'Email Address:') }}
		{{ Form::text('email') }}
		{{ $errors->first('email') }}

		{{ Form::label('email_confirmation', 'Confirm Email Address:') }}
		{{ Form::text('email_confirmation', $user->email) }}
		{{ $errors->first('email_confirmation') }}

		Change the users Password: (Password change functionality is disabled for now)

		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password') }}
		{{ $errors->first('password') }}

		{{ Form::label('password_confirmation', 'Confirm Password:') }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation') }}

		{{ Form::hidden('userId', $user->id) }}

		{{ Form::submit('Update User') }}

		{{ Form::token() }}

	{{ Form::close() }}

@endsection