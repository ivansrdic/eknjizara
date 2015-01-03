<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;


	protected $fillable = array('name', 'lastname','email', 'username', 'password', 'password_temp', 'code', 'active', 'isAdmin', 'remember_token');

	protected $table = 'users'; // table used for model 
	protected $hidden = array('password', 'remember_token');


	// one-to-one relationship
	public function statistics() { 
		return $this->hasOne('User_Statistics', 'user_id');   // matched Eloquent model 'User_Statistics'
	}
	 
    // many-to-many relationships (comments)
    public function comments() { 
    	return $this->belongsToMany('Book', 'book_comment', 'user_id', 'book_id_foreign')->withPivot('comment')->withTimestamps();  
	}

	// many-to-many relationships (rates)
	public function grades() {
		return $this->belongsToMany('Book', 'rating_book', 'user_id', 'book_id_foreign')->withPivot('grade')->withTimestamps();
	}

	// many-to-many relationships (purchases)
	public function purchases() { 
		return $this->belongsToMany('Book', 'purchase_book', 'user_id', 'book_id_foreign')->withPivot('certificate_link', 'purchase_price')->withTimestamps();
	}


}
