<?php

use Illuminate\Database\Migrations\Migration;

class CreateCountriesLookup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('ref_countries', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('name', 100);
			$table->string('code', 2);
			$table->smallInteger('order');
			$table->date('validfrom');
			$table->date('validto');
		});

		$file = __dir__ . '/../csv/countries.csv';
		$date = date('Y-m-d H:i:s');
		$pdo = DB::connection()->getPdo();
		$format = "LOAD DATA INFILE %s INTO TABLE ref_countries FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\r' IGNORE 1 LINES (@col1,@col2) SET name=@col1, code=@col2, `order`=99, validfrom=%s";
		$query = sprintf($format, $pdo->quote($file), $pdo->quote($date));
		$pdo->exec($query);
		
		Schema::table('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('address_country_id')->references('id')->on('ref_countries');
		});

		Schema::table('clients', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('address_country_id')->references('id')->on('ref_countries');
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

			$table->dropForeign('candidates_address_country_id_foreign');
		});

		Schema::table('clients', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->dropForeign('clients_address_country_id_foreign');
		});

		Schema::dropIfExists('ref_countries');
	}

}