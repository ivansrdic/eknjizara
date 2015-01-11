<?php
class ProfileController extends BaseController {

	public function getProfile() {
		// pronadi korisnika prema korisnickom imenu
		$id = Auth::id();
		$user = User::find($id);
		if ($user == null) return View::make('profile', $user);

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
		$purchases = Auth::user()->purchases();
		if(!is_array($purchases)) {
			$purchases = array($purchases);
		}
		$viewParametersBooks = array();

		if($purchases != null) {
			foreach ($purchases as $purchase) {
				var_dump($purchase);
				/*$book = Book::find($purchase->book_id_foreign);
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

	            array_push($viewParametersBooks, array(
	                'book_title' => $book->book_title,
	                'price' => $purchase->purchase_price,
	                'date' => $purchase->created_at,
	                'seller' => User::find($purchase->user_id_seller)->username,
	                'book_description' => route('book') . "/" . $book->id,
	                'book_certificate' => "",
	                'book_pdf' => route('home') . "pdf/" . $book->id . ".pdf"
	            ));*/
	        }
	    }

		return View::make('profile', array('user' => $viewParametersStatistics, 'books' => $viewParametersBooks));

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
			$user 		  = User::find(Auth::user()->id);
			$old_password = Input::get('old_password');
			$password 	  = Input::get('password');

			if(Hash::check($old_password, $user->getAuthPassword())){
				$user->password = Hash::make($password);

				if($user->save()) {
					return Redirect::route('edit')
						->with('global', 'Your password has been changed.');
				} else {
					return Redirect::route('edit')
						->with('global', 'Your old password is incorrect.');
				}
			}
		}

		return Redirect::route('account-change-password')
			->with('global', 'Your password could not be changed.');
	}


	public function getPartnerList() {
		$partners = ModelUsers::getPartners();
		// zelic treba srediti funkciju
		return View::make('client-partner-list', $partners);
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


	public function getBookstoreStatistics() {
		// provjera administratorskih ovlasti
		if (! Auth::user()->isAdmin) 
			return Redirect::route('home') 
				->with('global', 'You do not have permission for this action.');

		$viewParameters = BookstoreStatistics::all()->first;
		var_dump($viewParameters);
		return View::make('profile', $viewParameters);
	}

}