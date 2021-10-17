<?php

use Illuminate\Database\Migrations\Migration;

class CreatePrioritiesLookup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('ref_priorities', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('priority_type', 15);
			$table->string('priority', 30);
			$table->smallInteger('order');
			$table->date('validfrom');
			$table->date('validto');
		});

		$file = __dir__ . '/../csv/priorities.csv';
		$date = date('Y-m-d H:i:s');
		$pdo = DB::connection()->getPdo();
		$format = "LOAD DATA INFILE %s INTO TABLE ref_priorities FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES (@col1,@col2) SET priority_type=@col1, priority=@col2, `order`=99, validfrom=%s";
		$query = sprintf($format, $pdo->quote($file), $pdo->quote($date));
		$pdo->exec($query);
		
		Schema::table('candidates', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->foreign('priority_id')->references('id')->on('ref_priorities');
		});

		Schema::table('clients', function($table)
		{
			$table->engine = 'InnoDB';

			$table->foreign('priority_id')->references('id')->on('ref_priorities');
		});

		Schema::table('clientcontacts', function($table)
		{
			$table->engine = 'InnoDB';

			$table->foreign('priority_id')->references('id')->on('ref_priorities');
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

			$table->dropForeign('candidates_priority_id_foreign');
		});

		Schema::table('clients', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->dropForeign('clients_priority_id_foreign');
		});

		Schema::table('clientcontacts', function($table)
		{
    		$table->engine = 'InnoDB';

			$table->dropForeign('clientcontacts_priority_id_foreign');
		});

		Schema::dropIfExists('ref_priorities');
	}

}