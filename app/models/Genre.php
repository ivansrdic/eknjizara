<?php




class Genre extends Eloquent {

    protected $table = 'genres';

    protected $primaryKey = 'genre_id';

    public function books() {
        return $this->belongsToMany('Book')->withTimestamps();
    }

}



?>