<?php namespace App\Models;

use Eloquent;
use DateTime;

class ClientContact extends Eloquent {
	
	protected $table = 'clientcontacts';
	protected $softDelete = true;

	public function getNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}

	public function lastChangedByUser()
	{
		return $this->belongsTo('User', 'changed_by');
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
}