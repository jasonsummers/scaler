<?php

use App\Models\Client;
use App\Models\ClientContact;
use App\Services\ReferenceData;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('test', function(){
	var_dump(ReferenceData::Titles());
});

// Landing Page
Route::get('/', array('before' => 'auth', function() {

	return View::make('home');

}));

// Authentication and Authorisation Routes - All Public
Route::get('login', function() {
	return View::make('auth.login');
});
Route::post('login', array('uses' => 'AuthController@postLogin', 'before' => 'csrf'));
Route::get('logout', array('uses' => 'AuthController@getLogout'));
Route::get('forgottenpassword', function() {
	return View::make('auth.forgotten_password');
});
Route::post('forgottenpassword', array('uses' => 'AuthController@postForgottenPassword', 'before' => 'csrf'));
Route::get('resetpassword/{resetCode}', function($resetCode) {
	return View::make('auth.reset_password')->with('resetCode', $resetCode);
});
Route::post('resetpassword/{resetCode}', array('uses' => 'AuthController@postResetPassword', 'before' => 'csrf'));

// User Administration Routes
Route::group(array('before' => array('auth','authAdmin')), function()
{
	Route::get('users', function() {
		return View::make('auth.user_list');
	});
	Route::get('users/create', function() {
		return View::make('auth.create_user');
	});
	Route::post('users/create', array('uses' => 'AuthController@postCreateUser', 'before' => 'csrf'));
	Route::get('users/view/{id}', array('uses' => 'AuthController@getViewUser'));
	Route::post('users/update', array('uses' => 'AuthController@postUpdateUser', 'before' => 'csrf'));
});

// User Super User Routes
Route::group(array('before' => 'authSuperAdmin'), function()
{
	Route::get('su', function() {
		return View::make('su');
	});
	Route::post('su/disable', array('uses' => 'SuController@disableApplication', 'before' => 'csrf'));
	Route::post('su/enable', array('uses' => 'SuController@enableApplication', 'before' => 'csrf'));
});

// Clients
Route::group(array('before' => 'auth'), function ()
{
	Route::get('clients', array('as' => 'clients', function() {
		return View::make('clients.main');
	}));
	Route::get('client/new', array('as' => 'clients.new', function() {
		return View::make('clients.new_client');
	}));
	Route::get('client/{id}', array('as' => 'clients.view', 'uses' => 'ClientController@getClient'));
	Route::post('client/save', array('as' => 'clients.save', 'uses' => 'ClientController@saveClient', 'before' => 'csrf'));
	Route::get('client/{id}/newcontact', array('as' => 'clients.newcontact', function($id) {
		$client = Client::find($id);
		return View::make('clients.new_contact')->with('client', $client);
	}));
	Route::get('client/contact/{id}', array('as' => 'clients.viewcontact', 'uses' => 'ClientController@getClientContact'));
	Route::post('client/savecontact', array('as' => 'clients.savecontact', 'uses' => 'ClientController@saveClientContact', 'before' => 'csrf'));
});

// Candidates
Route::group(array('before' => 'auth'), function()
{
	Route::get('candidates', array('as' => 'candidates', function() {
		return View::make('candidates.main');
	}));
	Route::get('candidate/new', array('as' => 'candidates.new', function() {
		return View::make('candidates.new_candidate');
	}));
	Route::get('candidate/{id}', array('as' => 'candidates.view', 'uses' => 'CandidateController@getCandidate'));
	Route::post('candidate/save', array('as' => 'candidates.save', 'uses' => 'CandidateController@saveCandidate'));
});

// Notes
Route::post('notes/save', array('as' => 'notes.save', 'before' => array('auth', 'csrf'), 'uses' => 'NoteController@saveNote'));