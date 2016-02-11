<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();

	Route::get('/', function () {
		return view('index');
	});

	Route::get('/home', 'HomeController@show');
  Route::get('/actuality', 'ActualityController@show');

  Route::group(['prefix' => 'actuality', 'middleware' => ['auth']], function () {
    Route::post('add', 'ActualityController@create');
    Route::get('delete/{id}', 'ActualityController@delete');
  });


  Route::group(['middleware' => ['auth']], function() {
      Route::get('/home/edit', 'UserController@showForm');
      Route::post('/home/edit', 'UserController@processForm');

  });

});
