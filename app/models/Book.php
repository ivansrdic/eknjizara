<?php

/**
* 
*/
class Book extends Eloquent {
    
    protected $table = 'books';

    protected $primaryKey = 'book_id';

    public function stack() {
        return $this->hasOne('Stack', 'book_id_foreign');
    }

    public function authors() {
        return $this->belongsToMany('Author', 'author_book', 'book_id_foreign', 'author_id_foreign')->withTimestamps();
    }

    public function genres() {
        return $this->belongsToMany('Genre')->withTimestamps();
    }



}

?>