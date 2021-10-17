<!DOCTYPE HTML>
<html>
	<head>
		<title>@yield('title')</title>

		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
        
        @yield('inlinecss')
        
	</head>

	<body>
    
    	@yield('content')
    
    </body>
</html>