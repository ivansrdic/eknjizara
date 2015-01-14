<?php

class BookController extends BaseController {

    public function getBook($id) {
        $book = Book::find($id);

        //
        if ($book == null) return View::make('error');

        $authors = "";
        foreach ($book->authors as $author) {
            $authors = ($authors == "") ? "" : $authors . ", ";
            $authors = $authors . $author->author_name . " " . $author->author_lastname;
        }

        $genres = "";
        foreach ($book->genres as $genre) {
            $genres = ($genres == "") ? "" : $genres . ", ";
            $genres = $genres . $genre->genre_name;
        }

        $grades = ModelUsers::getGrades($id);
        $averageGrade = 0;
        foreach ($grades as $grade) {
            $averageGrade += $grade;
        }
        $averageGrade /= ((count($grades) != 0) ? count($grades) : 1);

        $viewParameters = array(
            'book_id' => $id,
            'book_title' => $book->book_title,
            'authors' => $authors,
            'link_picture' => $book->link_picture,
            'genres' => $genres,
            'publication_year' => $book->publication_year,
            'pagenumber' => $book->pagenumber,
            'grade' => $averageGrade,
            'comments' => ModelUsers::getComments_book($id),
            'stack_rank' => $book->stack->stack_rank,
            'description' => $book->description
        );
        return View::make('book', $viewParameters);
    }

    public function postBook() {
        $book = Book::find(Input::get('book_id'));
        if (Input::get('type') == 'rate') {
            // dodati autoriziranog usera
            ModelUsers::saveGrade(User::find(Auth::user()->id), $book, Input::get('rating'));

        } elseif (Input::get('type') == 'comment') {
            // dodati autoriziranog usera
            ModelUsers::saveComment(User::find(Auth::user()->id), $book, Input::get('comment'));
        }
        return Redirect::route('book', $book->book_id);
    }

    public function getBuyBook($id) {
        $book = Book::find($id);

        // nes drugo stavit
        if ($book == null) return View::make('buy', $book);

        $authors = "";
        foreach ($book->authors as $author) {
            $authors = ($authors == "") ? "" : $authors . ", ";
            $authors = $authors . $author->author_name . " " . $author->author_lastname;
        }

        $genres = "";
        foreach ($book->genres as $genre) {
            $genres = ($genres == "") ? "" : $genres . ", ";
            $genres = $genres . $genre->genre_name;
        }

        $grades = ModelUsers::getGrades($id);
        $averageGrade = 0;
        foreach ($grades as $grade) {
            $averageGrade += $grade;
        }
        $averageGrade /= ((count($grades) != 0) ? count($grades) : 1);

        $seller = User::find($book->stack->client_with_lowest_price);
        if ($seller == null) $seller = 'Bookstore';
        else $seller = $seller->username;

        $viewParameters = array(
            'book_id' => $id,
            'book_title' => $book->book_title,
            'authors' => $authors,
            'link_picture' => $book->link_picture,
            'genres' => $genres,
            'publication_year' => $book->publication_year,
            'pagenumber' => $book->pagenumber,
            'grade' => $averageGrade,
            'comments' => $book->userComments,
            'stack_rank' => $book->stack->stack_rank,
            'price' => $book->stack->price,
            'numberOfPurchases' => $book->number_of_purchased_copies,
            'seller' => $seller
        );
        return View::make('buy', $viewParameters);
    }

    public function postBuyBook() {
        $book = Book::find(Input::get('book_id'));
        if ($book->userPurchases()->wherePivot('user_id', '=', Auth::user()->id)->count() == 0) {
            ModelBooks::buyBook(Auth::user(), $book);
            return Redirect::route('profile')->with('global', "You just bought ".$book->book_title.". Enjoy your book.");
        }
        return Redirect::route('profile')->with('global', "You already own ".$book->book_title.".");
    }

