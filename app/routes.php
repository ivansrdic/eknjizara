<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/test', array(
	'as' => 'test',
	function() {
		$book = new Book();
		$book->book_title = 'Gospodar prstenova 1';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.gospodar_prstenova_1.hr';


		$author = new Author();
		$author->author_name = 'J.R.R';
		$author->author_lastname = 'Tolkien';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);

		$book = new Book();
		$book->book_title = 'Gospodar prstenova 2';
		$book->pagenumber = 270;
		$book->publication_year = 2006;
		$book->link_to_PDF = 'www.gospodar_prstenova_2.hr';

		ModelBooks::addBook($book, array($author), $genres, 250);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter 1';
		$book->pagenumber = 230;
		$book->publication_year = 2006;
		$book->link_to_PDF = 'www.Harry_Potter_1.hr';

		$author = new Author();
		$author->author_name = 'J.K.';
		$author->author_lastname = 'Rowling';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'erotic';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 300);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter 2';
		$book->pagenumber = 120;
		$book->publication_year = 2007;
		$book->link_to_PDF = 'www.Harry_Potter_2.hr';

		ModelBooks::addBook($book, array($author), $genres, 290);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter I Gospodar Prstenova';
		$book->pagenumber = 240;
		$book->publication_year = 2010;
		$book->link_to_PDF = 'www.Harry_Potter_lotr.hr';

		$authors = array(new Author(), new Author());
		$authors[0]->author_name = 'J.K.';
		$authors[0]->author_lastname = 'Rowling';
		$authors[1]->author_name = 'J.R.R';
		$authors[1]->author_lastname = 'Tolkien';
		

		ModelBooks::addBook($book, $authors, $genres, 10000);

		// if (ModelBooks::deleteBook($book)) return "bravo";
		// $books = ModelBooks::getBooks('author', array('author_name' => 'Ivo', 'author_lastname' => 'ivica'));
		// $books = ModelBooks::getBooks('title', array('book_title' => 'Gospodar prstenova 1'));
		// $books = ModelBooks::getBooks('genre', array('genre_name' => 'krimic'));
		// $books = ModelBooks::newest();
		// $books = ModelBooks::topSeller();
		// ModelBooks::updateStack($books[0], 2);
		// foreach ($books as $book) {
		// 	echo $book->book_title;
		// }
		// if (ModelBooks::deleteBook($books[0])) return "bravo";
}));

Route::get('/', array(
	'as' => 'home',
	'uses' => 'BookController@getHome'
));

 // ************************************************************************ // 

 /* Login / sign out sign in */

 /* 
Authenticated group 
*/
Route::group(array('before' => 'auth'), function() {
	/*
	CSRF protection group
	*/
	Route::group(array('before' => 'csrf'), function(){
		/* 
		Change password (post part)
		*/
		Route::post('/account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));
	});

	/* 
	Change password (get part)
	*/
	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));

	/* 
	Sign out (get part)
	*/
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));

	Route::get('/profile', array(
		'as' => 'profile',
		'uses' => 'ProfileController@getProfile'
	));

	Route::get('/profile/edit', array(
		'as' => 'edit',
		'uses' => 'ProfileController@getEditProfile'
	));

	Route::post('/profile/edit', array(
		'as' => 'edit',
		'uses' => 'ProfileController@postEditProfile'
	));

	Route::get('/profile/add-book', array(
		'as' => 'add-book',
		'uses' => 'BookController@getAddBook'
	));

	Route::post('/profile/add-book', array(
		'as' => 'add-book',
		'uses' => 'BookController@postAddBook'
	));

	Route::get('/profile/admin-book-list', array(
		'as' => 'admin-book-list',
		'uses' => 'ProfileController@getBookList'
	));

	Route::get('/profile/admin-registered-list', array(
		'as' => 'admin-registered-list',
		'uses' => 'ProfileController@getRegisteredClients'
	));

	Route::get('/profile/client-partner-list', array(
		'as' => 'client-partner-list',
		'uses' => 'ProfileController@getPartnerList'
	));

	Route::get('/search', array(
		'as' => 'search',
		'uses' => 'SearchController@getSearch'
	));

	Route::post('/search', array(
		'as' => 'search',
		'uses' => 'SearchController@postSearch'
	));

	Route::get('/book/{id}', array(
		'as' => 'book',
		'uses' =>  'BookController@getBook'
	))->where('id', '[0-9]+');

	Route::post('/book', array(
		'as' => 'book-post',
		'uses' =>  'BookController@postBook'
	));

	Route::get('/book/buy/{id}', array(
		'as' => 'buy-book',
		'uses' =>  'BookController@getBuyBook'
	))->where('id', '[0-9]+');

	Route::post('/book/buy/', array(
		'as' => 'buy-book-post',
		'uses' =>  'BookController@postBuyBook'
	));

}); 


/* 
Unauthenticated group 
*/
Route::group(array('before' => 'guest'), function() {
	
	/* 
	CSRF protection group 
	*/
	Route::group(array('before' => 'csrf'), function() {
		/* 
		Create account (post part) 
		*/
		Route::post('/account/create', array(
			'as' => 'account-create-post', 
			'uses' => 'AccountController@postCreate'
		));

		/* 
		Sign in (post part) 
		*/
		Route::post('/account/sign-in', array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));

	});
});