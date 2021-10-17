<?php

class AuthController extends BaseController {

	private $usernameValidationRules = 'required|min:4|max:32|alpha';
	private $passwordValidationRules = 'required|min:6';
	private $firstNameValidationRules = 'required|alpha|max:30';
	private $lastNameValidationRules = 'required|alpha|max:30';
	private $emailValidationRules = 'required|email';

	public function postLogin()
	{
		// Gather Sanitized Input
		$input = array(
			'username' => input::get('username'),
			'password' => input::get('password')
			);

		// Set Validation Rules
		$rules = array (
			'username' => $this->usernameValidationRules,
			'password' => $this->passwordValidationRules
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('login')->withErrors($v)->withInput();
		}

		try
		{
			//Check for suspension or banned status
			$user = Sentry::getUserProvider()->findByLogin(input::get('username'));
			$throttle = Sentry::getThrottleProvider()->findByUserId($user->id);
		    $throttle->check();

		    // Set login credentials
		    $credentials = $input;

		    // Try to authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
			$throttle->addLoginAttempt();
			$remainingAttempts = $throttle::getAttemptLimit() - $throttle->getLoginAttempts();
			Session::flash('error', 'The supplied password did not match the one stored for your account. You have '.$remainingAttempts.' login attempts before your account is suspended.');
			return Redirect::to('login')->withErrors($v)->withInput();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			Session::flash('error', 'The username provided was not recognised.');
			return Redirect::to('login')->withErrors($v)->withInput();
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			Session::flash('error', 'That account has not been activated.');
			return Redirect::to('login')->withErrors($v)->withInput();
		}

		// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			$suspensionTime = $throttle->getSuspensionTime();
			Session::flash('error', 'That account has been suspended for '.$suspensionTime.' minutes.');
			return Redirect::to('login')->withErrors($v)->withInput();
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			Session::flash('error', 'That account has been banned.  Please contact the System Administrator.');
			return Redirect::to('login')->withErrors($v)->withInput();
		}

