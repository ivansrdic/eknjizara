<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::table('users')->insert(array(
			'id' => 0,
			'name'=>'MinGW Bookstore',
			'lastname'=>'MinGW Bookstore',
			'username'=>'MinGW Bookstore',
			'email'=>'bookstore@mingw.com',
			'active'=>1,
			'isAdmin'=>1,
			'created_at'=>date('Y-m-d H:m:s'),
			'updated_at'=>date('Y-m-d H:m:s')
			));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
