<?php

class SuController extends BaseController {

	public function disableApplication()
	{
		//disable the site
		$encrypted = Crypt::encrypt(Config::get('su.dcode'));

		DB::table('su')->update(
			array(
				'1' => $encrypted
		));

		Session::flash('success', 'Application Disabled');
		return Redirect::to('su');
	}

	public function enableApplication()
	{
		//enable the site
		$encrypted = Crypt::encrypt(Config::get('su.acode'));

		DB::table('su')->update(
			array(
				'1' => $encrypted
		));

		Session::flash('success', 'Application Disabled');
		return Redirect::to('su');
	}

	public function exportDatabase()
	{
		//export the database for download
		echo('this function has yet to be written');
	}

	public function purgeDatabase()
	{
		//delete all data in the database
		echo('this function has yet to be written');
	}
}