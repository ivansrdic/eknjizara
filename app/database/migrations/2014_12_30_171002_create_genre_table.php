<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genres', function($table) {
			
			$table->increments('genre_id');
			$table->string('genre_name')->unique(); 
			
			$table->timestamps(); // creating created_at & updated_at
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('genres'); 
	}

}
