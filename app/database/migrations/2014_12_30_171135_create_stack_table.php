<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stack', function($table) {
			

			$table->integer('book_id_foreign')->unsigned();
			$table->foreign('book_id_foreign')->references('book_id')->on('books');

			$table->integer('price'); 
			$table->smallInteger('stack_rank');
			$table->string('percentage_reduction_price');
			$table->string('client_with_lowest_price'); 
			$table->string('percentage_reduction_commission');
			$table->integer('bookstore_commission'); 
			$table->smallInteger('max_stack_rank'); 

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
		Schema::drop('stack');
	}

}
