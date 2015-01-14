<?php
class ProfileController extends BaseController {

	public function getProfile() {
		// pronadi korisnika prema korisnickom imenu
		$user = Auth::user();
		$id = $user->id;

		if($user->isAdmin) {
			// pronađi statistiku knjižare
			$statistics = ModelUsers::getBookstoreStatistics();

			$viewParametersStatistics = array(
				'total_number_of_titles' => $statistics->total_number_of_titles, 
		        'total_number_of_sold_titles' => $statistics->total_number_of_sold_titles,
		        'total_earnings' => round($statistics->total_earnings, 2),
		        'commission_earnings' => round($statistics->commission_earnings, 2)
		    );
			

		    return View::make('profile', array('bookstore' => $viewParametersStatistics));
		} else {
			// pronadi statistiku korisnika
			$statistics = ModelUsers::getUserStatistics($id);
			$total_bought_books = $statistics->total_bought_bookstore + $statistics->total_bought_users;

			$viewParametersStatistics = array(
				'total_bought_books' => $total_bought_books, 
		        'total_bought_bookstore' => $statistics->total_bought_bookstore,
		        'total_bought_users' => $statistics->total_bought_users,
		        'total_price_books' => $statistics->total_price_books,
		        'number_of_client_partners' => $statistics->number_of_client_partners,
		        'user_rank' => $statistics->user_rank 
		    );

			// pronadi kupljene knjige od tog korisnika
			$purchases = ModelUsers::getBoughtBooks(Auth::user());
			$viewParametersBooks = array();

			if($purchases != null) {
				foreach ($purchases as $purchase) {
					$book = Book::find($purchase->pivot->book_id_foreign);

		            array_push($viewParametersBooks, array(
		                'book_title' => $book->book_title,
		                'price' => $purchase->pivot->purchase_price,
		                'date' => $purchase->pivot->created_at,
		                'seller' => User::find($purchase->pivot->user_id_seller)->username,
		                'book_description' => route('book', $book->book_id),
		                'book_certificate' => $purchase->pivot->certificate_link,
		                'book_pdf' => $purchase->pivot->link_to_PDF
		            ));
		        }
		    }

			return View::make('profile', array('user' => $viewParametersStatistics, 'books' => $viewParametersBooks));
		}
	}


	public function getChangePassword() {
		return View::make('edit-profile');
	}

	public function postChangePassword() {
		$validator = Validator::make(Input::all(),
			array(
				'old_password'	  => 'required',
				'password'		  => 'required|min:6'
			)
		);

		if($validator->fails()) {
			return Redirect::route('account-change-password')
				->withErrors($validator);
		} else {
			$user 		  = Auth::user();
			$old_password = Input::get('old_password');
			$password 	  = Input::get('password');

			if(Hash::check($old_password, $user->getAuthPassword())){
				$user->password = Hash::make($password);

				if($user->save()) {
					return Redirect::route('edit')
						->with('global', 'Your password has been changed.');
				} else {
					return Redirect::route('edit-profile')
						->with('global', 'Your password could not be changed.');
				}
			} else {
				return Redirect::route('edit')
					->with('global', 'Your old password is incorrect.');
			}
		}
	}


