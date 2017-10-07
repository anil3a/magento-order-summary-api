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

$router->get('/', function() use ($router) {
    return 'Default Landing Page for this application. Please use corresponding url with valid request.';
});

$router->group(['prefix' => 'users/'], function() use ($router) {
    $router->get('/','UsersController@index'); //get all the routes	
    $router->post('/','UsersController@store'); //store single route
    $router->get('/{id}/', 'UsersController@show'); //get single route
    $router->put('/{id}/','UsersController@update'); //update single route
    $router->delete('/{id}/','UsersController@destroy'); //delete single route
});