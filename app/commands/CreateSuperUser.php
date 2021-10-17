<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateSuperUser extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'createsuperuser';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creates a super user account.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		// Gather Sanitized Input
		$input = array(
			'first_name' => $this->argument('firstname'),
			'last_name' => $this->argument('surname'),
			'username' => $this->argument('login'),
			'password' => $this->argument('password'),
			'email' => $this->argument('email'),
			);

		// Set Validation Rules
		$rules = array (
			'first_name' => 'required|alpha|max:30',
			'last_name' => 'required|alpha|max:30',
			'username' => 'required|min:4|max:32|alpha',
			'password' => 'required|min:6|alphanum',
			'email' => 'required|email',
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			foreach ($v->messages()->all() as $error) {
				$this->error($error);
			}
			return;
		}

		//add the superuser permission to the input
		$input['permissions'] = array('superuser' => 1);

		try
		{
		    // Create the user
		    $user = Sentry::getUserProvider()->create($input);

		    // automatically activate the user so they can use the account straight away
		    $activationCode = $user->getActivationCode();
		    $user->attemptActivation($activationCode);
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->error('User with this login already exists.');
			return;
		}

		$this->info('Superuser created successfully.');
		return;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('firstname', InputArgument::REQUIRED, 'The Superusers first name.'),
			array('surname', InputArgument::REQUIRED, 'The Superusers surname.'),
			array('login', InputArgument::REQUIRED, 'The Superusers login.'),
			array('password', InputArgument::REQUIRED, 'The Superusers password.'),
			array('email', InputArgument::REQUIRED, 'The Superusers email address.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//no options
		);
	}

}