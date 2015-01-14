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
		$book->link_picture = 'images/book-covers/1.jpg';
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
		$book->link_picture = 'images/book-covers/1.jpg';
		$book->pagenumber = 270;
		$book->publication_year = 2006;
		$book->link_to_PDF = 'www.gospodar_prstenova_2.hr';

		ModelBooks::addBook($book, array($author), $genres, 250);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter 1';
		$book->link_picture = 'images/book-covers/2.jpg';
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
		$book->link_picture = 'images/book-covers/3.jpg';
		$book->pagenumber = 120;
		$book->publication_year = 2007;
		$book->link_to_PDF = 'www.Harry_Potter_2.hr';

		ModelBooks::addBook($book, array($author), $genres, 290);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter I Gospodar Prstenova';
		$book->link_picture = 'images/book-covers/4.jpg';
		$book->pagenumber = 240;
		$book->publication_year = 2010;
		$book->link_to_PDF = 'www.Harry_Potter_lotr.hr';

		$authors = array(new Author(), new Author());
		$authors[0]->author_name = 'J.K.';
		$authors[0]->author_lastname = 'Rowling';
		$authors[1]->author_name = 'J.R.R';
		$authors[1]->author_lastname = 'Tolkien';
		
		ModelBooks::addBook($book, $authors, $genres, 10000);


		$book = new Book();
		$book->book_title = 'Combray';
		$book->link_picture = 'images/book-covers/5.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.combray.hr';


		$author = new Author();
		$author->author_name = 'Marcel';
		$author->author_lastname = 'Proust';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Baraka pet be';
		$book->link_picture = 'images/book-covers/6.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.baraka_pet_be.hr';


		$author = new Author();
		$author->author_name = 'Miroslav';
		$author->author_lastname = 'Krleža';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Zlatarovo zlato';
		$book->link_picture = 'images/book-covers/7.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.zlatarovo_zlato.hr';


		$author = new Author();
		$author->author_name = 'August';
		$author->author_lastname = 'Šenoa';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Alkar';
		$book->link_picture = 'images/book-covers/8.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.alkar.hr';


		$author = new Author();
		$author->author_name = 'Dinko';
		$author->author_lastname = 'Šimunović';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Kraljević i prosjak';
		$book->link_picture = 'images/book-covers/9.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.kraljevic_i_prosjak.hr';


		$author = new Author();
		$author->author_name = 'Mark';
		$author->author_lastname = 'Twain';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'comedy';
		$genres[1]->genre_name = 'drama';

		ModelBooks::addBook($book, array($author), $genres, 235);
		unset($book);


		$book = new Book();
		$book->book_title = 'Lovac u žitu';
		$book->link_picture = 'images/book-covers/10.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.lovac_u_zitu.hr';


		$author = new Author();
		$author->author_name = 'J.D.';
		$author->author_lastname = 'Salinger';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Pakao';
		$book->link_picture = 'images/book-covers/11.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.pakao.hr';


		$author = new Author();
		$author->author_name = 'Dante';
		$author->author_lastname = 'Alighieri';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'triler';
		$genres[1]->genre_name = 'biography';

		ModelBooks::addBook($book, array($author), $genres, 876);
		unset($book);


		$book = new Book();
		$book->book_title = 'Prijan Lovro';
		$book->link_picture = 'images/book-covers/12.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.prijan_lovro.hr';


		$author = new Author();
		$author->author_name = 'August';
		$author->author_lastname = 'Šenoa';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'sf';

		ModelBooks::addBook($book, array($author), $genres, 128);
		unset($book);


		$book = new Book();
		$book->book_title = 'Prokleta avlija';
		$book->link_picture = 'images/book-covers/13.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.prokleta_avlija.hr';


		$author = new Author();
		$author->author_name = 'Ivo';
		$author->author_lastname = 'Andrić';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Stranac';
		$book->link_picture = 'images/book-covers/14.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.stranac.hr';


		$author = new Author();
		$author->author_name = 'Albert';
		$author->author_lastname = 'Camus';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'comedy';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 523);
		unset($book);


		$book = new Book();
		$book->book_title = 'Životinjska farma';
		$book->link_picture = 'images/book-covers/15.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.zivotinjska_farma.hr';


		$author = new Author();
		$author->author_name = 'Geroge';
		$author->author_lastname = 'Orwell';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'action';
		$genres[1]->genre_name = 'drama';

		ModelBooks::addBook($book, array($author), $genres, 423);
		unset($book);


		$name = 'Ivan';
		$lastname = 'Srdić';
		$email = 'ivan.srdic@fer.hr';
		$username = 'ivansrdic';
		$password = Hash::make('123456');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);

		$name = 'Deni';
		$lastname = 'Zeleni';
		$email = 'deni@zeleni.hr';
		$username = 'greenie';
		$password = Hash::make('greenie');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);


		$name = 'Pero';
		$lastname = 'Masni';
		$email = 'pero@masni.hr';
		$username = 'mast';
		$password = Hash::make('mast');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
		

		$name = 'Seke';
		$lastname = 'Sekulić';
		$email = 'seke@lud.hr';
		$username = 'puding';
		$password = Hash::make('puding');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
		

		$name = 'Dario';
		$lastname = 'Košpa';
		$email = 'dario93@gmail.hr';
		$username = 'dario93';
		$password = Hash::make('dario93');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
		

		$name = 'Marko';
		$lastname = 'Radio';
		$email = 'marko.radio@fer.hr';
		$username = 'radio';
		$password = Hash::make('radio');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
	

		$name = 'Nikola';
		$lastname = 'Rabjac';
		$email = 'nikica@fer.hr';
		$username = 'nikica';
		$password = Hash::make('nikica');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
				

		$name = 'Haris';
		$lastname = 'Lončar';
		$email = 'harry@hotmail.hr';
		$username = 'harry34';
		$password = Hash::make('harry34');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
		

		$name = '¸Elton';
		$lastname = 'John';
		$email = 'elton.john@fer.hr';
		$username = 'faca';
		$password = Hash::make('faca');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
		

		$name = 'Elvis';
		$lastname = 'Presley';
		$email = 'elvis42@fer.hr';
		$username = 'king';
		$password = Hash::make('king');
		ModelUsers::createUser($name, $lastname, $email, $username, $password);
		

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
			'uses' => 'ProfileController@postChangePassword'
		));
	});

	/* 
	Change password (get part)
	*/
	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'ProfileController@getChangePassword'
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
		'uses' => 'ProfileController@getChangePassword'
	));

	Route::post('/profile/edit', array(
		'as' => 'edit',
		'uses' => 'ProfileController@postChangePassword'
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

	Route::get('partner-profile/{username}', array(
		'as' => 'partner-profile',
		'uses' => 'ProfileController@getPartnerProfile'
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

	Route::get('/book/delete/{id}', array(
		'as' => 'delete-book',
		'uses' => 'BookController@getDeleteBook'
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