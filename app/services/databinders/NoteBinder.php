<?php namespace App\Services\DataBinders;

use Input;

class NoteBinder {

	public static function bindToInput($destination)
	{
		$destination->parent_object = Input::get('parent_object');
		$destination->parent_id = Input::get('parent_id');
		$destination->note = Input::get('note');
	}
}