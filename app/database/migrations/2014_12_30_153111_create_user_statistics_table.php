<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_statistics', function($table) {
			
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // id of the user
			
			$table->integer('user_rank'); 
			$table->integer('total_bought_bookstore');
			$table->integer('total_bought_users'); 
			$table->integer('total_price_books');
			$table->integer('number_of_client_partners');
			
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
		Schema::drop('users_statistics'); 
	}

}
