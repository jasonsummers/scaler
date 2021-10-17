<?php

use Illuminate\Database\Migrations\Migration;

class CreateAuthGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Users Group
		try
		{
		    // Create the group
		    $group = Sentry::getGroupProvider()->create(array(
		        'name' => 'Users'
		    ));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    echo 'Group already exists';
		}

		// Admin Group
		try
		{
		    // Create the group
		    $group = Sentry::getGroupProvider()->create(array(
		        'name' => 'Admins',
		        'permissions' => array('admin' => 1),
		    ));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    echo 'Group already exists';
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Users Group
		try
		{
		    // Find the group using the group id
		    $group = Sentry::getGroupProvider()->findByName('Users');

		    // Delete the group
		    $group->delete();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}

		// Admin Group
		try
		{
		    // Find the group using the group id
		    $group = Sentry::getGroupProvider()->findByName('Admins');

		    // Delete the group
		    $group->delete();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
	}

}