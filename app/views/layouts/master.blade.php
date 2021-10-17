<!DOCTYPE HTML>
<html>

	<head>
		<title>@yield('title')</title>
        
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  

		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />

        @section('inlinecss')
        @show
	</head>

	<body>
		<div id="container">

			<div id="header">
				

			  <div id="headerNav">
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
				</div>
			</div>

			<div id="content">
				@section('content')
				@show
			</div>

		</div>
	</body>

</html>