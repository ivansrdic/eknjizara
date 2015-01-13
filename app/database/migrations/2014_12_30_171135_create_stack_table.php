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
		Schema::create('stacks', function($table) {
			

			$table->integer('book_id_foreign')->unsigned();
			$table->foreign('book_id_foreign')->references('book_id')->on('books')->onDelete('cascade');

			$table->float('starting_price');
			$table->float('price');
			$table->smallInteger('stack_rank')->default(0);
			$table->float('percentage_reduction_price')->default(0.02);
			$table->integer('client_with_lowest_price')->unsigned()->default(1);
			$table->foreign('client_with_lowest_price')->references('id')->on('users');
			$table->float('bookstore_commission')->default(0.05);
			$table->smallInteger('max_stack_rank')->default(8);

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
		Schema::drop('stacks');
	}

}
