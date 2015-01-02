
<?php




class Author extends Eloquent {

    protected $table = 'authors';

    protected $primaryKey = 'author_id';

    public function books() {
        return $this->belongsToMany('Book', 'author_book', 'author_id_foreign', 'book_id_foreign')->withTimestamps();
    }

}



?>