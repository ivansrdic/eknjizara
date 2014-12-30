<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookstoreStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookstore_statistics', function($table) {
			
			$table->integer('total_number_of_titles')->primary(); 
			$table->integer('total_number_of_sold_titles'); 
			$table->integer('total_earnings');
			$table->integer('commission_earnings');
			
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
		Schema::drop('bookstore_statistics'); 

	}

}
