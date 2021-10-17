<?php namespace App\Services\DataBinders;

use Input;

class ClientBinder {
	
	public static function bindToInput($destination)
	{
		$destination->name = Input::get('name');
		$destination->address = Input::get('address');
		$destination->address_town = Input::get('address_town');
		$destination->address_city = Input::get('address_city');
		$destination->address_county = Input::get('address_county');
		$destination->address_country_id = Input::get('address_country_id');
		$destination->address_postcode = Input::get('address_postcode');
		$destination->telephone_main = Input::get('telephone_main');
		$destination->fax_main = Input::get('fax_main');
		$destination->website_1 = Input::get('website_1');
		$destination->website_1 = Input::get('website_2');
		$destination->website_1 = Input::get('website_3');
		$destination->industry_id = Input::get('industry_id');
		$destination->vacancy_value = Input::get('vacancy_value');
		$destination->placement_value = Input::get('placement_value');
		$destination->priority_id = Input::get('priority_id');
		$destination->primary_user = Input::get('primary_user');
	}

}