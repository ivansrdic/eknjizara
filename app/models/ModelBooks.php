<?php

class ModelBooks {

    public static function addBook($book, $authors, $genres) {

        //mozda dodati provjeru jel postoji;


        // $author_book = DB::table('books')
        //                 ->join('book_author', 'book_id', '=', 'book_id_foreign')
        //                 ->join('author', 'author_id', '=', 'author_id_foreign');

        // if ($author_book
        //     ->where('author_name', '=', $author['author_name'])
        //     ->where('author_lastname', '=', $author['author_lastname'])
        //     ->count() == 0) {
        //         DB::table('author')->insert($author);
        // }

        // if ($author_book
        //     ->where('book_title', '=', $book['book_title'])
        //     ->where('author_name', '=', $author['author_name'])
        //     ->where('author_lastname', '=', $author['author_lastname'])
        //     ->count() == 0) {
        //         DB::table('books')->insert($book);
        // }

        $authors[0]->save();
        $id = $authors[0]->author_id;
        echo $id;
        $book->save();
        $book->authors()->sync(array($id));
        $authors[1]->save();
        $genres[0]->save();
        $genres[1]->save();

        if($book->push()) {
            return true;
        }
        return false;
        

    }

}

?>