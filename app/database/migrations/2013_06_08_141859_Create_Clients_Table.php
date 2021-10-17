<?php

use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('clients', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('name', 255);
			$table->string('address', 50);
			$table->string('address_town', 50);
			$table->string('address_city', 50);
			$table->string('address_county', 50);
			$table->integer('address_country_id')->unsigned();
			$table->string('address_postcode', 10);
			$table->string('telephone_main', 15);
			$table->string('fax_main', 15);
			$table->string('website_1', 255);
			$table->string('website_2', 255);
			$table->string('website_3', 255);
			$table->decimal('vacancy_value', 7, 2);
			$table->decimal('placement_value', 7, 2);
			$table->integer('industry_id')->unsigned();
			$table->binary('logo');
			$table->integer('primary_user')->unsigned();
			$table->integer('priority_id')->unsigned();
			$table->integer('changed_by')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			
			$table->foreign('changed_by')->references('id')->on('users');
			$table->foreign('primary_user')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}