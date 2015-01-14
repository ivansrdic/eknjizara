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
            $bookstore = BookstoreStatistics::all()->first();
            $bookstore->total_number_of_titles++;
            $bookstore->save();
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
            foreach ($book->userPurchases as $purchase) {
                    $user = User::find($purchase->id);
                    Mail::send( 'emails.delete-book', 
                                array('username'        => $user->username,
                                    'book_title'        => $book->book_title,
                                    'book_pdf'          => $book->link_to_PDF,
                                    'book_certificate'  => $purchase->certificate_link),
                                function($message) use ($user) {
                                $message->to($user->email, $user->username)->subject('Deleted book'); 
                       });
                }
            if ($book->delete()) {
                $bookstore = BookstoreStatistics::all()->first();
                $bookstore->total_number_of_titles--;
                $bookstore->save();
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
    public static function getBooks($criteria, $parameter) {
        switch ($criteria) {
            case 'author':
                $words = preg_split("/[ ]/", $parameter);

                $author = null;

                if (count($words) == 2) {
                    $author = Author::where('author_name', '=', $words[0])
                                ->where('author_lastname', '=', $words[1])
                                ->get()->first();
                    if (!$author) {
                        $author = Author::where('author_name', '=', $words[1])
                                ->where('author_lastname', '=', $words[0])
                                ->get()->first();
                    }
                }

                if (!$author) {
                    $authors = array();
                    foreach ($words as $word) {
                        $authors = array_unique(array_merge($authors, Author::where('author_lastname', '=', $word)
                            ->get()->all()));
                    }

                    if (!$author) {
                        foreach ($words as $word) {
                            $authors = array_unique(array_merge($authors, Author::where('author_name', '=', $word)
                                ->get()->all()));
                        }
                    }
                    $books = array();
                    foreach ($authors as $author) {
                        $books = array_unique(array_merge($books, $author->books->all()));
                    }
                    return $books;
                }
                return $author->books->all();
                

            case 'title':
                $books = Book::where('book_title', '=', $parameter)->get()->all();
                if (!$books) $books = Book::where(
                                        'book_title', 'LIKE', '%'.$parameter.'%'
                                        )->get()->all();
                if (!$books) $books = array();

                $words = preg_split("/ /", $parameter);
                foreach ($words as $word) {
                    $books = array_unique(array_merge($books, 
                        Book::where('book_title', 'LIKE', '%'.$word.'%')->get()->all()));
                }
                return $books;

            case 'genre':
                $genre = Genre::where('genre_name', '=', $parameter)->get()->first();
                if (!$genre) return array();
                return $genre->books->all();
            case 'year':
                $books = Book::where('publication_year', '=', $parameter)->get()->all();
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
        return Book::orderBy('number_of_purchased_copies', 'desc')->get()->all();
    }

    /**
    * Dohvaca najnovije knjige na temelju godine izdanja.
    * @return vraca array objekata tipa Books, array je sortiran sto znaci da su na pocetku najnovije, a na
    *           kraju najstarije knjige, vraca sve knjige iz baze
    */
    public static function newest() {
        return Book::orderBy('created_at', 'desc')->get()->all();
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
            $stack->client_with_lowest_price = 1;
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

      // if ($book->stack->client_with_lowest_price == $user->id) return false;

      $bookstore = BookstoreStatistics::all()->first();
      $bookstore->total_number_of_sold_titles++;
      $book->number_of_purchased_copies++;
      $book->save();

      $stack = $book->stack; 
      $id_seller = $stack->client_with_lowest_price;
      if($id_seller == 1) {
        $purchase_price = $stack->starting_price;
        $bookstore->total_earnings += $purchase_price;
      } else {
        $purchase_price = $stack->price;
        $bookstore->total_earnings += $purchase_price * $stack->bookstore_commission;
        $bookstore->commission_earnings += $purchase_price * $stack->bookstore_commission;
      }

      fwrite(fopen(getcwd() . '/certificate/' . $user->username . '/' . $book->book_title . '.txt', "w"),
            "Poštovani " . $user->username . ",

ovo je certifikat za knjigu " . $book->book_title . " kojim se potvrđuje da legalno posjedujete pdf primjerak knjige.

Link na PDF primjerak knjige: " . asset($book->link_to_PDF) . "

Hvala Vam na vjernosti.
Vaš MinGW Bookstore");
      
      $book->userPurchases()->attach($user->id, array('user_id_seller' => $id_seller, 'purchase_price' => $purchase_price, 'certificate_link' => 'certificate/' . $user->username . '/' . $book->book_title . '.txt'));
      
      ModelUsers::updateUserStatistics($user, $book);
      ModelBooks::updateStack($book, $user->id);
      $bookstore->save();
      
      return true;
    }


}

?>






