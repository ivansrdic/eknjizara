<?php

class BookController extends BaseController {

    public function getBook($id) {
        $book = Book::find($id);

        //nes drugo stavit
        if ($book == null) return View::make('book', $book);

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
            'book_title' => $book->book_title,
            'authors' => $authors,
            'link_picture' => $book->link_picture,
            'genres' => $genres,
            'publication_year' => $book->publication_year,
            'pagenumber' => $book->pagenumber,
            'grade' => $averageGrade,
            'comments' => $book->userComments,
            'stack_rank' => $book->stack->stack_rank
        );
        return View::make('book', $viewParameters);
    }

    public function postBook() {
        $book = Book::find($id);

        //ili sta vec
        if (Input::get('bookId')) {
            return Redirect::route('buy', $id);
        } else {
            //dohvati ocjenu

            ModelUsers::saveGrade($book, Auth::user(), $grade);
        }
        return Redirect::route('book', $id);
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

    public function postBuyBook($id) {
        $book = Book::find($id);

        // nes drugo stavit
        if ($book == null) return View::make('buy', $book);

        if (Input::get('nesto')) {
            ModelBooks::buyBook(Auth::user(), $book);
            //nesto, fali route
            return Redirect::route();
        }
    }

}


?>