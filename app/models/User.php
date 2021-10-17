<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User {

	public function getNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

}