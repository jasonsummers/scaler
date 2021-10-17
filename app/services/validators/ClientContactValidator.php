<?php namespace App\Services\Validators;

class ClientContactValidator extends BaseValidator {
	
	public static $rules = array(
			'first_name' => 'required|alpha',
			'last_name' => 'required|alpha',
			'salutation' => 'regex:^[A-Za-z0-9 ]^',
			'job_title' => 'regex:^[A-Za-z0-9 ]^',
			// 'linkedin_profile' => '',
			// 'facebook_profile' => '',
			'phone_mobile' => 'numeric',
			'phone_work' => 'numeric',
			'email_1' => 'email',
			'email_2' => 'email',
			'email_3' => 'email',
			// 'skype_name' => '',
			// 'twitter' => '',
			'last_contact' => 'date',
			'next_contact' => 'date',
			// 'vacancy_value' => '',
			// 'placement_value' => '',
		);
}