<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function (){
	$res['success'] = true;
	$res['result'] = "Hello there welcome to web api using lumen tutorial!";
	return response($res);
});

// routes user
$router->post('/login', 'UserController@login');
$router->post('/register', 'UserController@register');
$router->get('/user/index', 'UserController@index');
$router->get('/user/delete/{id}', 'UserController@destroy');
$router->post('/user/update/{id}', 'UserController@update');
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);
//end routes user

// routes admin
$router->post('/admin/login', 'UserAdminController@login');
$router->post('/admin/register', 'UserAdminController@register');
$router->get('/admin/index', 'UserAdminController@index');
$router->get('/admin/delete/{id}', 'UserAdminController@destroy');
$router->post('/admin/update/{id}', 'UserAdminController@update');
$router->get('/admin/{id}', ['middleware' => 'auth', 'uses' =>  'UserAdminController@get_useradmin']);
//end routes admin

// routes rating paket
$router->post('/rating/store', 'RatingPaketController@store');
$router->post('/rating/update/{id}', 'RatingPaketController@update');
$router->get('/rating/index', 'RatingPaketController@index');
$router->get('/rating/show/{id}', 'RatingPaketController@show');
$router->get('/rating/destroy/{id}', 'RatingPaketController@destroy');
// end routes rating paket

// routes paket
$router->post('/paket/store', 'ItemPaketController@store');
$router->post('/paket/update/{id}', 'ItemPaketController@update');
$router->get('/paket/index', 'ItemPaketController@index');
$router->get('/paket/show/{id}', 'ItemPaketController@show');
$router->get('/paket/destroy/{id}', 'ItemPaketController@destroy');
// end routes paket

// routes user profile
$router->post('/profile/update', ['middleware' => 'auth', 'uses' =>  'UserController@updateProfile']);
$router->get('/profile/avatar/{name}', 'UserController@get_avatar');
