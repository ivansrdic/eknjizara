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