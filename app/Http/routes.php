<?php
/**
 * Nom : Bertrand Nicolas
 * Nom du fichier : routes.php
 * Description : Fichier contenant les routes
 */
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

Route::group(['middleware' => ['web']], function () { //Route global
    Route::auth();

	Route::get('/', function () { //Lorsque on accède au site
		return view('index');
	});

	Route::get('/home', 'HomeController@show'); //Si on accède à home on appelle la fonction show dans HomeController.php
  Route::get('/actuality', 'ActualityController@show');

  Route::group(['prefix' => 'actuality', 'middleware' => ['auth']], function ()
  { //Pour pouvoir accéder à ces pages il faut être authentifié
    Route::post('add', 'ActualityController@create');
    Route::get('delete/{id}', 'ActualityController@delete');
    Route::get('modify/{id}', 'ActualityController@showFormModify');
    Route::post('modify', 'ActualityController@modify');
  });


  Route::group(['middleware' => ['auth']], function() {
      Route::get('/home/edit', 'UserController@showForm');
      Route::post('/home/edit', 'UserController@processForm');

      Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
      { //Pour pouvoir accéder à ces pages il faut être administrateur
          Route::get('/admin', 'AdminController@show');
          Route::post('/admin', 'AdminController@processForm');
      });

  });

});
