@extends('layouts.auth_layout')

@section('title')
	Login
@endsection

@section('inlinecss')
<style type="text/css">
#Companydb
{
	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	color: #999;
	font-size: 15pt;
}


</style>

@endsection

@section('content')

	@include('notifications')
	
<section class="loginform cf">
    <img src="{{ asset('img/logo.jpg') }}" width="430" height="72"  alt=""/>
    <div id="Companydb">Company Database</div><p>
    
    
    	{{ Form::open(array('url' => 'login')) }}
        <ul>
            <li>
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username') }}
            {{ $errors->first('username') }}
            </li>
    
            <li>
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password') }}
                {{ $errors->first('password') }}
            </li>
    
            <li>
                {{ Form::submit('Login') }}
            </li>
        </ul>
		{{ Form::token() }}

	{{ Form::close() }}
    
    </p>
    </section>

@endsection