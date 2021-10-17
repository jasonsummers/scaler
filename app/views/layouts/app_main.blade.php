@extends('layouts.master')

@section('content')

	<div id="leftNav">
		@yield('leftNav')
	</div>

	<div id="appWindow">		

		@include('notifications')

		@section('appWindow')
		@show
		
	</div>

@endsection