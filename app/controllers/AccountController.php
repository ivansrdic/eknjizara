<?php 
class AccountController extends BaseController {

	public function getSignIn() {
		return View::make('account.signin');
	}

	public function postSignIn() {
		$validator = Validator::make(Input::all(),
		 array(
		 	'email' => 'required|email',
		 	'password' => 'required'
		 	)
		 );

		if($validator->fails()) {
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();
		} else {


			$remember = (Input::has('remember')) ? true : false;
			
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			), $remember);
		
			if($auth) {
				// Redirect to the intended page
				return Redirect::intended('/'); 
			} else {
				return Redirect::route('account-sign-in')
					->with('global', 'Email or password wrong, or account not activated.');
			}

		}
	

		return Redirect::route('account-sign-in')
				->with('global', 'There was a problem signing you in.');

	}

	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home'); 
	}

	/*  Viewing the form for account creation*/
	public function getCreate() {
		return View::make('account.create');
	}

	/* Submitting the form for account creation */ 
	public function postCreate() {

		$validator = Validator::make(Input::all(),
			array(
				'name'            => 'required|max:50|min:1',
				'lastname'        => 'required|max:50|min:1',
				'email'           => 'required|max:50|email|unique:users',
				'username'        => 'required|max:20|min:3|unique:users',
				'password'        => 'required|min:6', 
				'password_repeat' => 'required|same:password'
				) 
			);

		if($validator->fails()) {
				return Redirect::route('account-create')
				->withErrors($validator)
				->withInput(); 
		} else {
				$name     = Input::get('name'); 
				$lastname = Input::get('lastname');
				$email    = Input::get('email');
				$username = Input::get('username');
				$password = Input::get('password');
				
				// Activation code 
				$code = str_random(60); 

				$user = User::create(array(
					'name'     => $name,
					'lastname' => $lastname,
					'email'    => $email,
					'username' => $username,
					'password' => Hash::make($password),
					'code'     => $code,
					'active'   => 0
				));

				if($user) {

					// send email 
					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate',$code), 'username' => $username), function($message) use ($user) {
						/* use $user allows us to use $user-email */
						$message->to($user->email, $user->username)->subject('Activate your account'); 
					});

					return Redirect::route('home')
							->with('global', 'Your account has been created! We have sent you an email to activate your account.');
				}


		}

	}

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

}