	public function getPartnerList() {
		$user = Auth::user();
		$partners = array();  
		
		$purchases = DB::table('purchase_book')				// dohvaćanje iz purchase_book kupaca/prodavača prema id-u trenutno ulogiranog usera 
                    ->where('user_id', '=', $user->id)
                    ->orWhere('user_id_seller', $user->id)
                    ->get();
     
		foreach($purchases as $purchase) {
		 		$user_seller = $purchase->user_id_seller; 
		 		if ($purchase->user_id == $user->id && $purchase->user_id_seller == 1) {    // kupljeno -> ispisuje user_id_seller od koga je kupio 
		 				array_push($partners, 
		 			 		array(
			                	'username' => User::find($user_seller)->username,
			                	'book_title' => Book::find($purchase->book_id_foreign)->book_title,
			                	'sold/bought' => 'Kupio od knjizare',
			                	'created_at' => $purchase->created_at
	         			));
	         	} else if ($purchase->user_id == $user->id ) {
	         			array_push($partners, 
		 			 		array(
			                	'username' => User::find($user_seller)->username,
			                	'book_title' => Book::find($purchase->book_id_foreign)->book_title,
			                	'sold/bought' => 'Kupio od klijenta',
			                	'created_at' => $purchase->created_at
	         			));
		 		} else if ($purchase->user_id_seller == $user->id) {   // prodana -> ispisuje klijenta kojem je prodana 
		 				 array_push($partners, 
		 			 		array(
		                		'username' => User::find($purchase->user_id)->username,
		                		'book_title' => Book::find($purchase->book_id_foreign)->book_title,
		                		'sold/bought' => 'Prodano klijentu',
		                		'created_at' => $purchase->created_at
	         			));
	         	}
	     }
		return View::make('client-partner-list', array('partners' => $partners));
	}

	public function getPartnerProfile($username) {
		$user = User::where('username', '=', urldecode($username))->first();
		$statistics = ModelUsers::getUserStatistics($user->id);
		$total_bought_books = $statistics->total_bought_bookstore + $statistics->total_bought_users;

		$viewParameters = array(
			'username' => $user->username,
			'email' => $user->email,
			'total_bought_books' => $total_bought_books, 
	        'total_bought_bookstore' => $statistics->total_bought_bookstore,
	        'total_bought_users' => $statistics->total_bought_users,
	        'total_price_books' => $statistics->total_price_books,
	        'number_of_client_partners' => $statistics->number_of_client_partners,
	        'user_rank' => $statistics->user_rank 
	    );
		return View::make('partner-profile', array('user' => $viewParameters));
	}



	public function getRegisteredClients() {
		// provjera administratorskih ovlasti
		if (! Auth::user()->isAdmin) 
			return Redirect::route('home') 
				->with('global', 'You do not have permission for this action.');
		
		$users = ModelUsers::getUsers();
		$viewParameters = array();

		foreach ($users as $user) {
			if($user->username != 'eknjizara') {
	            $full_name = $user->name . " " . $user->lastname;

	            array_push($viewParameters, array(
	                'full_name' => $full_name,
	                'username' => $user->username,
	                'email' => $user->email
	            ));
	        }
        }

		return View::make('admin-registered-list', array('users' => $viewParameters));
	}


	/*public function getBookstoreStatistics() {
		// provjera administratorskih ovlasti
		if (! Auth::user()->isAdmin) 
			return Redirect::route('home') 
				->with('global', 'You do not have permission for this action.');

		$viewParameters = BookstoreStatistics::all()->first;
		return View::make('profile', $viewParameters);
	}*/

	public function getBookList() {
		// provjera administratorskih ovlasti
		if (! Auth::user()->isAdmin) 
			return Redirect::route('home') 
				->with('global', 'You do not have permission for this action.');
		
		$allBooks = Book::orderBy('book_title', 'asc')->get()->all();

        for($i = 0; $i < count($allBooks); $i++) {
            $authors = "";
            foreach ($allBooks[$i]->authors as $author) {
                $authors = ($authors == "") ? "" : $authors . ", ";
                $authors = $authors . $author->author_name . " " . $author->author_lastname;
            }
            $tmp = array(
            	'book_id' => $allBooks[$i]->book_id,
                'book_title' => $allBooks[$i]->book_title,
                'authors' => $authors,
                'link_to_PDF' => $allBooks[$i]->link_to_PDF,
                'price' => ($allBooks[$i]->stack) ? ($allBooks[$i]->stack->price):("N/A")
            );
            $allBooks[$i] = $tmp;
        }

        return View::make('admin-book-list', array('books' => $allBooks));
	}

}

?>