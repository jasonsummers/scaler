<?php namespace App\Services\Validators;

class ClientValidator extends BaseValidator {
	
	public static $rules = array(
			'name' => 'required|regex:^[A-Za-z0-9 ]^',
			'address' => 'required|regex:^[A-Za-z0-9 ]^',
			'address_town' => 'regex:^[A-Za-z0-9 ]^',
			'address_city' => 'required|regex:^[A-Za-z0-9 ]^',
			'address_county' => 'regex:^[A-Za-z0-9 ]^',
			'address_country_id' => 'integer',
			'address_postcode' => 'required|regex:^[A-Za-z0-9 ]^',
			'telephone_main' => 'numeric',
			'fax_main' => 'numeric',
			// 'website_1' => '',
			// 'website_2' => '',
			// 'website_3' => '',
			// 'vacancy_value' => '',
			// 'placement_value' => '',
		);
}