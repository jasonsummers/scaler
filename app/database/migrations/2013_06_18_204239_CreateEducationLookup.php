<?php

use Illuminate\Database\Migrations\Migration;

class CreateEducationLookup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('ref_education', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('qualification', 15);
			$table->smallInteger('level');
			$table->smallInteger('order');
			$table->date('validfrom');
			$table->date('validto');
		});

		$file = __dir__ . '/../csv/education.csv';
		$date = date('Y-m-d H:i:s');
		$pdo = DB::connection()->getPdo();
		$format = "LOAD DATA INFILE %s INTO TABLE ref_education FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES (@col1,@col2) SET qualification=@col1, level=@col2, `order`=99, validfrom=%s";
		$query = sprintf($format, $pdo->quote($file), $pdo->quote($date));
		$pdo->exec($query);
		
		Schema::table('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('education_id')->references('id')->on('ref_education');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->dropForeign('candidates_education_id_foreign');
		});

		Schema::dropIfExists('ref_education');
	}

}