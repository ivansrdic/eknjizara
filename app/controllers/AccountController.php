<?php 
class AccountController extends BaseController {

	public function postSignIn() {
		$validator = Validator::make(Input::all(),
		 array(
		 	'usernameLogin' => 'required',
		 	'password' => 'required'
		 	)
		 );

		if($validator->fails()) {
			return Redirect::route('home')
				->withErrors($validator)
				->withInput();
		} else {


			$remember = (Input::has('remember')) ? true : false;
			
			$auth = Auth::attempt(array(
				'username' => Input::get('usernameLogin'),
				'password' => Input::get('password'),
				'active' => 1
			), $remember);
		
			if($auth) {
				// Redirect to the intended page
				return Redirect::intended('profile'); 
			} else {
				return Redirect::route('home')
					->with('global', 'Email or password wrong, or account not activated.');
			}

		}
	

		return Redirect::route('home')
				->with('global', 'There was a problem signing you in.');

	}

	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home'); 
	}

	/* Submitting the form for account creation */ 
	public function postCreate() {

		$validator = Validator::make(Input::all(),
			array(
				'name'            => 'required|max:50|min:1',
				'lastname'        => 'required|max:50|min:1',
				'email'           => 'required|max:50|email|unique:users',
				'username'        => 'required|max:20|min:3|unique:users',
				'password'        => 'required|min:6'
				) 
			);



		if($validator->fails()) {
				return Redirect::route('home')
				->withErrors($validator)
				->withInput(); 
		} else {
				$name     = Input::get('name'); 
				$lastname = Input::get('lastname');
				$email    = Input::get('email');
				$username = Input::get('username');
				$password = Input::get('password'); 

				$user = User::create(array(
					'name'     => $name,
					'lastname' => $lastname,
					'email'    => $email,
					'username' => $username,
					'password' => Hash::make($password),
					'active'   => 1
				));

				if($user->save()) {
					$statistic = new User_Statistics(); 
			        $statistic->user_rank = '0'; 
			        $statistic->total_bought_bookstore = '0';
			        $statistic->total_bought_users = '0';
			        $statistic->total_price_books = '0';
			        $statistic->number_of_client_partners = '0';
			        $user->statistics()->save($statistic); 
		            return Redirect::route('home')
		                            ->with('global','Your account has been created!');
		        } else {
		        	return Redirect::route('home')
		                            ->with('global','Your account has not been created!');
		        }

		}

	}	
}