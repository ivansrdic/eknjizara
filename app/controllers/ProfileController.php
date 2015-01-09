<?php
class ProfileController extends BaseController {

	public function getProfile($id) {
		// pronadi korisnika prema korisnickom imenu
		$user = User::find($id);
		if ($user == null) return View::make('profile', $user);

		// pronadi statistiku korisnika
		$statistics = ModelUsers::getUserStatistics($id);
		$total_bought_books = $statistics->total_bought_bookstore + $statistics->total_bought_users

		$viewParameters = array(
			'total_bought_books' => $total_bought_books; 
	        'total_bought_bookstore' => $statistic->total_bought_bookstore;
	        'total_bought_users' => $statistic->total_bought_users;
	        'total_price_books' => $statistic->total_price_books;
	        'number_of_client_partners' => $statistic->number_of_client_partners;
	        'user_rank' => $statistic->user_rank; 
	    );

		var_dump($viewParameters);
		return View::make('profile', array('user' => $viewParameters));
	}


	public function getPartnerList() {
		$partners = ModelUsers::getPartners();
		// zelic treba srediti funkciju
		return View::make('client-partner-list', $partners);
	}


	public function getRegisteredClients() {
		// provjera administratorskih ovlasti
		if (! Auth::user()->isAdmin()) 
			return Redirect::route('home') 
				->with('global', 'You do not have permission for this action.');
		
		$users = ModelUsers::getUsers();
		$viewParameters = array();

		foreach ($users as $user) {
            $full_name = $users . $user->name . " " . $user->lastname;

            array_push($viewParameters, array(
                'full_name' => $full_name,
                'username' => $users->username,
                'email' => $user->email
            );
        }

        var_dump($viewParameters);
		return View::make('admin-registered-list', array('users' => $viewParameters));
	}


	public function getBookstoreStatistics() {
		// provjera administratorskih ovlasti
		if (! Auth::user()->isAdmin()) 
			return Redirect::route('home') 
				->with('global', 'You do not have permission for this action.');

		$viewParameters = BookstoreStatistics::all()->first;
		var_dump($viewParameters);
		return View::make('profile', $viewParameters);
	}


}