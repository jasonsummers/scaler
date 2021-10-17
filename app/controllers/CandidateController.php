<?php

use App\Models\Candidate;
use App\Services\Validators\CandidateValidator;
use App\Services\DataBinders\CandidateBinder;
use App\Services\NoteService;
use Carbon\Carbon;

class CandidateController extends BaseController {

	public function saveCandidate()
	{
		$id = Input::get('id');
		$isNew = $id == "";
		$hasErrors = false;

		$candidate = $isNew ? new Candidate() : Candidate::find($id);

		try
		{
			CandidateBinder::bindToInput($candidate);
		}
		catch(InvalidArgumentException $e)
		{
			Session::flash('error', 'One of the date fields was invalid.');
			$hasErrors = true;
		}

		$validator = new CandidateValidator($candidate->toArray());

		if(!$validator->passes() || $hasErrors)
		{
			if($isNew)
			{
				return Redirect::route('candidates.new')->withErrors($validator->errors)->withInput();
			}
			else
			{
				return Redirect::route('candidates.view', $candidate->id)->withErrors($validator->errors)->withInput();
			}
		}

		$candidate->changed_by = Sentry::getUser()->id;

		$candidate->save();

		Session::flash('success', 'Candidate [' . $candidate->name . '] saved successfully.');
		return Redirect::route('candidates');
	}

	public function getCandidate($id)
	{
		$candidate = Candidate::find($id);
		$notes = NoteService::getNotes($candidate);
		$noteSettings = NoteService::getNoteSettings($candidate);

		return View::make('candidates.view')->with('candidate', $candidate)->with('notes', $notes)
											->with('noteSettings', $noteSettings);
	}

}