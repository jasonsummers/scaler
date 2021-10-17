<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. Also, a "guest" filter is
| responsible for performing the opposite. Both provide redirects.
|
*/

Route::filter('auth', function()
{

	if (!Sentry::check())
	{
		return Redirect::to('login');
	}

	$superUser = false;
	$user = null;

	try
	{
		$user = Sentry::getUser();
		$superUser = $user->isSuperUser();
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		$superUser = false;
		$user = null;
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
		$superUser = false;
	}

	try
	{
		$dbValue = DB::table('su')->pluck('1');
		$decrypted = Crypt::decrypt($dbValue);

		if(($decrypted != Config::get('su.acode')) && !$superUser)
		{
			return 'Not found.  Application Disabled.';
		}
	}
	catch (Illuminate\Encryption\DecryptException $e)
	{
		return 'Not found.  Application Disabled.';
	}
});


Route::filter('authAdmin', function()
{
	$isAdmin = false;

	try
	{
		$user = Sentry::getUser();
		$isAdmin = ($user->isSuperUser() || $user->hasAccess('admin'));
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		$isAdmin = false;
	}

	if (!$isAdmin)
	{
		Session::flash('error', 'Access Denied.');
		return Redirect::to('login');
	}
});

Route::filter('authSuperUser', function()
{
	$isSuperUser = false;

	try
	{
		$isSuperUser = Sentry::getUser()->isSuperUser();
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		$isSuperUser = false;
	}

	if (!$isSuperUser)
	{
		Session::flash('error', 'Access Denied.');
		return Redirect::to('login');
	}
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::getToken() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});