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
		$book->book_title = 'Gospodar prstenova: Povratak kralja';
		$book->link_picture = 'images/book-covers/1.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.gospodar_prstenova_povratak_kralja.hr';
		$book->description = 'Povratak kralja je treća knjiga u triologiji Gospodar prstenova koju je napisao J.R.R. Tolkien. Putovanje Froda, Goluma i Sama se bliži kraju. Sauronova vojska je napala Minas Tirith, glavni grad Gondora, u posljednjem napadu na čovječanstvo. Kralj Teoden od Rohana ide u pomoć Gondoru dok Gandalf pokušava da organizuje odbranu. Aragorn, Legolas i Gimli idu po još pomoći. Prsten polako uništava Frodovu dušu.';


		$author = new Author();
		$author->author_name = 'J.R.R';
		$author->author_lastname = 'Tolkien';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'adventure';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Gospodar prstenova: Dvije kule';
		$book->link_picture = 'images/book-covers/2.jpg';
		$book->pagenumber = 270;
		$book->publication_year = 2006;
		$book->link_to_PDF = 'www.gospodar_prstenova_dvije_kule.hr';
		$book->description = 'Dok Frodo i Sam nastavljaju svoj put u Mordor kako bi uništili Prsten i upoznaju Golluma, njegova bivšeg vlasnika. Aragorn, Legolas i Gimli nailaze na rat u Rohanu i na preporođenog Gandalfa, prije Bitke kod Helmove klisure, dok Merry i Pippin bježe iz zarobljeništva i upoznaju Drvobradaša, divovsko stablo.';

		ModelBooks::addBook($book, array($author), $genres, 250);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter i Kamen mudraca';
		$book->link_picture = 'images/book-covers/3.jpg';
		$book->pagenumber = 230;
		$book->publication_year = 2006;
		$book->link_to_PDF = 'www.Harry_Potter_i_kamen_mudraca.hr';
		$book->description = 'Roditelji Harryja Pottera stradali su dok je još bio jednogodišnja beba. Deset je dugih i neveselih ljeta Harry proveo kao neželjen gost pod krovom Dursleyjevih, pod grdnjom navijek ljute tete Petunije, pod podozrivim pogledom neugodnog tetka Vernona i pod pakosnim udarcima bratića Dudleyja.
			A onda, netom pred njegov jedanaesti rođendan, počela su stizati pisma! Tajanstvena pisma naslovljena na gospodina Harryja Pottera, opasna pisma koja mu tetak Vernon nikako nije želio pokazati, čarobna pisma ispisana smaragdnozelenom tintom, iz kojih bi Harry mogao saznati istinu! 
			A istina je da Harryjevi roditelji nisu poginuli u prometnoj nesreći, i istina je da Harry Potter nije sasvim običan dječak, i istina je da na jesen ipak neće morati krenuti u peti razred obližnje škole.
			Harry Potter je naime izravno i pismeno pozvan u Hogwarts, najpoznatiju školu vještičarenja i čarobnjaštva, jer Harry Potter je zapravo prirodno nadaren čarobnjak, kao što su bili i njegovi roditelji. Harry Potter je čak i više od toga: u svijetu čarobnjaka Harry Potter je legenda, samo što on o tome još uopće nema pojma.';

		$author = new Author();
		$author->author_name = 'J.K.';
		$author->author_lastname = 'Rowling';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'adventure';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 300);
		unset($book);

		$book = new Book();
		$book->book_title = 'Harry Potter i Darovi smrti';
		$book->link_picture = 'images/book-covers/4.jpg';
		$book->pagenumber = 120;
		$book->publication_year = 2007;
		$book->link_to_PDF = 'www.Harry_Potter_i_Darovi_smrti.hr';
		$book->description = 'Harry Potter i Darovi smrti sedmi je i ujedno posljednji roman iz serije o Harryju Potteru britanske spisateljice J. K. Rowling. Knjiga je u prodaju puštena 21. srpnja 2007. i time je zaključena serija koja je započela izdavanjem knjige Harry Potter i Kamen mudraca 10 godina ranije, odnosno 1997. godine. Ova, posljednja, knjiga opisuje događaje koji vode do dugo očekivane posljednje bitke između Harryja Pottera i njegovih saveznika te nikad moćnijeg Lorda Voldemorta i njegovih podanika, Smrtonoša.';

		ModelBooks::addBook($book, array($author), $genres, 290);
		unset($book);


		$book = new Book();
		$book->book_title = 'Combray';
		$book->link_picture = 'images/book-covers/5.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.combray.hr';
		$book->description = 'Combray je kronološki početak cijelog opusa i ishodište njegove fabule u kojoj se prikazuje postupno prerastanje osjetljivog dječaka u zrelog umjetnika. U njemu se nalaze sve Prustovske teme u samom svom začetku, pojavljuju se najvažniji likovi romana i postavlja se metafizička zagonetka o svrsi života za koju će se naći odgovor tek na kraju ciklusa u romanu Pronađeno vrijeme.';

		$author = new Author();
		$author->author_name = 'Marcel';
		$author->author_lastname = 'Proust';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'modernist';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Baraka pet be';
		$book->link_picture = 'images/book-covers/6.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.baraka_pet_be.hr';
		$book->description = 'Opisuje se život u jednoj baraci koja zbrinjava ranjenika. Na mjesto broj 8 u baraku dolazi ranjenik Vidović za kojeg je prognoza smrt u roku od jednog dana. Front je probijen (radi se o II. svjetskom ratu, logor – baraka je smješten negdje oko granice s Rusijom), svi napeto iščekuju prekid puškaranja, tj. da se puškaranje od njih udalji. Kad je ipak fronta odbačena dalje od barake grof priređuje mimohod u čast pobjede.';


		$author = new Author();
		$author->author_name = 'Miroslav';
		$author->author_lastname = 'Krleža';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'novel';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Zlatarovo zlato';
		$book->link_picture = 'images/book-covers/7.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.zlatarovo_zlato.hr';
		$book->description = 'Autor je ispripovjedio ljubavnu priču građanke Dore Krupićeve i plemića Pavla Gregorijanca te sukob Zagrepčana i medvedgradskoga vlastelina Stjepka Gregorijanca.';

		$author = new Author();
		$author->author_name = 'August';
		$author->author_lastname = 'Šenoa';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'novel';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Alkar';
		$book->link_picture = 'images/book-covers/8.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.alkar.hr';
		$book->description = 'U podtekstu svoga Alkara Šimunović u konačnici afirmira tezu o tome da je društvo, odnosno sredina sa svojim kolektivom, pravilima i običajima, uvijek jača od pojedinca i da svako izdvajanje, odnosno funkcioniranje bez uporišta, biva osuđeno na neuspjeh.';


		$author = new Author();
		$author->author_name = 'Dinko';
		$author->author_lastname = 'Šimunović';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'action';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Kraljević i prosjak';
		$book->link_picture = 'images/book-covers/9.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.kraljevic_i_prosjak.hr';
		$book->description = 'Nevjerojatan, ali ne i nemoguć. Zamršen, ali ne i nepregledan te, što je najvažnije, napet i uzbudljiv. Twain je u ovome romanu umješnošću pravoga maestra rekonstruirao atmosferu Engleske iz 16. st., koju obilježava kraj vladavine engleskoga kralja Henrika VIII. i početak kraljevanja njegova sina kralja Edwarda VI. Zahvaljujući Twainovu talentu, roman Kraljević i prosjak zabavan je, akcijski dječji roman, a ujedno i vrstan portret jedne epohe.';


		$author = new Author();
		$author->author_name = 'Mark';
		$author->author_lastname = 'Twain';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'comedy';
		$genres[1]->genre_name = 'adventure';

		ModelBooks::addBook($book, array($author), $genres, 235);
		unset($book);


		$book = new Book();
		$book->book_title = 'Lovac u žitu';
		$book->link_picture = 'images/book-covers/10.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.lovac_u_zitu.hr';
		$book->description = '17-godišnji Holden Caulfield prepričava svoja iskustva iz prijašnje godine svoga života (kada je imao 16 godina). Holden je izbačen iz Pencey Preparatory School (privatna srednja škola koju pohađa), nakon što pada iz svih predmeta osim engleskog jezika. Holden odlazi u New York, planirajući provesti par dana u gradu prije nego što ode kući i obavijesti roditelje. Knjiga, pisana u prvom licu, prepričava ta tri dana provedena u New Yorku. Knjiga zapravo, od početka, opisuje 72 sata u Holdenovu životu, od čega on 48 sati provodi skitajući New Yorkom, nakon što je izbačen iz škole, u predbožićno vrijeme.';


		$author = new Author();
		$author->author_name = 'J.D.';
		$author->author_lastname = 'Salinger';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'adventure';
		
		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Pakao';
		$book->link_picture = 'images/book-covers/11.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.pakao.hr';
		$book->description = 'Pakao (Inferno) je dio Božanstvene komedije. Priča pakla jest da se Dante u trideset i petoj godini našao u mračnoj i divljoj šumi. Lutao je čitavu noć, dok u zoru nije izašao iz nje i naišao na podnožje nekog brda. Ugledavši ga, počne se penjati, ali mu na put stanu tri zvijeri i to: pantera, lav i vučica. Htjele bi da se vrati odakle je i izašao. Od tih zvijeri spasi ga Vergilije, slavni rimski pjesnik, autor Eneide, pozivajući ga da krene sa njim kroz pakao i čistilište, a da bi došao do raja trebat će mu pratnja Beatrice (njegove ljubavi i u pravom životu koja je umrla mlada).';


		$author = new Author();
		$author->author_name = 'Dante';
		$author->author_lastname = 'Alighieri';

		$genres = array(new Genre(), new Genre());
		$genres[0]->genre_name = 'epic poem';
		$genres[1]->genre_name = 'fantasy';

		ModelBooks::addBook($book, array($author), $genres, 876);
		unset($book);


		$book = new Book();
		$book->book_title = 'Prijan Lovro';
		$book->link_picture = 'images/book-covers/12.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.prijan_lovro.hr';
		$book->description = 'Pripovijetkom Prijan Lovro, "crticom po istini", August Šenoa po prvi put u hrvatsku književnost uvodi kasnije često obrađivanu temu: tragičnu sudbinu intelektualca seoskog podrijetla, čiji teški životni put završava tragedijom. Glavni junak je pohrvaćeni slovenski jezikoslovac, pripovjedačev prijatelj sa studija iz Praga, Lovro, koji zbog materijalnih i ljubavnih nevolja život završava samoubojstvom.';


		$author = new Author();
		$author->author_name = 'August';
		$author->author_lastname = 'Šenoa';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'short story';

		ModelBooks::addBook($book, array($author), $genres, 128);
		unset($book);


		$book = new Book();
		$book->book_title = 'Prokleta avlija';
		$book->link_picture = 'images/book-covers/13.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.prokleta_avlija.hr';
		$book->description = 'U romanu o Prokletoj avliji, zlogasnom zatvoru Depositou Carigradu, sjecištu »rasa i naroda«, mjesto u koje dolazi sve što se »svakodnevno pritvara i hapsi« (...), »po krivici ili pod sumnjom krivice«, Andrić je na samo stotinjak stranica ostvario pravo čudo pripovjedačkoga umijeća.';


		$author = new Author();
		$author->author_name = 'Ivo';
		$author->author_lastname = 'Andrić';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'novel';

		ModelBooks::addBook($book, array($author), $genres, 200);
		unset($book);


		$book = new Book();
		$book->book_title = 'Stranac';
		$book->link_picture = 'images/book-covers/14.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.stranac.hr';
		$book->description = 'U strogo književnoumjetničkom smislu roman Stranac najbolje je Camusovo djelo. To je priča o činovniku Meursaultu, koji dobiva obavijest da mu je umrla majka u ubožnici. On odlazi na pogreb, no ljudi se čude njegovom "hladnom" držanju: nije se rasplakao, nije želio majku čak ni vidjeti, razmišljao je jedino o tome da je majka ovdje živjela kako je mogla i sebi nema što predbacivati.';


		$author = new Author();
		$author->author_name = 'Albert';
		$author->author_lastname = 'Camus';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'thriller';

		ModelBooks::addBook($book, array($author), $genres, 523);
		unset($book);


		$book = new Book();
		$book->book_title = 'Životinjska farma';
		$book->link_picture = 'images/book-covers/15.jpg';
		$book->pagenumber = 250;
		$book->publication_year = 2005;
		$book->link_to_PDF = 'www.zivotinjska_farma.hr';
		$book->description = 'Životinjska farma govori o grupi životinja koji su osvojili farmu za sebe i uživali do jednog perioda otkad je počeo teror i patnja. Pisana je za vrijeme II. svjetskog rata, a izdana je 1945., no slavu je doživjela tek za vrijeme 1950-ih.';


		$author = new Author();
		$author->author_name = 'Geroge';
		$author->author_lastname = 'Orwell';

		$genres = array(new Genre());
		$genres[0]->genre_name = 'satire';

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