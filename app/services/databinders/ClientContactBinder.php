<?php namespace App\Services\DataBinders;

use Input;

class ClientContactBinder {
	
	public static function bindToInput($destination)
	{
		$destination->title_id = Input::get('title_id');
		$destination->first_name = Input::get('first_name');
		$destination->last_name = Input::get('last_name');
		$destination->salutation = Input::get('salutation');
		$destination->job_title = Input::get('job_title');
		$destination->linkedin_profile = Input::get('linkedin_profile');
		$destination->facebook_profile = Input::get('facebook_profile');
		$destination->phone_mobile = Input::get('phone_mobile');
		$destination->phone_work = Input::get('phone_work');
		$destination->email_1 = Input::get('email_1');
		$destination->email_2 = Input::get('email_2');
		$destination->email_3 = Input::get('email_3');
		$destination->skype_name = Input::get('skype_name');
		$destination->twitter = Input::get('twitter');
		$destination->priority_id = Input::get('priority_id');
		$destination->primary_user = Input::get('primary_user');
		$destination->last_contact = ((Input::get('last_contact') == '') || str_contains(Input::get('last_contact'), '0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('last_contact'));
		$destination->next_contact = ((Input::get('next_contact') == '') || str_contains(Input::get('next_contact'), '0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('next_contact'));
		$destination->vacancy_value = Input::get('vacancy_value');
		$destination->placement_value = Input::get('placement_value');
	}
}