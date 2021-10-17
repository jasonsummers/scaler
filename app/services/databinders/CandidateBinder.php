<?php namespace App\Services\DataBinders;

use Input;
use Carbon\Carbon;

class CandidateBinder {
	
	public static function bindToInput($destination)
	{
		$destination->title_id = Input::get('title_id');
		$destination->first_name = Input::get('first_name');
		$destination->last_name = Input::get('last_name');
		$destination->salutation = Input::get('salutation');
		$destination->headline = Input::get('headline');
		$destination->dob = ((Input::get('dob') == '') || str_contains(Input::get('dob'), '0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('dob'));
		$destination->phone_home = Input::get('phone_home');
		$destination->phone_work = Input::get('phone_work');
		$destination->phone_mobile = Input::get('phone_mobile');
		$destination->email_1 = Input::get('email_1');
		$destination->email_2 = Input::get('email_2');
		$destination->email_3 = Input::get('email_3');
		$destination->web_address = Input::get('web_address');
		$destination->facebook_profile = Input::get('facebook_profile');
		$destination->linkedin_profile = Input::get('linkedin_profile');
		$destination->googleplus_profile = Input::get('googleplus_profile');
		$destination->skype_name = Input::get('skype_name');
		$destination->address = Input::get('address');
		$destination->address_town = Input::get('address_town');
		$destination->address_city = Input::get('address_city');
		$destination->address_county = Input::get('address_county');
		$destination->address_country_id = Input::get('address_country_id');
		$destination->address_postcode = Input::get('address_postcode');
		$destination->currency_id = Input::get('currency_id');
		$destination->moved_on = ((Input::get('moved_on') == '') || str_contains(Input::get('moved_on'),'0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('moved_on'));
		$destination->ni_number = Input::get('ni_number');
		$destination->education_id = Input::get('education_id');
		$destination->eligable_uk = (Input::get('eligable_uk') != '');
		$destination->eligable_europe = (Input::get('eligable_europe') != '');
		$destination->curpos_title = Input::get('curpos_title');
		$destination->curpos_employer = Input::get('curpos_employer');
		$destination->curpos_devision = Input::get('curpos_devision');
		$destination->curpos_notice = Input::get('curpos_notice');
		$destination->despos_title = Input::get('despos_title');
		$destination->renum_perm = (Input::get('renum_perm') != '');
		$destination->renum_perm_ammt = Input::get('renum_perm_ammt');
		$destination->renum_self_emp = (Input::get('renum_self_emp') != '');
		$destination->renum_self_emp_ammt = Input::get('renum_self_emp_ammt');
		$destination->renum_temp = (Input::get('renum_temp') != '');
		$destination->renum_temp_ammt = Input::get('renum_temp_ammt');
		$destination->renum_cont = (Input::get('renum_cont') != '');
		$destination->renum_cont_ammt = Input::get('renum_cont_ammt');
		$destination->available = ((Input::get('available') == '') || str_contains(Input::get('available'), '0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('available'));
		$destination->will_relocate = (Input::get('will_relocate') != '');
		$destination->commute_distance = Input::get('commute_distance');
		$destination->commute_from_postcode = Input::get('commute_from_postcode');
		$destination->priority_id = Input::get('priority_id');
		$destination->primary_user = Input::get('primary_user');
		$destination->our_ref = Input::get('our_ref');
		$destination->last_contact = ((Input::get('last_contact') == '') || str_contains(Input::get('last_contact'), '0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('last_contact'));
		$destination->next_contact = ((Input::get('next_contact') == '') || str_contains(Input::get('next_contact'), '0000')) ? null : Carbon::createFromFormat('d/m/Y', Input::get('next_contact'));
	}

}