<?php namespace App\Models;

use Eloquent;

class Note extends \Eloquent {

	protected $table = 'notes';
	
	public function lastChangedByUser()
	{
		return $this->belongsTo('User', 'changed_by');
	}
}