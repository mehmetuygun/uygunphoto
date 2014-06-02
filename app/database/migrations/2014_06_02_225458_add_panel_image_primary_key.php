<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPanelImagePrimaryKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('panel_image', function($table) {
			$table->primary(array('panel_id', 'image_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('panel_image', function($table) {
			$table->dropPrimary('PRIMARY');
		});
	}

}
