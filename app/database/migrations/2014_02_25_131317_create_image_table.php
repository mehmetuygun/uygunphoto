<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('title', 64);
			$table->string('thumbnail_name', 128);
			$table->string('web_name', 128);
			$table->string('web_string', 64);
			$table->integer('web_width');
			$table->integer('web_height');
			$table->string('original_name', 128);
			$table->integer('user_id');
			$table->integer('banner_id');
			$table->boolean('active');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('image');
	}

}
