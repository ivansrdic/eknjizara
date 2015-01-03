<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User_Statistics extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;


	protected $fillable = array('user_rank', 'total_bought_bookstore', 'total_bought_users', 'total_price_books', 'number_of_client-partners'); 

	protected $table = 'users_statistics';  // table used for model 
	protected $primaryKey = 'user_id'; 

	// one-to-one relationship 
	public function user() {
		return $this->belongsTo('User', 'user_id', 'id'); // matched Eloquent model 'User'
	}

}
