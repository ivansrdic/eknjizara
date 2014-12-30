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
			'name'=>'Filip',
			'lastname'=>'Zelic',
			'username'=>'fico',
			'email'=>'filip.zelic@fer.hr',
			'active'=>0,
			'isAdmin'=>0,
			'created_at'=>date('Y-m-d H:m:s'),
			'updated_at'=>date('Y-m-d H:m:s')
			));
	
		DB::table('users')->insert(array(
			'name'=>'Ivan',
			'lastname'=>'Ivic',
			'username'=>'ivan',
			'email'=>'ivan.ivic@fer.hr',
			'active'=>0,
			'isAdmin'=>0,
			'created_at'=>date('Y-m-d H:m:s'),
			'updated_at'=>date('Y-m-d H:m:s')
			));

		DB::table('users')->insert(array(
			'name'=>'Luka',
			'lastname'=>'Lukic',
			'username'=>'luka',
			'email'=>'luka.lukic@fer.hr',
			'active'=>0,
			'isAdmin'=>0,
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
		DB::table('users')->where('name', '=', 'Filip')->delete(); 
		DB::table('users')->where('name', '=', 'Ivan')->delete(); 
		DB::table('users')->where('name', '=', 'Luka')->delete(); 
	}

}
