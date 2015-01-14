<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Book extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;


	protected $fillable = array('book_title', 'link_picture', 'pagenumber', 'publication_year', 'link_to_PDF', 'number_of_purchased_copies', 'description');

	protected $table = 'books'; // table used for model 
  protected $primaryKey = 'book_id';

  // one-to-one relationships (stack)
  public function stack() {
      return $this->hasOne('Stack', 'book_id_foreign');
  }

  // many-to-many relationships (authors)
  public function authors() {
      return $this->belongsToMany('Author', 'author_book', 'book_id_foreign', 'author_id_foreign')->withTimestamps();
  }

  // many-to-many relationships (genres)
  public function genres() {
      return $this->belongsToMany('Genre', 'book_genre', 'book_id_foreign', 'genre_id_foreign')->withTimestamps();
  }
  // many-to-many relationships (comments)
  public function userComments() { 
      return $this->belongsToMany('User', 'book_comment', 'book_id_foreign', 'user_id')->withPivot('comment')->withTimestamps();  
  }

  // many-to-many relationships (rates)
  public function userGrades() {
      return $this->belongsToMany('User', 'rating_book', 'book_id_foreign', 'user_id')->withPivot('grade')->withTimestamps();
  }

  // many-to-many relationships (purchases)
  public function userPurchases() { 
      return $this->belongsToMany('User', 'purchase_book', 'book_id_foreign', 'user_id')->withPivot('certificate_link', 'purchase_price')->withTimestamps();
  }

  public function __toString(){
      return (string)$this->book_id;
  }

}
