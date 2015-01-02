<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookGenreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_genre', function($table) {
			
			$table->integer('book_id_foreign')->unsigned();
			$table->foreign('book_id_foreign')->references('book_id')->on('books')->onDelete('cascade');

			$table->integer('genre_id_foreign')->unsigned();
			$table->foreign('genre_id_foreign')->references('genre_id')->on('genres')->onDelete('cascade');
	
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
		Schema::drop('book_genre'); 
	}

}
