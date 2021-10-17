<?php namespace App\Services;

use App\Models\Note;

class NoteService {

	public static function saveNote($parentObject, $note)
	{
		$note->parent_object = class_basename($parentObject);
		$note->parent_id = $parentObject->id;
		$note->changed_by = Sentry::getUser()->id;

		$note->save();
	}

	public static function getNotes($parentObject)
	{
		return Note::where('parent_object', '=', class_basename($parentObject))
						->where('parent_id', '=', $parentObject->id)
						->orderBy('created_at', 'desc')
						->get();
	}

	public static function getNoteSettings($parentObject)
	{
		$settings = new \stdClass();
		$settings->parent_object = class_basename($parentObject);
		$settings->parent_id = $parentObject->id;
		$settings->redirectUrl = NoteService::getRedirectUrl($parentObject);

		return $settings;
	}

	private static function getRedirectUrl($object)
	{
		$url = "";

		switch (class_basename($object)) {
			case 'Client':
				$url = \URL::route('clients.view', $object->id);
				break;

			case 'ClientContact':
				$url = \URL::route('clients.viewcontact', $object->id);
				break;

			case 'Candidate':
				$url = \URL::route('candidates.view', $object->id);
				break;
			
			default:
				$url = "";
				break;
		}

		return $url;
	}

}