<?php

use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesLookup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('ref_currencies', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('name', 100);
			$table->string('code', 3);
			$table->string('symbol');
			$table->smallInteger('order');
			$table->date('validfrom');
			$table->date('validto');
		});

		$file = __dir__ . '/../csv/currencies.csv';
		$date = date('Y-m-d H:i:s');
		$pdo = DB::connection()->getPdo();
		$format = "LOAD DATA INFILE %s INTO TABLE ref_currencies FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\r' IGNORE 1 LINES (@col2,@col1,@col3) SET name=@col1, code=@col2, symbol=@col3, `order`=99, validfrom=%s";
		$query = sprintf($format, $pdo->quote($file), $pdo->quote($date));
		$pdo->exec($query);
		
		Schema::table('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('currency_id')->references('id')->on('ref_currencies');
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

			$table->dropForeign('candidates_currency_id_foreign');
		});

		Schema::dropIfExists('ref_currencies');
	}

}