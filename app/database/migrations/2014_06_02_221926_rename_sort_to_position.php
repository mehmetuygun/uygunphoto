<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSortToPosition extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('panel', function($table) {
			$table->renameColumn('sort', 'position');
		});

		Schema::table('panel_image', function($table) {
			$table->renameColumn('sort', 'position');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('panel', function($table) {
			$table->renameColumn('position', 'sort');
		});

		Schema::table('panel_image', function($table) {
			$table->renameColumn('position', 'sort');
		});
	}

}
