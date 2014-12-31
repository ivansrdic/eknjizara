<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;


	protected $fillable = array('name', 'lastname','email', 'username', 'password', 'password_temp', 'code', 'active', 'isAdmin', 'remember_token');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function registerValidation() {
		$users = DB::table('users')->get(); 
		foreach($users as $user) {
			var_dump($user->id); 
		}
	}


	public static function getUsers() {

		$users = DB::table('users')->get();
		$array[] = array(); 
		foreach($users as $user) {
			array_push($array, $user); 
		}
		var_dump($array);
		//return $array; 
	}

	public static function getUsersStatistics() { 

		$statistics = DB::table('users_statistics')->get(); 
		$array[] = array(); 
		foreach($statistics as $row) { 
			array_push($array, $row); 
		}
		var_dump($array); 
		// return $array; 
	}

	public static function getBookstoreStatistics() { 

		$statistics = DB::table('bookstore_statistics')->get(); 
		$array[] = array(); 
		foreach($statistics as $row) { 
			array_push($array, $row); 
		}
		var_dump($array); 
		// return $array; 
	}

	public static function getNumberOfPartners() { 
		$users = DB::table('users')->get();
		
		foreach($users as $user){
			$id = $user->id; 
			$array[] = array(); 
			$number = DB::table('users')
			        ->join('users_statistics', function($join)
			        {
			            $join->on('users.id', '=', 'users_statistics.user_id');	                
			        })
			        ->select('number_of_client-partners')->where('id', $id)->get();
			array_push($array, $number);			
		}
	
	var_dump($array); 
	// return $array; 
	}




	public static function updateUser() { 

		if($user->save()) {
            return true; 
        } else return false; 
	}









}
