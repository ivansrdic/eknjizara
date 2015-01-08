<?php 
class AccountController extends BaseController {

	public function postSignIn() {
		$validator = Validator::make(Input::all(),
		 array(
		 	'username' => 'required',
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
				'username' => Input::get('username'),
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
		            return Redirect::route('home')
		                            ->with('global','Your account has been created!');
		        } else {
		        	return Redirect::route('home')
		                            ->with('global','Your account has not been created!');
		        }

		}

	}

<<<<<<< HEAD
=======
	public function getActivate ($code) {
    /*  Method called when user clicks on link for account activation */
    $user = User::where('code','=',$code)->where('active','=',0)->first();

    if ($user) {
        //Update user to active state
        $user->active = 1;
        $user->code ='';

        if($user->save()) {
            return Redirect::route('home')
                            ->with('global','Your account is activated!');
        }
    }

    return Redirect::route('home')
                    ->with('global', 'We could not activate your account. Try again later');
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
>>>>>>> 3bbd6616beca2d9c7d204463b661221e894938e7
}