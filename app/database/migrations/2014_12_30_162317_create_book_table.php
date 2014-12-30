<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function($table) {
			
			$table->increments('book_id');
			$table->string('book_title'); 
			$table->string('link_picture');
			$table->integer('pagenumber');
			$table->integer('publication_year');  // Nema year type pa sam stavio integer(da bude samo godina bez datuma)! 
			$table->string('link_to_PDF')->unique();
			$table->integer('number_of_purchased_copies');
		
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
		Schema::drop('books'); 
	}

}
