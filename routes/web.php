<?php


/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->group(['middleware'=>[]], function () use ($router){
	$router->get('/user','UserController@index');
	$router->get('/user/{id}','UserController@show');
	$router->post('/user','UserController@store');
	$router->patch('/user/{user}','UserController@update');
	$router->delete('/user/{id}','UserController@destroy');
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
