<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddBooks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('books')->insert(array(
			'book_title'      => 'Gospodar prstenova 1',
			'pagenumber'      => '250',
			'publication_year'=>'2005',
			'link_to_PDF'     =>'www.gospodar_prstenova_1.hr',
			'created_at'      =>date('Y-m-d H:m:s'),
			'updated_at'      =>date('Y-m-d H:m:s')
			));

		DB::table('books')->insert(array(
			'book_title'      =>'Gospodar prstenova 2',
			'pagenumber'      =>'270',
			'publication_year'=>'2006',
			'link_to_PDF'     =>'www.gospodar_prstenova_2.hr',
			'created_at'      =>date('Y-m-d H:m:s'),
			'updated_at'      =>date('Y-m-d H:m:s')
			));

		DB::table('books')->insert(array(
			'book_title'      =>'Gospodar prstenova 3',
			'pagenumber'      =>'300',
			'publication_year'=>'2009',
			'link_to_PDF'     =>'www.gospodar_prstenova_3.hr',
			'created_at'      =>date('Y-m-d H:m:s'),
			'updated_at'      =>date('Y-m-d H:m:s')
			));

		DB::table('books')->insert(array(
			'book_title'      =>'Gospodar prstenova 4',
			'pagenumber'      =>'350',
			'publication_year'=>'2010',
			'link_to_PDF'     =>'www.gospodar_prstenova_4.hr',
			'created_at'      =>date('Y-m-d H:m:s'),
			'updated_at'      =>date('Y-m-d H:m:s')
			));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('books')->where('book_title', '=', 'Gospodar prstenova 1')->delete(); 
		DB::table('books')->where('book_title', '=', 'Gospodar prstenova 2')->delete(); 
		DB::table('books')->where('book_title', '=', 'Gospodar prstenova 3')->delete(); 
		DB::table('books')->where('book_title', '=', 'Gospodar prstenova 4')->delete();  
	}

}
