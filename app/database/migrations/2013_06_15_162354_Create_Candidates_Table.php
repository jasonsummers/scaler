<?php

use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('title_id')->unsigned();
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('salutation', 30);
			$table->string('headline', 255);
			$table->date('dob')->nullable();
			$table->string('phone_home', 15);
			$table->string('phone_work', 15);
			$table->string('phone_mobile', 15);
			$table->string('email_1', 255);
			$table->string('email_2', 255);
			$table->string('email_3', 255);
			$table->string('web_address', 255);
			$table->string('facebook_profile', 255);
			$table->string('linkedin_profile', 255);
			$table->string('googleplus_profile', 255);
			$table->string('skype_name', 30);
			$table->string('address', 50);
			$table->string('address_town', 50);
			$table->string('address_city', 50);
			$table->string('address_county', 50);
			$table->integer('address_country_id')->unsigned();
			$table->string('address_postcode', 10);
			$table->integer('currency_id')->unsigned();
			$table->date('moved_on')->nullable();
			$table->string('ni_number', 12);
			$table->integer('education_id')->unsigned();
			$table->boolean('eligable_uk');
			$table->boolean('eligable_europe');
			$table->string('curpos_title', 50);
			$table->string('curpos_employer', 50);
			$table->string('curpos_devision', 50);
			$table->smallInteger('curpos_notice');
			$table->string('despos_title', 50);
			$table->boolean('renum_perm');
			$table->decimal('renum_perm_ammt', 7, 2);
			$table->boolean('renum_self_emp');
			$table->decimal('renum_self_emp_ammt', 7, 2);
			$table->boolean('renum_temp');
			$table->decimal('renum_temp_ammt', 7, 2);
			$table->boolean('renum_cont');
			$table->decimal('renum_cont_ammt', 7, 2);
			$table->date('available')->nullable();
			$table->boolean('will_relocate');
			$table->smallInteger('commute_distance');
			$table->string('commute_from_postcode', 10);
			$table->integer('priority_id')->unsigned();
			$table->integer('primary_user')->unsigned();
			$table->string('our_ref', 30);
			$table->integer('changed_by')->unsigned();
			$table->date('last_contact')->nullable();
			$table->date('next_contact')->nullable();
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
		Schema::dropIfExists('candidates');
	}

}