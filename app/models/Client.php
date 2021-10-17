<?php namespace App\Models;

use Eloquent;

class Client extends \Eloquent {

	protected $table = 'clients';
	protected $softDelete = true;

	public function contacts()
	{
		return $this->hasMany('App\Models\ClientContact');
	}

	public function lastChangedByUser()
	{
		return $this->belongsTo('User', 'changed_by');
	}

}