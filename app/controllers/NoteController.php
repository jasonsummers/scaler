<?php

use App\Models\Note;
use App\Services\DataBinders\NoteBinder;
use App\Services\Validators\NoteValidator;

class NoteController extends BaseController {

	public function saveNote()
	{
		$note = new Note();

		NoteBinder::bindToInput($note);

		$validator = new NoteValidator($note->toArray());

		$note->changed_by = Sentry::getUser()->id;
		$note->save();

		return Redirect::to(Input::get('redirect_url'));
	}
}