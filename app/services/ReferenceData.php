<?php namespace App\Services;

use DB;
use App\Models\Reference\Title;
use App\Models\Reference\Country;
use App\Models\Reference\Currency;
use App\Models\Reference\Education;
use App\Models\Reference\Priority;
use App\Models\Reference\Industry;
use User;

class ReferenceData {
	
	public static function Titles()
	{
		$titles = Title::where('validfrom', '<', date('Y-m-d H:i:s'))
						->where(function($query)
						{
							$query->where('validto', '>', date('Y-m-d H:i:s'))
									->orWhere('validto', '=', null);
						})
						->orderBy('order')
						->orderBy('title')
					 	->get(array('id', 'title'));

		return ReferenceData::makeArray($titles, 'title');
	}

	public static function Countries()
	{
		$countries = Country::where('validfrom', '<', date('Y-m-d H:i:s'))
							->where(function($query)
							{
								$query->where('validto', '>', date('Y-m-d H:i:s'))
										->orWhere('validto', '=', null);
							})
							->orderBy('order')
							->orderBy('name')
							->get(array('id', 'name'));

		return ReferenceData::makeArray($countries, 'name');
	}

	public static function Currencies()
	{
		$currencies = Currency::where('validfrom', '<', date('Y-m-d H:i:s'))
								->where(function($query)
								{
									$query->where('validto', '>', date('Y-m-d H:i:s'))
											->orWhere('validto', '=', null);
								})
								->orderBy('order')
								->orderBy('name')
								->get(array('id', 'name', 'symbol'));

		$currenciesArr = array();

		foreach ($currencies as $currency)
		{
			$valueString = $currency->name;
			if((strpos($currency->symbol, ' ') === FALSE) && (strpos($currency->symbol, '_') === FALSE) && ($currency->symbol != ''))
			{
				$valueString .= ' (' . $currency->symbol . ')';
			}

			$currenciesArr[$currency->id] = $valueString;
		}

		return $currenciesArr;						
	}

	public static function Education()
	{
		$education = Education::where('validfrom', '<', date('Y-m-d H:i:s'))
								->where(function($query)
								{
									$query->where('validto', '>', date('Y-m-d H:i:s'))
											->orWhere('validto', '=', null);
								})
								->orderBy('order')
								->orderBy('level')
								->orderBy('qualification')
								->get(array('id', 'qualification'));

		return ReferenceData::makeArray($education, 'qualification');
	}

	public static function Industries()
	{
		$industries = Industry::where('validfrom', '<', date('Y-m-d H:i:s'))
								->where(function($query)
								{
									$query->where('validto', '>', date('Y-m-d H:i:s'))
											->orWhere('validto', '=', null);
								})
								->orderBy('order')
								->orderBy('industry')
								->get(array('id', 'industry'));

		return ReferenceData::makeArray($industries, 'industry');
	}

	public static function CandidatePriorities()
	{
		return ReferenceData::Priorities('candidate');
	}

	public static function ClientPriorities()
	{
		return ReferenceData::Priorities('client');
	}

	public static function ClientContactPriorities()
	{
		return ReferenceData::Priorities('clientcontact');
	}

	public static function UserList()
	{
		$users = User::all();

		$arr = array();

		foreach ($users as $user)
		{
			$arr[$user->id] = $user->name;
		}

		return $arr;
	}

	private static function makeArray($data, $valueColumn)
	{
		$arr = array();

		foreach ($data as $d)
		{
			$arr[$d->id] = $d->$valueColumn;
		}

		return $arr;
	}

	private static function Priorities($priorityType)
	{
		$priorities = Priority::where('priority_type', '=', $priorityType)
								->where('validfrom', '<', date('Y-m-d H:i:s'))
								->where(function($query)
								{
									$query->where('validto', '>', date('Y-m-d H:i:s'))
											->orWhere('validto', '=', null);
								})
								->orderBy('order')
								->orderBy('priority')
								->get(array('id', 'priority'));

		return ReferenceData::makeArray($priorities, 'priority');
	}

}