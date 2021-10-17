<?php

use App\Models\Client;
use App\Models\ClientContact;
use App\Models\Candidate;
use App\Services\ReferenceData;

View::composer('auth.user_list', function($view)
{
	$usersGroup = Sentry::getGroupProvider()->findByName('Users');
	$adminGroup = Sentry::getGroupProvider()->findByName('Admins');

	$users = Sentry::getUserProvider()->findAllInGroup($adminGroup);
	$users += Sentry::getUserProvider()->findAllInGroup($usersGroup);

    $view->with('users', $users);
});

View::composer('clients.main', function($view)
{

	$clients = Client::all();

	$view->with('clients', $clients);

});

View::composer('clients.clientnav', function($view)
{
	
	if(isset($view->client))
	{
		$view->with('clientNav', $view->client);
	}
	else
	{
		if(isset($view->contact))
		{
			$view->with('clientNav', $view->contact->client);
		}
		else
		{
			$view->with('clientNav', null);
		}
	}
	
});

View::composer('clients.forms.client', function($view)
{
	$countriesLookup = ReferenceData::Countries();
	$prioritiesLookup = ReferenceData::ClientPriorities();
	$usersLookup = ReferenceData::UserList();
	$industriesLookup = ReferenceData::Industries();

	$view->with('countriesLookup', $countriesLookup)->with('prioritiesLookup', $prioritiesLookup)
			->with('usersLookup', $usersLookup)->with('industriesLookup', $industriesLookup);

	if(!isset($view->client))
	{
		$view->with('client', null);
	}
});

View::composer('clients.forms.clientcontact', function($view)
{
	$titlesLookup = ReferenceData::Titles();
	$prioritiesLookup = ReferenceData::ClientContactPriorities();
	$usersLookup = ReferenceData::UserList();

	$view->with('titlesLookup', $titlesLookup)->with('prioritiesLookup', $prioritiesLookup)
			->with('usersLookup', $usersLookup);

	if(!isset($view->contact))
	{
		$view->with('contact', null);
	}
});

View::composer('candidates.main', function($view)
{
	$candidates = Candidate::all();

	$view->with('candidates', $candidates);
});

View::composer('candidates.forms.candidate', function($view)
{
	$titlesLookup = ReferenceData::Titles();
	$countriesLookup = ReferenceData::Countries();
	$currenciesLookup = ReferenceData::Currencies();
	$educationLookup = ReferenceData::Education();
	$prioritiesLookup = ReferenceData::CandidatePriorities();
	$usersLookup = ReferenceData::UserList();

	if (!isset($view->candidate))
	{
		$view->with('candidate', null);
	}

	$view->with('titlesLookup', $titlesLookup)->with('countriesLookup', $countriesLookup)
			->with('currenciesLookup', $currenciesLookup)->with('educationLookup', $educationLookup)
			->with('prioritiesLookup', $prioritiesLookup)->with('usersLookup', $usersLookup);
});