 <?php

class ModelBooks {

    /**
    * Dodavanje knjige u bazu. Klase Book, Author i Genre imaju istu 
    * @param Book &$book - knjiga koja se dodaje u bazu, prima se po referenci sto znaci da ako je
    *                    knjiga uspjesno dodana u bazu dobili ste instancu te knjige nazad u $book
    * @param array $authors - objekti tipa Author u arrayu, svi autori knjige ako ih ima vise,
    *                           i ako je samo jedan autor mora biti u arrayu, prima se referenca
    * @param array $genres - objekti tipa Genre u arrayu, vrijede ista pravila kao i za autore
    * @param $price - pocetna cijena knjige
    * @return vraca true ako je knjiga dodana a false inace
    * 
    * Primjer koristenja:
    *
    *    $book = new Book();
    *    //imena atributa su jednaka imenima iz baze, isto vrijedi i za razred Author i Genre
    *    $book->book_title = 'Harry Potter';
    *    $authors = array(new Author(), new Author());
    *    $authors[0]->author_name = 'ivo';
    *    $authors[0]->author_lastname = 'ivica';
    *    $authors[1]->author_name = 'pero';
    *    $authors[1]->author_lastname = 'perica';
    *   
    *    $genres = array(new Genre(), new Genre());
    *    $genres[0]->genre_name = 'krimic';
    *    $genres[1]->genre_name = 'fantasy';
    *
    *    ModelBooks::addBook($book, $authors, $genres, 100);
    *    
    */
    public static function addBook(Book &$book, array $authors, array $genres, $price) {
        $authors_ids = array();
        foreach ($authors as $author) {
            try {
                $author->save();
                array_push($authors_ids, $author->author_id);
            } catch (\Illuminate\Database\QueryException $e) {
                $author = Author::where('author_name', '=', $author->author_name)
                                ->where('author_lastname', '=', $author->author_lastname)
                                ->get()->first();
                array_push($authors_ids, $author->author_id);
            }
        }

        $genres_ids = array();
        foreach ($genres as $genre) {
            try {
                $genre->save();
                array_push($genres_ids, $genre->genre_id);
            } catch (\Illuminate\Database\QueryException $e) {
                try{$genre = Genre::where('genre_name', '=', $genre->genre_name)
                                ->get()->first(); } catch(QueryException $e){}
                array_push($genres_ids, $genre->genre_id);
            }
        }
        
        try {
            if (!$book->save()) return false;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }

        $book->authors()->sync($authors_ids);
        $book->genres()->sync($genres_ids);

        $stack = new Stack();
        $stack->starting_price = $price;
        $stack->price = $price;
        $book->stack()->save($stack);

        if ($book->push()) {
            return true;
        }
        return false;

    }

