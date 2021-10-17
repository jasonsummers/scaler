<?php

use Illuminate\Database\Migrations\Migration;

class CreateClientContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('clientcontacts', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('client_id');
			$table->integer('title_id')->unsigned();
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('salutation', 30);
			$table->string('job_title', 30);
			$table->string('linkedin_profile', 255);
			$table->string('facebook_profile', 255);
			$table->string('phone_mobile', 15);
			$table->string('phone_work', 15);
			$table->string('email_1', 255);
			$table->string('email_2', 255);
			$table->string('email_3', 255);
			$table->string('skype_name', 30);
			$table->string('twitter', 255);
			$table->integer('priority_id')->unsigned();
			$table->integer('primary_user')->unsigned();
			$table->integer('changed_by')->unsigned();
			$table->date('last_contact')->nullable();
			$table->date('next_contact')->nullable();
			$table->decimal('vacancy_value', 7, 2);
			$table->decimal('placement_value', 7, 2);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('primary_user')->references('id')->on('users');
			$table->foreign('changed_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('clientcontacts');
	}

}