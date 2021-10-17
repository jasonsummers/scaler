<?php

use Illuminate\Database\Migrations\Migration;

class CreateTitlesLookup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('ref_persontitles', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('title', 10);
			$table->smallInteger('order');
			$table->date('validfrom');
			$table->date('validto');
		});

		$file = __dir__ . '/../csv/titles.csv';
		$date = date('Y-m-d H:i:s');
		$pdo = DB::connection()->getPdo();
		$format = "LOAD DATA INFILE %s INTO TABLE ref_persontitles FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 0 LINES (@col1) SET title=@col1, `order`=99, validfrom = %s";
		$query = sprintf($format, $pdo->quote($file), $pdo->quote('99'), $pdo->quote($date));
		$pdo->exec($query);
		
		Schema::table('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('title_id')->references('id')->on('ref_persontitles');
		});

		Schema::table('clientcontacts', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('title_id')->references('id')->on('ref_persontitles');
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

			$table->dropForeign('candidates_title_id_foreign');
		});

		Schema::table('clientcontacts', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->dropForeign('clientcontacts_title_id_foreign');
		});

		Schema::dropIfExists('ref_persontitles');
	}

}