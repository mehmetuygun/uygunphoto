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

Route::get('/', 'HomeController@Home');

Route::any('/register', 'HomeController@Register');

Route::any('/upload', 'HomeController@Upload');

Route::any('/login', array('before' => 'user', 'uses'=> 'HomeController@Login'));

Route::get('/photo/{id}', array('before' => 'image', 'uses' => 'PhotoController@Home'));

Route::get('/profile/{id}', array('before' => 'profile', 'uses' => 'PhotoController@Profile'));

Route::post('/ajax/comment', 'PhotoController@Comment');

Route::get('/logout', function()
{
	Auth::logout();
	return Redirect::to('/login');
});

Route::get('/admin', function() 
{
	return Redirect::to('/admin/dashboard');
});

Route::get('/admin/logout', function()
{
	Auth::logout();
	return Redirect::to('/admin/login');
});

Route::any('/admin/login', array('after' => 'admin', 'uses' => 'AdminController@Login'));

Route::get('/admin/dashboard',  array('before' => 'admin', 'uses' => 'AdminController@Dashboard'));

Route::get('/admin/comment',  array('before' => 'admin', 'uses' => 'AdminCommentController@Index'));

Route::get('/admin/photo',  array('before' => 'admin', 'uses' => 'AdminPhotoController@Index'));

Route::any('/admin/comment/edit/{id}',  array('before' => 'admin|comment', 'uses' => 'AdminCommentController@Edit'));
Route::any('/admin/photo/edit/{id}',  array('before' => 'admin|photo', 'uses' => 'AdminPhotoController@Edit'));
Route::any('/admin/user/edit/{id}',  array('before' => 'admin', 'uses' => 'AdminUserController@Edit'));
Route::any('/admin/user/profile',  array('before' => 'admin', 'uses' => 'AdminUserController@Profile'));
Route::any('/admin/user/password',  array('before' => 'admin', 'uses' => 'AdminUserController@Password'));

Route::get('/admin/user',  array('before' => 'admin', 'uses' => 'AdminUserController@Index'));

Route::any('/admin/comment/ajax/active',  array('before' => 'admin', 'uses' => 'AdminCommentController@Active'));
Route::any('/admin/photo/ajax/active',  array('before' => 'admin', 'uses' => 'AdminPhotoController@Active'));

Route::any('/admin/comment/ajax/delete',  array('before' => 'admin', 'uses' => 'AdminCommentController@Delete'));
Route::any('/admin/user/ajax/delete',  array('before' => 'admin', 'uses' => 'AdminUserController@Delete'));
Route::any('/admin/photo/ajax/delete',  array('before' => 'admin', 'uses' => 'AdminPhotoController@Delete'));

Route::get('/email', function() 
{
	return View::make('email/reminder');

	// $data = array();

	// Mail::send('email.basic', $data, function($message)
	// {
 //    	$message->to('mehmet.uygun@outlook.com', 'John Smith')->subject('Welcome!');
	// });
});

App::missing(function($exception) {
	return '404';
});
