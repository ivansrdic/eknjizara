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
            'stack_rank' => $book->stack->stack_rank
        );
        return View::make('book', $viewParameters);
    }

    /*
    Moram u komentaru dobit username, a ne user_id tak da to u modelu treba sredit

    */

    public function postBook() {
        $book = Book::find(Input::get('book_id'));
        if (Input::get('type') == 'rate') {
            // dodati autoriziranog usera
            ModelUsers::saveGrade(User::find(2), $book, Input::get('rating'));

        } elseif (Input::get('type') == 'comment') {
            // dodati autoriziranog usera
            ModelUsers::saveComment(User::find(2), $book, Input::get('comment'));
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

        // dodati autoriziranog usera
        ModelBooks::buyBook(User::find(2), $book);
        return Redirect::route('profile');
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
        if (! Auth::user()->isAdmin()) 
            return Redirect::route('home') 
                ->with('global', 'You do not have permission for this action.');

        return View::make('add-book');

    }


    public function postAddBook() {
        // provjera administratorskih ovlasti
        if (! Auth::user()->isAdmin()) 
            return Redirect::route('home') 
                ->with('global', 'You do not have permission for this action.');

        $validator = Validator::make(Input::all(),
            array(
                'book_title'  => 'required|max:100|min:1',
                'authors'     => 'required|max:200|min:1',
                'genres'      => 'required|max:200|min:1',
                'price'       => 'required'
                ) 
            );


        if($validator->fails()) {
                return Redirect::route('home')
                ->withErrors($validator)
                ->withInput(); 
        } else {
                $book_title = Input::get('book_title'); 
                $authors    = Input::get('authors');
                $genres     = Input::get('genres');
                $price      = Input::get('price'); 

                $book = new Book();
                $book->book_title = $book_title;
                $book = ModelBooks::addBook(&$book, $authors, $genres, $price);

                /*
                $book = Book::create(array(
                    'book_title' => $book_title,
                    'authors'    => $authors,
                    'genres'     => $genres,
                    'price'      => $price
                ));
                */

                if($book->save()) {
                    return Redirect::route('profile')
                                    ->with('global','Your book has been saved!');
                } else {
                    return Redirect::route('profile')
                                    ->with('global','Your book has not been saved!');
                }
            }

        return View::make('add-book');
    }


}


?>