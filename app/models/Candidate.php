<?php namespace App\Models;

use Eloquent;
use DateTime;

class Candidate extends Eloquent {
	
	protected $table = 'candidates';
	protected $softDeletes = true;

	public function getDates()
	{
		return array('created_at', 'updated_at', 'deleted_at', 'dob', 'moved_on', 'available', 'last_contact', 'next_contact');
	}

	public function getNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getDobAttribute($value)
	{
		if (!$value)
		{
			return;
		}

		$date = new DateTime($value);
		return $date->format('d/m/Y');
	}

	public function getMovedOnAttribute($value)
	{
		if (!$value)
		{
			return;
		}

		$date = new DateTime($value);
		return $date->format('d/m/Y');
	}

	public function getAvailableAttribute($value)
	{
		if (!$value)
		{
			return;
		}

		$date = new DateTime($value);
		return $date->format('d/m/Y');
	}

	public function getLastContactAttribute($value)
	{
		if (!$value)
		{
			return;
		}

		$date = new DateTime($value);
		return $date->format('d/m/Y');
	}

	public function getNextContactAttribute($value)
	{
		if (!$value)
		{
			return;
		}

		$date = new DateTime($value);
		return $date->format('d/m/Y');
	}

	public function lastChangedByUser()
	{
		return $this->belongsTo('User', 'changed_by');
	}

}