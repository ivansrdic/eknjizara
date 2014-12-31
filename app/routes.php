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

Route::get('/', array(
	'as' => 'home',
	function() {
	return View::make('home');
}));

Route::get('/profile', array(
	'as' => 'profile',
	function() {
		return View::make('profile');
}));

Route::get('/profile/edit', array(
	'as' => 'edit',
	function() {
		return View::make('edit-profile');
}));

Route::get('/profile/add-book', array(
	'as' => 'add-book',
	function(){
		return View::make('add-book');
}));

Route::get('/profile/admin-book-list', array(
	'as' => 'admin-book-list',
	function(){
		return View::make('admin-book-list');
}));

Route::get('/profile/admin-registered-list', array(
	'as' => 'admin-registered-list',
	function(){
		return View::make('admin-registered-list');
}));

Route::get('/profile/client-partner-list', array(
	'as' => 'client-partner-list',
	function(){
		return View::make('client-partner-list');
}));

Route::get('/search', array(
	'as' => 'search',
	function() {
		return View::make('search');
}));

Route::get('/book/{id}', array(
	'as' => 'book',
	function($id) {
		return View::make('book');
}))->where('id', '[0-9]+');

Route::get('/book/buy/{id}', array(
	'as' => 'buy',
	function($id) {
		return View::make('buy');
}))->where('id', '[0-9]+');


 // ************************************************************************ // 

 /* Login / sign out sign in */

 /* 
Authenticated group 
*/
Route::group(array('before' => 'auth'), function() {

	/* 
	Sign out (get part)
	*/
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
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

	/* 
	Sign in (get part) 
	*/
	Route::get('/account/sign-in', array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));

	
	/* 
	Create account (get part) 
	*/
	Route::get('/account/create', array(
		'as' => 'account-create', 
		'uses' => 'AccountController@getCreate'
		));


	Route::get('/account/activate/{code}', array(
		'as' => 'account-activate', 
		'uses' => 'AccountController@getActivate'
	));


});