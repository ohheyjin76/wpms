<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@index');

Route::resource('posts', 'PostsController');
Route::resource('posts.comments', 'PostsCommentController');

Route::get('auth', function(){
	$credentials = [
		'email' => 'jone@gmail.com',
		'password' => 'password'
	];

	if(! Auth::attempt($credentials)) {
		return 'Incorrect username or password combination';
	}

	return redirect('protected');
});

Route::get('auth/logout', function(){
	Auth::logout();
	return 'See you again~';
});

Route::get('protected', [
	'middleware' => 'auth',
	function(){
		return 'Welcome back, ' . Auth::user()->name;
	}
]);

//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
