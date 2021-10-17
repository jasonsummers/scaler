<?php

return array(
	'driver' => 'eloquent',
	'hasher' => 'native',
	'groups' => array(
		'model' => 'Cartalyst\Sentry\Groups\Eloquent\Group',
	),
	'users' => array(
		'model' => 'User',
		'login_attribute' => 'username',
	),
	'throttling' => array(
		'enabled' => true,
		'model' => 'Cartalyst\Sentry\Throttling\Eloquent\Throttle',
		'attempt_limit' => 5,
		'suspension_time' => 15,
	),
);