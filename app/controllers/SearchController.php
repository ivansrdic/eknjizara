<?php

class SearchController extends BaseController {

    public function getSearch() {
        $books = ModelBooks::newest();
        $viewParameters = array()
        foreach ($books as $book) {
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

            array_push($viewParameters, array(
                'book_title' => $book->book_title,
                'authors' => $authors,
                'link_picture' => $book->link_picture,
                'genres' => $genres,
                'publication_year' => $book->publication_year,
            );
        }

        return View::make('search', $viewParameters);
    }

    public function postSearch() {

        // ucitaj input

        $viewParameters = array()
        foreach ($books as $book) {
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

            array_push($viewParameters, array(
                'book_title' => $book->book_title,
                'authors' => $authors,
                'link_picture' => $book->link_picture,
                'genres' => $genres,
                'publication_year' => $book->publication_year,
            );
        }

        return View::make('search', $viewParameters);
    }

}


?>