    public function getHome() {
        $newest = ModelBooks::newest();

        // var_dump($newest);
        if (count($newest) > 4) {
            $newest = array_slice($newest, 0, 4);
        }

        for($i = 0; $i < count($newest); $i++) {
            $authors = "";
            foreach ($newest[$i]->authors as $author) {
                $authors = ($authors == "") ? "" : $authors . ", ";
                $authors = $authors . $author->author_name . " " . $author->author_lastname;
            }
            $tmp = array(
                'book_id' => $newest[$i]->book_id,
                'link_picture' => $newest[$i]->link_picture,
                'book_title' => $newest[$i]->book_title,
                'authors' => $authors
            );
            $newest[$i] = $tmp;
        }

        $topSeller = ModelBooks::topSeller();

        // var_dump($topSeller);
        if (count($topSeller) > 4) {
            $topSeller = array_slice($topSeller, 0, 4);
        }

        for($i = 0; $i < count($topSeller); $i++) {
            $authors = "";
            foreach ($topSeller[$i]->authors as $author) {
                $authors = ($authors == "") ? "" : $authors . ", ";
                $authors = $authors . $author->author_name . " " . $author->author_lastname;
            }
            $tmp = array(
                'book_id' => $topSeller[$i]->book_id,
                'link_picture' => $topSeller[$i]->link_picture,
                'book_title' => $topSeller[$i]->book_title,
                'authors' => $authors
            );
            $topSeller[$i] = $tmp;
        }

        return View::make('home', array('newest' => $newest, 'topSeller' => $topSeller)); 


    }


    public function getAddBook() {
        // provjera administratorskih ovlasti
        if (! Auth::user()->isAdmin)
            return Redirect::route('home') 
                ->with('global', 'You do not have permission for this action.');
        
        return View::make('add-book');

    }


    public function postAddBook() {
        // provjera administratorskih ovlasti
        if (! Auth::user()->isAdmin) 
            return Redirect::route('home') 
                ->with('global', 'You do not have permission for this action.');
        
        $validator = Validator::make(Input::all(),
            array(
                'book_title'       => 'required|max:100',
                'authors'          => 'required|max:200',
                'genres'           => 'required|max:200',
                'publication_year' => 'required',
                'price'            => 'required',
                'pagenumber'       => 'required',
                'description'      => 'required',
                'book_copy'        => 'required',
                'book_picture'     => 'required'
                ) 
            );

        if($validator->fails()) {
                return Redirect::route('add-book')
                ->withErrors($validator)
                ->withInput(); 
        } else {
                $book_title       = Input::get('book_title'); 
                $tmp1Authors      = Input::get('authors');
                $tmpGenres        = Input::get('genres');
                $publication_year = Input::get('publication_year');
                $price            = Input::get('price');
                $pagenumber       = Input::get('pagenumber');
                $description      = Input::get('description');

                

                $tmp1Authors = explode(", ", $tmp1Authors);
                $authors = array();
                $j = count($tmp1Authors);

                foreach ($tmp1Authors as $author) {
                    $tmpAuthors[] = explode(" ", $author);
                }
                
                for($i=0; $i<$j; $i++) {
                    $authors[$i] = new Author();
                    $authors[$i]->author_name     = $tmpAuthors[$i][0];
                    $authors[$i]->author_lastname = $tmpAuthors[$i][1];
                }
                
                $genres = array();
                $tmpGenres = explode(", ", $tmpGenres);
                $j = count($tmpGenres);
                for($i=0; $i<$j; $i++) {
                    $genres[$i] = new Genre();
                    $genres[$i]->genre_name = $tmpGenres[$i]; 
                }
                $id = Book::all()->last()->book_id;

                $book = new Book();
                $book->book_title       = $book_title;
                $book->publication_year = $publication_year;
                $book->pagenumber       = $pagenumber;
                $book->link_to_PDF      = 'pdf/' . $id . '.' . Input::file('book_copy')->getClientOriginalExtension();
                $book->link_picture     = 'images/book-covers/' . $id . '.' . Input::file('book_picture')->getClientOriginalExtension(); 
                $book->description      = $description;
                if (ModelBooks::addBook($book, $authors, $genres, $price)) {
                    Input::file('book_copy')->move('pdf', $id . "." . Input::file('book_copy')->getClientOriginalExtension());
                    Input::file('book_picture')->move('images/book-covers', $id . "." . Input::file('book_picture')->getClientOriginalExtension());
                    return Redirect::route('add-book')
                        ->with('global','Your book has been saved!');
                } else {
                    return Redirect::route('add-book')
                        ->with('global','Your book has not been saved!')
                        ->withInput();
                }
                
            }

    }

    public function getDeleteBook($id) {
        $book = Book::find($id);
        $book_title = $book->book_title;
        if(ModelBooks::deleteBook($book)) {
            return Redirect::route('admin-book-list')
                        ->with('global','The book "' . $book_title . '" has been deleted!');
        } else {
            return Redirect::route('admin-book-list')
                        ->with('global','The book "' . $book_title . '" has NOT been deleted!');
        }
    }


}


