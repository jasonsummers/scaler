<?php

use Illuminate\Database\Migrations\Migration;

class CreateSUTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('su', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->text('1');
		});

		DB::table('su')->insert(
			array('1' => '',)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('su');
	}

}