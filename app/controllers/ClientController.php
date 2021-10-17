<?php

use App\Models\Client;
use App\Services\Validators\ClientValidator;
use App\Services\Validators\ClientContactValidator;
use App\Models\ClientContact;
use App\Services\DataBinders\ClientBinder;
use App\Services\DataBinders\ClientContactBinder;
use App\Services\NoteService;

class ClientController extends BaseController {

	public function saveClient()
	{
		$id = Input::get('id');
		$isNew = $id == "";
		$client;

		if ($isNew)
		{
			$client = new Client();
		}
		else
		{
			$client = Client::find($id);
		}
		
		ClientBinder::bindToInput($client);

		$validator = new ClientValidator($client->toArray());

		if(!$validator->passes())
		{
			if($isNew)
			{
				return Redirect::route('clients.new')->withErrors($validator->errors)->withInput();
			}
			else
			{
				return Redirect::route('clients.view', $client->id)->withErrors($validator->errors)->withInput();
			}
		}

		$client->changed_by = Sentry::getUser()->id;

		$client->save();

		return Redirect::route('clients');
	}

	public function getClient($id)
	{
		$client = Client::find($id);
		$notes = NoteService::getNotes($client);
		$noteSettings = NoteService::getNoteSettings($client);
		
		return View::make('clients.view')->with('client', $client)->with('notes', $notes)
											->with('noteSettings', $noteSettings);
	}

	public function saveClientNote()
	{
		$id = Input::get('id');
		$client = Client::find($id);

		$note = new Note();

		NoteBinder::bindToInput($note);

		$validator = new NoteValidator($note->toArray());

		NoteService::SaveNote($client, $note);

		return Redirect::route('clients.view', $id);
	}

	public function saveClientContact()
	{
		$id = Input::get('id');
		$isNew = $id == "";
		$contact;

		if ($isNew)
		{
			$contact = new ClientContact();
		}
		else
		{
			$contact = ClientContact::find($id);
		}
		
		ClientContactBinder::bindToInput($contact);

		$validator = new ClientContactValidator($contact->toArray());

		if(!$validator->passes())
		{
			if($isNew)
			{
				return Redirect::route('clients.newcontact', Input::get('client_id'))->withErrors($validator->errors)->withInput();
			}
			else
			{
				return Redirect::route('clients.viewcontact', $contact->id)->withErrors($validator->errors)->withInput();
			}
		}

		$contact->changed_by = Sentry::getUser()->id;

		if(!$isNew)
		{
			$contact->save();
		}
		else
		{
			$client = Client::find(Input::get('client_id'));
			$client->contacts()->save($contact);
		}

		return Redirect::route('clients.viewcontact', $contact->id);
	}

	public function getClientContact($id)
	{
		$contact = ClientContact::find($id);
		$notes = NoteService::getNotes($contact);
		$noteSettings = NoteService::getNoteSettings($contact);
		
		return View::make('clients.view_contact')->with('contact', $contact)->with('notes', $notes)
											->with('noteSettings', $noteSettings);
	}

	public function saveClientContactNote()
	{
		$id = Input::get('id');
		$contact = ClientContact::find($id);$note = new Note();

		$note = new Note();

		NoteBinder::bindToInput($note);

		$validator = new NoteValidator($note->toArray());

		NoteService::SaveNote($client, $note);

		return Redirect::route('clients.viewcontact', $id);
	}
}