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
			
			$table->integer('total_number_of_titles')->primary()->default(0); 
			$table->integer('total_number_of_sold_titles')->default(0); 
			$table->float('total_earnings')->default(0); 
			$table->float('commission_earnings')->default(0); 
			
			$table->timestamps(); // creating created_at & updated_at
		});

		DB::table('bookstore_statistics')->insert(array());

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
