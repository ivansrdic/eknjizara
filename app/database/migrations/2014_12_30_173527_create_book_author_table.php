<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookAuthorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_author', function($table) {
			
			$table->integer('book_id_foreign')->unsigned();
			$table->foreign('book_id_foreign')->references('book_id')->on('books');

			$table->integer('author_id_foreign')->unsigned();
			$table->foreign('author_id_foreign')->references('author_id')->on('author');
	
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
		Schema::drop('book_author'); 
	}

}
