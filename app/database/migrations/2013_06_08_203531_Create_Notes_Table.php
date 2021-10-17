<?php

use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('notes', function($table)
		{
			$table->increments('id');
			$table->string('parent_object', 20);
			$table->integer('parent_id')->unsigned();
			$table->text('note');
			$table->integer('changed_by')->unsigned();
			$table->timestamps();
			$table->softDeletes();

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
		Schema::table('notes', function($table)
		{
			$table->dropForeign('notes_changed_by_foreign');
		});

		Schema::drop('notes');
	}

}