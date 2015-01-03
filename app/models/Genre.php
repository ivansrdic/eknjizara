<?php




class Genre extends Eloquent {

    protected $table = 'genres';

    protected $primaryKey = 'genre_id';

    public function books() {
        return $this->belongsToMany('Book', 'book_genre', 'genre_id_foreign', 'book_id_foreign')->withTimestamps();
    }

}



?>