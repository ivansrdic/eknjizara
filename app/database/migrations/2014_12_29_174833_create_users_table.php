<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function($table) {
			$table->engine = 'InnoDB';
			
			$table->increments('id');

			$table->string('name'); 
			$table->string('lastname');
			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('password_temp');
			$table->string('code');				// activation code 
			$table->string('remember_token'); 
			$table->integer('active')->default('0'); 
			$table->integer('isAdmin');

			$table->timestamps(); // creating created_at & updated_at
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users'); 
	}

}
