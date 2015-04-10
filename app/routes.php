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

Route::get('/', function()
{
	return View::make('new');
});

Route::post('/attach', array('as' => 'attach', 'uses' => 'HomeController@attach'));

Route::get('/deleteall', array('as' => 'deleteall', 'uses' => 'HomeController@deleteAll'));