		//Login was succesful.  
		return Redirect::to('/');
	}

	public function getLogout()
	{
		Sentry::logout();
		return Redirect::to('/');
	}

	public function postForgottenPassword()
	{
		// Gather Sanitized Input
		$input = array(
			'username' => input::get('username'),
			);

		// Set Validation Rules
		$rules = array (
			'username' => $this->usernameValidationRules,
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('forgottenpassword')->withErrors($v)->withInput();
		}

		try
		{
			Sentry::getUserProvider()->findByLogin(input::get('username'));

			$data['resetCode'] = $user->getResetPasswordCode();
		    $data['userId'] = $user->getId();
		    $data['email'] = $user->email();

			Mail::send('auth.email_reset_password', $data, function($m) use($data)
			{
			    $m->to($data['email'])->subject('Password Reset Confirmation');
			});
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Session::flash('error', 'The username provided was not recognised.');
			return Redirect::to('forgottenpassword')->withErrors($v)->withInput();
		}

		Session::flash('success', 'Check your email for password reset information.');
	    return Redirect::to('/');
	}

	public function postResetPassword()
	{
		// Gather Sanitized Input
		$input = array(
			'password' => input::get('password'),
			);

		// Set Validation Rules
		$rules = array (
			'password' => $this->passwordValidationRules . '|confirmed',
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('resetpassword/'.$resetCode)->withErrors($v)->withInput();
		}

		try
		{
			$resetCode = input::get('resetcode');
			$newPassword = input::get('password');

			// Find the user using the user id
		    $user = Sentry::getUserProvider()->findByResetPasswordCode($resetCode);

		    // Check if the reset password code is valid
		    if ($user->checkResetPasswordCode($resetCode))
		    {
		        // Attempt to reset the user password
		        if ($user->attemptResetPassword($resetCode, $newPassword))
		        {
		        	Session::flash('success', 'Your password has been successfully changed, you may now login.');
		            return Redirect::to('login');
		        }
		        else
		        {
		        	Session::flash('error', 'An error occurred whilst resetting your password, please try again.');
		            return Redirect::to('resetpassword/'.$id.'/'.$resetCode)->withErrors($v)->withInput();
		        }
		    }
		    else
		    {
		        Session::flash('error', 'The password reset code was invalid.');
		        return Redirect::to('/');
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Session::flash('error', 'The password reset code was invalid.');
		    return Redirect::to('/');
		}
	}

	public function postCreateUser()
	{
		// Gather Sanitized Input
		$input = array(
			'first_name' => input::get('first_name'),
			'last_name' => input::get('last_name'),
			'username' => input::get('username'),
			'password' => input::get('password'),
			'password_confirmation' => input::get('password_confirmation'),
			'email' => input::get('email'),
			'email_confirmation' => input::get('email_confirmation')
			);

		// Set Validation Rules
		$rules = array (
			'first_name' => $this->firstNameValidationRules,
			'last_name' => $this->lastNameValidationRules,
			'username' => $this->usernameValidationRules,
			'password' => $this->passwordValidationRules . '|confirmed',
			'email' => $this->emailValidationRules . '|confirmed',
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('users/create')->withErrors($v)->withInput();
		}

		// remove the confirmation fields from the input array
		unset($input["password_confirmation"]);
		unset($input["email_confirmation"]);

		try
		{
		    // Create the user
		    $user = Sentry::getUserProvider()->create($input);

		    // Find the group using the group id
		    $usersGroup = Sentry::getGroupProvider()->findByName('Users');

		    // Assign the group to the user
		    $user->addGroup($usersGroup);

		    // automatically activate the user so they can use the account straight away
		    $activationCode = $user->getActivationCode();
		    $user->attemptActivation($activationCode);
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			Session::flash('error', 'User with this login already exists.');
			return Redirect::to('users/create')->withErrors($v)->withInput();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			Session::flash('error', 'Group was not found.');
			return Redirect::to('users/create')->withErrors($v)->withInput();
		}

		return Redirect::to('users');
	}

	public function getViewUser($id)
	{
		$user = Sentry::getUserProvider()->findById($id);
		return View::make('auth.view_user')->with('user', $user);
	}

	public function postUpdateUser()
	{
		// Gather Sanitized Input
		$input = array(
			'first_name' => input::get('first_name'),
			'last_name' => input::get('last_name'),
			'username' => input::get('username'),
			//'password' => input::get('password'),
			//'password_confirmation' => input::get('password_confirmation'),
			'email' => input::get('email'),
			'email_confirmation' => input::get('email_confirmation')
			);

		// Set Validation Rules
		$rules = array (
			'first_name' => $this->firstNameValidationRules,
			'last_name' => $this->lastNameValidationRules,
			'username' => $this->usernameValidationRules,
			'password' => $this->passwordValidationRules . '|confirmed',
			'email' => $this->emailValidationRules . '|confirmed',
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('users/view/'.input::get('userId'))->withErrors($v)->withInput();
		}

		// remove the confirmation fields from the input array
		unset($input["password_confirmation"]);
		unset($input["email_confirmation"]);

		try
		{
		    // Create the user
		    $user = Sentry::getUserProvider()->findById(input::get('userId'));

		    $user->first_name = input::get('first_name');
		    $user->last_name = input::get('last_name');
		    $user->username = input::get('username');
		    $user->email = input::get('email');

		    if($user->save())
		    {
		    	Session::flash('success', $user->name.' was updated successfully');
		    	return Redirect::to('users');
		    }
		    else
		    {
		    	Session::flash('error', 'An error occurred while updating user details. Please try again.');
				return Redirect::to('users/view/'.input::get('userId'))->withErrors($v)->withInput();
		    }

		    // Do we really want to allow admins to change user passwords??
		    // if(input::get('password') != "")
		    // {
		    // 	$resetCode = $user->getResetPasswordCode();
		    // 	if($user->attemptResetPassword($resetCode, input::get('password')))
		    // 	{
		    // 		//password changed
		    // 	}
		    // 	else
		    // 	{
		    // 		//password change failed
		    // 	}
		    // }

		    
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			Session::flash('error', 'User with this login already exists.');
			return Redirect::to('users/view/'.input::get('userId'))->withErrors($v)->withInput();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Session::flash('error', 'The user could not be found.');
			return Redirect::to('users/view/'.input::get('userId'))->withErrors($v)->withInput();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			Session::flash('error', 'Group was not found.');
			return Redirect::to('users/view/'.input::get('userId'))->withErrors($v)->withInput();
		}

		return Redirect::to('users');
	}

}