    /**
    * Updateanje knjige.
    * @param Book &$book - knjiga koju treba updateati, mora biti konkretna instanca vec postojece knjige,
    *                       naprimjer jedna od knjiga dohvacena pomocu metode getBooks(),
    *                       potrebni atributi se mijenjaju izvana, ova metoda samo sprema predanu knjigu 
    *                       u bazu
    * @return vraca true ako je update uspjesan, false inace
    */
    public static function updateBook(Book &$book) {
        try {
            if ($book->push()) {
                return true;
            }
            return false;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }

    /**
    * Brisanje knjige.
    * @param Book &$book - knjiga koju treba obrisati, mora biti konkretna instanca vec postojece knjige,
    *                       naprimjer jedna od knjiga dohvacena pomocu metode getBooks()
    * @return vraca true ako je delete uspjesan, false inace
    */
    public static function deleteBook(Book &$book) {
        try {
             if ($book->delete()) {
                return true;
            }
            return false;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }

    /**
    * Dohvacanje knjiga po kriterijima. Vracaju se knjige koje samo tocno odgovaraju trazenim kriterijima.
    * @param $criteria - kriterij, moze biti 'author', 'title', 'genre'
    * @param array $parameter - asocijativni array
    *                         - ako je kriterij 'author', kljucevi su 'author_name', 'author_lastname'
    *                         - ako je kriterij 'title', kljuc je 'book_title'
    *                         - ako je kriterij 'genre', kljuc je 'genre_name'
    *                         - svi argumenti su case insensitive, znaci nemorate brinut o malim i velikim slovima
    * @return vraca array objekata tipa Books, knjige koje odgovaraju trazenom kriteriju
    * 
    * Primjer koristenja:
    * 
    *    $books = ModelBooks::getBooks('author', array('author_name' => 'Ivo', 'author_lastname' => 'ivica'));
    *    $books = ModelBooks::getBooks('title', array('book_title' => 'Gospodar prstenova 1'));
    *    $books = ModelBooks::getBooks('genre', array('genre_name' => 'krimic'));
    *
    */
    public static function getBooks($criteria, array $parameter) {
        switch ($criteria) {
            case 'author':
                // $authors = Author::where('author_name', 'LIKE', '%'.$parameter['author_name'].'%')
                //             ->where('author_lastname', 'LIKE', '%'.$parameter['author_lastname'].'%')
                //             ->get();

                $author = Author::where('author_name', '=', $parameter['author_name'])
                            ->where('author_lastname', '=', $parameter['author_lastname'])
                            ->get()->first();

                if (!$author) return array();
                return $author->books->all();
                // foreach ($authors as $author) {
                //     $books += $author->books->all();
                // }

            case 'title':
                $books = Book::where('book_title', '=', $parameter['book_title'])->get();
                return $books;

            case 'genre':
                $genre = Genre::where('genre_name', '=', $parameter['genre_name'])->get()->first();
                if (!$genre) return array();
                return $genre->books->all();
            case 'year':
                $books = Book::where('publication_year', '=', $parameter['year'])->get();
                return $books;

            default:
                throw new Exception("Criteria format invalid", 1);
        }
    }

    /**
    * Dohvaca najprodavanije knjige. Ne knjige koje su najvise zaradile nego koje su najveci broj puta prodane.
    * @return vraca array objekata tipa Books, array je sortiran sto znaci da su na pocetku najprodavanije, a na
    *           kraju najneprodavanije knjige, vraca sve knjige iz baze
    */
    public static function topSeller() {
        return Book::orderBy('number_of_purchased_copies', 'desc')->get();
    }

    /**
    * Dohvaca najnovije knjige na temelju godine izdanja.
    * @return vraca array objekata tipa Books, array je sortiran sto znaci da su na pocetku najnovije, a na
    *           kraju najstarije knjige, vraca sve knjige iz baze
    */
    public static function newest() {
        return Book::orderBy('publication_year', 'desc')->get();
    }

    /**
    * Updatea stog kupnje za odredenu knjigu po formuli iz dokumentacije.
    * @param Book &$book - knjiga ciji stog treba updateati, mora biti konkretna instanca vec postojece knjige,
    *                       naprimjer jedna od knjiga dohvacena pomocu metode getBooks()
    * @param $userID - id usera koji je kupio knjigu, tj. koji ima sada novu najmanju cijenu
    * @return vraca true ako je uspjesno, inace false
    */
    public static function updateStack(Book &$book, $userID) {
        $stack = $book->stack;
        if ($stack->stack_rank == $stack->max_stack_rank) {
            $stack->stack_rank = 0;
            $stack->price = $stack->starting_price;
            $stack->client_with_lowest_price = null;
        } else {
            $stack->stack_rank++;
            $stack->price -= $stack->stack_rank * $stack->percentage_reduction_price * $stack->price;
            $stack->client_with_lowest_price = $userID;
        }
        try {
            if ($stack->save()) return true;
            return false;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }


    /**
    * Metoda simulira kupnju odnoso pohranjuje obavljenu kupnju u bazu podataka ( sprema id kupca, id knjige i id prodavaca).
    * @param User $user kupac
    * @param Book $book knjiga koja je kupljena
    */
    public static function buyBook(User $user, Book $book) {

      $stack = $book->stack; 
      $id_seller = $stack->client_with_lowest_price; 
      if($id_seller == '0') {
        $purchase_price = $stack->starting_price; 
      } else {
        $purchase_price = $stack->price; 
      }
      
      //certificate link ???
      $book->userPurchases()->attach($user->id, array('user_id_seller' => $id_seller, 'purchase_price' => $purchase_price, 'certificate_link' => 'Link_na_certifikat'));
      updateStack($book, $id_seller);
    }


}

?>






