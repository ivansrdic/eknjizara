<?php




class Stack extends Eloquent {

    protected $table = 'stacks';

    protected $primaryKey = 'book_id_foreign';

    public function book() {
        return $this->belongsTo('Book', 'book_id_foreign');
    }

}



?>