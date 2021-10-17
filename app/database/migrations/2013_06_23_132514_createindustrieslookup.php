<?php

use Illuminate\Database\Migrations\Migration;

class Createindustrieslookup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('ref_industries', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('industry', 30);
			$table->smallInteger('order');
			$table->date('validfrom');
			$table->date('validto');
		});

		$file = __dir__ . '/../csv/industries.csv';
		$date = date('Y-m-d H:i:s');
		$pdo = DB::connection()->getPdo();
		$format = "LOAD DATA INFILE %s INTO TABLE ref_industries FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES (@col1) SET industry=@col1, `order`=99, validfrom=%s";
		$query = sprintf($format, $pdo->quote($file), $pdo->quote($date));
		$pdo->exec($query);
		
		Schema::table('clients', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('industry_id')->references('id')->on('ref_industries');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clients', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->dropForeign('clients_industry_id_foreign');
		});

		Schema::dropIfExists('ref_industries');
	}

}