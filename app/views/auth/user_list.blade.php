@extends('layouts.app_main')

@section('title')
User List
@endsection

@section('leftNav')

	<ul>

		<li><a href="{{ URL::to('/users/create') }}">Create New User</a></li>

	@foreach($users as $user)

		<li><a href="{{  URL::to('users/view', array('id' => $user->id)) }}">{{ $user->name }}</a></li>

	@endforeach

	<ul>

@endsection