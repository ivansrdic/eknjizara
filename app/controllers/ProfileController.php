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

		$viewParameters = array(
			'total_bought_books' => $total_bought_books, 
	        'total_bought_bookstore' => $statistics->total_bought_bookstore,
	        'total_bought_users' => $statistics->total_bought_users,
	        'total_price_books' => $statistics->total_price_books,
	        'number_of_client_partners' => $statistics->number_of_client_partners,
	        'user_rank' => $statistics->user_rank 
	    );

		return View::make('profile', array('user' => $viewParameters));
	}


	public function getChangePassword() {
		return View::make('account.password');
	}

	public function postChangePassword() {
		$validator = Validator::make(Input::all(),
			array(
				'old_password'	  => 'required',
				'password'		  => 'required|min:6',
				'password_repeat' => 'required|same:password'
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
					return Redirect::route('home')
						->with('global', 'Your password has been changed.');
				} else {
					return Redirect::route('home')
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