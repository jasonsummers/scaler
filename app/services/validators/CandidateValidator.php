<?php namespace App\Services\Validators;

class CandidateValidator extends BaseValidator {
	
	public static $rules = array(
			'title_id' => 'integer',
			'first_name' => 'required|alpha',
			'last_name' => 'required|alpha',
			'salutation' => 'regex:^[A-Za-z0-9 ]^',
			'headline' => 'regex:^[A-Za-z0-9 ]^',
			'dob' => 'date_format:d/m/Y',
			'phone_home' => 'regex:^[0-9 ]^',
			'phone_work' => 'regex:^[0-9 ]^',
			'phone_mobile' => 'regex:^[0-9 ]^',
			'email_1' => 'email',
			'email_2' => 'email',
			'email_3' => 'email',
			//'web_address' => 'regex:',
			// 'facebook_profile' => 'regex:',
			// 'linkedin_profile' => 'regex:',
			// 'googleplus_profile' => 'regex:',
			// 'skype_name' => 'regex:',
			'address' => 'regex:^[A-Za-z0-9 ]^',
			'address_town' => 'regex:^[A-Za-z0-9 ]^',
			'address_city' => 'regex:^[A-Za-z0-9 ]^',
			'address_county' => 'regex:^[A-Za-z0-9 ]^',
			'address_postcode' => 'regex:^[A-Za-z0-9 ]^',
			'moved_on' => 'date_format:d/m/Y',
			'ni_number' => 'regex:^[A-Za-z0-9 ]^',
			'curpos_title' => 'regex:^[A-Za-z0-9 ]^',
			'curpos_employer' => 'regex:^[A-Za-z0-9 ]^',
			'curpos_devision' => 'regex:^[A-Za-z0-9 ]^',
			'curpos_notice' => 'integer',
			'despos_title' => 'regex:^[A-Za-z0-9 ]^',
			// 'renum_perm_ammt' => 'regex:',
			// 'renum_self_emp_ammt' => 'regex:',
			// 'renum_temp_ammt' => 'regex:',
			// 'renum_cont_ammt' => 'regex:',
			'available' => 'date_format:d/m/Y',
			'commute_distance' => 'integer',
			'commute_from_postcode' => 'regex:^[A-Za-z0-9 ]^',
			'priority_id' => 'integer',
			'primary_user' => 'integer',
			'our_ref' => 'regex:^[A-Za-z0-9/ ]^',
			'last_contact' => 'date_format:d/m/Y',
			'next_contact' => 'date_format:d/m/Y',
		);

}